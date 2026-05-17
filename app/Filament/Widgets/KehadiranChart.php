<?php

namespace App\Filament\Widgets;

use App\Models\HasilPemeriksaan;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class KehadiranChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Kehadiran Balita';

    protected function getData(): array
    {
        $data = collect(range(0, 5))->map(function ($monthAgo) {

            $date = Carbon::now()->subMonths(5 - $monthAgo);

            return [
                'month' => $date->translatedFormat('M Y'),

                'total' => HasilPemeriksaan::query()
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ];
        });

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kehadiran',
                    'data' => $data->pluck('total')->toArray(),
                ],
            ],

            'labels' => $data->pluck('month')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}