<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ServiceController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::where('user_id', auth()->id())
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'price_type' => 'nullable|string|in:hourly,fixed,monthly,project',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Service::create($validated);

        return redirect()->route('services.index')
            ->with('success', 'Service added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $this->authorize('update', $service);
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $this->authorize('update', $service);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'price_type' => 'nullable|string|in:hourly,fixed,monthly,project',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $service->update($validated);

        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);

        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully!');
    }
}
