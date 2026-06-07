<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Baby extends Model
{
    protected $table      = 'baby';
    protected $primaryKey = 'id_baby';

    protected $fillable = [
        'id_user',
        'name',
        'gender',
        'date_birth',
        'time_birth',
        'weight',
        'height',
    ];

    protected $casts = [
        'date_birth' => 'date',
        'weight'     => 'float',
        'height'     => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
