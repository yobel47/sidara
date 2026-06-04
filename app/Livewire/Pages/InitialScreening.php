<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class InitialScreening extends Component
{
    // Nanti diisi property & logic sesuai kebutuhan form skrining

    public function render()
    {
        return view('livewire.pages.initial-screening')
            ->layout('layouts.app', ['pageTitle' => 'Skrining Awal']);
    }
}