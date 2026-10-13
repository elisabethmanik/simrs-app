<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SpesialisController extends Controller
{
    public function show($slug)
    {
        // Bersihkan slug
        $namaPoliBersih = ucwords(str_replace('-', ' ', $slug));
        
        // Ekstrak kata kunci (abaikan kata 'dan' / 'pembuluh' jika terlalu panjang)
        $keywords = explode('-', $slug);

        $dokters = User::where('role', 'dokter')
            ->where(function ($query) use ($keywords, $slug) {
                foreach ($keywords as $kw) {
                    if (strlen($kw) > 2 && $kw !== 'dan') {
                        $query->orWhere('poli', 'LIKE', '%' . $kw . '%');
                    }
                }
            })
            ->get();

        $namaPoli = 'Poli ' . $namaPoliBersih;

        return view('spesialis.show', compact('namaPoli', 'dokters', 'slug'));
    }
}