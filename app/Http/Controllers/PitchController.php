<?php

namespace App\Http\Controllers;

use App\Models\AiResponse;
use App\Models\Pitch;
use App\Http\Requests\StorePitchRequest;
use App\Http\Requests\UpdatePitchRequest;
use Illuminate\Http\Request;

class PitchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 15);
        $pitches = AiResponse::where('user_id', auth()->id())->paginate($perPage);
        return view('salesai.index', compact('pitches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePitchRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pitch $pitch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pitch $pitch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePitchRequest $request, Pitch $pitch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pitch $pitch)
    {
        //
    }
}
