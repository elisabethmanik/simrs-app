<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OnlinePendaftaranController extends Controller
{
    public function index()
    {
        $polis = User::where('role', 'dokter')
            ->whereNotNull('poli')
            ->where('poli', '!=', '')
            ->select('poli')
            ->distinct()
            ->orderBy('poli')
            ->pluck('poli');

        return view('pendaftaran-online.index', compact('polis'));
    }

    public function checkPasien(Request $request)
    {
        $request->validate([
            'keyword' => ['required', 'string', 'max:100'],
        ]);

        $keyword = trim((string) $request->keyword);
        $normalizedRm = preg_replace('/[^A-Za-z0-9]/', '', $keyword);

        $pasien = Pasien::where(function ($query) use ($keyword, $normalizedRm) {
            $query->where('nik', $keyword)
                ->orWhere('no_rm', $keyword);

            if ($normalizedRm !== '') {
                $query->orWhereRaw("REPLACE(REPLACE(no_rm, '-', ''), ' ', '') = ?", [$normalizedRm]);
            }
        })->first();

        if (!$pasien) {
            return response()->json([
                'success' => false,
                'message' => 'Data pasien tidak ditemukan. Periksa kembali NIK atau No. RM.',
            ], 404);
        }

        $riwayats = Pendaftaran::with('dokter')
            ->where('pasien_id', $pasien->id)
            ->orderByDesc('tanggal_daftar')
            ->take(5)
            ->get();

        return response()->json([
            'success' => true,
            'pasien' => $pasien,
            'riwayat' => $riwayats,
        ]);
    }

    public function checkStatus($keyword)
    {
        try {
            $keyword = trim(urldecode($keyword));
            $normalizedRm = preg_replace('/[^A-Za-z0-9]/', '', $keyword);

            $pasien = Pasien::where(function ($query) use ($keyword, $normalizedRm) {
                $query->where('nik', $keyword)->orWhere('no_rm', $keyword);
                if ($normalizedRm !== '') {
                    $query->orWhereRaw("REPLACE(REPLACE(no_rm, '-', ''), ' ', '') = ?", [$normalizedRm]);
                }
            })->first();

            if (!$pasien) {
                return response()->json(['success' => false, 'message' => 'Data pasien tidak ditemukan.'], 200);
            }

            $pendaftaran = Pendaftaran::with(['pasien', 'dokter'])
                ->where('pasien_id', $pasien->id)
                ->latest()
                ->first();

            if (!$pendaftaran) {
                return response()->json(['success' => false, 'message' => 'Pasien belum memiliki pendaftaran.'], 200);
            }

            $kodeBookingFormat = 'REG-' . date('Ymd', strtotime($pendaftaran->tanggal_daftar)) . '-' . preg_replace('/\D/', '', (string) $pendaftaran->no_antrean);

            return response()->json([
                'success' => true,
                'data' => [
                    'kode_booking' => $pendaftaran->kode_booking ?? $kodeBookingFormat,
                    'nomor_antrean' => $pendaftaran->no_antrean,
                    'nama_pasien' => $pendaftaran->pasien->nama ?? '-',
                    'poli' => $pendaftaran->poli,
                    'tanggal_daftar' => Carbon::parse($pendaftaran->tanggal_daftar)->translatedFormat('d F Y'),
                    'jam_daftar' => $pendaftaran->jam_daftar ? substr((string) $pendaftaran->jam_daftar, 0, 5) : '-',
                    'status' => $pendaftaran->status,
                    'nama_dokter' => $pendaftaran->dokter->name ?? '-',
                ],
            ]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem.'], 200);
        }
    }

    public function getDokterByPoli(Request $request, $poli)
    {
        $request->validate([
            'tanggal' => ['required', 'date', 'after_or_equal:today'],
        ], [
            'tanggal.required' => 'Pilih tanggal kunjungan terlebih dahulu.',
            'tanggal.after_or_equal' => 'Tanggal kunjungan tidak boleh sebelum hari ini.',
        ]);

        $poliName = trim(urldecode($poli));
        $tanggal = Carbon::parse($request->tanggal, 'Asia/Jakarta');
        $hari = $this->hariIndonesia($tanggal);

        $dokters = User::where('role', 'dokter')
            ->where('poli', $poliName)
            ->orderBy('name')
            ->get()
            ->map(function (User $dokter) use ($tanggal, $hari) {
                $hariPraktik = $this->parseHariPraktik($dokter->hari_praktik);
                $tersediaHari = in_array($hari, $hariPraktik, true);
                $slots = $tersediaHari ? $this->buildSlots($dokter, $tanggal) : [];

                return [
                    'id' => $dokter->id,
                    'name' => $dokter->name,
                    'poli' => $dokter->poli,
                    'hari_praktik' => $hariPraktik,
                    'jam_mulai' => $dokter->jam_mulai ? substr((string) $dokter->jam_mulai, 0, 5) : '08:00',
                    'jam_selesai' => $dokter->jam_selesai ? substr((string) $dokter->jam_selesai, 0, 5) : '16:00',
                    'tersedia' => $tersediaHari && count($slots) > 0,
                    'slots' => $slots,
                    'keterangan' => !$tersediaHari
                        ? "Tidak praktik hari {$hari}"
                        : (count($slots) === 0 ? 'Tidak ada jam yang masih tersedia hari ini' : 'Tersedia'),
                ];
            });

        return response()->json([
            'success' => true,
            'hari' => $hari,
            'dokters' => $dokters,
        ]);
    }

    public function store(Request $request)
    {
        $isPasienBaru = (string) $request->input('is_pasien_baru', '1') === '1';

        if ($isPasienBaru) {
            $validatedPasien = $request->validate([
                'nama' => ['required', 'string', 'min:3', 'max:100', 'regex:/^[\pL\s\.\'\-]+$/u'],
                'nik' => ['required', 'digits:16', 'unique:pasiens,nik'],
                'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
                'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
                'no_hp' => ['required', 'regex:/^[0-9]{10,13}$/'],
                'alamat' => ['required', 'string', 'min:5', 'max:1000'],
            ], [
                'nama.regex' => 'Nama hanya boleh berisi huruf, spasi, titik, apostrof, atau tanda hubung.',
                'nik.digits' => 'NIK harus tepat 16 digit angka.',
                'nik.unique' => 'NIK sudah terdaftar. Gunakan pilihan Pasien Lama.',
                'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak boleh melebihi hari ini.',
                'no_hp.regex' => 'Nomor HP harus 10 sampai 13 digit angka.',
            ]);
        } else {
            $request->validate([
                'pasien_id' => ['required', 'exists:pasiens,id'],
            ], [
                'pasien_id.required' => 'Cari dan pilih data pasien lama terlebih dahulu.',
            ]);
        }

        $validatedBooking = $request->validate([
            'poli' => ['required', 'string', Rule::exists('users', 'poli')->where(fn ($query) => $query->where('role', 'dokter'))],
            'dokter_id' => ['required', 'integer', 'exists:users,id'],
            'tanggal_daftar' => ['required', 'date', 'after_or_equal:today'],
            'jam_daftar' => ['required', 'date_format:H:i'],
        ], [
            'poli.required' => 'Poliklinik wajib dipilih.',
            'dokter_id.required' => 'Dokter wajib dipilih.',
            'tanggal_daftar.required' => 'Tanggal kunjungan wajib dipilih.',
            'tanggal_daftar.after_or_equal' => 'Tanggal kunjungan tidak boleh sebelum hari ini.',
            'jam_daftar.required' => 'Jam kunjungan wajib dipilih.',
            'jam_daftar.date_format' => 'Format jam kunjungan tidak valid.',
        ]);

        $dokter = User::where('id', $validatedBooking['dokter_id'])
            ->where('role', 'dokter')
            ->firstOrFail();

        if ($dokter->poli !== $validatedBooking['poli']) {
            return back()->withErrors([
                'dokter_id' => 'Dokter yang dipilih tidak sesuai dengan poliklinik.',
            ])->withInput();
        }

        $tanggal = Carbon::parse($validatedBooking['tanggal_daftar'], 'Asia/Jakarta');
        $hari = $this->hariIndonesia($tanggal);
        $hariPraktik = $this->parseHariPraktik($dokter->hari_praktik);

        if (!in_array($hari, $hariPraktik, true)) {
            return back()->withErrors([
                'tanggal_daftar' => "{$dokter->name} tidak praktik pada hari {$hari}.",
            ])->withInput();
        }

        $jamMulai = $dokter->jam_mulai ? substr((string) $dokter->jam_mulai, 0, 5) : '08:00';
        $jamSelesai = $dokter->jam_selesai ? substr((string) $dokter->jam_selesai, 0, 5) : '16:00';
        $jamPilihan = Carbon::createFromFormat('Y-m-d H:i', $tanggal->format('Y-m-d') . ' ' . $validatedBooking['jam_daftar'], 'Asia/Jakarta');
        $mulai = Carbon::createFromFormat('Y-m-d H:i', $tanggal->format('Y-m-d') . ' ' . $jamMulai, 'Asia/Jakarta');
        $selesai = Carbon::createFromFormat('Y-m-d H:i', $tanggal->format('Y-m-d') . ' ' . $jamSelesai, 'Asia/Jakarta');

        if ($jamPilihan->lt($mulai) || !$jamPilihan->lt($selesai)) {
            return back()->withErrors([
                'jam_daftar' => "Jam kunjungan harus berada pada jam praktik {$jamMulai} - {$jamSelesai} WIB.",
            ])->withInput();
        }

        if ($tanggal->isToday() && $jamPilihan->lte(Carbon::now('Asia/Jakarta'))) {
            return back()->withErrors([
                'jam_daftar' => 'Jam kunjungan untuk hari ini harus lebih besar dari waktu sekarang.',
            ])->withInput();
        }

        try {
            $pendaftaran = DB::transaction(function () use ($request, $isPasienBaru, $validatedBooking, $dokter) {
                if ($isPasienBaru) {
                    $today = now('Asia/Jakarta')->format('Ymd');
                    $lastPasien = Pasien::whereDate('created_at', now('Asia/Jakarta')->toDateString())->latest()->first();
                    $lastNumber = $lastPasien ? (int) substr((string) $lastPasien->no_rm, -3) : 0;
                    $noRm = 'RM-' . $today . '-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

                    $pasien = Pasien::create([
                        'no_rm' => $noRm,
                        'nama' => trim((string) $request->nama),
                        'nik' => trim((string) $request->nik),
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'tanggal_lahir' => $request->tanggal_lahir,
                        'no_hp' => trim((string) $request->no_hp),
                        'alamat' => trim((string) $request->alamat),
                    ]);

                    $pasienId = $pasien->id;
                } else {
                    $pasienId = (int) $request->pasien_id;
                }

                $duplikat = Pendaftaran::where('pasien_id', $pasienId)
                    ->whereDate('tanggal_daftar', $validatedBooking['tanggal_daftar'])
                    ->whereIn('status', ['menunggu', 'diperiksa', 'menunggu_apotek', 'menunggu_obat'])
                    ->exists();

                if ($duplikat) {
                    throw new Exception('Pasien masih memiliki pendaftaran aktif pada tanggal tersebut.');
                }

                $lastNumber = Pendaftaran::whereDate('tanggal_daftar', $validatedBooking['tanggal_daftar'])
                    ->where('poli', $validatedBooking['poli'])
                    ->get()
                    ->map(fn ($item) => (int) preg_replace('/\D/', '', (string) $item->no_antrean))
                    ->max() ?? 0;

                return Pendaftaran::create([
                    'pasien_id' => $pasienId,
                    'poli' => $validatedBooking['poli'],
                    'dokter_id' => $dokter->id,
                    'tanggal_daftar' => $validatedBooking['tanggal_daftar'],
                    'jam_daftar' => $validatedBooking['jam_daftar'] . ':00',
                    'no_antrean' => 'A-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT),
                    'status' => 'menunggu',
                ]);
            });

            return redirect()->route('pendaftaran-online.sukses', $pendaftaran->id)
                ->with('success', 'Pendaftaran online berhasil dibuat.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function sukses($id)
    {
        $pendaftaran = Pendaftaran::with(['pasien', 'dokter'])->findOrFail($id);
        $estimasiJam = $pendaftaran->jam_daftar
            ? substr((string) $pendaftaran->jam_daftar, 0, 5)
            : '08:00';

        return view('pendaftaran-online.sukses', compact('pendaftaran', 'estimasiJam'));
    }

    public function lihatTiket(Request $request)
    {
        $request->validate(['keyword' => ['required', 'string']]);

        $keyword = trim((string) $request->keyword);
        $normalizedRm = preg_replace('/[^A-Za-z0-9]/', '', $keyword);

        $pasien = Pasien::where(function ($query) use ($keyword, $normalizedRm) {
            $query->where('nik', $keyword)->orWhere('no_rm', $keyword);
            if ($normalizedRm !== '') {
                $query->orWhereRaw("REPLACE(REPLACE(no_rm, '-', ''), ' ', '') = ?", [$normalizedRm]);
            }
        })->first();

        if (!$pasien) {
            return back()->with('error', 'Data pasien tidak ditemukan.');
        }

        $pendaftaran = Pendaftaran::where('pasien_id', $pasien->id)->latest()->first();

        if (!$pendaftaran) {
            return back()->with('error', 'Pasien belum memiliki riwayat pendaftaran.');
        }

        return redirect()->route('pendaftaran-online.sukses', $pendaftaran->id);
    }

    private function parseHariPraktik(?string $value): array
    {
        $value = trim((string) $value);

        if ($value === '') {
            return ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        }

        return array_values(array_filter(array_map('trim', explode(',', $value))));
    }

    private function hariIndonesia(Carbon $date): string
    {
        return match ($date->dayOfWeekIso) {
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu',
        };
    }

    private function buildSlots(User $dokter, Carbon $tanggal): array
    {
        $jamMulai = $dokter->jam_mulai ? substr((string) $dokter->jam_mulai, 0, 5) : '08:00';
        $jamSelesai = $dokter->jam_selesai ? substr((string) $dokter->jam_selesai, 0, 5) : '16:00';

        $cursor = Carbon::createFromFormat('Y-m-d H:i', $tanggal->format('Y-m-d') . ' ' . $jamMulai, 'Asia/Jakarta');
        $end = Carbon::createFromFormat('Y-m-d H:i', $tanggal->format('Y-m-d') . ' ' . $jamSelesai, 'Asia/Jakarta');
        $now = Carbon::now('Asia/Jakarta');
        $slots = [];

        while ($cursor->lt($end)) {
            if (!$tanggal->isToday() || $cursor->gt($now)) {
                $slots[] = $cursor->format('H:i');
            }
            $cursor->addMinutes(30);
        }

        return $slots;
    }
}
