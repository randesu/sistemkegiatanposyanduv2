<?php
use App\Http\Controllers\BalitaDataController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');



Route::get('/cek-balita', [BalitaDataController::class, 'showForm'])->name('balita.form');
Route::post('/cek-balita', [BalitaDataController::class, 'showData'])->name('balita.data');




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
