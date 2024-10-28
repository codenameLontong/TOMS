<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;


class CheckActiveStatus
{
    public function handle(Request $request, Closure $next)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user is inactive (active is 0)
        if ($user && $user->active == 0) {
            Auth::logout();  // Log out the inactive user
            session()->invalidate();  // Invalidate the session
            session()->regenerateToken();  // Regenerate the CSRF token

            return redirect()->route('login')->withErrors([
                'email' => 'Your account is inactive. Please contact the administrator.',
            ]);
        }

        return $next($request);
    }
}
