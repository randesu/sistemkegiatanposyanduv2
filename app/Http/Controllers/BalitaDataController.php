<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BalitaDataController extends Controller
{
    public function showForm()
    {
        return view('balita.cek');
    }

    public function showData(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|exists:balitas,nik',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'nik.exists' => 'Data balita dengan NIK tersebut tidak ditemukan.',
            'g-recaptcha-response.required' => 'Silakan selesaikan CAPTCHA terlebih dahulu.',
            'g-recaptcha-response.captcha' => 'Verifikasi CAPTCHA gagal.',
        ]);

        $balita = Balita::with([
            'hasilPemeriksaans' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }
        ])
            ->where('nik', $request->nik)
            ->firstOrFail();

        Carbon::setLocale('id');

        return view('balita.dashboard', compact('balita'));
    }

    public function showPemeriksaan(Request $request)
    {
        $request->validate([
            'nik' => 'required|exists:balitas,nik',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'nik.exists' => 'Data balita dengan NIK tersebut tidak ditemukan.',
            'g-recaptcha-response.required' => 'Silakan selesaikan CAPTCHA terlebih dahulu.',
            'g-recaptcha-response.captcha' => 'Verifikasi CAPTCHA gagal.',
        ]);

        $balita = Balita::with([
            'hasilPemeriksaans.vaksins',
            'hasilPemeriksaans.vitamins'
        ])
            ->where('nik', $request->nik)
            ->firstOrFail();

        Carbon::setLocale('id');

        return view('balita.riwayat_pemeriksaan', compact('balita'));
    }

    public function showDataById($id)
    {
        $balita = Balita::findOrFail($id);

        return view('dashboard', compact('balita'));
    }

    public function showDetail(Request $request, Balita $balita = null)
    {
        if ($request->has('nik')) {

            $request->validate([
                'g-recaptcha-response' => 'required|captcha',
            ], [
                'g-recaptcha-response.required' => 'Silakan selesaikan CAPTCHA terlebih dahulu.',
                'g-recaptcha-response.captcha' => 'Verifikasi CAPTCHA gagal.',
            ]);

            $balita = Balita::where('nik', $request->input('nik'))->firstOrFail();
        } elseif (!$balita) {

            abort(404, 'Data balita tidak ditemukan.');
        }

        return view('balita.detail', compact('balita'));
    }

    public function showIdCard(Request $request)
    {
        $request->validate([
            'nik' => 'required|exists:balitas,nik',
            'g-recaptcha-response' => 'required|captcha',
        ], [
            'nik.exists' => 'Data balita dengan NIK tersebut tidak ditemukan.',
            'g-recaptcha-response.required' => 'Silakan selesaikan CAPTCHA terlebih dahulu.',
            'g-recaptcha-response.captcha' => 'Verifikasi CAPTCHA gagal.',
        ]);

        $balita = Balita::where('nik', $request->nik)->firstOrFail();

        return view('balita.id_card', compact('balita'));
    }
}