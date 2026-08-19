<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Pregnancy;
use App\Models\Childbirth;
use App\Models\Baby;

class AncVisit extends Component
{
    public string $datePregnancy  = '';
    public string $gestationalAge = '';
    public string $hemoglobin     = '';
    public string $weight         = '';
    public string $notes          = '';

    public ?array $preview = null;

    private function isNotPregnant(): bool
    {
        $userId   = auth()->id();
        $user     = auth()->user();
        $hasBirth = Childbirth::where('id_user', $userId)->exists();
        $hasBaby  = Baby::where('id_user', $userId)->exists();
        $isHamil  = $user->chUser && $user->chUser->statusPregnant === 'hamil';
        return !($hasBirth && $hasBaby) && !$isHamil;
    }

    public function mount(): void
    {
        if ($this->isNotPregnant()) {
            $this->redirect(route('home'), navigate: true);
            return;
        }

        $this->datePregnancy = now()->format('Y-m-d');

        $user = auth()->user();

        $lastVisit = Pregnancy::where('id_user', $user->id)
            ->latest('date_pregnancy')
            ->first();

        if ($lastVisit) {
            $this->gestationalAge = (string) ($lastVisit->gestational_age + 1);
        } elseif ($user->chUser?->gestationalAge) {
            $this->gestationalAge = (string) $user->chUser->gestationalAge;
        }

        if ($user->chUser) {
            $this->weight = (string) $user->chUser->weight;
        }
    }

    public function updatedHemoglobin(): void
    {
        $hb = (float) $this->hemoglobin;
        if ($hb > 0) {
            $this->preview = (new Pregnancy([
                'hemoglobin'      => $hb,
                'gestational_age' => (int) ($this->gestationalAge ?: 0),
            ]))->diagnosis;
        } else {
            $this->preview = null;
        }
    }

    public function simpan(): void
    {
        $this->validate([
            'datePregnancy'  => 'required|date',
            'gestationalAge' => 'required|integer|min:1|max:42',
            'hemoglobin'     => 'required|numeric|min:1|max:25',
            'weight'         => 'required|numeric|min:20|max:200',
            'notes'          => 'nullable|string|max:500',
        ], [
            'datePregnancy.required'  => 'Tanggal kunjungan wajib diisi.',
            'gestationalAge.required' => 'Usia kehamilan wajib diisi.',
            'gestationalAge.min'      => 'Usia kehamilan minimal 1 minggu.',
            'gestationalAge.max'      => 'Usia kehamilan maksimal 42 minggu.',
            'hemoglobin.required'     => 'Kadar Hb wajib diisi.',
            'hemoglobin.min'          => 'Kadar Hb tidak valid.',
            'hemoglobin.max'          => 'Kadar Hb tidak valid.',
            'weight.required'         => 'Berat badan wajib diisi.',
        ]);

        Pregnancy::create([
            'id_user'         => auth()->id(),
            'date_pregnancy'  => $this->datePregnancy,
            'gestational_age' => (int) $this->gestationalAge,
            'hemoglobin'      => (float) $this->hemoglobin,
            'weight'          => (float) $this->weight,
            'notes'           => $this->notes ?: null,
        ]);

        session()->flash('toast', 'Kunjungan ANC berhasil ditambahkan.');
        $this->redirect(route('kehamilan'), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.anc-visit')
            ->layout('layouts.app', ['pageTitle' => 'Tambah Kunjungan ANC']);
    }
}