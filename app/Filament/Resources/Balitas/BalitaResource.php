<?php

namespace App\Filament\Resources\Balitas;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\Balitas\Pages;
use App\Models\Balita;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker as FilterDatePicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Operation;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class BalitaResource extends Resource
{
    protected static ?string $model = Balita::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Master Posyandu';
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Data Balita';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            // TextInput::make('nik')
            //     ->label('NIK')
            //     ->required()
            //     ->unique(ignoreRecord: true),

            TextInput::make('nik')
    ->label('NIK')
    ->required()
    ->unique(ignoreRecord: true)
    ->suffixActions([
        Action::make('generateNik')
            ->icon('heroicon-m-arrow-path')
            ->tooltip('Generate NIK Sementara')
            ->action(function ($set) {
                $set('nik', '0000' . now()->format('ymdHis'));
            }),
    ]),

            TextInput::make('nama')
                ->label('Nama Balita')
                ->required(),

            TextInput::make('tempat_lahir')
                ->label('Tempat Lahir')
                ->maxLength(100)
                ->nullable(),

            DatePicker::make('tanggal_lahir')
                ->label('Tanggal Lahir')
                ->maxDate(now())
                ->required(),

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
                TextColumn::make('tanggal_lahir')->label('Tgl Lahir')->date('d M Y')->sortable(),
                TextColumn::make('jenis_kelamin')->label('JK')->sortable(),
                TextColumn::make('orang_tua')->label('Orang Tua'),
                TextColumn::make('alamat')->label('Alamat'),
                TextColumn::make('created_at')->label('Dibuat')->dateTime(),
            ])

            // ✅ Tambahkan filter jenis kelamin & tanggal
            ->filters([
                SelectFilter::make('jenis_kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ])
                    ->label('Jenis Kelamin'),

                Filter::make('created_at')
                    ->label('Tanggal Pendaftaran')
                    ->form([
                        FilterDatePicker::make('from')->label('Dari'),
                        FilterDatePicker::make('until')->label('Sampai'),
                    ])
                    ->query(function ($query, array $data): void {
                        $query
                            ->when($data['from'], fn($q, $date) => $q->whereDate('created_at', '>=', $date))
                            ->when($data['until'], fn($q, $date) => $q->whereDate('created_at', '<=', $date));
                    }),
            ])

            // ✅ Tambahkan tombol export di header dan bulk action
            ->headerActions([
                FilamentExportHeaderAction::make('export')
                    ->label('Export Data')
                    ->button()
                    ->fileName('data_balita')
                    ->defaultFormat('pdf')
                    ->disableXlsx()
                    ->disableCsv()
                    ->directDownload(),
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('export')
                    ->label('Export yang Dipilih')
                    ->button()
                    ->fileName('data_balita')
                    ->defaultFormat('pdf')
                    ->disableXlsx()
                    ->disableCsv(),
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
