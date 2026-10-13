<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ApotekController extends Controller
{
    private function ensureCanView(): void
    {
        abort_unless(
            auth()->check() && in_array(auth()->user()->role, ['admin', 'dokter', 'apoteker', 'farmasi'], true),
            403,
            'Anda tidak memiliki akses ke data resep farmasi.'
        );
    }

    private function ensurePharmacy(): void
    {
        abort_unless(
            auth()->check() && in_array(auth()->user()->role, ['apoteker', 'farmasi'], true),
            403,
            'Hanya petugas farmasi yang dapat menyerahkan obat.'
        );
    }

    public function index(Request $request)
    {
        $this->ensureCanView();

        $search = trim((string) $request->get('search', ''));
        $normalizedRm = preg_replace('/[^A-Za-z0-9]/', '', $search);

        $reseps = RekamMedis::with(['pasien', 'dokter', 'pendaftaran'])
            ->whereHas('pendaftaran', function ($query) {
                $query->whereDate('tanggal_daftar', now()->toDateString())
                    ->whereIn('status', ['menunggu_apotek', 'menunggu_obat', 'selesai']);
            })
            ->whereNotNull('resep_obat')
            ->where('resep_obat', '!=', '')
            ->when($search !== '', function ($query) use ($search, $normalizedRm) {
                $query->where(function ($q) use ($search, $normalizedRm) {
                    $q->whereHas('pasien', function ($pasien) use ($search, $normalizedRm) {
                        $pasien->where('nama', 'like', "%{$search}%")
                            ->orWhere('nik', 'like', "%{$search}%")
                            ->orWhere('no_rm', 'like', "%{$search}%");

                        if ($normalizedRm !== '') {
                            $pasien->orWhereRaw("REPLACE(REPLACE(no_rm, '-', ''), ' ', '') LIKE ?", ["%{$normalizedRm}%"]);
                        }
                    })
                    ->orWhereHas('dokter', fn ($dokter) => $dokter->where('name', 'like', "%{$search}%"))
                    ->orWhere('resep_obat', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        return view('apotek.index', compact('reseps', 'search'));
    }

    public function serahkanObat($pendaftaran_id)
    {
        $this->ensurePharmacy();

        try {
            DB::transaction(function () use ($pendaftaran_id) {
                $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);

                abort_unless(
                    in_array($pendaftaran->status, ['menunggu_apotek', 'menunggu_obat'], true),
                    422,
                    'Resep ini sudah diproses atau statusnya tidak valid.'
                );

                $pendaftaran->update(['status' => 'selesai']);
            });

            return redirect()->route('apotek.index')
                ->with('success', 'Obat berhasil diserahkan ke pasien dan pelayanan dinyatakan selesai!');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal memproses penyerahan obat: ' . $e->getMessage());
        }
    }

    public function cetak($id)
    {
        $this->ensureCanView();

        $rekamMedis = RekamMedis::with(['pasien', 'dokter', 'pendaftaran'])->findOrFail($id);

        return view('apotek.cetak', compact('rekamMedis'));
    }
}
