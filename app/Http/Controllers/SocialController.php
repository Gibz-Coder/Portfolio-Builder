<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Social;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SocialController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socials = Social::where('user_id', auth()->id())
            ->orderBy('sort_order')
            ->orderBy('platform')
            ->get();

        return view('socials.index', compact('socials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('socials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'nullable|string|max:255',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_visible'] = $request->has('is_visible');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Social::create($validated);

        return redirect()->route('socials.index')
            ->with('success', 'Social link added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Social $social)
    {
        $this->authorize('update', $social);
        return view('socials.edit', compact('social'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Social $social)
    {
        $this->authorize('update', $social);

        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'nullable|string|max:255',
            'is_visible' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['is_visible'] = $request->has('is_visible');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $social->update($validated);

        return redirect()->route('socials.index')
            ->with('success', 'Social link updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Social $social)
    {
        $this->authorize('delete', $social);

        $social->delete();

        return redirect()->route('socials.index')
            ->with('success', 'Social link deleted successfully!');
    }
}
