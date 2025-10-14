<?php

namespace App\Filament\Resources\Vitamins;

use Filament\Tables;
use App\Models\Vitamin;
use Filament\Tables\Table;
use Tables\Actions\EditAction;
use Filament\Resources\Resource;
use Tables\Actions\DeleteAction;
use App\Filament\Resources\Vitamins\Pages;
use Filament\Schemas\Schema; // Pastikan impor ini
use Filament\Forms\Components; // Gunakan alias untuk Components

class VitaminResource extends Resource
{
    protected static ?string $model = Vitamin::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Master Posyandu';
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $navigationLabel = 'Vitamin';

    /**
     * Tanda tangan (signature) yang BENAR untuk Filament v4 adalah Schema $schema
     */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([ // Panggil components() pada objek $schema
                Components\TextInput::make('nama_vitamin') // Gunakan alias Components\TextInput
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
                //
            ]);
            // ->actions([
            //     EditAction::make(),
            //     DeleteAction::make(),
            // ])
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
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