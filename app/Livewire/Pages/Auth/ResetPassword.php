<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class ResetPassword extends Component
{
    public string $token                = '';
    public string $email                = '';
    public string $password             = '';
    public string $passwordConfirmation = '';

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->email = request()->query('email', '');
    }

    public function simpan(): void
    {
        $this->validate([
            'password'             => 'required|string|min:6|same:passwordConfirmation',
            'passwordConfirmation' => 'required',
        ], [
            'password.required'             => 'Password baru wajib diisi.',
            'password.min'                  => 'Password minimal 6 karakter.',
            'password.same'                 => 'Konfirmasi password tidak cocok.',
            'passwordConfirmation.required' => 'Konfirmasi password wajib diisi.',
        ]);

        $status = Password::reset(
            [
                'email'                 => $this->email,
                'password'              => $this->password,
                'password_confirmation' => $this->passwordConfirmation,
                'token'                 => $this->token,
            ],
            function ($user) {
                $user->forceFill([
                    'password'       => $this->password,
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('success', 'Password berhasil diubah. Silakan login kembali.');
            $this->redirect(route('login'), navigate: true);
        } else {
            $this->addError('password', 'Link reset tidak valid atau sudah kedaluwarsa. Minta link baru.');
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.reset-password')
            ->layout('layouts.guest', ['pageTitle' => 'Reset Password']);
    }
}
