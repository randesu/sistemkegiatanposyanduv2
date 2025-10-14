<?php

namespace App\Filament\Resources\Balitas;

use App\Filament\Resources\Balitas\Pages;
use App\Models\Balita;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker; // Import baru: DatePicker
use Filament\Forms\Components\Select;     // Import baru: Select
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Enums\Operation;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Filters\SelectFilter; // Import baru: SelectFilter

class BalitaResource extends Resource
{
    protected static ?string $model = Balita::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Master Posyandu';
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Data Balita';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            // Kolom yang sudah ada
            TextInput::make('nik')
                ->label('NIK')
                ->required()
                ->unique(ignoreRecord: true),

            TextInput::make('nama')
                ->label('Nama Balita')
                ->required(),

            // --- ATRIBUT BARU: DETAIL BALITA ---

            TextInput::make('tempat_lahir')
                ->label('Tempat Lahir')
                ->maxLength(100)
                ->nullable(),

            DatePicker::make('tanggal_lahir')
                ->label('Tanggal Lahir')
                ->maxDate(now()) // Batasi tanggal maksimum hingga hari ini
                ->nullable()
                ->required(), // Jika Anda ingin wajib diisi di form

            Select::make('jenis_kelamin')
                ->label('Jenis Kelamin')
                ->options([
                    'Laki-laki' => 'Laki-laki',
                    'Perempuan' => 'Perempuan',
                ])
                ->required(),

            Textarea::make('alamat')
                ->label('Alamat')
                ->rows(3)
                ->nullable(),

            // Kolom yang sudah ada
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
                
                // --- KOLOM BARU DI TABEL ---
                TextColumn::make('tanggal_lahir')
                    ->label('Tgl Lahir')
                    ->date('d M Y')
                    ->sortable(),
                
                TextColumn::make('jenis_kelamin')
                    ->label('JK')
                    ->sortable(),
                // -----------------------------

                TextColumn::make('orang_tua')->label('Orang Tua'),
                TextColumn::make('created_at')->label('Dibuat')->dateTime(),
            ])
            ->filters([
                // Menambahkan filter berdasarkan Jenis Kelamin
                SelectFilter::make('jenis_kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ])
                    ->label('Jenis Kelamin'),
            ]);
            // Bagian actions dan bulkActions lainnya tetap sama
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