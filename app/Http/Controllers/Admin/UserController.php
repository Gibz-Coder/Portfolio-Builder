<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('profile')
            ->latest()
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'is_active' => 'boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        // Auto-approve admin-created users
        $validated['admin_approved'] = true;
        $validated['admin_approved_at'] = now();

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully!');
    }

    public function show(User $user)
    {
        $user->load(['profile', 'projects', 'skills', 'experiences', 'messages']);
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'is_active' => 'boolean',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }

    public function toggleStatus(User $user)
    {
        // Prevent admin from deactivating themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot deactivate your own account!');
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "User {$status} successfully!");
    }

    public function approve(User $user)
    {
        // Only allow approving non-admin users who are not already approved
        if ($user->isAdmin()) {
            return back()->with('error', 'Admin users are automatically approved!');
        }

        if ($user->isApproved()) {
            return back()->with('info', 'User is already approved!');
        }

        $user->update([
            'admin_approved' => true,
            'admin_approved_at' => now(),
        ]);

        return back()->with('success', 'User approved successfully!');
    }

    public function unapprove(User $user)
    {
        // Only allow unapproving non-admin users
        if ($user->isAdmin()) {
            return back()->with('error', 'Admin users cannot be unapproved!');
        }

        // Prevent admin from unapproving themselves
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot unapprove your own account!');
        }

        $user->update([
            'admin_approved' => false,
            'admin_approved_at' => null,
        ]);

        return back()->with('success', 'User approval revoked successfully!');
    }
}
