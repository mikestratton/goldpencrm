<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pitch extends Model
{
    /** @use HasFactory<\Database\Factories\PitchFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'note_id',
        'title',
        'body',
    ];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function note(): BelongsTo
    {
        return $this->belongsTo(Note::class);
    }
}
