<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'last_login_at',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password'      => 'hashed',
            'last_login_at' => 'datetime',
            'is_admin'      => 'boolean',
        ];
    }

    public function chUser(): HasOne
    {
        return $this->hasOne(ChUser::class, 'id_user');
    }

    public function pregnancy(): HasMany
    {
        return $this->hasMany(\App\Models\Pregnancy::class, 'id_user');
    }

    public function screening(): HasMany
    {
        return $this->hasMany(\App\Models\Screening::class, 'id_user');
    }

    public function childbirth(): HasMany
    {
        return $this->hasMany(\App\Models\Childbirth::class, 'id_user');
    }

    public function baby(): HasMany
    {
        return $this->hasMany(\App\Models\Baby::class, 'id_user');
    }

    // Helper: cek apakah identitas sudah diisi
    // Kalau ada field baru yang wajib diisi ulang oleh user lama (mis. field
    // baru ditambahkan setelah aplikasi sudah berjalan), cek kelengkapannya
    // di sini juga — middleware ProfileComplete otomatis akan paksa user
    // yang datanya belum lengkap balik ke halaman /identitas.
    public function hasCompletedProfile(): bool
    {
        $chUser = $this->chUser;

        if (!$chUser) {
            return false;
        }

        if ($chUser->maritalStatus === null) {
            return false;
        }

        if ($chUser->maritalStatus === 'sudah_menikah' && $chUser->marriageNumber === null) {
            return false;
        }

        return true;
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}