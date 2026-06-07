<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Screening;

class ResultScreening extends Component
{
    public ?array $hasil      = null;
    public ?array $detailData = null;

    public function mount(int $id): void
    {
        // Pastikan screening milik user yang login
        $screening = Screening::where('id_screening', $id)
            ->where('id_user', auth()->id())
            ->firstOrFail();

        $this->hasil = $screening->diagnosis;
        $this->hasil['hemoglobin']      = $screening->hemoglobin;
        $this->hasil['tanggalSkrining'] = $screening->created_at->translatedFormat('d F Y');

        $this->detailData = [
            'date'      => $screening->date_screening->translatedFormat('d F Y'),
            'weight'    => $screening->weight,
            'height'    => $screening->height,
            'complaint' => $screening->complaint,
        ];
    }

    public function selesai(): void
    {
        $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.result-screening')
            ->layout('layouts.app', ['pageTitle' => 'Hasil Skrining']);
    }
}