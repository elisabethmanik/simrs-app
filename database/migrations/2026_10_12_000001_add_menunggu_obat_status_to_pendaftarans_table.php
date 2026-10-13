<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Alur dokter -> farmasi membutuhkan status menunggu_obat.
        // Project menggunakan MySQL baik melalui Laragon maupun XAMPP.
        DB::statement("ALTER TABLE pendaftarans MODIFY COLUMN status ENUM('menunggu','diperiksa','menunggu_obat','selesai','batal') NOT NULL DEFAULT 'menunggu'");
    }

    public function down(): void
    {
        DB::table('pendaftarans')
            ->where('status', 'menunggu_obat')
            ->update(['status' => 'diperiksa']);

        DB::statement("ALTER TABLE pendaftarans MODIFY COLUMN status ENUM('menunggu','diperiksa','selesai','batal') NOT NULL DEFAULT 'menunggu'");
    }
};
