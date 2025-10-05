<?php

// app/Models/Balita.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // bila balita/ortu login (opsional)

class Balita extends Model
{
    protected $table = 'balitas';
    protected $primaryKey = 'id';
    protected $fillable = ['nik','nama','orang_tua','password'];
    public $timestamps = true;

    public function hasilPemeriksaans()
    {
        return $this->hasMany(HasilPemeriksaan::class, 'balita_id', 'id');
    }
}

