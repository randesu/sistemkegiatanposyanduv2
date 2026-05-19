<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('who_weight_age', function (Blueprint $table) {
            $table->id();

            $table->string('gender'); // L / P

            $table->integer('umur_bulan');

            $table->float('minus_3sd');
            $table->float('minus_2sd');
            $table->float('median');
            $table->float('plus_1sd');
            $table->float('plus_2sd');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('who_weight_age');
    }
};