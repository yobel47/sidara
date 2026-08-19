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
    public string $statusPregnant = ''; // tidak ada default, user wajib memilih
    public string $gestationalAge = '';
    public string $maritalStatus = ''; // tidak ada default, user wajib memilih
    public string $weddingDate = '';
    public bool $isDispensationMarriage = false;
    public string $marriageDispensationDate = '';

    public function mount(): void
    {
        // Middleware sudah handle redirect, tapi kalau lolos juga pre-fill form
        $chUser = auth()->user()->chUser;
        if ($chUser) {
            $this->fullname                 = $chUser->fullname;
            $this->address                  = $chUser->address;
            $this->age                      = (string) $chUser->age;
            $this->phone                    = $chUser->phone;
            $this->weight                   = (string) $chUser->weight;
            $this->height                   = (string) $chUser->height;
            $this->statusPregnant           = $chUser->statusPregnant;
            $this->gestationalAge           = $chUser->gestationalAge ?? '';
            $this->maritalStatus            = $chUser->maritalStatus ?? '';
            $this->weddingDate              = $chUser->weddingDate?->format('Y-m-d') ?? '';
            $this->isDispensationMarriage   = (bool) $chUser->isDispensationMarriage;
            $this->marriageDispensationDate = $chUser->marriageDispensationDate?->format('Y-m-d') ?? '';
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
            'maritalStatus'            => 'required|in:sudah_menikah,belum_menikah',
            'weddingDate'              => 'nullable|date|required_if:maritalStatus,sudah_menikah',
            'isDispensationMarriage'   => 'boolean',
            'marriageDispensationDate' => 'nullable|date|required_if:isDispensationMarriage,true',
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
            'weight.min'       => 'Berat badan minimal 20 kg.',
            'weight.max'       => 'Berat badan maksimal 200 kg.',
            'height.required' => 'Tinggi badan wajib diisi.',
            'height.min'      => 'Tinggi badan minimal 100 cm.',
            'height.max'      => 'Tinggi badan maksimal 250 cm.',
            'statusPregnant.required' => 'Status hamil wajib dipilih.',
            'gestationalAge.required' => 'Usia kehamilan wajib diisi.',
            'maritalStatus.required'            => 'Status pernikahan wajib dipilih.',
            'weddingDate.required_if'           => 'Tanggal pernikahan wajib diisi.',
            'weddingDate.date'                  => 'Format tanggal pernikahan tidak valid.',
            'marriageDispensationDate.required_if' => 'Tanggal dispensasi pernikahan wajib diisi.',
            'marriageDispensationDate.date'        => 'Format tanggal dispensasi pernikahan tidak valid.',
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
                'maritalStatus'            => $this->maritalStatus,
                'weddingDate'              => $this->maritalStatus === 'sudah_menikah' ? $this->weddingDate : null,
                'isDispensationMarriage'   => $this->maritalStatus === 'belum_menikah' && $this->isDispensationMarriage,
                'marriageDispensationDate' => ($this->maritalStatus === 'belum_menikah' && $this->isDispensationMarriage)
                    ? $this->marriageDispensationDate
                    : null,
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