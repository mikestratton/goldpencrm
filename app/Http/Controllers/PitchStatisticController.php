<?php

namespace App\Http\Controllers;

use App\Models\PitchStatistic;
use App\Http\Requests\StorePitchStatisticRequest;
use App\Http\Requests\UpdatePitchStatisticRequest;

class PitchStatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
    public function store(StorePitchStatisticRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PitchStatistic $pitchStatistic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PitchStatistic $pitchStatistic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePitchStatisticRequest $request, PitchStatistic $pitchStatistic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PitchStatistic $pitchStatistic)
    {
        //
    }
}
