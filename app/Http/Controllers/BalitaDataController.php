<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;
use Carbon\Carbon; // <--- Impor Carbon di sini

class BalitaDataController extends Controller
{
    public function showForm()
    {
        return view('balita.cek'); // form input ID balita
    }

    public function showData(Request $request)
    {
        $request->validate([
            'balita_id' => 'required|integer|exists:balitas,id',
        ], [
            'balita_id.exists' => 'Data balita tidak ditemukan.',
        ]);

        // Load balita beserta hasil pemeriksaan untuk dashboard utama
        // dan pastikan hasilPemeriksaans diurutkan berdasarkan tanggal
        $balita = Balita::with(['hasilPemeriksaans' => function($query) {
            $query->orderBy('created_at', 'asc'); // Urutkan dari terlama ke terbaru
        }])->findOrFail($request->balita_id);

        // Set locale Carbon untuk memastikan 'translatedFormat' di Blade bekerja
        Carbon::setLocale('id'); // <--- Set locale ke Bahasa Indonesia

        return view('balita.dashboard', compact('balita')); // Mengarahkan ke tampilan dashboard utama
    }

    /**
     * Menampilkan halaman riwayat pemeriksaan lengkap untuk balita tertentu.
     */
    public function showPemeriksaan($balitaId)
    {
        // Memuat balita dan relasi hasilPemeriksaans,
        // serta vaksins di setiap hasil pemeriksaan
        $balita = Balita::with(['hasilPemeriksaans.vaksins'])->findOrFail($balitaId);

        // Set locale Carbon untuk memastikan 'translatedFormat' di Blade bekerja
        Carbon::setLocale('id'); // <--- Set locale ke Bahasa Indonesia

        return view('balita.riwayat_pemeriksaan', compact('balita')); // Tampilan tabel riwayat pemeriksaan
    }
}