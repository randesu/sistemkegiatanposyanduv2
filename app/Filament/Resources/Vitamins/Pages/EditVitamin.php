<?php

namespace App\Filament\Resources\Vitamins\Pages;

use App\Filament\Resources\Vitamins\VitaminResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVitamin extends EditRecord
{
    protected static string $resource = VitaminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
