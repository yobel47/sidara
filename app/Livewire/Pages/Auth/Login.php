<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Models\User;

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

        // Email boleh dipakai lebih dari satu akun (mis. menumpang email kader),
        // jadi login by email jadi ambigu — minta pakai username saja.
        if ($field === 'email' && User::where('email', $this->username)->count() > 1) {
            $this->addError('username', 'Email ini digunakan oleh lebih dari satu akun. Silakan login menggunakan username.');
            return;
        }

        $user = User::where($field, $this->username)->first();

        if (!$user) {
            RateLimiter::hit($throttleKey);
            $this->addError('username', $field === 'email' ? 'Email tidak ditemukan.' : 'Username tidak ditemukan.');
            return;
        }

        if (!Hash::check($this->password, $user->password)) {
            RateLimiter::hit($throttleKey);
            $this->addError('password', 'Password salah.');
            return;
        }

        RateLimiter::clear($throttleKey);
        Auth::login($user, remember: true);
        request()->session()->regenerate();

        $chUser = $user->chUser;

        $wasAway     = !$user->last_login_at || $user->last_login_at->lt(now()->subDays(30));
        $notPregnant = !$chUser || $chUser->statusPregnant !== 'hamil';

        $user->update(['last_login_at' => now()]);

        $destination = ($wasAway && $notPregnant) ? route('perbarui-status') : route('home');
        $this->redirect($destination, navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.auth.login')
            ->layout('layouts.guest', ['pageTitle' => 'Login']);
    }
}