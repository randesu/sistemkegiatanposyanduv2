<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // untuk login Laravel/Filament
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PetugasPosyandu extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'petugas_posyandu';
    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'password',
        'nama',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Kolom yang digunakan untuk autentikasi (username, bukan email)
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Relasi ke hasil pemeriksaan
     */
    public function hasilPemeriksaans()
    {
        return $this->hasMany(HasilPemeriksaan::class, 'petugas_id', 'id');
    }
}
