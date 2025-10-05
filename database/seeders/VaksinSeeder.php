<?php

namespace Database\Seeders;

use App\Models\Vaksin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VaksinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/VaksinSeeder.php
    public function run()
    {
        Vaksin::insert([
            ['nama_vaksin'=>'BCG','jenis_vaksin'=>'Bakteri','created_at'=>now(),'updated_at'=>now()],
            ['nama_vaksin'=>'DPT','jenis_vaksin'=>'Combo','created_at'=>now(),'updated_at'=>now()],
            ['nama_vaksin'=>'Polio','jenis_vaksin'=>'Virus','created_at'=>now(),'updated_at'=>now()],
        ]);
    }

}
