<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('petugas_posyandu', function (Blueprint $table) {
            // Ganti nama kolom username menjadi email
            $table->renameColumn('username', 'email');
        });

        // Optional: pastikan tidak ada NULL & isi dengan email placeholder jika perlu
    
    }

    public function down(): void
    {
        Schema::table('petugas_posyandu', function (Blueprint $table) {
            $table->renameColumn('email', 'username');
        });
    }
};
