<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use App\Http\Requests\StoreProspectRequest;
use App\Http\Requests\UpdateProspectRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class ProspectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Prospect::where('user_id', auth()->id());
        
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name_first', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('name_last', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('phone', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('company', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Keep existing sorting logic
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        
        $prospects = $query->orderBy($sort, $direction)->paginate(10);
        
        return view('prospects.index', compact('prospects', 'sort', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prospects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
//        dd($request->user()->id);

        $validatedData = $request->validate([
            'name_first' => 'required|string|max:255',
            'name_last' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'status' => ['required', 'integer', Rule::in([0, 1, 2, 3, 4])], // Added 0 to allowed values
        ]);

        $user_id = $request->user()->id;
        $validatedData['user_id'] = $user_id; // Add user_id

//        dd($validatedData);

        Prospect::create($validatedData);

        return redirect()->route('prospects.index')->with('success', 'Prospect created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Prospect $prospect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prospect $prospect)
    {
        // Check if the user owns this prospect
        if ($prospect->user_id !== auth()->id()) {
            abort(403);
        }

        return view('prospects.edit', compact('prospect'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prospect $prospect)
    {
        // Check if the user owns this prospect
        if ($prospect->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name_first' => 'required|string|max:255',
            'name_last' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'fax' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'status' => 'required|integer|min:0|max:4',
        ]);

        $prospect->update($validated);

        return redirect()->route('prospects.index')
            ->with('success', 'Prospect updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prospect $prospect)
    {
        // Check if the user owns this prospect
        if ($prospect->user_id !== auth()->id()) {
            abort(403);
        }

        $prospect->delete();
        return redirect()->route('prospects.index')->with('success', 'Prospect deleted successfully!');
    }
}
