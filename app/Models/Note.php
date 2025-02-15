<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    /** @use HasFactory<\Database\Factories\NoteFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'type_of_contact',
    ];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function prospect(): BelongsTo
    {
        return $this->belongsTo(Prospect::class);
    }
}
