<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_pemeriksaans', function (Blueprint $table) {

            $table->float('lingkar_kepala')
                ->nullable()
                ->change();

        });
    }

    public function down(): void
    {
        Schema::table('hasil_pemeriksaans', function (Blueprint $table) {

            $table->integer('lingkar_kepala')
                ->nullable()
                ->change();

        });
    }
};