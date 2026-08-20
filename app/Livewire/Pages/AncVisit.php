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

    // Khusus ANC1 / kunjungan pertama
    public bool   $isFirstVisit = false;
    public string $hpht         = '';
    public string $height       = '';

    // Setiap kunjungan
    public string $systolic            = '';
    public string $diastolic           = '';
    public string $lila                = '';
    public string $tookIronSupplement  = ''; // 'ya' | 'tidak'

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

        $this->isFirstVisit = !$lastVisit;

        if ($lastVisit) {
            $this->gestationalAge = (string) ($lastVisit->gestational_age + 1);
        } elseif ($user->chUser?->gestationalAge) {
            $this->gestationalAge = (string) $user->chUser->gestationalAge;
        }

        if ($user->chUser) {
            $this->weight = (string) $user->chUser->weight;
            $this->height = (string) $user->chUser->height;
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
        $rules = [
            'datePregnancy'      => 'required|date',
            'gestationalAge'     => 'required|integer|min:1|max:42',
            'hemoglobin'         => 'required|numeric|min:1|max:25',
            'weight'             => 'required|numeric|min:20|max:200',
            'systolic'           => 'required|integer|min:60|max:250',
            'diastolic'          => 'required|integer|min:40|max:150',
            'lila'               => 'required|numeric|min:10|max:50',
            'tookIronSupplement' => 'required|in:ya,tidak',
            'notes'              => 'nullable|string|max:500',
        ];

        if ($this->isFirstVisit) {
            $rules['hpht']   = 'required|date|before_or_equal:today';
            $rules['height'] = 'required|numeric|min:100|max:250';
        }

        $this->validate($rules, [
            'datePregnancy.required'      => 'Tanggal kunjungan wajib diisi.',
            'gestationalAge.required'     => 'Usia kehamilan wajib diisi.',
            'gestationalAge.min'          => 'Usia kehamilan minimal 1 minggu.',
            'gestationalAge.max'          => 'Usia kehamilan maksimal 42 minggu.',
            'hemoglobin.required'         => 'Kadar Hb wajib diisi.',
            'hemoglobin.min'              => 'Kadar Hb tidak valid.',
            'hemoglobin.max'              => 'Kadar Hb tidak valid.',
            'weight.required'             => 'Berat badan wajib diisi.',
            'weight.min'                  => 'Berat badan minimal 20 kg.',
            'weight.max'                  => 'Berat badan maksimal 200 kg.',
            'hpht.required'                => 'HPHT wajib diisi.',
            'hpht.before_or_equal'         => 'Tanggal HPHT tidak valid.',
            'height.required'              => 'Tinggi badan wajib diisi.',
            'height.min'                   => 'Tinggi badan minimal 100 cm.',
            'height.max'                   => 'Tinggi badan maksimal 250 cm.',
            'systolic.required'            => 'Tekanan darah (sistole) wajib diisi.',
            'systolic.min'                 => 'Tekanan darah (sistole) minimal 60 mmHg.',
            'systolic.max'                 => 'Tekanan darah (sistole) maksimal 250 mmHg.',
            'diastolic.required'           => 'Tekanan darah (diastole) wajib diisi.',
            'diastolic.min'                => 'Tekanan darah (diastole) minimal 40 mmHg.',
            'diastolic.max'                => 'Tekanan darah (diastole) maksimal 150 mmHg.',
            'lila.required'                => 'LILA wajib diisi.',
            'lila.min'                     => 'LILA minimal 10 cm.',
            'lila.max'                     => 'LILA maksimal 50 cm.',
            'tookIronSupplement.required'  => 'Konsumsi tablet tambah darah/MMS wajib dipilih.',
        ]);

        Pregnancy::create([
            'id_user'              => auth()->id(),
            'date_pregnancy'       => $this->datePregnancy,
            'gestational_age'      => (int) $this->gestationalAge,
            'hpht'                 => $this->isFirstVisit ? $this->hpht : null,
            'hemoglobin'           => (float) $this->hemoglobin,
            'weight'               => (float) $this->weight,
            'height'               => $this->isFirstVisit ? (float) $this->height : null,
            'systolic'             => (int) $this->systolic,
            'diastolic'            => (int) $this->diastolic,
            'lila'                 => (float) $this->lila,
            'took_iron_supplement' => $this->tookIronSupplement === 'ya',
            'notes'                => $this->notes ?: null,
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
