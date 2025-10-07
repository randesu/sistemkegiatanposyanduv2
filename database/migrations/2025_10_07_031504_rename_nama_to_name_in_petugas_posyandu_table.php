<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi (ubah kolom).
     */
    public function up(): void
    {
        Schema::table('petugas_posyandu', function (Blueprint $table) {
            // Pastikan kolom 'nama' ada sebelum rename
            if (Schema::hasColumn('petugas_posyandu', 'nama')) {
                $table->renameColumn('nama', 'name');
            }
        });
    }

    /**
     * Batalkan migrasi (kembalikan ke nama semula).
     */
    public function down(): void
    {
        Schema::table('petugas_posyandu', function (Blueprint $table) {
            if (Schema::hasColumn('petugas_posyandu', 'name')) {
                $table->renameColumn('name', 'nama');
            }
        });
    }
};
