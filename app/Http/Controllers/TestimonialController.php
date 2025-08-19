<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TestimonialController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::where('user_id', auth()->id())
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'client_avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'project_title' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_approved' => 'boolean',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_approved'] = $request->has('is_approved');

        // Handle avatar upload
        if ($request->hasFile('client_avatar')) {
            $validated['client_avatar'] = $request->file('client_avatar')->store('testimonials', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimonial added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        $this->authorize('update', $testimonial);
        return view('testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $this->authorize('update', $testimonial);

        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_position' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'client_avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'project_title' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_approved' => 'boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_approved'] = $request->has('is_approved');

        // Handle avatar upload
        if ($request->hasFile('client_avatar')) {
            // Delete old avatar if exists
            if ($testimonial->client_avatar) {
                Storage::disk('public')->delete($testimonial->client_avatar);
            }
            $validated['client_avatar'] = $request->file('client_avatar')->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimonial updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $this->authorize('delete', $testimonial);

        // Delete avatar if exists
        if ($testimonial->client_avatar) {
            Storage::disk('public')->delete($testimonial->client_avatar);
        }

        $testimonial->delete();

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimonial deleted successfully!');
    }
}
