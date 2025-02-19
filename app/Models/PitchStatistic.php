<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PitchStatistic extends Model
{
    /** @use HasFactory<\Database\Factories\PitchStatisticFactory> */
    use HasFactory;

    protected $fillable = [
        'prospect_id',
        'note_id',
        'ai_response_id', // must be unique
        'total_count', // row updates +1 every time a pitch is used
        'total_status', // row updates +status every time a pitch is used and a status is defined
    ];
}
