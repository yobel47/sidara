<?php

use Illuminate\Support\Facades\Route;

// Auth pages
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\Auth\ForgotPassword;
use App\Livewire\Pages\Auth\ResetPassword;

// Pages
use App\Livewire\Pages\Landing;
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
use App\Livewire\Pages\Admin;

/*
|--------------------------------------------------------------------------
| PUBLIC — halaman depan, bisa diakses siapapun
| Kalau sudah login → Landing::mount() redirect ke beranda
|--------------------------------------------------------------------------
*/
Route::get('/', Landing::class)->name('landing');


/*
|--------------------------------------------------------------------------
| GUEST — hanya bisa diakses kalau BELUM login
| Kalau sudah login → otomatis redirect ke '/'
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login',         Login::class)->name('login');
    Route::get('/register',      Register::class)->name('register');
    Route::get('/lupa-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});


/*
|--------------------------------------------------------------------------
| AUTH — sudah login, belum tentu isi identitas
| Halaman identitas tidak butuh profile.complete (justru tujuan redirect-nya)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/identitas', Identity::class)->name('identitas');
});


/*
|--------------------------------------------------------------------------
| AUTH — sudah login + sudah isi identitas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/beranda',                  Home::class)->name('home');
    Route::get('/skrining-awal',            InitialScreening::class)->name('skrining-awal');
    Route::get('/skrining-awal/{id}/hasil', ResultScreening::class)->name('skrining-hasil');
    Route::get('/kehamilan',                Pregnancy::class)->name('kehamilan');
    Route::get('/kehamilan/kunjungan-baru', AncVisit::class)->name('anc-visit');
    Route::get('/persalinan',               Childbirth::class)->name('persalinan');
    Route::get('/data-bayi',                Baby::class)->name('data-bayi');
    Route::get('/rekam-medis',              MedicalRecord::class)->name('rekam-medis');
    Route::get('/profil',                   Profile::class)->name('profil');
    Route::get('/perbarui-status',          UpdateStatus::class)->name('perbarui-status');
});


/*
|--------------------------------------------------------------------------
| ADMIN — hanya bisa diakses akun yang emailnya ada di ADMIN_EMAILS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'profile.complete'])->group(function () {
    Route::get('/admin', Admin::class)->name('admin');
});


/*
|--------------------------------------------------------------------------
| LOGOUT — GET request, butuh auth
|--------------------------------------------------------------------------
*/
Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('landing');
})->middleware('auth')->name('logout');
