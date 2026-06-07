<?php

use Illuminate\Support\Facades\Route;

// Auth pages
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;

// Pages
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Identity;
use App\Livewire\Pages\InitialScreening;
use App\Livewire\Pages\ResultScreening;
use App\Livewire\Pages\Pregnancy;
use App\Livewire\Pages\AncVisit;
use App\Livewire\Pages\Childbirth;
use App\Livewire\Pages\Baby;
use App\Livewire\Pages\MedicalRecord;
use App\Livewire\Pages\Profile;
use App\Livewire\Pages\UpdateStatus;

/*
|--------------------------------------------------------------------------
| GUEST — hanya bisa diakses kalau BELUM login
| Kalau sudah login → otomatis redirect ke '/'
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login',    Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/lupa-password', function () {
        return 'Coming soon';
    })->name('password.request');
});
 

/*
|--------------------------------------------------------------------------
| AUTH — sudah login, tapi BELUM tentu isi identitas
| Hanya route identitas yang ada di sini
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'profile.complete'])->group(function () {
    // Identitas pakai layout guest (tidak ada navbar/sidebar)
    Route::get('/identitas', Identity::class)->name('identitas');
});


/*
|--------------------------------------------------------------------------
| AUTH — hanya bisa diakses kalau SUDAH login + sudah isi identitas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/',              Home::class)->name('home');
    Route::get('/skrining-awal', InitialScreening::class)->name('skrining-awal');
    Route::get('/skrining-awal/{id}/hasil', ResultScreening::class)->name('skrining-hasil');
    Route::get('/kehamilan',                  Pregnancy::class)->name('kehamilan');
    Route::get('/kehamilan/kunjungan-baru',   AncVisit::class)->name('anc-visit');
    Route::get('/persalinan',    Childbirth::class)->name('persalinan');
    Route::get('/data-bayi',     Baby::class)->name('data-bayi');
    Route::get('/rekam-medis',     MedicalRecord::class)->name('rekam-medis');
    Route::get('/profil',          Profile::class)->name('profil');
    Route::get('/perbarui-status', UpdateStatus::class)->name('perbarui-status');
});
 
/*
|--------------------------------------------------------------------------
| LOGOUT — POST request, butuh auth
|--------------------------------------------------------------------------
*/
Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->middleware('auth')->name('logout');