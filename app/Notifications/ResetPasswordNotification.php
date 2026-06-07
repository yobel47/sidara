<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    public function toMail($notifiable): MailMessage
    {
        $expireMinutes = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');

        return (new MailMessage)
            ->from('noreply@kurobell.my.id', 'SI DARA')
            ->subject('Reset Password Akun SI DARA')
            ->view('emails.reset-password', [
                'url'           => $this->resetUrl($notifiable),
                'notifiable'    => $notifiable,
                'expireMinutes' => $expireMinutes,
            ]);
    }
}