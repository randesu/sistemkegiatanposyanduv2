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

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

// ✅ tambahan untuk filter tanggal
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;

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
                ->label('Email')
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
        return $table
            ->columns([
                TextColumn::make('email')->label('Email')->searchable(),
                TextColumn::make('name')->label('Nama')->searchable(),
                TextColumn::make('created_at')->label('Dibuat')->dateTime(),
            ])

            // filter tanggal
            ->filters([
                Filter::make('created_at')
                    ->label('Filter Tanggal')
                    ->form([
                        DatePicker::make('from')->label('Dari Tanggal'),
                        DatePicker::make('until')->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data): void {
                        $query
                            ->when($data['from'], fn($q, $date) => $q->whereDate('created_at', '>=', $date))
                            ->when($data['until'], fn($q, $date) => $q->whereDate('created_at', '<=', $date));
                    }),
            ])

            ->headerActions([
                FilamentExportHeaderAction::make('export')
                    ->label('Export Data')
                    ->button()
                    ->fileName('petugas_posyandu')
                    ->defaultFormat('pdf')
                    ->disableXlsx()
                    ->disableCsv()
                    ->directDownload(),
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('export')
                    ->label('Export yang Dipilih')
                    ->button()
                    ->fileName('petugas_posyandu')
                    ->defaultFormat('pdf')
                    ->disableXlsx()
                    ->disableCsv(),
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
