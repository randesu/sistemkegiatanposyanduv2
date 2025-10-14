<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Balita extends Authenticatable
{
    use Notifiable;

    protected $table = 'balitas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nik',
        'nama',
        'orang_tua',
        'password',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Login akan menggunakan kolom ID sebagai identifier utama.
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Relasi ke hasil pemeriksaan.
     */
    public function hasilPemeriksaans()
    {
        return $this->hasMany(HasilPemeriksaan::class, 'balita_id', 'id');
    }

    /**
     * Mutator (opsional) jika suatu saat ingin menyimpan password terenkripsi.
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
