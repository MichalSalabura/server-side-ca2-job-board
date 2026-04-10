<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsJobseeker
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'jobseeker') {
            return redirect('/dashboard'); // or home
        }

        return $next($request);
    }
}