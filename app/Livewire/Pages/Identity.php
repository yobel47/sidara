<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\ChUser;

class Identity extends Component
{
    public string $fullname = '';
    public string $address = '';
    public string $age = '';
    public string $phone = '';
    public string $weight = '';
    public string $height = '';
    public string $statusPregnant = 'hamil'; // default: hamil
    public string $gestationalAge = '';

    public function mount(): void
    {
        // Middleware sudah handle redirect, tapi kalau lolos juga pre-fill form
        $chUser = auth()->user()->chUser;
        if ($chUser) {
            $this->fullname       = $chUser->fullname;
            $this->address        = $chUser->address;
            $this->age            = (string) $chUser->age;
            $this->phone          = $chUser->phone;
            $this->weight         = (string) $chUser->weight;
            $this->height         = (string) $chUser->height;
            $this->statusPregnant = $chUser->statusPregnant;
            $this->gestationalAge = $chUser->gestationalAge ?? '';
        }
    }

    public function simpan(): void
    {
        $rules = [
            'fullname' => 'required|string|min:3|max:100',
            'address'      => 'required|string|min:5',
            'age'        => 'required|integer|min:10|max:60',
            'phone'        => 'required|string|min:10|max:15',
            'weight'  => 'required|numeric|min:20|max:200',
            'height' => 'required|numeric|min:100|max:250',
            'statusPregnant' => 'required|in:hamil,tidak_hamil',
        ];

        // usiaKehamilan wajib hanya kalau status hamil
        if ($this->statusPregnant === 'hamil') {
            $rules['gestationalAge'] = 'required|string';
        }

        $this->validate($rules, [
            'fullname.required' => 'Nama lengkap wajib diisi.',
            'fullname.min'      => 'Nama minimal 3 karakter.',
            'address.required'      => 'Alamat wajib diisi.',
            'address.min'           => 'Alamat terlalu singkat.',
            'age.required'        => 'Usia wajib diisi.',
            'age.min'             => 'Usia minimal 10 tahun.',
            'age.max'             => 'Usia maksimal 60 tahun.',
            'phone.required'        => 'No. HP wajib diisi.',
            'phone.min'             => 'No. HP minimal 10 digit.',
            'weight.required'  => 'Berat badan wajib diisi.',
            'height.required' => 'Tinggi badan wajib diisi.',
            'statusPregnant.required' => 'Status hamil wajib dipilih.',
            'gestationalAge.required' => 'Usia kehamilan wajib diisi.',
        ]);

        ChUser::updateOrCreate(
            ['id_user' => auth()->id()],
            [
                'fullname'       => $this->fullname,
                'address'        => $this->address,
                'age'            => (int) $this->age,
                'phone'          => $this->phone,
                'weight'         => (float) $this->weight,
                'height'         => (float) $this->height,
                'statusPregnant' => $this->statusPregnant,
                'gestationalAge' => $this->statusPregnant === 'hamil' ? $this->gestationalAge : null,
            ]
        );

        // Setelah simpan → ke home
        $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.identity')
            ->layout('layouts.guest', ['pageTitle' => 'Identitas Diri']);
    }
}