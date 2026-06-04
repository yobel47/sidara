<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Childbirth extends Component
{
    public function render()
    {
        return view('livewire.pages.childbirth')
            ->layout('layouts.app', ['pageTitle' => 'Persalinan']);
    }
}