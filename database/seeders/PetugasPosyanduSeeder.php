<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\PetugasPosyandu;

class PetugasPosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PetugasPosyandu::create([
            'name' => 'Admin Posyandu',
            'email' => 'admin@posyandu.com',
            'password' => Hash::make('admin123'), // otomatis bcrypt
        ]);

        PetugasPosyandu::create([
            'name' => 'Petugas 1',
            'email' => 'petugas1@posyandu.com',
            'password' => Hash::make('petugas123'),
        ]);
    }
}
