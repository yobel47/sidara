<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Screening;
use App\Models\Pregnancy;
use App\Models\Childbirth;
use App\Models\Baby;

class MedicalRecord extends Component
{
    public array  $ringkasan    = [];
    public ?array $skrining     = null;
    public array  $kunjunganAnc = [];
    public ?array $persalinan   = null;
    public array  $bayi         = [];

    public function mount(): void
    {
        $userId = auth()->id();

        $screening   = Screening::where('id_user', $userId)->latest()->first();
        $pregnancies = Pregnancy::where('id_user', $userId)->orderBy('date_pregnancy')->get();
        $childbirth  = Childbirth::where('id_user', $userId)->first();
        $babies      = Baby::where('id_user', $userId)->orderBy('date_birth')->orderBy('time_birth')->get();

        $this->ringkasan = [
            'jumlahAnc'       => $pregnancies->count(),
            'adaPersalinan'   => $childbirth !== null,
            'tanggalSkrining' => $screening ? $screening->created_at->translatedFormat('d M Y') : null,
            'tanggalBayi'     => $babies->isNotEmpty()
                ? $babies->first()->date_birth->translatedFormat('d M Y')
                    . ($babies->count() > 1 ? ' · ' . $babies->count() . ' bayi' : '')
                : null,
        ];

        if ($screening) {
            $diag = $screening->diagnosis;
            $this->skrining = [
                'id'       => $screening->id_screening,
                'tanggal'  => $screening->created_at->translatedFormat('d F Y'),
                'kategori' => $diag['kategori'],
                'warna'    => $diag['warna'],
            ];
        }

        // Oldest first untuk timeline kronologis
        $this->kunjunganAnc = $pregnancies->map(function ($v, $i) {
            return [
                'nomor'         => $i + 1,
                'tanggal'       => $v->date_pregnancy->translatedFormat('d F Y'),
                'usiaKehamilan' => $v->gestational_age,
            ];
        })->values()->toArray();

        if ($childbirth) {
            $this->persalinan = [
                'tanggal' => $childbirth->date_childbirth->translatedFormat('d F Y'),
                'type'    => $childbirth->type === 'SC' ? 'Section Caesarea (SC)' : 'Persalinan Normal',
            ];
        }

        $this->bayi = $babies->map(fn($b) => [
            'name'    => $b->name,
            'gender'  => $b->gender,
            'tanggal' => $b->date_birth->translatedFormat('d F Y'),
            'weight'  => number_format($b->weight * 1000, 0, ',', '.') . ' gram',
            'height'  => number_format($b->height, 1) . ' cm',
        ])->toArray();
    }

    public function render()
    {
        return view('livewire.pages.medical-record')
            ->layout('layouts.app', ['pageTitle' => 'Rekam Medis']);
    }
}
