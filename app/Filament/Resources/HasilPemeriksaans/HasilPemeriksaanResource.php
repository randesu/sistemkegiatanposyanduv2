<?php

namespace App\Filament\Resources\HasilPemeriksaans;

use App\Filament\Resources\HasilPemeriksaans\Pages;
use App\Models\HasilPemeriksaan;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\MultiSelect;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class HasilPemeriksaanResource extends Resource
{
    protected static ?string $model = HasilPemeriksaan::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Manajemen Posyandu';
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?string $navigationLabel = 'Hasil Pemeriksaan';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('balita_id')
                ->label('Balita')
                ->relationship('balita', 'nama')
                ->required(),

            Select::make('petugas_id')
                ->label('Petugas Posyandu')
                ->relationship('petugas', 'nama')
                ->required(),

            TextInput::make('tinggi')->label('Tinggi (cm)')->numeric()->required(),
            TextInput::make('berat_badan')->label('Berat Badan (kg)')->numeric()->required(),
            Textarea::make('catatan')->label('Catatan'),

            MultiSelect::make('vaksins')
                ->label('Vaksin Diberikan')
                ->relationship('vaksins', 'nama_vaksin')
                ->preload(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('balita.nama')->label('Balita'),
            TextColumn::make('petugas.nama')->label('Petugas'),
            TextColumn::make('tinggi')->label('Tinggi (cm)'),
            TextColumn::make('berat_badan')->label('Berat (kg)'),
            // TextColumn::make('created_at')->label('Tanggal Pemeriksaan')->dateTime(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHasilPemeriksaans::route('/'),
            'create' => Pages\CreateHasilPemeriksaan::route('/create'),
            'edit' => Pages\EditHasilPemeriksaan::route('/{record}/edit'),
        ];
    }
}
