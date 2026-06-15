<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Landing extends Component
{
    public function mount(): void
    {
        if (auth()->check()) {
            $this->redirect(route('home'), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.pages.landing')
            ->layout('layouts.landing');
    }
}
