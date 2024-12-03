<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfPegawai
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->hasRole('pegawai')) {
            // Redirect pegawai to the overtime page
            dd('Redirecting pegawai user'); // Add this for debugging
            return redirect()->route('overtime.index'); // Ensure this route exists
        }
        return $next($request);
    }
}
