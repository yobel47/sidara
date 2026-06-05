<?php

use Illuminate\Support\Facades\Route;

// Auth pages
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;

// Pages
use App\Livewire\Pages\Home;
use App\Livewire\Pages\InitialScreening;
use App\Livewire\Pages\Pregnancy;
use App\Livewire\Pages\Childbirth;
use App\Livewire\Pages\Baby;
use App\Livewire\Pages\MedicalRecord;
use App\Livewire\Pages\Profile;

Route::get('/test', function () {
    return 'Laravel jalan!';
});

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
| AUTH — hanya bisa diakses kalau SUDAH login
| Kalau belum login → otomatis redirect ke '/login'
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/',             Home::class)->name('home');
    Route::get('/skrining-awal', InitialScreening::class)->name('skrining-awal');
    Route::get('/kehamilan',    Pregnancy::class)->name('kehamilan');
    Route::get('/persalinan',   Childbirth::class)->name('persalinan');
    Route::get('/data-bayi',    Baby::class)->name('data-bayi');
    Route::get('/rekam-medis',  MedicalRecord::class)->name('rekam-medis');
    Route::get('/profil',       Profile::class)->name('profil');
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