<?php

namespace App\Filament\Resources\HasilPemeriksaans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class HasilPemeriksaanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('balita_id')
                    ->required()
                    ->numeric(),
                TextInput::make('petugas_id')
                    ->required()
                    ->numeric(),
                TextInput::make('tinggi')
                    ->numeric(),
                TextInput::make('berat_badan')
                    ->numeric(),
                Textarea::make('catatan')
                    ->columnSpanFull(),
            ]);
    }
}
