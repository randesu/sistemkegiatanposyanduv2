<?php

namespace App\Filament\Widgets;

use App\Models\Balita;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class GrafikPertumbuhan extends ChartWidget
{
    protected static bool $isDiscovered = false;

    public ?Balita $record = null;

    protected ?string $heading = 'Grafik Pertumbuhan Berat Badan';

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

        $labels = [];
        $data = [];
        $pointColors = [];

        foreach ($checkups as $checkup) {

            // Hitung umur dalam bulan
           $umur = round(
    Carbon::parse($this->record->tanggal_lahir)
        ->diffInMonths($checkup->created_at, true),
    1
);

            $berat = $checkup->berat_badan;

            $labels[] = $umur . ' bln';
            $data[] = $berat;

            // Warna status sederhana
            if ($berat < 7) {
                $pointColors[] = '#ef4444'; // merah
            } elseif ($berat < 8) {
                $pointColors[] = '#facc15'; // kuning
            } else {
                $pointColors[] = '#22c55e'; // hijau
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Berat Badan (KG)',
                    'data' => $data,

                    'borderColor' => '#3b82f6',
                    'borderWidth' => 3,

                    'backgroundColor' => 'rgba(59, 130, 246, 0.15)',

                    'pointBackgroundColor' => $pointColors,
                    'pointBorderColor' => $pointColors,

                    'pointRadius' => 6,
                    'pointHoverRadius' => 8,

                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],

            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    
}