<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PetugasPosyandu extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'petugas_posyandu';
    protected $primaryKey = 'id';

    protected $fillable = [
        'email',
        'password',
        'name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Menentukan kolom yang digunakan untuk autentikasi (id).
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function hasilPemeriksaans()
    {
        return $this->hasMany(HasilPemeriksaan::class, 'petugas_id', 'id');
    }

    public function getFilamentName(): string
    {
        return $this->nama ?? $this->email ?? 'Petugas';
    }
}
