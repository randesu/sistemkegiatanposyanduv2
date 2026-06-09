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
use Carbon\Carbon;

use App\Models\Vaksin;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

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

protected static ?string $modelLabel = 'Check-Up';

protected static ?string $pluralModelLabel = 'Check-Up';

    public static function form(Schema $schema): Schema
    {
        
    return $schema->components([
            
         ViewField::make('balita_qr_scanner')
            ->label('Scan QR Balita')
            ->view('filament.forms.components.balita-qr-scanner')
            ->dehydrated(false) // jangan disimpan ke DB
            ->columnSpanFull()
            ->viewData([
                'balitaStatePath' => 'balita_id', // kita akan set ini dari JS
            ]),
        Select::make('balita_id')
            ->label('Balita')
            ->relationship('balita', 'nama')
            ->searchable(['nama', 'orang_tua', 'nik'])
            ->searchPrompt('Ketik nama, NIK, atau orang tua...')
            ->getOptionLabelFromRecordUsing(fn ($record) =>
                $record->nama . ' (' . $record->orang_tua . ') - ' . $record->nik
            )
            ->live()
            ->afterStateUpdated(function (Set $set, $state) {

                $balita = Balita::find($state);

                if (!$balita || !$balita->tanggal_lahir) {
                    return;
                }

                $umurBulan = Carbon::parse($balita->tanggal_lahir)
                    ->diffInMonths(now());

                $vaksinIds = Vaksin::query()
                    ->where('bulan_min', '<=', $umurBulan)
                    ->where('bulan_max', '>=', $umurBulan)
                    ->pluck('id')
                    ->toArray();

                $set('vaksins', $vaksinIds);
            })
            ->required(),
        // Select::make('balita_id')
        //     ->label('Balita')
        //     ->relationship('balita', 'nama')
        //     ->searchable(['nama', 'orang_tua', 'nik'])
        //     ->searchPrompt('Ketik nama, NIK, atau orang tua...')
        //     ->getOptionLabelFromRecordUsing(fn ($record) =>
        //         $record->nama . ' (' . $record->orang_tua . ') - ' . $record->nik
        //     )
        //     ->required(),

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


        // Select::make('vaksins')
        //     ->relationship('vaksins', 'nama_vaksin')
        //     ->multiple()
        //     ->preload(),
        Select::make('vaksins')
                ->label('Vaksin')
                ->relationship('vaksins', 'nama_vaksin')
                ->multiple()
                ->preload()
                ->searchable()
                ->helperText(function (Get $get) {

                    $balitaId = $get('balita_id');

                    if (!$balitaId) {
                        return 'Pilih balita terlebih dahulu.';
                    }

                    $balita = Balita::find($balitaId);

                    if (!$balita || !$balita->tanggal_lahir) {
                        return null;
                    }

                    $umurBulan = Carbon::parse($balita->tanggal_lahir)
                        ->diffInMonths(now());

                    $vaksinRekomendasi = Vaksin::query()
                        ->where('bulan_min', '<=', $umurBulan)
                        ->where('bulan_max', '>=', $umurBulan)
                        ->pluck('nama_vaksin')
                        ->toArray();

                    if (empty($vaksinRekomendasi)) {
                        return "Tidak ada rekomendasi vaksin untuk usia {$umurBulan} bulan.";
                    }

                    return 'Rekomendasi usia ' . $umurBulan . ' bulan: ' . implode(', ', $vaksinRekomendasi);
                }),
        Select::make('vitamins')
            ->label('Vitamin')
            ->relationship('vitamins', 'nama_vitamin')
            ->multiple()
            ->preload()
            ->searchable(),
    ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('balita.nama')->label('Balita')->searchable(),
                // TextColumn::make('petugas.name')->label('Petugas')->searchable(),
                TextColumn::make('tinggi')->label('Tinggi (cm)'),
                TextColumn::make('berat_badan')->label('Berat (kg)'),
                                                TextColumn::make('lingkar_kepala')->label('Lingkar Kepala (cm)'),


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
