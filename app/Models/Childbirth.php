<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Childbirth extends Model
{
    protected $table      = 'childbirth';
    protected $primaryKey = 'id_childbirth';

    protected $fillable = [
        'id_user',
        'date_childbirth',
        'gestational_age',
        'place',
        'type',
        'helper',
        'condition',
        'complication',
        'notes',
    ];

    protected $casts = [
        'date_childbirth' => 'date',
        'gestational_age' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
