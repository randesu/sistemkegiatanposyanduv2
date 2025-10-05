<?php

namespace App\Filament\Resources\Balitas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BalitaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nik')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                TextInput::make('orang_tua'),
                TextInput::make('password')
                    ->password(),
            ]);
    }
}
