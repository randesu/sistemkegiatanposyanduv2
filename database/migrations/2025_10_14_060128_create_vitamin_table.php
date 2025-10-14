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
        Schema::create('vitamin', function (Blueprint $table) {
            $table->id(); // Kolom ID (auto-increment primary key)
            $table->string('nama_vitamin'); // Kolom nama_vitamin (string, maksimal 100 karakter, harus unik)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vitamin');
    }
};