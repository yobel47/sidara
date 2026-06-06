<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileComplete
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && !$user->hasCompletedProfile()) {
            if (!$request->routeIs('identitas')) {
                return redirect()->route('identitas');
            }
        }

        return $next($request);
    }
}