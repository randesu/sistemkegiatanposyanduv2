<?php

namespace App\Filament\Resources\HasilPemeriksaans\Pages;

use App\Filament\Resources\HasilPemeriksaans\HasilPemeriksaanResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

class EditHasilPemeriksaan extends EditRecord
{
    protected static string $resource = HasilPemeriksaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),

            Actions\Action::make('exportPdf')
                ->label('Export ke PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->url(fn () => route('hasil-pemeriksaan.pdf', $this->getRecord()))
                ->openUrlInNewTab(),
        ];
    }
}
