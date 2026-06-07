<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class Login extends Component
{
    public string $username = '';
    public string $password = '';

    public function login(): void
    {
        $this->validate([
            'username'    => 'required|string|min:3',
            'password' => 'required|string|min:6',
        ], [
            'username.required'    => 'Username atau email wajib diisi.',
            'username.min'         => 'Minimal 3 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        // Rate limiting — max 5x per menit
        $throttleKey = Str::lower($this->username) . '|' . request()->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->addError('username', "Terlalu banyak percobaan. Coba lagi dalam {$seconds} detik.");
            return;
        }

        // Deteksi apakah input adalah email atau username
        $field = filter_var($this->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $success = Auth::attempt([
            $field     => $this->username,
            'password' => $this->password,
        ], remember: true);

        if (!$success) {
            RateLimiter::hit($throttleKey);
            $this->addError('password', 'Username/email atau password salah.');
            return;
        }

        RateLimiter::clear($throttleKey);
        request()->session()->regenerate();
        $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.auth.login')
            ->layout('layouts.guest', ['pageTitle' => 'Login']);
    }
}