<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WhoWeightAge;

class WhoWeightAgeSeeder extends Seeder
{
    public function run(): void
    {
        WhoWeightAge::truncate();

        $data = [

            /*
            |--------------------------------------------------------------------------
            | LAKI-LAKI
            |--------------------------------------------------------------------------
            */

            ['gender'=>'L','umur_bulan'=>0,'minus_3sd'=>2.1,'minus_2sd'=>2.5,'median'=>3.3,'plus_1sd'=>4.4,'plus_2sd'=>5.0],
            ['gender'=>'L','umur_bulan'=>1,'minus_3sd'=>2.9,'minus_2sd'=>3.4,'median'=>4.5,'plus_1sd'=>5.8,'plus_2sd'=>6.6],
            ['gender'=>'L','umur_bulan'=>2,'minus_3sd'=>3.8,'minus_2sd'=>4.3,'median'=>5.6,'plus_1sd'=>6.9,'plus_2sd'=>7.8],
            ['gender'=>'L','umur_bulan'=>3,'minus_3sd'=>4.4,'minus_2sd'=>5.0,'median'=>6.4,'plus_1sd'=>7.7,'plus_2sd'=>8.6],
            ['gender'=>'L','umur_bulan'=>4,'minus_3sd'=>4.9,'minus_2sd'=>5.6,'median'=>7.0,'plus_1sd'=>8.4,'plus_2sd'=>9.4],
            ['gender'=>'L','umur_bulan'=>5,'minus_3sd'=>5.3,'minus_2sd'=>6.0,'median'=>7.5,'plus_1sd'=>9.0,'plus_2sd'=>10.0],
            ['gender'=>'L','umur_bulan'=>6,'minus_3sd'=>5.7,'minus_2sd'=>6.4,'median'=>7.9,'plus_1sd'=>9.5,'plus_2sd'=>10.6],
            ['gender'=>'L','umur_bulan'=>7,'minus_3sd'=>5.9,'minus_2sd'=>6.7,'median'=>8.3,'plus_1sd'=>9.9,'plus_2sd'=>11.1],
            ['gender'=>'L','umur_bulan'=>8,'minus_3sd'=>6.2,'minus_2sd'=>6.9,'median'=>8.6,'plus_1sd'=>10.3,'plus_2sd'=>11.5],
            ['gender'=>'L','umur_bulan'=>9,'minus_3sd'=>6.4,'minus_2sd'=>7.1,'median'=>8.9,'plus_1sd'=>10.6,'plus_2sd'=>11.9],
            ['gender'=>'L','umur_bulan'=>10,'minus_3sd'=>6.6,'minus_2sd'=>7.4,'median'=>9.2,'plus_1sd'=>10.9,'plus_2sd'=>12.2],
            ['gender'=>'L','umur_bulan'=>11,'minus_3sd'=>6.8,'minus_2sd'=>7.6,'median'=>9.4,'plus_1sd'=>11.2,'plus_2sd'=>12.5],
            ['gender'=>'L','umur_bulan'=>12,'minus_3sd'=>6.9,'minus_2sd'=>7.7,'median'=>9.6,'plus_1sd'=>11.5,'plus_2sd'=>12.8],
            ['gender'=>'L','umur_bulan'=>13,'minus_3sd'=>7.1,'minus_2sd'=>7.9,'median'=>9.9,'plus_1sd'=>11.8,'plus_2sd'=>13.1],
            ['gender'=>'L','umur_bulan'=>14,'minus_3sd'=>7.2,'minus_2sd'=>8.1,'median'=>10.1,'plus_1sd'=>12.0,'plus_2sd'=>13.4],
            ['gender'=>'L','umur_bulan'=>15,'minus_3sd'=>7.4,'minus_2sd'=>8.3,'median'=>10.3,'plus_1sd'=>12.3,'plus_2sd'=>13.7],
            ['gender'=>'L','umur_bulan'=>16,'minus_3sd'=>7.5,'minus_2sd'=>8.4,'median'=>10.5,'plus_1sd'=>12.5,'plus_2sd'=>14.0],
            ['gender'=>'L','umur_bulan'=>17,'minus_3sd'=>7.7,'minus_2sd'=>8.6,'median'=>10.7,'plus_1sd'=>12.7,'plus_2sd'=>14.3],
            ['gender'=>'L','umur_bulan'=>18,'minus_3sd'=>7.8,'minus_2sd'=>8.8,'median'=>10.9,'plus_1sd'=>13.0,'plus_2sd'=>14.5],
            ['gender'=>'L','umur_bulan'=>19,'minus_3sd'=>8.0,'minus_2sd'=>8.9,'median'=>11.1,'plus_1sd'=>13.2,'plus_2sd'=>14.8],
            ['gender'=>'L','umur_bulan'=>20,'minus_3sd'=>8.1,'minus_2sd'=>9.1,'median'=>11.3,'plus_1sd'=>13.4,'plus_2sd'=>15.0],
            ['gender'=>'L','umur_bulan'=>21,'minus_3sd'=>8.2,'minus_2sd'=>9.2,'median'=>11.5,'plus_1sd'=>13.6,'plus_2sd'=>15.3],
            ['gender'=>'L','umur_bulan'=>22,'minus_3sd'=>8.4,'minus_2sd'=>9.4,'median'=>11.8,'plus_1sd'=>13.9,'plus_2sd'=>15.6],
            ['gender'=>'L','umur_bulan'=>23,'minus_3sd'=>8.5,'minus_2sd'=>9.5,'median'=>12.0,'plus_1sd'=>14.1,'plus_2sd'=>15.8],
            ['gender'=>'L','umur_bulan'=>24,'minus_3sd'=>8.6,'minus_2sd'=>9.7,'median'=>12.2,'plus_1sd'=>14.3,'plus_2sd'=>16.0],

            /*
            |--------------------------------------------------------------------------
            | PEREMPUAN
            |--------------------------------------------------------------------------
            */

            ['gender'=>'P','umur_bulan'=>0,'minus_3sd'=>2.0,'minus_2sd'=>2.4,'median'=>3.2,'plus_1sd'=>4.2,'plus_2sd'=>4.8],
            ['gender'=>'P','umur_bulan'=>1,'minus_3sd'=>2.7,'minus_2sd'=>3.2,'median'=>4.2,'plus_1sd'=>5.5,'plus_2sd'=>6.2],
            ['gender'=>'P','umur_bulan'=>2,'minus_3sd'=>3.4,'minus_2sd'=>3.9,'median'=>5.1,'plus_1sd'=>6.5,'plus_2sd'=>7.3],
            ['gender'=>'P','umur_bulan'=>3,'minus_3sd'=>4.0,'minus_2sd'=>4.5,'median'=>5.8,'plus_1sd'=>7.2,'plus_2sd'=>8.0],
            ['gender'=>'P','umur_bulan'=>4,'minus_3sd'=>4.4,'minus_2sd'=>5.0,'median'=>6.4,'plus_1sd'=>7.8,'plus_2sd'=>8.8],
            ['gender'=>'P','umur_bulan'=>5,'minus_3sd'=>4.8,'minus_2sd'=>5.4,'median'=>6.9,'plus_1sd'=>8.4,'plus_2sd'=>9.3],
            ['gender'=>'P','umur_bulan'=>6,'minus_3sd'=>5.1,'minus_2sd'=>5.7,'median'=>7.3,'plus_1sd'=>8.8,'plus_2sd'=>9.8],
            ['gender'=>'P','umur_bulan'=>7,'minus_3sd'=>5.3,'minus_2sd'=>6.0,'median'=>7.6,'plus_1sd'=>9.2,'plus_2sd'=>10.3],
            ['gender'=>'P','umur_bulan'=>8,'minus_3sd'=>5.6,'minus_2sd'=>6.3,'median'=>7.9,'plus_1sd'=>9.6,'plus_2sd'=>10.7],
            ['gender'=>'P','umur_bulan'=>9,'minus_3sd'=>5.8,'minus_2sd'=>6.5,'median'=>8.2,'plus_1sd'=>9.9,'plus_2sd'=>11.0],
            ['gender'=>'P','umur_bulan'=>10,'minus_3sd'=>5.9,'minus_2sd'=>6.7,'median'=>8.5,'plus_1sd'=>10.2,'plus_2sd'=>11.4],
            ['gender'=>'P','umur_bulan'=>11,'minus_3sd'=>6.1,'minus_2sd'=>6.9,'median'=>8.7,'plus_1sd'=>10.5,'plus_2sd'=>11.7],
            ['gender'=>'P','umur_bulan'=>12,'minus_3sd'=>6.3,'minus_2sd'=>7.0,'median'=>8.9,'plus_1sd'=>10.8,'plus_2sd'=>12.0],
            ['gender'=>'P','umur_bulan'=>13,'minus_3sd'=>6.4,'minus_2sd'=>7.2,'median'=>9.2,'plus_1sd'=>11.0,'plus_2sd'=>12.3],
            ['gender'=>'P','umur_bulan'=>14,'minus_3sd'=>6.6,'minus_2sd'=>7.4,'median'=>9.4,'plus_1sd'=>11.3,'plus_2sd'=>12.6],
            ['gender'=>'P','umur_bulan'=>15,'minus_3sd'=>6.7,'minus_2sd'=>7.6,'median'=>9.6,'plus_1sd'=>11.5,'plus_2sd'=>12.8],
            ['gender'=>'P','umur_bulan'=>16,'minus_3sd'=>6.9,'minus_2sd'=>7.7,'median'=>9.8,'plus_1sd'=>11.7,'plus_2sd'=>13.1],
            ['gender'=>'P','umur_bulan'=>17,'minus_3sd'=>7.0,'minus_2sd'=>7.9,'median'=>10.0,'plus_1sd'=>12.0,'plus_2sd'=>13.4],
            ['gender'=>'P','umur_bulan'=>18,'minus_3sd'=>7.2,'minus_2sd'=>8.1,'median'=>10.2,'plus_1sd'=>12.2,'plus_2sd'=>13.6],
            ['gender'=>'P','umur_bulan'=>19,'minus_3sd'=>7.3,'minus_2sd'=>8.2,'median'=>10.4,'plus_1sd'=>12.5,'plus_2sd'=>13.9],
            ['gender'=>'P','umur_bulan'=>20,'minus_3sd'=>7.5,'minus_2sd'=>8.4,'median'=>10.6,'plus_1sd'=>12.7,'plus_2sd'=>14.1],
            ['gender'=>'P','umur_bulan'=>21,'minus_3sd'=>7.6,'minus_2sd'=>8.6,'median'=>10.9,'plus_1sd'=>13.0,'plus_2sd'=>14.4],
            ['gender'=>'P','umur_bulan'=>22,'minus_3sd'=>7.8,'minus_2sd'=>8.7,'median'=>11.1,'plus_1sd'=>13.2,'plus_2sd'=>14.6],
            ['gender'=>'P','umur_bulan'=>23,'minus_3sd'=>7.9,'minus_2sd'=>8.9,'median'=>11.3,'plus_1sd'=>13.5,'plus_2sd'=>14.9],
            ['gender'=>'P','umur_bulan'=>24,'minus_3sd'=>8.1,'minus_2sd'=>9.0,'median'=>11.5,'plus_1sd'=>13.7,'plus_2sd'=>15.1],

        ];

        foreach ($data as $item) {
            WhoWeightAge::create($item);
        }
    }
}