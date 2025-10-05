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
        Schema::create('hasil_vaksin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hasil_id')->constrained('hasil_pemeriksaans','id')->cascadeOnDelete();
            $table->foreignId('vaksin_id')->constrained('vaksins','id')->cascadeOnDelete();
            $table->string('dosis')->nullable();
            $table->date('tanggal_vaksin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_vaksin');
    }
};
