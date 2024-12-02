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

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the login credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in with the provided credentials
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // If authentication succeeds, redirect to the authenticated route
            return $this->authenticated($request, Auth::user());
        }

        // If authentication fails, redirect back with errors
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle the logic after successful authentication.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // Ensure $user is not null
        if (!$user) {
            return redirect()->route('auth.login')->withErrors('Authentication failed. User not found.');
        }

        // Check the user's level and redirect accordingly
        switch ($user->level) {
            case 0: // Normal User
                return redirect()->route('user.dashboard');
            case 1: // Admin
                return redirect()->route('admin.dashboard');
            case 2: // Super Admin
                return redirect()->route('superadmin.dashboard');
            case 3: // Supervisor
                return redirect()->route('supervisor.dashboard');
            default:
                return redirect()->route('login')->withErrors('Unauthorized access.');
        }
    }

    /**
     * Log the user out.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page after logout
        return redirect()->route('auth.login')->with('message', 'You have been logged out successfully.');
    }
}
