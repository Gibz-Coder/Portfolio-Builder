<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ExperienceController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = Experience::where('user_id', auth()->id())
            ->orderBy('start_date', 'desc')
            ->get();

        return view('experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('experiences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'technologies' => 'nullable|array',
            'technologies.*' => 'string|max:255',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_current'] = $request->has('is_current');

        // If current job, set end_date to null
        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        Experience::create($validated);

        return redirect()->route('experiences.index')
            ->with('success', 'Experience added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
        $this->authorize('update', $experience);
        return view('experiences.edit', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        $this->authorize('update', $experience);

        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'technologies' => 'nullable|array',
            'technologies.*' => 'string|max:255',
        ]);

        $validated['is_current'] = $request->has('is_current');

        // If current job, set end_date to null
        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        $experience->update($validated);

        return redirect()->route('experiences.index')
            ->with('success', 'Experience updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        $this->authorize('delete', $experience);

        $experience->delete();

        return redirect()->route('experiences.index')
            ->with('success', 'Experience deleted successfully!');
    }
}
