<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class UpdateStatus extends Component
{
    public string $userName       = '';
    public string $selectedStatus = '';

    public function mount(): void
    {
        $user   = auth()->user();
        $chUser = $user->chUser;
        $this->userName       = $chUser->fullname ?? $user->name ?? 'Bunda';
        $this->selectedStatus = ($chUser && $chUser->statusPregnant === 'hamil') ? 'hamil' : 'tidak_hamil';
    }

    public function simpan(): void
    {
        $chUser = auth()->user()->chUser;
        if ($chUser) {
            $chUser->update([
                'statusPregnant' => $this->selectedStatus === 'hamil' ? 'hamil' : 'tidak_hamil',
            ]);
        }
        session()->flash('toast', 'Status kehamilan berhasil diperbarui.');
        $this->redirect(route('home'), navigate: true);
    }

    public function batalkan(): void
    {
        $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.update-status')
            ->layout('layouts.app', ['pageTitle' => 'Perbarui Status']);
    }
}
