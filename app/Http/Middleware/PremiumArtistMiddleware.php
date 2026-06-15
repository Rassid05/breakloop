<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PremiumArtistMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $subscription = auth()->user()
            ->subscriptions()
            ->where('status','active')
            ->first();

        if (!$subscription) {
            abort(403);
        }

        return $next($request);
    }
}
