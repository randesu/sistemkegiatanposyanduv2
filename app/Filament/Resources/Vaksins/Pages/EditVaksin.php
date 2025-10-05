<?php

namespace App\Filament\Resources\Vaksins\Pages;

use App\Filament\Resources\Vaksins\VaksinResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVaksin extends EditRecord
{
    protected static string $resource = VaksinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
