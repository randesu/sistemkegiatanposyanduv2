<?php

namespace App\Filament\Resources\PetugasPosyandus;

use App\Filament\Resources\PetugasPosyandus\Pages;
use App\Models\PetugasPosyandu;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Enums\Operation;
use Illuminate\Support\Facades\Hash;

class PetugasPosyanduResource extends Resource
{
    protected static ?string $model = PetugasPosyandu::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Master Posyandu';
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Petugas Posyandu';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('email')
                ->label('email')
                ->required()
                ->unique(ignoreRecord: true),

            TextInput::make('name')
                ->label('Nama Lengkap')
                ->required(),

            TextInput::make('password')
                ->password()
                ->label('Password')
                ->dehydrateStateUsing(fn ($state) => $state ? Hash::make($state) : null)
                ->visibleOn(Operation::Create),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('email')->label('Email')->searchable(),
            TextColumn::make('name')->label('Nama')->searchable(),
            TextColumn::make('created_at')->label('Dibuat')->dateTime(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPetugasPosyandus::route('/'),
            'create' => Pages\CreatePetugasPosyandu::route('/create'),
            'edit' => Pages\EditPetugasPosyandu::route('/{record}/edit'),
        ];
    }
}
