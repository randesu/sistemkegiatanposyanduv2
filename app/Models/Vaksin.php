<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Vaksin extends Model
{
    protected $table = 'vaksins';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_vaksin','jenis_vaksin'];

    public function hasilPemeriksaans()
    {
        return $this->belongsToMany(HasilPemeriksaan::class, 'hasil_vaksin', 'vaksin_id', 'hasil_id')
                    ->withPivot('dosis','tanggal_vaksin')->withTimestamps();
    }
}
