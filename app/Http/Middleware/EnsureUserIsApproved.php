<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Allow access if user is admin (admins are auto-approved)
        if ($user && $user->isAdmin()) {
            return $next($request);
        }

        // Check if user is approved
        if ($user && !$user->isApproved()) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is pending admin approval. Please wait for an administrator to approve your account.');
        }

        return $next($request);
    }
}
