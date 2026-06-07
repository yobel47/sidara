<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'last_login_at',
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
        ];
    }

    // Relasi ke ChUser — one to one
    public function chUser(): HasOne
    {
        return $this->hasOne(ChUser::class, 'id_user');
    }

    // Helper: cek apakah identitas sudah diisi
    public function hasCompletedProfile(): bool
    {
        return $this->chUser()->exists();
    }
}