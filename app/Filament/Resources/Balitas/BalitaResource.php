<?php

namespace App\Filament\Resources\Balitas;

use App\Filament\Resources\Balitas\Pages;
use App\Models\Balita;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Enums\Operation;
use Illuminate\Support\Facades\Hash;

class BalitaResource extends Resource
{
    protected static ?string $model = Balita::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Manajemen Posyandu';
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Data Balita';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nik')
                ->label('NIK')
                ->required()
                ->unique(ignoreRecord: true),

            TextInput::make('nama')
                ->label('Nama Balita')
                ->required(),

            TextInput::make('orang_tua')
                ->label('Nama Orang Tua')
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
        return $table
            ->columns([
                TextColumn::make('nik')->label('NIK')->searchable(),
                TextColumn::make('nama')->label('Nama Balita')->searchable(),
                TextColumn::make('orang_tua')->label('Orang Tua'),
                TextColumn::make('created_at')->label('Dibuat')->dateTime(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBalitas::route('/'),
            'create' => Pages\CreateBalita::route('/create'),
            'edit' => Pages\EditBalita::route('/{record}/edit'),
        ];
    }
}
