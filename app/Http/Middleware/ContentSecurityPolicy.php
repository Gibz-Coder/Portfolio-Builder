<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Generate a nonce for inline scripts
        $nonce = base64_encode(random_bytes(16));
        
        // Store nonce for use in views
        app()->instance('csp-nonce', $nonce);

        // Set a more permissive CSP that allows Alpine.js and Chart.js to work
        $csp = implode('; ', [
            "default-src 'self' 'unsafe-inline' 'unsafe-eval' http: https: data: blob:",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdnjs.cloudflare.com https://fonts.bunny.net https://cdn.jsdelivr.net",
            "script-src-elem 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.bunny.net https://cdn.jsdelivr.net",
            "style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.bunny.net https://cdn.jsdelivr.net",
            "font-src 'self' https://fonts.bunny.net https://cdnjs.cloudflare.com",
            "img-src 'self' data: https:",
            "connect-src 'self'",
            "object-src 'none'",
            "base-uri 'self'"
        ]);

        $response->headers->set('Content-Security-Policy', $csp);

        // Add debug header to verify CSP is being applied
        $response->headers->set('X-CSP-Applied', 'true');

        return $response;
    }
}
