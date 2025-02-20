<?php

namespace App\Http\Controllers;

use App\Models\AiResponse;
use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\PitchStatistic;
use App\Models\Prospect;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 20); // Get the number of items per page from the request or use a default
        $notes = Note::where('user_id', auth()->id())->paginate($perPage);

        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prospects = Prospect::where('user_id', auth()->id())->orderBy('name_last', 'asc')->get();
        $pitches = AiResponse::where('user_id', auth()->id())->orderBy('response', 'asc')->get();
        return view('notes.create', compact('prospects', 'pitches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prospect_id' => 'required|exists:prospects,id',
            'ai_response_id' => 'nullable|exists:ai_responses,id', // Changed from pitches to ai_responses
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'type_of_contact' => 'nullable|string|max:255',
            'status' => 'required|integer|in:0,1,2,3,4', // Ensure status is valid
        ]);

        // Create a new Note instance and fill it with the validated data
        $note = new Note();
        $note->user_id = $request->user()->id;
        $note->prospect_id = $validatedData['prospect_id'];
        $note->title = $validatedData['title'];
        $note->body = $validatedData['body'];
        $note->type_of_contact = $validatedData['type_of_contact'];
        $note->ai_response_id = $validatedData['ai_response_id'] ?? null;

        // Save the note to the database
        $note->save();

        // Update the prospect table status
        $prospect = Prospect::find($validatedData['prospect_id']);
        $prospect->status = $validatedData['status'];
        $prospect->save();

        // Update pitch statistics if ai_response_id is present
        if ($validatedData['ai_response_id']) {
            PitchStatistic::updateOrCreate(
                ['ai_response_id' => $validatedData['ai_response_id']], // unique identifier
                [
                    'total_count' => \DB::raw('total_count + 1'),
                    'total_status' => \DB::raw('total_status + ' . $validatedData['status'])
                ]
            );
        }

        // Redirect to a success page or back to the form
        return redirect()->route('notes.index')->with('success', 'Note created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        // Check if the user owns this note
        if ($note->user_id !== auth()->id()) {
            abort(403);
        }

        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully!');
    }
}
