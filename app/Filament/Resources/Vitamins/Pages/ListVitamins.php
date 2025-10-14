<?php

namespace App\Filament\Resources\Vitamins\Pages;

use App\Filament\Resources\Vitamins\VitaminResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVitamins extends ListRecords
{
    protected static string $resource = VitaminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
