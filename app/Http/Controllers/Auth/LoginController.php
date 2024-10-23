<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Specify the redirect path after login failure
    protected $redirectTo = '/';

    // Handle the login request
    public function login(Request $request)
    {
        // Validate the login credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // If authentication succeeds, call the authenticated method to redirect user
            return $this->authenticated($request, Auth::user());
        }

        // If authentication fails, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle the authenticated logic
    protected function authenticated(Request $request, $user)
    {
        // Check the user's role and redirect accordingly
        switch ($user->level) {
            case 0: // Normal User
                return redirect()->route('user.dashboard');
            case 1: // Admin
                return redirect()->route('admin.dashboard');
            case 2: // Super Admin
                return redirect()->route('superadmin.dashboard');
            default:
                return redirect()->route('login')->withErrors('Unauthorized access.');
        }
    }

    // Log the user out
    public function logout(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Invalidate the session and regenerate token for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page after logout
        return redirect()->route('auth.login')->with('message', 'You have been logged out successfully.');
    }
}