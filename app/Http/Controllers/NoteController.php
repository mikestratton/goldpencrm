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
        $query = Note::with(['prospect', 'ai_response'])
            ->where('user_id', auth()->id());

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('body', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('type_of_contact', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('prospect', function($q) use ($searchTerm) {
                      $q->where('name_first', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('name_last', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        $notes = $query->orderBy($sort, $direction)->paginate(15);

        return view('notes.index', compact('notes', 'sort', 'direction'));
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
            'ai_response_id' => 'nullable|exists:ai_responses,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'type_of_contact' => 'nullable|string|max:255',
            'status' => 'required|integer|in:0,1,2,3,4',
        ]);

        $note = new Note();
        $note->user_id = $request->user()->id;
        $note->prospect_id = $validatedData['prospect_id'];
        $note->title = $validatedData['title'];
        $note->body = $validatedData['body'];
        $note->type_of_contact = $validatedData['type_of_contact'];
        $note->ai_response_id = $validatedData['ai_response_id'] ?? null;

        $note->save();

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
        if ($note->user_id !== auth()->id()) {
            abort(403);
        }

        $prospects = Prospect::where('user_id', auth()->id())->get();
        $pitches = AiResponse::where('user_id', auth()->id())->get();

        return view('notes.edit', compact('note', 'prospects', 'pitches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'prospect_id' => 'required|exists:prospects,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'type_of_contact' => 'required|string|max:255',
            'ai_response_id' => 'nullable|exists:ai_responses,id',
            'status' => 'required|integer|min:0|max:4'
        ]);

        $note->update($validated);

        $prospect = Prospect::findOrFail($validated['prospect_id']);
        if ($prospect->user_id === auth()->id()) {
            $prospect->update(['status' => $validated['status']]);
        }

        return redirect()->route('notes.index')
            ->with('success', 'Note updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if ($note->user_id !== auth()->id()) {
            abort(403);
        }

        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully!');
    }
}
