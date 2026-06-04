<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Pregnancy extends Component
{
    public function render()
    {
        return view('livewire.pages.pregnancy')
            ->layout('layouts.app', ['pageTitle' => 'Kehamilan']);
    }
}