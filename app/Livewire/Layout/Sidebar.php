<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use App\Models\Childbirth;
use App\Models\Baby;

class Sidebar extends Component
{
    public string $pregnancyStatus = 'tidak hamil';

    public function mount(): void
    {
        $this->resolveStatus();
    }

    public function logout(): void
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        $this->redirect(route('login'), navigate: true);
    }

    private function resolveStatus(): void
    {
        $userId = auth()->id();
        $chUser = auth()->user()->chUser;

        $hasBirth = Childbirth::where('id_user', $userId)->exists();
        $hasBaby  = Baby::where('id_user', $userId)->exists();

        if ($hasBirth && $hasBaby) {
            $this->pregnancyStatus = 'melahirkan';
        } elseif ($chUser && $chUser->statusPregnant === 'hamil') {
            $this->pregnancyStatus = 'hamil';
        } else {
            $this->pregnancyStatus = 'tidak hamil';
        }
    }

    public function render()
    {
        return view('livewire.layout.sidebar');
    }
}