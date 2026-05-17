<?php

namespace App\Filament\Widgets;

use App\Models\Balita;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class HistoriPemeriksaan extends BaseWidget
{
    protected static bool $isDiscovered = false;
    public ?Balita $record = null;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Histori Pemeriksaan';

    protected function getTableQuery(): Builder
    {
        return $this->record
            ->hasilPemeriksaans()
            ->with(['vaksins', 'vitamins'])
            ->getQuery()
            ->latest();
    }

    protected function getTableColumns(): array
    {
        return [

            Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal')
                ->date('d M Y'),

            Tables\Columns\TextColumn::make('berat_badan')
                ->label('Berat Badan (KG)'),

            Tables\Columns\TextColumn::make('tinggi')
                ->label('Tinggi Badan (CM)'),

            Tables\Columns\TextColumn::make('lingkar_kepala')
                ->label('Lingkar Kepala'),

            Tables\Columns\TextColumn::make('vaksins')
                ->label('Vaksin')
                ->formatStateUsing(function ($record) {
                    return $record->vaksins
                        ->pluck('nama_vaksin')
                        ->implode(', ');
                }),

            Tables\Columns\TextColumn::make('vitamins')
                ->label('Vitamin')
                ->formatStateUsing(function ($record) {
                    return $record->vitamins
                        ->pluck('nama_vitamin')
                        ->implode(', ');
                }),

        ];
    }
}