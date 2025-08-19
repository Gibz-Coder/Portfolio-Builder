<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        // Get the user by ID from the route
        $user = User::findOrFail($request->route('id'));

        // Verify the hash matches the user's email
        if (! hash_equals(sha1($user->getEmailForVerification()), (string) $request->route('hash'))) {
            abort(403, 'Invalid verification link.');
        }

        // Verify the URL signature with proxy-aware validation
        if (! $this->hasValidSignature($request)) {
            abort(403, 'Invalid or expired verification link.');
        }

        // Check if already verified
        if ($user->hasVerifiedEmail()) {
            // If user is not logged in, log them in
            if (!Auth::check()) {
                Auth::login($user);
            }
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        // Mark email as verified
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Log the user in if they're not already authenticated
        if (!Auth::check()) {
            Auth::login($user);
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }

    /**
     * Determine if the given request has a valid signature with proxy support.
     */
    protected function hasValidSignature(Request $request): bool
    {
        // First try the standard Laravel signature validation
        if (URL::hasValidSignature($request)) {
            return true;
        }

        // If that fails, try with the original URL scheme/host
        $originalUrl = $request->url();
        $originalQuery = $request->getQueryString();

        // Try with HTTPS scheme if we're behind a proxy
        if ($request->header('X-Forwarded-Proto') === 'https') {
            $httpsUrl = str_replace('http://', 'https://', $originalUrl);
            if ($originalQuery) {
                $httpsUrl .= '?' . $originalQuery;
            }

            // Create a new request with the HTTPS URL for validation
            $httpsRequest = Request::create($httpsUrl, 'GET', $request->query->all());
            if (URL::hasValidSignature($httpsRequest)) {
                return true;
            }
        }

        return false;
    }
}
