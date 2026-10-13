<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('hari_praktik')->nullable()->after('kuota_harian');
            $table->time('jam_mulai')->nullable()->after('hari_praktik');
            $table->time('jam_selesai')->nullable()->after('jam_mulai');
        });

        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->time('jam_daftar')->nullable()->after('tanggal_daftar');
        });

        // Jadwal default untuk dokter yang sudah ada agar fitur langsung bisa dipakai.
        DB::table('users')
            ->where('role', 'dokter')
            ->update([
                'hari_praktik' => 'Senin,Selasa,Rabu,Kamis,Jumat',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '16:00:00',
            ]);
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn('jam_daftar');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['hari_praktik', 'jam_mulai', 'jam_selesai']);
        });
    }
};
