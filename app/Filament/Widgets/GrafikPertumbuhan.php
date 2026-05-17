<?php

namespace App\Filament\Widgets;

use App\Models\Balita;
use Filament\Widgets\ChartWidget;

class GrafikPertumbuhan extends ChartWidget
{
    protected static bool $isDiscovered = false;
    public ?Balita $record = null;

    protected ?string $heading = 'Grafik Pertumbuhan';

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
                    'label' => 'Berat Badan (KG)',
                    'data' => $checkups->pluck('berat_badan')->toArray(),
                ],
            ],

            'labels' => $checkups
                ->pluck('created_at')
                ->map(fn ($date) => $date->format('d M'))
                ->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}