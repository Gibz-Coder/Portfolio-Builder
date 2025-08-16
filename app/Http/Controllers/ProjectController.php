<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $projects = Project::where('user_id', auth()->id())
            ->orderBy('is_featured', 'desc')
            ->orderBy('sort_order')
            ->paginate(12);

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'demo_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'technologies' => 'nullable|array',
            'status' => 'required|in:completed,in_progress,planned',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully!');
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'demo_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'technologies' => 'nullable|array',
            'status' => 'required|in:completed,in_progress,planned',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}
