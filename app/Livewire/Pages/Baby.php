<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Baby extends Component
{
    public function render()
    {
        return view('livewire.pages.baby')
            ->layout('layouts.app', ['pageTitle' => 'Data Bayi']);
    }
}