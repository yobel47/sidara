<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Baby as BabyModel;
use App\Models\Childbirth;

class Baby extends Component
{
    public string  $mode     = 'form'; // 'form' | 'view'
    public ?int    $recordId = null;
    public ?array  $viewData = null;

    // Form fields
    public string $name        = '';
    public string $gender      = 'Laki-laki';
    public string $dateBirth   = '';
    public string $timeBirth   = '';
    public string $weight      = '';
    public string $height      = '';

    private function isNotPregnant(): bool
    {
        $userId   = auth()->id();
        $user     = auth()->user();
        $hasBirth = Childbirth::where('id_user', $userId)->exists();
        $hasBaby  = BabyModel::where('id_user', $userId)->exists();
        $isHamil  = $user->chUser && $user->chUser->statusPregnant === 'hamil';
        return !($hasBirth && $hasBaby) && !$isHamil;
    }

    public function mount(): void
    {
        if ($this->isNotPregnant()) {
            $this->redirect(route('home'), navigate: true);
            return;
        }

        $existing = BabyModel::where('id_user', auth()->id())->first();

        if ($existing) {
            $this->mode     = 'view';
            $this->recordId = $existing->id_baby;
            $this->viewData = $this->toViewData($existing);
            return;
        }

        $this->dateBirth = now()->format('Y-m-d');
    }

    public function edit(): void
    {
        $existing = BabyModel::find($this->recordId);
        if (!$existing) return;

        $this->name      = $existing->name;
        $this->gender    = $existing->gender;
        $this->dateBirth = $existing->date_birth->format('Y-m-d');
        // DB menyimpan H:i:s, validasi butuh H:i — ambil 5 karakter pertama
        $this->timeBirth = $existing->time_birth ? substr($existing->time_birth, 0, 5) : '';
        $this->weight    = (string) round($existing->weight * 1000);
        $this->height    = (string) $existing->height;
        $this->mode      = 'form';
    }

    public function simpan(): void
    {
        $this->validate([
            'name'      => 'required|string|max:100',
            'gender'    => 'required|in:Laki-laki,Perempuan',
            'dateBirth' => 'required|date',
            'timeBirth' => 'nullable|date_format:H:i',
            'weight'    => 'required|numeric|min:500|max:10000',
            'height'    => 'required|numeric|min:20|max:70',
        ], [
            'name.required'         => 'Nama bayi wajib diisi.',
            'name.max'              => 'Nama bayi maksimal 100 karakter.',
            'gender.required'       => 'Jenis kelamin wajib dipilih.',
            'gender.in'             => 'Jenis kelamin tidak valid.',
            'dateBirth.required'    => 'Tanggal lahir wajib diisi.',
            'dateBirth.date'        => 'Format tanggal lahir tidak valid.',
            'timeBirth.date_format' => 'Format waktu lahir tidak valid (contoh: 14:30).',
            'weight.required'       => 'Berat lahir wajib diisi.',
            'weight.numeric'        => 'Berat lahir harus berupa angka.',
            'weight.min'            => 'Berat lahir minimal 500 gram.',
            'weight.max'            => 'Berat lahir maksimal 10.000 gram.',
            'height.required'       => 'Panjang badan wajib diisi.',
            'height.numeric'        => 'Panjang badan harus berupa angka.',
            'height.min'            => 'Panjang badan minimal 20 cm.',
            'height.max'            => 'Panjang badan maksimal 70 cm.',
        ]);

        $data = [
            'name'       => $this->name,
            'gender'     => $this->gender,
            'date_birth' => $this->dateBirth,
            'time_birth' => $this->timeBirth ?: null,
            'weight'     => (float) $this->weight / 1000,
            'height'     => (float) $this->height,
        ];

        if ($this->recordId) {
            BabyModel::where('id_baby', $this->recordId)->update($data);
        } else {
            $record         = BabyModel::create(['id_user' => auth()->id()] + $data);
            $this->recordId = $record->id_baby;
        }

        $this->viewData = $this->toViewData(BabyModel::find($this->recordId));
        $this->mode     = 'view';
        $this->dispatch('toast', message: 'Data bayi berhasil disimpan.');
    }

    private function toViewData(BabyModel $record): array
    {
        return [
            'name'      => $record->name,
            'gender'    => $record->gender,
            'tanggal'   => $record->date_birth->translatedFormat('d F Y'),
            'waktu'     => $record->time_birth
                ? \Carbon\Carbon::createFromFormat('H:i:s', $record->time_birth)->format('H:i') . ' WIB'
                : '-',
            'weight'    => number_format($record->weight * 1000, 0, ',', '.') . ' gram',
            'height'    => number_format($record->height, 1) . ' cm',
        ];
    }

    public function render()
    {
        return view('livewire.pages.baby')
            ->layout('layouts.app', ['pageTitle' => 'Data Bayi']);
    }
}
