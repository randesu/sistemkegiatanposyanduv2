<?php

namespace App\Filament\Resources\Balitas\Pages;

use App\Filament\Resources\Balitas\BalitaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Widgets\GrafikPertumbuhan;
use App\Filament\Widgets\GrafikPertumbuhanTinggi;
use App\Filament\Widgets\HistoriPemeriksaan;

class EditBalita extends EditRecord
{
    protected static string $resource = BalitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
        GrafikPertumbuhan::make([
            'record' => $this->record,
        ]),
        GrafikPertumbuhanTinggi::make([
                'record' => $this->record,
            ]),
    ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            HistoriPemeriksaan::make([
                'record' => $this->record,
            ]),
        ];
    }
}
