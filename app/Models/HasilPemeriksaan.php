<?php

// app/Models/HasilPemeriksaan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Tambahkan import ini

class HasilPemeriksaan extends Model
{
    protected $table = 'hasil_pemeriksaans';
    protected $primaryKey = 'id';
    protected $fillable = ['balita_id','petugas_id','tinggi','berat_badan','catatan'];

    public function balita() { return $this->belongsTo(Balita::class, 'balita_id', 'id'); }
    public function petugas() { return $this->belongsTo(PetugasPosyandu::class, 'petugas_id', 'id'); }
    
    public function vaksins() { 
        return $this->belongsToMany(Vaksin::class, 'hasil_vaksin', 'hasil_id', 'vaksin_id')
                    ->withPivot('dosis','tanggal_vaksin')->withTimestamps();
    }

    /**
     * Relasi Many-to-Many ke model Vitamin melalui tabel pivot 'hasil_vitamin'.
     */
    public function vitamins(): BelongsToMany
    {
        return $this->belongsToMany(Vitamin::class, 'hasil_vitamin', 'hasil_pemeriksaan_id', 'vitamin_id');
    }
}
