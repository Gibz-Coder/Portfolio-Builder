<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SkillController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $skills = Skill::where('user_id', auth()->id())
            ->orderBy('is_featured', 'desc')
            ->orderBy('proficiency', 'desc')
            ->get();

        return view('skills.index', compact('skills'));
    }

    public function create()
    {
        return view('skills.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'proficiency' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        $validated['user_id'] = auth()->id();

        Skill::create($validated);

        return redirect()->route('skills.index')
            ->with('success', 'Skill added successfully!');
    }

    public function show(Skill $skill)
    {
        $this->authorize('view', $skill);
        return view('skills.show', compact('skill'));
    }

    public function edit(Skill $skill)
    {
        $this->authorize('update', $skill);
        return view('skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $this->authorize('update', $skill);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'proficiency' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        $skill->update($validated);

        return redirect()->route('skills.index')
            ->with('success', 'Skill updated successfully!');
    }

    public function destroy(Skill $skill)
    {
        $this->authorize('delete', $skill);
        $skill->delete();

        return redirect()->route('skills.index')
            ->with('success', 'Skill deleted successfully!');
    }
}
