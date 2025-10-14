<?php

namespace App\Filament\Resources\Vitamins;

use Filament\Tables;
use App\Models\Vitamin;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\Vitamins\Pages;
use Filament\Schemas\Schema;
use Filament\Forms\Components;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

class VitaminResource extends Resource
{
    protected static ?string $model = Vitamin::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Master Posyandu';
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $navigationLabel = 'Vitamin';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Components\TextInput::make('nama_vitamin')
                ->label('Nama Vitamin')
                ->required()
                ->maxLength(100)
                ->unique(ignoreRecord: true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('ID'),
                
                Tables\Columns\TextColumn::make('nama_vitamin')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Vitamin'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Dibuat Pada'),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan nanti
            ])
            ->headerActions([
                // ✅ Tombol export di header (export semua data)
                FilamentExportHeaderAction::make('export'),
            ])
            ->bulkActions([
                // ✅ Export hanya data yang dipilih (checkbox)
                FilamentExportBulkAction::make('export'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVitamins::route('/'),
            'create' => Pages\CreateVitamin::route('/create'),
            'edit' => Pages\EditVitamin::route('/{record}/edit'),
        ];
    }
}
