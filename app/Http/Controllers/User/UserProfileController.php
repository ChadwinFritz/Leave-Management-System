<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    // Show the authenticated user's profile
    public function index()
    {
        // Pass the authenticated user to the view
        return view('user.user_profile', ['user' => auth()->user()]);
    }

    // Show the edit profile form
    public function edit($id)
    {
        // Retrieve the user by ID (the user ID from route)
        $user = User::findOrFail($id);
        
        return view('user.user_update_profile', compact('user'));
    }

    // Update the authenticated user's profile
    public function update(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Update the user's information
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        // Update associated employee details (if applicable)
        if ($user->employee) {
            $user->employee->update([
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }

        // Redirect back with a success message
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }
}
