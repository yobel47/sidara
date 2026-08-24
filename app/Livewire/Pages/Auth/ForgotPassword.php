<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class ForgotPassword extends Component
{
    public string $email     = '';
    public bool   $sent      = false;
    public bool   $submitted = false;

    public function kirim(): void
    {
        if ($this->submitted) return;

        $this->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
        ]);

        $this->submitted = true;

        if (User::where('email', $this->email)->count() > 1) {
            $this->submitted = false;
            $this->addError('email', 'Email ini digunakan oleh lebih dari satu akun. Silakan hubungi admin untuk reset password.');
            return;
        }

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->sent = true;
        } elseif ($status === Password::RESET_THROTTLED) {
            $this->submitted = false;
            $this->addError('email', 'Terlalu banyak permintaan. Tunggu beberapa menit sebelum mencoba lagi.');
        } else {
            $this->submitted = false;
            $this->addError('email', 'Email tidak ditemukan dalam sistem kami.');
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.forgot-password')
            ->layout('layouts.guest', ['pageTitle' => 'Lupa Password']);
    }
}
