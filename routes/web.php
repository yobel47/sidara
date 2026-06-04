<?php

use Illuminate\Support\Facades\Route;

// Pages
use App\Livewire\Pages\Home;
use App\Livewire\Pages\InitialScreening;
use App\Livewire\Pages\Pregnancy;
use App\Livewire\Pages\Childbirth;
use App\Livewire\Pages\Baby;
use App\Livewire\Pages\MedicalRecord;
use App\Livewire\Pages\Profile;

/*
|--------------------------------------------------------------------------
| Semua route tanpa middleware — sementara untuk preview tampilan
| Nanti tambahkan ->middleware(['auth']) setelah login sudah siap
|--------------------------------------------------------------------------
*/

Route::get('/',             Home::class)->name('home');
Route::get('/skrining-awal', InitialScreening::class)->name('skrining-awal');
Route::get('/kehamilan',    Pregnancy::class)->name('kehamilan');
Route::get('/persalinan',   Childbirth::class)->name('persalinan');
Route::get('/data-bayi',    Baby::class)->name('data-bayi');
Route::get('/rekam-medis',  MedicalRecord::class)->name('rekam-medis');
Route::get('/profil',       Profile::class)->name('profil');