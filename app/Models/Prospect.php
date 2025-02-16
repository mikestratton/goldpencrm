<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prospect extends Model
{
    /** @use HasFactory<\Database\Factories\ProspectFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name_first',
        'name_last',
        'email',
        'phone',
        'fax',
        'company',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
