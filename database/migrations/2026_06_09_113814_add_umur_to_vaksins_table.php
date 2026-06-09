<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vaksins', function (Blueprint $table) {

            $table->integer('bulan_min')
                ->nullable()
                ->after('jenis_vaksin');

            $table->integer('bulan_max')
                ->nullable()
                ->after('bulan_min');

        });
    }

    public function down(): void
    {
        Schema::table('vaksins', function (Blueprint $table) {

            $table->dropColumn([
                'bulan_min',
                'bulan_max'
            ]);

        });
    }
};