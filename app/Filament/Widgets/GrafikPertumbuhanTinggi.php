<?php

namespace App\Filament\Widgets;

use App\Models\Balita;
use Filament\Widgets\ChartWidget;

class GrafikPertumbuhanTinggi extends ChartWidget
{
    protected static bool $isDiscovered = false;
    public ?Balita $record = null;

    protected ?string $heading = 'Grafik Tinggi Badan';

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        if (!$this->record) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        $checkups = $this->record
            ->hasilPemeriksaans()
            ->orderBy('created_at')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Tinggi Badan (cm)',
                    'data' => $checkups
                        ->pluck('tinggi')
                        ->toArray(),
                ],
            ],

            'labels' => $checkups
                ->pluck('created_at')
                ->map(fn ($date) => $date->format('d M Y'))
                ->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}