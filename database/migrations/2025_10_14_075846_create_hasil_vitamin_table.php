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
        // Nama tabel pivot harus mengikuti urutan alfabetis dari nama kedua tabel
        Schema::create('hasil_vitamin', function (Blueprint $table) {
            // Foreign Key ke tabel hasil_pemeriksaans
            $table->foreignId('hasil_pemeriksaan_id')
                  ->constrained('hasil_pemeriksaans')
                  ->onDelete('cascade');

            // Foreign Key ke tabel vitamin (pastikan nama tabelnya 'vitamin', bukan 'vitamins')
            $table->foreignId('vitamin_id')
                  ->constrained('vitamin')
                  ->onDelete('cascade');

            // Menjadikan kombinasi kedua kolom sebagai primary key agar tidak ada duplikasi
            $table->primary(['hasil_pemeriksaan_id', 'vitamin_id']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_vitamin');
    }
};
