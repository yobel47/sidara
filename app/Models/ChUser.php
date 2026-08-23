<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChUser extends Model
{
    protected $table      = 'ch_user';
    protected $primaryKey = 'id_ch';

    protected $fillable = [
        'id_user',
        'fullname',
        'address',
        'age',
        'phone',
        'weight',
        'height',
        'statusPregnant',
        'gestationalAge',
        'maritalStatus',
        'weddingDate',
        'marriageNumber',
    ];

    protected $casts = [
        'age'             => 'integer',
        'weight'          => 'float',
        'height'          => 'float',
        'weddingDate'     => 'date',
        'marriageNumber'  => 'integer',
    ];

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}