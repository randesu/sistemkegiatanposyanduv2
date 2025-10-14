<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('balitas', function (Blueprint $table) {
            // 1. tempat_lahir (string, opsional)
            $table->string('tempat_lahir', 100)->nullable();
            
            // 2. tanggal_lahir (date)
            $table->date('tanggal_lahir')->nullable();
            
            // 3. alamat (text, opsional)
            $table->text('alamat')->nullable();
            
            // 4. jenis_kelamin (enum/string)
            // Menggunakan enum untuk membatasi nilai menjadi Laki-laki atau Perempuan
            $table->text('jenis_kelamin')->nullable();
            
            // Catatan: Jika Anda tidak ingin membatasi nilai, Anda bisa menggunakan:
            // $table->string('jenis_kelamin', 20)->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('balitas', function (Blueprint $table) {
            // Menghapus kolom yang ditambahkan saat rollback
            $table->dropColumn(['tempat_lahir', 'tanggal_lahir', 'alamat', 'jenis_kelamin']);
        });
    }
};