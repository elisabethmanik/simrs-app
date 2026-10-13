<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class OnlinePendaftaranController extends Controller
{
    /**
     * Halaman Utama Form Pendaftaran Online Pasien
     */
    public function index()
    {
        return view('pendaftaran-online.index');
    }

    /**
     * API Cek Data Pasien Lama & Riwayat Berobat via NIK / No. RM (AJAX)
     */
    public function checkPasien(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string',
        ]);

        $keyword = trim($request->keyword);

        $pasien = Pasien::where('no_rm', $keyword)
            ->orWhere('nik', $keyword)
            ->first();

        if (!$pasien) {
            return response()->json([
                'success' => false,
                'message' => 'Data pasien tidak ditemukan.'
            ], 404);
        }

        $riwayats = Pendaftaran::with('dokter')
            ->where('pasien_id', $pasien->id)
            ->orderBy('tanggal_daftar', 'desc')
            ->take(5)
            ->get();

        return response()->json([
            'success' => true,
            'pasien'  => $pasien,
            'riwayat' => $riwayats
        ], 200);
    }

    /**
     * API Cek Status Antrean / Booking via No. RM atau NIK
     */
    public function checkStatus($keyword)
    {
        try {
            $keyword = trim(urldecode($keyword));

            if (empty($keyword)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Masukkan No. RM atau NIK terlebih dahulu.'
                ], 200);
            }

            // 1. Cari data pasien berdasarkan NIK atau No. RM
            $pasien = Pasien::where('nik', $keyword)
                ->orWhere('no_rm', $keyword)
                ->first();

            if (!$pasien) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data pasien dengan NIK / No. RM tersebut tidak ditemukan.'
                ], 200);
            }

            // 2. Cari pendaftaran antrean paling baru milik pasien
            $pendaftaran = Pendaftaran::with(['pasien', 'dokter'])
                ->where('pasien_id', $pasien->id)
                ->latest()
                ->first();

            if (!$pendaftaran) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pasien ini belum memiliki pendaftaran / antrean aktif.'
                ], 200);
            }

            // Format otomatis kode booking menggunakan tanggal & nomor antrean
            $kodeBookingFormat = 'REG-' . date('Ymd', strtotime($pendaftaran->tanggal_daftar)) . '-' . sprintf('%03d', $pendaftaran->no_antrean);

            return response()->json([
                'success' => true,
                'data'    => [
                    'kode_booking'  => $pendaftaran->kode_booking ?? $kodeBookingFormat,
                    'nomor_antrean' => $pendaftaran->no_antrean,
                    'nama_pasien'   => $pendaftaran->pasien ? $pendaftaran->pasien->nama : '-',
                    'poli'          => $pendaftaran->poli,
                    'tanggal_daftar'=> Carbon::parse($pendaftaran->tanggal_daftar)->translatedFormat('d F Y'),
                    'status'        => $pendaftaran->status,
                    'nama_dokter'   => $pendaftaran->dokter ? $pendaftaran->dokter->name : 'Akan ditentukan saat panggilan',
                ]
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 200);
        }
    }

    /**
     * API Estimasi Jam Panggilan Real-Time (Dinamis WIB)
     */
    public function getDokterByPoli(Request $request, $poli)
    {
        try {
            $poliName = trim(urldecode($poli));
            $tanggal = $request->get('tanggal', date('Y-m-d'));

            $totalAntrean = Pendaftaran::where('poli', $poliName)
                ->whereDate('tanggal_daftar', $tanggal)
                ->count();

            $noAntreanSelanjutnya = $totalAntrean + 1;

            $now = Carbon::now('Asia/Jakarta');
            $jamBukaDefault = Carbon::parse($tanggal . ' 08:00:00', 'Asia/Jakarta');

            if ($tanggal == $now->format('Y-m-d') && $now->gt($jamBukaDefault)) {
                $baseTime = $now->copy()->addMinutes(15);
                $estimasiMenit = ($noAntreanSelanjutnya - 1) * 15;
                $estimasiJam = $baseTime->addMinutes($estimasiMenit)->format('H:i');
            } else {
                $estimasiMenit = ($noAntreanSelanjutnya - 1) * 15;
                $estimasiJam = $jamBukaDefault->addMinutes($estimasiMenit)->format('H:i');
            }

            return response()->json([
                'success'      => true,
                'no_antrean'   => $noAntreanSelanjutnya,
                'estimasi_jam' => $estimasiJam,
                'message'      => "Antrean Ke-{$noAntreanSelanjutnya} (Estimasi Dipanggil Jam: {$estimasiJam} WIB)"
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false, 
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Proses Simpan Pendaftaran Online Pasien (Auto-Increment Antrean Presisi)
     */
    public function store(Request $request)
    {
        if ($request->is_pasien_baru == '1') {
            $request->validate([
                'nama'          => 'required|string|max:255',
                'nik'           => 'required|numeric|digits:16|unique:pasiens,nik',
                'jenis_kelamin' => 'required|in:L,P',
                'tanggal_lahir' => 'required|date',
                'no_hp'         => 'required|numeric|digits_between:10,13',
                'alamat'        => 'required|string',
            ], [
                'nik.unique'           => 'NIK ini sudah terdaftar sebagai pasien lama. Silakan gunakan tab Pasien Lama.',
                'nik.digits'           => 'NIK harus berisi tepat 16 digit angka.',
                'no_hp.digits_between' => 'Nomor HP/WA harus berkisar antara 10 sampai 13 digit angka.'
            ]);
        } else {
            $request->validate([
                'pasien_id' => 'required|exists:pasiens,id'
            ], [
                'pasien_id.required' => 'Gagal! Anda belum melakukan pencarian NIK / No. RM yang valid.'
            ]);
        }

        $request->validate([
            'poli'           => 'required|string',
            'tanggal_daftar' => 'required|date|after_or_equal:today',
            'keluhan'        => 'nullable|string|max:500',
        ]);

        try {
            $pendaftaran = DB::transaction(function () use ($request) {
                if ($request->is_pasien_baru == '1') {
                    $today = date('Ymd');
                    $lastPasien = Pasien::whereDate('created_at', now()->toDateString())->latest()->first();
                    $nextNumber = $lastPasien ? sprintf('%03d', ((int) substr($lastPasien->no_rm, -3)) + 1) : '001';
                    $no_rm = "RM-{$today}-{$nextNumber}";

                    $pasien = Pasien::create([
                        'no_rm'         => $no_rm,
                        'nama'          => trim($request->nama),
                        'nik'           => trim($request->nik),
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'tanggal_lahir' => $request->tanggal_lahir,
                        'no_hp'         => trim($request->no_hp),
                        'alamat'        => trim($request->alamat),
                    ]);

                    $pasien_id = $pasien->id;
                } else {
                    $pasien_id = $request->pasien_id;
                }

                $cleanPoli = trim(str_ireplace('poli', '', strtolower($request->poli)));

                $dokters = User::where('role', 'LIKE', '%dokter%')
                    ->where('poli', 'LIKE', '%' . $cleanPoli . '%')
                    ->get();

                if ($dokters->isEmpty()) {
                    $dokters = User::where('role', 'LIKE', '%dokter%')->get();
                }

                if ($dokters->isEmpty()) {
                    throw new Exception('Mohon maaf, belum ada akun Dokter yang terdaftar di sistem.');
                }

                $selectedDokter = $dokters->sortBy(function ($dokter) use ($request) {
                    return Pendaftaran::where('dokter_id', $dokter->id)
                        ->whereDate('tanggal_daftar', $request->tanggal_daftar)
                        ->whereIn('status', ['menunggu', 'diperiksa'])
                        ->count();
                })->first();

                $lastAntrean = Pendaftaran::whereDate('tanggal_daftar', $request->tanggal_daftar)
                    ->where('poli', $request->poli)
                    ->max('no_antrean');

                $noAntrean = $lastAntrean ? $lastAntrean + 1 : 1;

                return Pendaftaran::create([
                    'pasien_id'      => $pasien_id,
                    'poli'           => $request->poli,
                    'dokter_id'      => $selectedDokter->id,
                    'tanggal_daftar' => $request->tanggal_daftar,
                    'no_antrean'     => $noAntrean,
                    'keluhan'        => $request->keluhan,
                    'status'         => 'menunggu',
                ]);
            });

            return redirect()->route('pendaftaran-online.sukses', $pendaftaran->id)
                ->with('success', 'Pendaftaran online berhasil dibuat!');

        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Halaman Struk Bukti Pendaftaran
     */
    public function sukses($id)
    {
        $pendaftaran = Pendaftaran::with(['pasien', 'dokter'])->findOrFail($id);
        
        $now = Carbon::now('Asia/Jakarta');
        $tglDaftarStr = Carbon::parse($pendaftaran->tanggal_daftar)->format('Y-m-d');
        $jamBukaDefault = Carbon::parse($tglDaftarStr . ' 08:00:00', 'Asia/Jakarta');
        $isToday = Carbon::parse($pendaftaran->tanggal_daftar)->isToday();

        if ($isToday && $now->gt($jamBukaDefault)) {
            $baseTime = $now->copy()->addMinutes(15);
            $estimasiMenit = ($pendaftaran->no_antrean - 1) * 15;
            $estimasiJam = $baseTime->addMinutes($estimasiMenit)->format('H:i');
        } else {
            $estimasiMenit = ($pendaftaran->no_antrean - 1) * 15;
            $estimasiJam = $jamBukaDefault->addMinutes($estimasiMenit)->format('H:i');
        }

        return view('pendaftaran-online.sukses', compact('pendaftaran', 'estimasiJam'));
    }

    /**
     * Redirect ke Tiket Antrean Terakhir Pasien
     */
    public function lihatTiket(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string',
        ]);

        $keyword = trim($request->keyword);

        $pasien = Pasien::where('no_rm', $keyword)
            ->orWhere('nik', $keyword)
            ->first();

        if (!$pasien) {
            return back()->with('error', 'Data pasien tidak ditemukan.');
        }

        $pendaftaranTerakhir = Pendaftaran::where('pasien_id', $pasien->id)
            ->latest()
            ->first();

        if (!$pendaftaranTerakhir) {
            return back()->with('error', 'Pasien ini belum memiliki riwayat pendaftaran.');
        }

        return redirect()->route('pendaftaran-online.sukses', $pendaftaranTerakhir->id);
    }
}