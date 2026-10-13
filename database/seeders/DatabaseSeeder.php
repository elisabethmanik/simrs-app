<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@simrs.com'],
            [
                'name' => 'Admin SIMRS',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'poli' => null,
            ]
        );

        $dokters = [
            ['name' => 'dr. Andi Pratama', 'email' => 'andi@simrs.com', 'poli' => 'Poli Umum'],
            ['name' => 'dr. Sarah Wijaya', 'email' => 'sarah@simrs.com', 'poli' => 'Poli Umum'],
            ['name' => 'drg. Rian Hidayat', 'email' => 'rian@simrs.com', 'poli' => 'Poli Gigi'],
            ['name' => 'drg. Siti Nurhaliza', 'email' => 'siti@simrs.com', 'poli' => 'Poli Gigi'],
            ['name' => 'dr. Budi Santoso, Sp.A', 'email' => 'budi@simrs.com', 'poli' => 'Poli Anak'],
            ['name' => 'dr. Maya Indah, Sp.A', 'email' => 'maya@simrs.com', 'poli' => 'Poli Anak'],
            ['name' => 'dr. Hendra Kusuma, Sp.PD', 'email' => 'hendra@simrs.com', 'poli' => 'Poli Penyakit Dalam'],
            ['name' => 'dr. Nina Lestari, Sp.PD', 'email' => 'nina@simrs.com', 'poli' => 'Poli Penyakit Dalam'],
        ];

        foreach ($dokters as $dokter) {
            User::updateOrCreate(
                ['email' => $dokter['email']],
                [
                    'name' => $dokter['name'],
                    'password' => Hash::make('password'),
                    'role' => 'dokter',
                    'poli' => $dokter['poli'],
                ]
            );
        }

        // Aktor Farmasi / Apoteker
        User::updateOrCreate(
            ['email' => 'farmasi@simrs.com'],
            [
                'name' => 'Petugas Farmasi',
                'password' => Hash::make('password'),
                'role' => 'apoteker',
                'poli' => null,
            ]
        );
    }
}
