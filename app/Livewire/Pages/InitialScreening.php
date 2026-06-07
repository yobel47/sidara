<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Screening;

class InitialScreening extends Component
{
    public string $dateScreening = '';
    public string $weight        = '';
    public string $height        = '';
    public string $hemoglobin    = '';
    public string $complaint     = '';
    public ?int   $usia          = null;

    public function mount(): void
    {
        $existing = Screening::where('id_user', auth()->id())->latest()->first();
        if ($existing) {
            $this->redirect(
                route('skrining-hasil', $existing->id_screening),
                navigate: true
            );
            return;
        }

        $this->dateScreening = now()->format('Y-m-d');

        $chUser = auth()->user()->chUser;
        if ($chUser) {
            $this->usia   = $chUser->age;
            $this->weight = (string) $chUser->weight;
            $this->height = (string) $chUser->height;
        }
    }

    public function simpan(): void
    {
        $this->validate([
            'dateScreening' => 'required|date',
            'weight'        => 'required|numeric|min:20|max:200',
            'height'        => 'required|numeric|min:100|max:250',
            'hemoglobin'    => 'required|numeric|min:1|max:25',
            'complaint'     => 'required|string|min:3',
        ], [
            'dateScreening.required' => 'Tanggal pemeriksaan wajib diisi.',
            'weight.required'        => 'Berat badan wajib diisi.',
            'height.required'        => 'Tinggi badan wajib diisi.',
            'hemoglobin.required'    => 'Kadar Hb wajib diisi.',
            'hemoglobin.min'         => 'Kadar Hb tidak valid.',
            'hemoglobin.max'         => 'Kadar Hb tidak valid.',
            'complaint.required'     => 'Keluhan wajib diisi.',
            'complaint.min'          => 'Keluhan terlalu singkat.',
        ]);

        $screening = Screening::create([
            'id_user'        => auth()->id(),
            'date_screening' => $this->dateScreening,
            'weight'         => (float) $this->weight,
            'height'         => (float) $this->height,
            'hemoglobin'     => (float) $this->hemoglobin,
            'complaint'      => $this->complaint,
        ]);

        // Redirect ke halaman hasil dengan id screening
        $this->redirect(
            route('skrining-hasil', $screening->id_screening),
            navigate: true
        );
    }

    public function render()
    {
        return view('livewire.pages.initial-screening')
            ->layout('layouts.app', ['pageTitle' => 'Skrining Awal']);
    }
}