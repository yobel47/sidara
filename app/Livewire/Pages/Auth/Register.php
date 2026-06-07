<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Register extends Component
{
    public string $username             = '';
    public string $email                = '';
    public string $password             = '';
    public string $passwordConfirmation = '';

    public function register(): void
    {
        $this->validate([
            'username' => [
                'required', 'string', 'min:3', 'max:30',
                'unique:users,username',
                'regex:/^[a-zA-Z0-9_]+$/',
            ],
            'email' => [
                'required', 'email', 'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required', 'string', 'min:6',
            ],
            'passwordConfirmation' => [
                'required', 'same:password',
            ],
        ], [
            'username.required'             => 'Username wajib diisi.',
            'username.min'                  => 'Username minimal 3 karakter.',
            'username.max'                  => 'Username maksimal 30 karakter.',
            'username.unique'               => 'Username sudah dipakai, coba yang lain.',
            'username.regex'                => 'Username hanya boleh huruf, angka, dan underscore.',
            'email.required'                => 'Email wajib diisi.',
            'email.email'                   => 'Format email tidak valid.',
            'email.unique'                  => 'Email sudah terdaftar.',
            'password.required'             => 'Password wajib diisi.',
            'password.min'                  => 'Password minimal 6 karakter.',
            'passwordConfirmation.required' => 'Konfirmasi password wajib diisi.',
            'passwordConfirmation.same'     => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'username' => $this->username,
            'name'     => $this->username,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user, remember: true);
        request()->session()->regenerate();
        $this->redirect(route('home'), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.auth.register')
            ->layout('layouts.guest', ['pageTitle' => 'Registrasi']);
    }
}