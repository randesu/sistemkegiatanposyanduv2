<?php

namespace App\Http\Controllers;

use App\Models\HasilPemeriksaan;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilPemeriksaanPdfController extends Controller
{
    public function show(HasilPemeriksaan $hasil)
    {
        $pdf = Pdf::loadView('pdf.hasil-pemeriksaan', [
            'hasil' => $hasil,
        ]);

        $fileName = 'hasil-pemeriksaan-' . $hasil->id . '.pdf';

        return $pdf->download($fileName);
        // Atau kalau mau dibuka di browser:
        // return $pdf->stream($fileName);
    }
}
