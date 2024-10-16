<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

        // Check if the email exists in the users table or pegawai table
        $userExists = User::where('email', $request->email)->exists();
        $pegawaiExists = Pegawai::where('alamat_email', $request->email)->exists();

        // Log whether the email exists in the respective table
        Log::info('Checking if email exists in users table: ' . ($userExists ? 'Yes' : 'No'));
        Log::info('Checking if email exists in pegawai table: ' . ($pegawaiExists ? 'Yes' : 'No'));

        // If the email exists in the users table or pegawai table, attempt login
        if ($userExists || $pegawaiExists) {
            if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
                // Log success
                Log::info('Login successful for email: ' . $request->email);

                // Redirect based on user role or other conditions
                return redirect()->intended('/superadmin/dashboard'); // or change to your desired path
            } else {
                // Log failure
                Log::warning('Login failed for email: ' . $request->email . ' - Incorrect password.');
            }
        } else {
            // Log failure if email doesn't exist
            Log::warning('Login failed for email: ' . $request->email . ' - Email not found.');
        }

        // Return with error if authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    protected function redirectBasedOnRole()
    {
        $user = Auth::user();

        // You can modify this switch to handle other roles and their respective redirects
        switch ($user->role->name) {
            case 'superadmin':
                return redirect()->intended('/superadmin/dashboard');
            case 'admin':
                return redirect()->intended('/admin/dashboard');
            case 'direct_superior':
                return redirect()->intended('/direct_superior/dashboard');
            // Add other role-based redirects as needed
            default:
                return redirect()->intended('/home');  // Default redirect
        }
    }
}
