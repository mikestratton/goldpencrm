<?php

namespace App\Http\Controllers;

use App\Models\PitchStatistic;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = PitchStatistic::whereHas('AiResponse', function($query) {
            $query->where('user_id', auth()->id());
        })->get();
        return view('dashboard', compact('stats'));
    }
}
