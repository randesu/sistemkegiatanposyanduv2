<?php
namespace App\Filament\Resources\HasilPemeriksaans\Pages;

use App\Models\Balita;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\HasilPemeriksaans\HasilPemeriksaanResource;

class CreateHasilPemeriksaan extends CreateRecord
{
    protected static string $resource = HasilPemeriksaanResource::class;

    public function fillBalitaFromQR(string $nik): void
    {
        $balita = Balita::where('nik', $nik)->first();

        if ($balita) {
            $this->form->fill([
                'balita_id' => $balita->id,
            ]);

            $this->notify('success', "Data Balita ditemukan: {$balita->nama}");
        } else {
            $this->notify('danger', 'Data Balita tidak ditemukan untuk NIK: ' . $nik);
        }
    }
}
