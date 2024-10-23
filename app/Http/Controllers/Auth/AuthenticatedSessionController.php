<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user with the provided credentials
        $request->authenticate();

        // Regenerate session to protect against session fixation attacks
        $request->session()->regenerate();

        // Redirect based on user role
        $user = Auth::user(); // Get the currently authenticated user

        switch ($user->level) {
            case 0: // Normal User
                return redirect()->intended(route('user.dashboard'));
            case 1: // Admin
                return redirect()->intended(route('admin.dashboard'));
            case 2: // Super Admin
                return redirect()->intended(route('superadmin.dashboard'));
            default:
                return redirect()->route('auth.login')->withErrors('Unauthorized access.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log out the user
        Auth::guard('web')->logout();

        // Invalidate the session to log out the user completely and end the session
        $request->session()->invalidate();

        // Regenerate the CSRF token to protect against session fixation attacks
        $request->session()->regenerateToken();

        // Redirect the user to the login page after successful logout
        return redirect('/')->with('message', 'You have been logged out successfully.');
    }
}
