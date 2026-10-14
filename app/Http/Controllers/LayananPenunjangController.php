<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayananPenunjangController extends Controller
{
    public function detail($slug)
    {
        // Data detail layanan penunjang lengkap dengan array 'fasilitas'
        $dataLayanan = [
            'rawat-inap' => [
                'judul' => 'Layanan Rawat Inap',
                'deskripsi' => 'Fasilitas kamar rawat inap yang nyaman dengan standar pelayanan medis modern dan pengawasan dokter 24 jam.',
                'fasilitas' => [
                    'Kamar VVIP, VIP, Kelas 1, 2, dan 3 yang bersih dan ber-AC',
                    'Tempat tidur pasien elektrik modern',
                    'Perawat jaga dan dokter spesialis visite setiap hari',
                    'Menu makanan sehat bernutrisi 3 kali sehari'
                ]
            ],
            'laboratorium' => [
                'judul' => 'Laboratorium Medis',
                'deskripsi' => 'Pemeriksaan sampel darah dan patologi dengan peralatan otomatis berakurasi tinggi.',
                'fasilitas' => [
                    'Pemeriksaan hematologi dan kimia darah lengkap',
                    'Uji urine dan feses mikroskopis',
                    'Layanan tes cepat (Rapid/PCR) dan serologi',
                    'Hasil lab akurat terintegrasi rekam medis digital'
                ]
            ],
            'radiologi' => [
                'judul' => 'Layanan Radiologi & Rontgen',
                'deskripsi' => 'Pemeriksaan pencitraan medis modern termasuk CT Scan, Ultrasonografi (USG), dan Rontgen digital.',
                'fasilitas' => [
                    'Rontgen Digital (X-Ray) beradiasi rendah',
                    'USG 4 Dimensi untuk kandungan dan organ dalam',
                    'CT Scan 128 Slices berkecepatan tinggi',
                    'Pembacaan hasil oleh dokter spesialis radiologi konsultan'
                ]
            ],
            'farmasi' => [
                'judul' => 'Apotek & Farmasi 24 Jam',
                'deskripsi' => 'Layanan penyediaan obat-obatan terpadu dengan resep dokter dan konsultasi apoteker.',
                'fasilitas' => [
                    'Obat generik dan paten lengkap berkualitas terjamin',
                    'Layanan peracikan obat puyer dan kapsul',
                    'Konsultasi penggunaan obat langsung dengan apoteker',
                    'Layanan antar obat ke ruang rawat inap'
                ]
            ],
        ];

        // Ambil data berdasarkan slug, atau gunakan default jika slug tidak ditemukan
        $layanan = $dataLayanan[$slug] ?? [
            'judul' => ucwords(str_replace('-', ' ', $slug)),
            'deskripsi' => 'Informasi lengkap mengenai fasilitas dan layanan medis penunjang di RS Cipta Medika.',
            'fasilitas' => [
                'Peralatan medis modern dan steril',
                'Tenaga medis profesional dan berpengalaman',
                'Pelayanan ramah dan responsif 24 jam'
            ]
        ];

        return view('layanan_penunjang.detail', compact('layanan', 'slug'));
    }
}