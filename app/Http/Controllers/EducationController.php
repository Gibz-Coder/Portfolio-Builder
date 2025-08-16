<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EducationController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $education = Education::where('user_id', auth()->id())
            ->orderBy('start_date', 'desc')
            ->get();

        return view('education.index', compact('education'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('education.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'grade' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_current'] = $request->has('is_current');

        // If current education, set end_date to null
        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        Education::create($validated);

        return redirect()->route('education.index')
            ->with('success', 'Education added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Education $education)
    {
        $this->authorize('update', $education);
        return view('education.edit', compact('education'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Education $education)
    {
        $this->authorize('update', $education);

        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'grade' => 'nullable|string|max:255',
        ]);

        $validated['is_current'] = $request->has('is_current');

        // If current education, set end_date to null
        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        $education->update($validated);

        return redirect()->route('education.index')
            ->with('success', 'Education updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
        $this->authorize('delete', $education);

        $education->delete();

        return redirect()->route('education.index')
            ->with('success', 'Education deleted successfully!');
    }
}
