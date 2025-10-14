<?php

use App\Http\Controllers\BalitaDataController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

// 1. Rute untuk menampilkan form input ID Balita
// URL: /
// Nama Rute: balita.form
Route::get('/', [BalitaDataController::class, 'showForm'])->name('balita.form');

// 2. Rute untuk memproses ID dan menampilkan Dashboard Utama (Card Menu)
// Dashboard Utama ini adalah tempat pengguna melihat Ringkasan data dan menekan "Riwayat Pemeriksaan"
// URL: /dashboard-balita
// Nama Rute: balita.dashboard
Route::post('/dashboard-balita', [BalitaDataController::class, 'showData'])->name('balita.dashboard');


// 3. Rute untuk menampilkan halaman Riwayat Pemeriksaan Detail (Tabel)
// Halaman ini muncul setelah pengguna menekan kartu "Riwayat Pemeriksaan" di dashboard utama.
// URL: /balita/{id}/pemeriksaan
// Nama Rute: balita.hasil-pemeriksaan
Route::get('/balita/{id}/pemeriksaan', [BalitaDataController::class, 'showPemeriksaan'])->name('balita.hasil-pemeriksaan');


// Catatan: Jika ada rute Fortify/Livewire/Volt lainnya, mereka harus diletakkan di sini juga.
//Route::post('/riwayat-balita', [BalitaDataController::class, ])->name('balita.data');



// Route::get('/login-user', [UserLoginController::class, 'showLogin'])->name('user.login');
// Route::post('/login-user', [UserLoginController::class, 'authenticate'])->name('user.authenticate');

// Route::get('/dashboard-user', [UserLoginController::class, 'dashboard'])
//     ->middleware('auth')
//     ->name('user.dashboard');

// Route::post('/logout-user', [UserLoginController::class, 'logout'])->name('user.logout');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
//     Volt::route('settings/password', 'settings.password')->name('password.edit');
//     Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

//     Volt::route('settings/two-factor', 'settings.two-factor')
//         ->middleware(
//             when(
//                 Features::canManageTwoFactorAuthentication()
//                     && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
//                 ['password.confirm'],
//                 [],
//             ),
//         )
//         ->name('two-factor.show');
// });

// require __DIR__.'/auth.php';
