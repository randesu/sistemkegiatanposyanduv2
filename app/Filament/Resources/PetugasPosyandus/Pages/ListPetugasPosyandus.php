<?php

namespace App\Filament\Resources\PetugasPosyandus\Pages;

use App\Filament\Resources\PetugasPosyandus\PetugasPosyanduResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPetugasPosyandus extends ListRecords
{
    protected static string $resource = PetugasPosyanduResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
