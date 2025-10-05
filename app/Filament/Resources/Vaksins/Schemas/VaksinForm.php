<?php

namespace App\Filament\Resources\Vaksins\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VaksinForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_vaksin')
                    ->required(),
                TextInput::make('jenis_vaksin'),
            ]);
    }
}
