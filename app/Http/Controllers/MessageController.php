<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('messages.index', compact('messages'));
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'project' => 'nullable|string|max:255',
            'description' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
        ]);

        // Map template form fields to database fields
        $messageData = [
            'user_id' => $user->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['project'] ?? 'Portfolio Contact',
            'message' => $validated['description'],
            'phone' => $validated['phone'] ?? null,
            'company' => $validated['company'] ?? null,
        ];

        Message::create($messageData);

        return back()->with('success', 'Message sent successfully! We\'ll get back to you soon.');
    }

    public function show(Message $message)
    {
        $this->authorize('view', $message);
        
        if ($message->status === 'unread') {
            $message->markAsRead();
        }

        return view('messages.show', compact('message'));
    }

    public function update(Request $request, Message $message)
    {
        $this->authorize('update', $message);

        $validated = $request->validate([
            'status' => 'required|in:unread,read,replied,archived',
        ]);

        $message->update($validated);

        return back()->with('success', 'Message status updated successfully!');
    }

    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);
        $message->delete();

        return redirect()->route('messages.index')
            ->with('success', 'Message deleted successfully!');
    }

    public function markAsRead(Message $message)
    {
        $this->authorize('update', $message);
        $message->markAsRead();

        return back()->with('success', 'Message marked as read!');
    }
}
