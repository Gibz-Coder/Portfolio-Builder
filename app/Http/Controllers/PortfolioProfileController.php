<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class PortfolioProfileController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $profile = auth()->user()->profile;
        return view('portfolio-profile.index', compact('profile'));
    }

    public function create()
    {
        return view('portfolio-profile.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'avatar' => 'nullable|image|max:2048',
            'resume' => 'nullable|file|mimes:pdf|max:5120',
            'birth_date' => 'nullable|date',
            'profession' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer|min:0',
            'about_me' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->hasFile('resume')) {
            $validated['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        Profile::create($validated);

        return redirect()->route('portfolio-profile.index')
            ->with('success', 'Profile created successfully!');
    }

    public function edit(Profile $portfolioProfile)
    {
        $this->authorize('update', $portfolioProfile);
        return view('portfolio-profile.edit', compact('portfolioProfile'));
    }

    public function update(Request $request, Profile $portfolioProfile)
    {
        $this->authorize('update', $portfolioProfile);

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'avatar' => 'nullable|image|max:2048',
            'resume' => 'nullable|file|mimes:pdf|max:5120',
            'birth_date' => 'nullable|date',
            'profession' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer|min:0',
            'about_me' => 'nullable|string',
        ]);

        // Handle file uploads
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($portfolioProfile->avatar) {
                Storage::disk('public')->delete($portfolioProfile->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->hasFile('resume')) {
            // Delete old resume if exists
            if ($portfolioProfile->resume) {
                Storage::disk('public')->delete($portfolioProfile->resume);
            }
            $validated['resume'] = $request->file('resume')->store('resumes', 'public');
        }

        // Update the profile
        $portfolioProfile->update($validated);

        return redirect()->route('portfolio-profile.index')
            ->with('success', 'Profile updated successfully!');
    }

    public function destroy(Profile $portfolioProfile)
    {
        $this->authorize('delete', $portfolioProfile);
        $portfolioProfile->delete();

        return redirect()->route('portfolio-profile.index')
            ->with('success', 'Profile deleted successfully!');
    }
}
