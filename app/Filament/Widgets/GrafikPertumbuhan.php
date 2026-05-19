<?php

namespace App\Filament\Widgets;

use App\Models\Balita;
use App\Models\WhoWeightAge;
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

        // DATA ANAK
        $anakData = [];

        // DATA WHO
        $medianData = [];
        $minus2Data = [];
        $minus3Data = [];

        $plus1Data = [];
        $plus2Data = [];

        $pointColors = [];

        foreach ($checkups as $checkup) {

            // HITUNG UMUR
            $umur = round(
                Carbon::parse($this->record->tanggal_lahir)
                    ->diffInMonths($checkup->created_at, true),
                1
            );

            $umurBulan = floor($umur);

            $berat = $checkup->berat_badan;

            // AMBIL GENDER
            $gender = $this->record->jenis_kelamin;

            if ($gender === 'Laki-laki') {
                $gender = 'L';
            }

            if ($gender === 'Perempuan') {
                $gender = 'P';
            }

            // AMBIL DATA WHO
            $who = WhoWeightAge::where('gender', $gender)
                ->where('umur_bulan', $umurBulan)
                ->first();

            $labels[] = $umur . ' bln';

            // DATA BERAT BADAN ANAK
            $anakData[] = $berat;

            // DATA WHO
            $medianData[] = $who?->median;
            $minus2Data[] = $who?->minus_2sd;
            $minus3Data[] = $who?->minus_3sd;

            $plus1Data[] = $who?->plus_1sd;
            $plus2Data[] = $who?->plus_2sd;

            // WARNA TITIK BERDASARKAN WHO
            if ($who) {

                if ($berat < $who->minus_3sd) {

                    $pointColors[] = '#ef4444'; // merah

                } elseif ($berat < $who->minus_2sd) {

                    $pointColors[] = '#facc15'; // kuning

                } else {

                    $pointColors[] = '#22c55e'; // hijau

                }

            } else {

                $pointColors[] = '#3b82f6';

            }
        }

        return [
            'datasets' => [

                // GARIS WHO +2 SD
                [
                    'label' => '+2 SD',

                    'data' => $plus2Data,

                    'borderColor' => '#16a34a',

                    'backgroundColor' => 'transparent',

                    'borderWidth' => 2,

                    'borderDash' => [6, 4],

                    'pointRadius' => 0,

                    'tension' => 0.4,
                ],

                // GARIS WHO +1 SD
                [
                    'label' => '+1 SD',

                    'data' => $plus1Data,

                    'borderColor' => '#86efac',

                    'backgroundColor' => 'transparent',

                    'borderWidth' => 2,

                    'borderDash' => [4, 4],

                    'pointRadius' => 0,

                    'tension' => 0.4,
                ],

                // GARIS WHO MEDIAN
                [
                    'label' => 'Median WHO',

                    'data' => $medianData,

                    'borderColor' => '#22c55e',

                    'backgroundColor' => 'transparent',

                    'borderWidth' => 2,

                    'pointRadius' => 0,

                    'tension' => 0.4,
                ],

                // GARIS WHO -2 SD
                [
                    'label' => '-2 SD',

                    'data' => $minus2Data,

                    'borderColor' => '#facc15',

                    'backgroundColor' => 'transparent',

                    'borderWidth' => 2,

                    'borderDash' => [5, 5],

                    'pointRadius' => 0,

                    'tension' => 0.4,
                ],

                // GARIS WHO -3 SD
                [
                    'label' => '-3 SD',

                    'data' => $minus3Data,

                    'borderColor' => '#ef4444',

                    'backgroundColor' => 'transparent',

                    'borderWidth' => 2,

                    'borderDash' => [8, 5],

                    'pointRadius' => 0,

                    'tension' => 0.4,
                ],

                // GARIS BERAT BADAN ANAK
                [
                    'label' => 'Berat Badan Anak',

                    'data' => $anakData,

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