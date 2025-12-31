<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Skip tracking untuk admin routes dan API routes
        if ($request->is('admin/*') || $request->is('api/*') || $request->is('livewire/*')) {
            return $response;
        }

        // Skip tracking untuk static assets
        if ($request->is('css/*') || $request->is('js/*') || $request->is('images/*') || $request->is('storage/*')) {
            return $response;
        }

        // Skip tracking untuk bots (basic check)
        $userAgent = $request->userAgent();
        if ($this->isBot($userAgent)) {
            return $response;
        }

        try {
            Visitor::create([
                'ip_address' => $request->ip(),
                'user_agent' => $userAgent,
                'url' => $request->fullUrl(),
                'referer' => $request->header('referer'),
                'session_id' => $request->session()->getId(),
                'visited_at' => now(),
            ]);
        } catch (\Exception $e) {
            // Silent fail - don't break the application if tracking fails
            \Log::error('Visitor tracking failed: '.$e->getMessage());
        }

        return $response;
    }

    /**
     * Check if user agent is a bot
     */
    private function isBot($userAgent)
    {
        if (! $userAgent) {
            return true;
        }

        $bots = [
            'bot',
            'crawler',
            'spider',
            'googlebot',
            'bingbot',
            'yahoo',
            'facebookexternalhit',
            'twitterbot',
            'linkedinbot',
            'whatsapp',
        ];

        $userAgent = strtolower($userAgent);

        foreach ($bots as $bot) {
            if (strpos($userAgent, $bot) !== false) {
                return true;
            }
        }

        return false;
    }
}
