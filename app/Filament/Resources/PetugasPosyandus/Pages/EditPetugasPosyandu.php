<?php

namespace App\Filament\Resources\PetugasPosyandus\Pages;

use App\Filament\Resources\PetugasPosyandus\PetugasPosyanduResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPetugasPosyandu extends EditRecord
{
    protected static string $resource = PetugasPosyanduResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
