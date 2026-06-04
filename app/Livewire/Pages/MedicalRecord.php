<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class MedicalRecord extends Component
{
    public function render()
    {
        return view('livewire.pages.medical-record')
            ->layout('layouts.app', ['pageTitle' => 'Rekam Medis']);
    }
}