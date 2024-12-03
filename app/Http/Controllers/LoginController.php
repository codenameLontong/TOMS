<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Role;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Since we added a global scope, we only need to check authentication now.
        // Attempt to log in from the `users` table
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            Log::info('Login successful for User: ' . $request->email);
            return $this->redirectBasedOnRole();
        }

        // Log failure if authentication fails
        Log::warning('Login failed for email: ' . $request->email . ' - Incorrect password or inactive account.');

        // Return with error if authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records or your account is inactive.',
        ]);
    }


    protected function authenticated(Request $request, $user)
    {
        // Check if the user has the 'pegawai' role
        if ($user->hasRole('pegawai')) {
            // Redirect to the overtime page for 'pegawai' role
            return redirect()->route('overtime.index');  // Replace 'overtime.index' with your actual route name
        }

        // Default redirection for other roles
        return redirect()->route('home');  // Or the default route you want for other roles
    }

    // protected function redirectBasedOnRole()
    // {
    //     $user = Auth::user();

    //     // Handle role-based redirects
    //     switch ($user->role->name) {
    //         case 'superadmin':
    //             return redirect()->intended('/superadmin/dashboard');
    //         case 'admin':
    //             return redirect()->intended('/admin/dashboard');
    //         case 'direct_superior':
    //             return redirect()->intended('/direct_superior/dashboard');
    //         case 'pegawai':
    //             return redirect()->intended('/pegawai/overtime'); // Add Pegawai redirect
    //         // Add other roles if needed
    //         default:
    //             return redirect()->intended('/home');  // Default redirect
    //     }
    // }
}
