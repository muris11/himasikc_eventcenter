<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptimizeResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Add caching headers for static assets
        if ($response instanceof \Illuminate\Http\Response) {
            // Add caching headers for static assets
            if ($request->is('build/*') || $request->is('storage/*')) {
                $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
                $response->headers->set('Expires', now()->addYear()->toRfc7231String());
            }

            // Add caching for pages (5 minutes)
            elseif ($request->isMethod('GET') && ! $request->has('page')) {
                $response->headers->set('Cache-Control', 'public, max-age=300');
            }
        }

        return $response;
    }
}
