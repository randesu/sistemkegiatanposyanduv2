<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;

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
        // Kita tidak perlu memuat vaksin di sini karena dashboard utama hanya menampilkan ringkasan
        $balita = Balita::with('hasilPemeriksaans')->findOrFail($request->balita_id);

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

        // Pastikan Anda telah menambahkan 'tanggal_lahir' dan 'jenis_kelamin'
        // ke model Balita dan database seperti yang didiskusikan sebelumnya.

        return view('balita.riwayat_pemeriksaan', compact('balita')); // Tampilan tabel riwayat pemeriksaan
    }
}