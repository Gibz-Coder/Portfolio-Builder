<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EagerLoadUserProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Eager load the profile relationship and calculate unread messages for authenticated users
        if ($request->user()) {
            $user = $request->user();

            // Eager load profile to avoid N+1 queries in navigation
            $user->load('profile');

            // Calculate unread messages count and store it as an attribute to avoid repeated queries
            $unreadCount = $user->messages()->where('status', 'unread')->count();
            $user->setAttribute('unread_messages_count', $unreadCount);
        }

        return $next($request);
    }
}
