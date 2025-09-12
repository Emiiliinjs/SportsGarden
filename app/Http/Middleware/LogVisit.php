<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;

class LogVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Saglabā tikai GET pieprasījumus (lai neraksta formu POST utt.)
        if ($request->isMethod('get')) {
            Visit::create([
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'user_id' => Auth::check() ? Auth::id() : null,
            ]);
        }

        return $next($request);
    }
}
