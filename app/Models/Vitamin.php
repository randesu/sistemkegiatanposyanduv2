<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vitamin extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang sesuai jika berbeda dari konvensi jamak (defaultnya 'vitamins')
    protected $table = 'vitamin'; 

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     * Kolom 'nama_vitamin' perlu diizinkan untuk diisi.
     */
    protected $fillable = [
        'nama_vitamin',
    ];
}