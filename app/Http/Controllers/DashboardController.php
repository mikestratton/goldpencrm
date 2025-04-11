<?php

namespace App\Http\Controllers;

use App\Models\AiResponse;
use App\Models\Note;
use App\Models\PitchStatistic;
use App\Models\Prospect;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = PitchStatistic::whereHas('AiResponse', function($query) {
            $query->where('user_id', auth()->id());
        })->get();
        $contacts = Prospect::where('user_id', auth()->id())->count();
        $notes = Note::where('user_id', auth()->id())->count();
        $pitches = AiResponse::where('user_id', auth()->id())->count();

        return view('dashboard', compact('stats', 'contacts', 'notes', 'pitches'));
    }
}
