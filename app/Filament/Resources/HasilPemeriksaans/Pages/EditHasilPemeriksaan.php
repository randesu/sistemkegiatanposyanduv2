<?php

namespace App\Filament\Resources\HasilPemeriksaans\Pages;

use App\Filament\Resources\HasilPemeriksaans\HasilPemeriksaanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHasilPemeriksaan extends EditRecord
{
    protected static string $resource = HasilPemeriksaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
