<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\ChUser;

class UpdateMaritalStatus extends Component
{
    public string $userName       = '';
    public string $maritalStatus  = '';
    public string $weddingDate    = '';
    public string $marriageNumber = '';

    public function mount(): void
    {
        $user   = auth()->user();
        $chUser = $user->chUser;

        $this->userName       = $chUser->fullname ?? $user->name ?? 'Bunda';
        $this->maritalStatus  = $chUser->maritalStatus ?? 'belum_menikah';
        $this->weddingDate    = $chUser->weddingDate?->format('Y-m-d') ?? '';
        $this->marriageNumber = $chUser->marriageNumber ? (string) $chUser->marriageNumber : '';
    }

    public function simpan(): void
    {
        $this->validate([
            'maritalStatus'  => 'required|in:sudah_menikah,belum_menikah',
            'weddingDate'    => 'nullable|date|required_if:maritalStatus,sudah_menikah',
            'marriageNumber' => 'nullable|integer|min:1|max:10|required_if:maritalStatus,sudah_menikah',
        ], [
            'maritalStatus.required'     => 'Status pernikahan wajib dipilih.',
            'weddingDate.required_if'    => 'Tanggal pernikahan wajib diisi.',
            'weddingDate.date'           => 'Format tanggal pernikahan tidak valid.',
            'marriageNumber.required_if' => 'Pernikahan ke berapa wajib diisi.',
            'marriageNumber.integer'     => 'Pernikahan ke berapa harus berupa angka.',
            'marriageNumber.min'         => 'Pernikahan ke berapa minimal 1.',
            'marriageNumber.max'         => 'Pernikahan ke berapa maksimal 10.',
        ]);

        $chUser = auth()->user()->chUser;
        if ($chUser) {
            $chUser->update([
                'maritalStatus'  => $this->maritalStatus,
                'weddingDate'    => $this->maritalStatus === 'sudah_menikah' ? $this->weddingDate : null,
                'marriageNumber' => $this->maritalStatus === 'sudah_menikah' ? (int) $this->marriageNumber : null,
            ]);
        }

        session()->flash('toast', 'Status pernikahan berhasil diperbarui.');
        $this->redirect(route('profil'), navigate: true);
    }

    public function batalkan(): void
    {
        $this->redirect(route('profil'), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.update-marital-status')
            ->layout('layouts.app', ['pageTitle' => 'Ubah Status Pernikahan']);
    }
}
