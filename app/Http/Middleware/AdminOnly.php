<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->roles()->whereName('admin')->exists()) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
