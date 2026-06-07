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

        if ($user) {
            $complete = $user->hasCompletedProfile();

            // Belum isi identitas → paksa ke /identitas
            if (!$complete && !$request->routeIs('identitas')) {
                return redirect()->route('identitas');
            }

            // Sudah isi identitas tapi buka /identitas lagi → ke home
            if ($complete && $request->routeIs('identitas')) {
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}