<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data dokter lama
        User::where('role', 'dokter')->delete();

        $dokters = [
            // POLI UMUM (4 DOKTER)
            ['name' => 'dr. Ahmad Dahlan', 'email' => 'ahmad.u@simrs.com', 'poli' => 'Poli Umum'],
            ['name' => 'dr. Siska Putri', 'email' => 'siska.u@simrs.com', 'poli' => 'Poli Umum'],
            ['name' => 'dr. Kevin Pratama', 'email' => 'kevin.u@simrs.com', 'poli' => 'Poli Umum'],
            ['name' => 'dr. Nabila Hapsari', 'email' => 'nabila.u@simrs.com', 'poli' => 'Poli Umum'],

            // POLI ANAK (3 DOKTER)
            ['name' => 'dr. Budi Santoso, Sp.A', 'email' => 'budi.a@simrs.com', 'poli' => 'Poli Anak'],
            ['name' => 'dr. Triana Darmayanti, Sp.A', 'email' => 'triana.a@simrs.com', 'poli' => 'Poli Anak'],
            ['name' => 'dr. Faisal Reza, Sp.A', 'email' => 'faisal.a@simrs.com', 'poli' => 'Poli Anak'],

            // POLI ANESTESI (2 DOKTER)
            ['name' => 'dr. Agung Setiadi, Sp.An', 'email' => 'agung.an@simrs.com', 'poli' => 'Poli Anestesi'],
            ['name' => 'dr. Citra Lestari, Sp.An', 'email' => 'citra.an@simrs.com', 'poli' => 'Poli Anestesi'],

            // POLI BEDAH (3 DOKTER)
            ['name' => 'dr. Hendra Pratama, Sp.B', 'email' => 'hendra.b@simrs.com', 'poli' => 'Poli Bedah'],
            ['name' => 'dr. Irfan Hakim, Sp.B', 'email' => 'irfan.b@simrs.com', 'poli' => 'Poli Bedah'],
            ['name' => 'dr. Rina Marlina, Sp.B', 'email' => 'rina.b@simrs.com', 'poli' => 'Poli Bedah'],

            // POLI BEDAH PLASTIK (2 DOKTER)
            ['name' => 'dr. Maya Kusuma, Sp.BP-RE', 'email' => 'maya.p@simrs.com', 'poli' => 'Poli Bedah Plastik & Estetika'],
            ['name' => 'dr. Danang Wijaya, Sp.BP-RE', 'email' => 'danang.p@simrs.com', 'poli' => 'Poli Bedah Plastik & Estetika'],

            // POLI BEDAH SARAF (2 DOKTER)
            ['name' => 'dr. Rizky Hidayat, Sp.BS', 'email' => 'rizky.bs@simrs.com', 'poli' => 'Poli Bedah Saraf'],
            ['name' => 'dr. Dini Anggraini, Sp.BS', 'email' => 'dini.bs@simrs.com', 'poli' => 'Poli Bedah Saraf'],

            // POLI DRY NEEDLING (2 DOKTER)
            ['name' => 'dr. Denny Kurniawan, Sp.KFR', 'email' => 'denny.dn@simrs.com', 'poli' => 'Poli Dry Needling Fungsional'],
            ['name' => 'dr. Yulia Fransiska, Sp.KFR', 'email' => 'yulia.dn@simrs.com', 'poli' => 'Poli Dry Needling Fungsional'],

            // POLI GIGI (3 DOKTER)
            ['name' => 'drg. Rian Hidayat, Sp.KG', 'email' => 'rian.g@simrs.com', 'poli' => 'Poli Gigi'],
            ['name' => 'drg. Maya Indah, Sp.ORT', 'email' => 'maya.g@simrs.com', 'poli' => 'Poli Gigi'],
            ['name' => 'drg. Oscar Kurnia', 'email' => 'oscar.g@simrs.com', 'poli' => 'Poli Gigi'],

            // POLI GIZI KLINIK (2 DOKTER)
            ['name' => 'dr. Nurul Aini, Sp.GK', 'email' => 'nurul.gz@simrs.com', 'poli' => 'Poli Gizi Klinik'],
            ['name' => 'dr. Ari Wibowo, Sp.GK', 'email' => 'ari.gz@simrs.com', 'poli' => 'Poli Gizi Klinik'],

            // POLI JANTUNG & PEMBULUH DARAH (3 DOKTER)
            ['name' => 'dr. Andi Pratama, Sp.JP', 'email' => 'andi.j@simrs.com', 'poli' => 'Poli Jantung & Pembuluh Darah'],
            ['name' => 'dr. Tari Rahmawati, Sp.JP', 'email' => 'tari.j@simrs.com', 'poli' => 'Poli Jantung & Pembuluh Darah'],
            ['name' => 'dr. Lukita Suwandi, Sp.JP', 'email' => 'lukita.j@simrs.com', 'poli' => 'Poli Jantung & Pembuluh Darah'],

            // POLI KEDOKTERAN FISIK & REHABILITASI (2 DOKTER)
            ['name' => 'dr. Sarah Wijaya, Sp.KFR', 'email' => 'sarah.kfr@simrs.com', 'poli' => 'Poli Kedokteran Fisik & Rehabilitasi'],
            ['name' => 'dr. Taufik Hidayat, Sp.KFR', 'email' => 'taufik.kfr@simrs.com', 'poli' => 'Poli Kedokteran Fisik & Rehabilitasi'],

            // POLI KEDOKTERAN JIWA (2 DOKTER)
            ['name' => 'dr. Lukman Hakim, Sp.KJ', 'email' => 'lukman.kj@simrs.com', 'poli' => 'Poli Kedokteran Jiwa'],
            ['name' => 'dr. Intan Pertiwi, Sp.KJ', 'email' => 'intan.kj@simrs.com', 'poli' => 'Poli Kedokteran Jiwa'],

            // POLI KEDOKTERAN OLAHRAGA (2 DOKTER)
            ['name' => 'dr. Farhan Utomo, Sp.KO', 'email' => 'farhan.ko@simrs.com', 'poli' => 'Poli Kedokteran Olahraga'],
            ['name' => 'dr. Sandra Dewi, Sp.KO', 'email' => 'sandra.ko@simrs.com', 'poli' => 'Poli Kedokteran Olahraga'],

            // POLI KONSULTAN GASTROENTEROLOGI (2 DOKTER)
            ['name' => 'dr. Siti Rahma, Sp.PD-KGEH', 'email' => 'siti.ge@simrs.com', 'poli' => 'Poli Konsultan Gastroenterologi'],
            ['name' => 'dr. Hadi Gunawan, Sp.PD-KGEH', 'email' => 'hadi.ge@simrs.com', 'poli' => 'Poli Konsultan Gastroenterologi'],

            // POLI KONSULTAN GINJAL & HIPERTENSI (2 DOKTER)
            ['name' => 'dr. Hendra Kusuma, Sp.PD-KGH', 'email' => 'hendra.gh@simrs.com', 'poli' => 'Poli Konsultan Ginjal & Hipertensi'],
            ['name' => 'dr. Nina Marlina, Sp.PD-KGH', 'email' => 'nina.gh@simrs.com', 'poli' => 'Poli Konsultan Ginjal & Hipertensi'],

            // POLI KULIT & KELAMIN (3 DOKTER)
            ['name' => 'dr. Dewi Lestari, Sp.KK', 'email' => 'dewi.kk@simrs.com', 'poli' => 'Poli Kulit & Kelamin'],
            ['name' => 'dr. Reza Rahadian, Sp.KK', 'email' => 'reza.kk@simrs.com', 'poli' => 'Poli Kulit & Kelamin'],
            ['name' => 'dr. Amanda Manopo, Sp.KK', 'email' => 'amanda.kk@simrs.com', 'poli' => 'Poli Kulit & Kelamin'],

            // POLI MATA (3 DOKTER)
            ['name' => 'dr. Annisa Pertiwi, Sp.M', 'email' => 'annisa.m@simrs.com', 'poli' => 'Poli Mata'],
            ['name' => 'dr. Bambang Yudhoyono, Sp.M', 'email' => 'bambang.m@simrs.com', 'poli' => 'Poli Mata'],
            ['name' => 'dr. Clara Bernadeth, Sp.M', 'email' => 'clara.m@simrs.com', 'poli' => 'Poli Mata'],

            // POLI OBSTETRI & GINEKOLOGI / KANDUNGAN (3 DOKTER)
            ['name' => 'dr. Ratna Sari, Sp.OG', 'email' => 'ratna.og@simrs.com', 'poli' => 'Poli Obstetri & Ginekologi'],
            ['name' => 'dr. Eko Prasetyo, Sp.OG', 'email' => 'eko.og@simrs.com', 'poli' => 'Poli Obstetri & Ginekologi'],
            ['name' => 'dr. Fitri Handayani, Sp.OG', 'email' => 'fitri.og@simrs.com', 'poli' => 'Poli Obstetri & Ginekologi'],

            // POLI ORTOPEDI & TRAUMATOLOGI (3 DOKTER)
            ['name' => 'dr. Bambang Perkasa, Sp.OT', 'email' => 'bambang.ot@simrs.com', 'poli' => 'Poli Ortopedi & Traumatologi'],
            ['name' => 'dr. Gunawan Wibisono, Sp.OT', 'email' => 'gunawan.ot@simrs.com', 'poli' => 'Poli Ortopedi & Traumatologi'],
            ['name' => 'dr. Helen Wijaya, Sp.OT', 'email' => 'helen.ot@simrs.com', 'poli' => 'Poli Ortopedi & Traumatologi'],
        ];

        foreach ($dokters as $d) {
            User::create([
                'name'          => $d['name'],
                'email'         => $d['email'],
                'password'      => Hash::make('password'),
                'role'          => 'dokter',
                'poli'          => $d['poli'],
                'hari_praktik'  => 'Senin,Selasa,Rabu,Kamis,Jumat',
                'jam_mulai'     => '08:00:00',
                'jam_selesai'   => '16:00:00',
            ]);
        }
    }
}