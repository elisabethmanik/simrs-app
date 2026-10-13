<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PasienController extends Controller
{
    private function ensureAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403, 'Hanya admin yang dapat mengelola data pasien.');
    }

    public function index(Request $request)
    {
        $this->ensureAdmin();

        $search = trim((string) $request->get('search', ''));
        $normalizedRm = preg_replace('/[^A-Za-z0-9]/', '', $search);

        $pasiens = Pasien::query()
            ->when($search !== '', function ($query) use ($search, $normalizedRm) {
                $query->where(function ($q) use ($search, $normalizedRm) {
                    $q->where('nama', 'like', "%{$search}%")
                        ->orWhere('no_rm', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%");

                    if ($normalizedRm !== '') {
                        $q->orWhereRaw("REPLACE(REPLACE(no_rm, '-', ''), ' ', '') LIKE ?", ["%{$normalizedRm}%"]);
                    }
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pasiens.index', compact('pasiens'));
    }

    public function create()
    {
        $this->ensureAdmin();

        $nextId = (Pasien::max('id') ?? 0) + 1;
        $noRmAuto = 'RM-' . date('Y') . '-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        return view('pasiens.create', compact('noRmAuto'));
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'no_rm' => ['required', 'string', 'max:30', 'unique:pasiens,no_rm'],
            'nik' => ['required', 'regex:/^\d{16}$/', 'unique:pasiens,nik'],
            'nama' => ['required', 'string', 'min:3', 'max:255', "regex:/^[\pL\s\.\'\-]+$/u"],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'alamat' => ['required', 'string', 'min:5', 'max:1000'],
            'no_hp' => ['required', 'regex:/^\d{10,13}$/'],
        ], $this->validationMessages());

        Pasien::create($validated);

        return redirect()->route('pasiens.index')->with('success', 'Pasien berhasil didaftarkan!');
    }

    public function edit(Pasien $pasien)
    {
        $this->ensureAdmin();

        return view('pasiens.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $this->ensureAdmin();

        $validated = $request->validate([
            'nik' => ['required', 'regex:/^\d{16}$/', Rule::unique('pasiens', 'nik')->ignore($pasien->id)],
            'nama' => ['required', 'string', 'min:3', 'max:255', "regex:/^[\pL\s\.\'\-]+$/u"],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'alamat' => ['required', 'string', 'min:5', 'max:1000'],
            'no_hp' => ['required', 'regex:/^\d{10,13}$/'],
        ], $this->validationMessages());

        $pasien->update($validated);

        return redirect()->route('pasiens.index')->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function destroy(Pasien $pasien)
    {
        $this->ensureAdmin();

        $pasien->delete();

        return redirect()->route('pasiens.index')->with('success', 'Data pasien berhasil dihapus!');
    }

    private function validationMessages(): array
    {
        return [
            'no_rm.required' => 'Nomor rekam medis wajib diisi.',
            'no_rm.unique' => 'Nomor rekam medis sudah digunakan.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.regex' => 'NIK harus terdiri dari tepat 16 digit angka tanpa huruf.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama.required' => 'Nama pasien wajib diisi.',
            'nama.min' => 'Nama pasien minimal 3 karakter.',
            'nama.regex' => 'Nama hanya boleh berisi huruf, spasi, titik, apostrof, atau tanda hubung.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir tidak valid.',
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak boleh melebihi hari ini.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.min' => 'Alamat terlalu singkat.',
            'alamat.max' => 'Alamat maksimal 1000 karakter.',
            'no_hp.required' => 'Nomor HP / WA wajib diisi.',
            'no_hp.regex' => 'Nomor HP / WA harus berupa 10 sampai 13 digit angka.',
        ];
    }
}
