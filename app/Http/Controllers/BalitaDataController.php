<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;

class BalitaDataController extends Controller
{
    public function showForm()
    {
        return view('balita.cek'); // form input ID
    }

    public function showData(Request $request)
    {
        $request->validate([
            'balita_id' => 'required|integer|exists:balitas,id',
        ], [
            'balita_id.exists' => 'Data balita tidak ditemukan.',
        ]);

        $balita = Balita::with('hasilPemeriksaans')->find($request->balita_id);

        return view('balita.data', compact('balita'));
    }
}
