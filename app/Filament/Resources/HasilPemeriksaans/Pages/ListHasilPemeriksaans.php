<?php

namespace App\Filament\Resources\HasilPemeriksaans\Pages;

use App\Filament\Resources\HasilPemeriksaans\HasilPemeriksaanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHasilPemeriksaans extends ListRecords
{
    protected static string $resource = HasilPemeriksaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
