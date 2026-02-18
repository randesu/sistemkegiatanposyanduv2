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

// ✅ Tambahan
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker as FilterDatePicker;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

// use JeffersonGoncalves\Filament\QrCodeField\Forms\Components\QrCodeInput;
use Filament\Forms\Components\ViewField;

use App\Models\Balita;

class HasilPemeriksaanResource extends Resource
{
    protected static ?string $model = HasilPemeriksaan::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Manajemen Posyandu';
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-clipboard-document';
    protected static ?string $navigationLabel = 'Check-Up';

    public static function form(Schema $schema): Schema
    {
        
    return $schema->components([
            
         ViewField::make('balita_qr_scanner')
            ->label('Scan QR Balita')
            ->view('filament.forms.components.balita-qr-scanner')
            ->dehydrated(false) // jangan disimpan ke DB
            ->columnSpSERVERanFull()
            ->viewData([
                'balitaStatePath' => 'balita_id', // kita akan set ini dari JS
            ]),

        Select::make('balita_id')
            ->label('Balita')
            ->relationship('balita', 'nama')
            ->searchable(['nama', 'orang_tua', 'nik'])
            ->getOptionLabelFromRecordUsing(fn ($record) =>
                $record->nama . ' (' . $record->orang_tua . ')'
            )
            ->required(),

        // Select::make('balita_id')
        //     ->label('Balita')
        //     ->relationship('balita', 'nama')
        //     ->searchable()
        //     ->required(),

        // Select::make('petugas_id')
        //     ->label('Petugas Posyandu')
        //     ->relationship('petugas', 'name'),
            

        TextInput::make('tinggi')->label('Tinggi (cm)')->numeric()->required(),
        TextInput::make('berat_badan')->label('Berat Badan (kg)')->numeric()->required(),
        Textarea::make('catatan')->label('Catatan'),

        TextInput::make('lingkar_kepala')->label('lingkar kepala (cm)')->numeric(),


        MultiSelect::make('vaksins')
            ->label('Vaksin Diberikan')
            ->relationship('vaksins', 'nama_vaksin')
            ->preload(),

        MultiSelect::make('vitamins')
            ->label('Vitamin Diberikan')
            ->relationship('vitamins', 'nama_vitamin')
            ->preload()
            ->helperText('Pilih vitamin yang diberikan pada pemeriksaan ini.'),
    ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('balita.nama')->label('Balita')->searchable(),
                TextColumn::make('petugas.name')->label('Petugas')->searchable(),
                TextColumn::make('tinggi')->label('Tinggi (cm)'),
                                TextColumn::make('lingkar_kepala')->label('Tinggi (cm)'),
                TextColumn::make('berat_badan')->label('Berat (kg)'),

                TextColumn::make('vaksins.nama_vaksin')
                    ->label('Vaksin')
                    ->formatStateUsing(fn($state) => is_array($state) ? implode(', ', $state) : $state)
                    ->badge(),

                TextColumn::make('vitamins.nama_vitamin')
                    ->label('Vitamin')
                    ->formatStateUsing(fn($state) => is_array($state) ? implode(', ', $state) : $state)
                    ->badge(),

                TextColumn::make('created_at')->label('Tanggal Pemeriksaan')->dateTime(),
            ])

            // ✅ Filter berdasarkan tanggal pemeriksaan
            ->filters([
                Filter::make('created_at')
                    ->label('Tanggal Pemeriksaan')
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

            // ✅ Tambahkan tombol Export di header dan bulk action
            ->headerActions([
                FilamentExportHeaderAction::make('export')
                    ->label('Export Data Pemeriksaan')
                    ->button()
                    ->fileName('hasil_pemeriksaan')
                    ->defaultFormat('pdf')
                    ->disableXlsx()
                    ->disableCsv()
                    ->directDownload(),
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('export')
                    ->label('Export yang Dipilih')
                    ->button()
                    ->fileName('hasil_pemeriksaan')
                    ->defaultFormat('pdf')
                    ->disableXlsx()
                    ->disableCsv(),
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
