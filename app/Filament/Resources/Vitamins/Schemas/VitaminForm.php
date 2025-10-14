<?php

namespace App\Filament\Resources\Vitamins\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VitaminForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_vitamin')
                    ->required(),
            ]);
    }
}
