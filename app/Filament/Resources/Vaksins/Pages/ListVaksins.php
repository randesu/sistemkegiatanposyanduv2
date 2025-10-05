<?php

namespace App\Filament\Resources\Vaksins\Pages;

use App\Filament\Resources\Vaksins\VaksinResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVaksins extends ListRecords
{
    protected static string $resource = VaksinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
