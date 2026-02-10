<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_pemeriksaans', function (Blueprint $table) {
            $table->integer('lingkar_kepala')->nullable()->after('nama_kolom_sebelumnya');
        });
    }

    public function down(): void
    {
        Schema::table('hasil_pemeriksaans', function (Blueprint $table) {
            $table->dropColumn('lingkar_kepala');
        });
    }
};
