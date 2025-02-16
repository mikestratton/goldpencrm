<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
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
        $notes = Note::paginate($perPage);

        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prospects = Prospect::orderBy('name_last', 'asc')->get();
        return view('notes.create', compact('prospects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'prospect_id' => 'required|exists:prospects,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'type_of_contact' => 'nullable|string|max:255',
            'status' => 'required|integer|in:1,2,3,4', // Ensure status is valid
        ]);

        // Create a new Note instance and fill it with the validated data
        $note = new Note();
        $note->user_id = $request->user()->id;
        $note->prospect_id = $validatedData['prospect_id'];
        $note->title = $validatedData['title'];
        $note->body = $validatedData['body'];
        $note->type_of_contact = $validatedData['type_of_contact'];

        // Save the note to the database
        $note->save();

        // Update the prospect table status
        $prospect = Prospect::find($validatedData['prospect_id']);
        $prospect->status = $validatedData['status'];
        $prospect->save();

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
        //
    }
}
