<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class BottomNav extends Component
{
    public bool $isAdmin = false;

    public function mount(): void
    {
        $this->isAdmin = (bool) auth()->user()->is_admin;
    }

    public function render()
    {
        return view('livewire.layout.bottom-nav');
    }
}