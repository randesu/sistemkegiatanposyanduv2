<?php

namespace App\Filament\Resources\Vaksins;

use App\Filament\Resources\Vaksins\Pages;
use App\Models\Vaksin;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class VaksinResource extends Resource
{
    protected static ?string $model = Vaksin::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Master Posyandu';
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $navigationLabel = 'Data Vaksin';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nama_vaksin')
                ->label('Nama Vaksin')
                ->required(),

            TextInput::make('jenis_vaksin')
                ->label('Jenis Vaksin')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('nama_vaksin')->label('Nama Vaksin')->searchable(),
            TextColumn::make('jenis_vaksin')->label('Jenis'),
            TextColumn::make('created_at')->label('Dibuat')->dateTime(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVaksins::route('/'),
            'create' => Pages\CreateVaksin::route('/create'),
            'edit' => Pages\EditVaksin::route('/{record}/edit'),
        ];
    }
}
