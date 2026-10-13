<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE pendaftarans MODIFY status ENUM('menunggu','diperiksa','menunggu_apotek','menunggu_obat','selesai','batal') NOT NULL DEFAULT 'menunggu'");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::table('pendaftarans')
                ->whereIn('status', ['menunggu_apotek', 'menunggu_obat'])
                ->update(['status' => 'selesai']);

            DB::statement("ALTER TABLE pendaftarans MODIFY status ENUM('menunggu','diperiksa','selesai','batal') NOT NULL DEFAULT 'menunggu'");
        }
    }
};
