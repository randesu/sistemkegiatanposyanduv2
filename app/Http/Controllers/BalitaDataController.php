<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BalitaDataController extends Controller
{
    public function showForm()
    {
        return view('balita.cek'); // form input NIK balita
    }

    public function showData(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|exists:balitas,nik',
        ], [
            'nik.exists' => 'Data balita dengan NIK tersebut tidak ditemukan.',
        ]);

        $balita = Balita::with(['hasilPemeriksaans' => function ($query) {
            $query->orderBy('created_at', 'asc');
        }])->where('nik', $request->nik)->firstOrFail();

        Carbon::setLocale('id');

        return view('balita.dashboard', compact('balita'));
    }

    public function showPemeriksaan(Request $request)
{
    $request->validate([
        'nik' => 'required|exists:balitas,nik',
    ]);

    $balita = \App\Models\Balita::with(['hasilPemeriksaans.vaksins', 'hasilPemeriksaans.vitamins'])
        ->where('nik', $request->nik)
        ->firstOrFail();

    \Carbon\Carbon::setLocale('id');

    return view('balita.riwayat_pemeriksaan', compact('balita'));
}


    public function showDataById($id)
    {
        $balita = \App\Models\Balita::findOrFail($id);

        return view('dashboard', compact('balita'));
    }

    public function showDetail(Request $request, Balita $balita = null)
    {
        // Jika menggunakan POST dan NIK dikirim via form
        if ($request->has('nik')) {
            $balita = Balita::where('nik', $request->input('nik'))->firstOrFail();
        } elseif (!$balita) {
            // Jika tidak ada parameter balita di URL dan tidak ada NIK di request
            abort(404, 'Data balita tidak ditemukan.');
        }

        return view('balita.detail', compact('balita'));
    }

    public function showIdCard(Request $request)
    {
        $request->validate(['nik' => 'required|exists:balitas,nik']);
        $balita = Balita::where('nik', $request->nik)->firstOrFail();
        return view('balita.id_card', compact('balita'));
    }

}
