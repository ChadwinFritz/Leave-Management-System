<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    /**
     * Show the user profile edit form.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('user.user_profile');
    }

    /**
     * Update the user profile.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validation for user profile fields
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get authenticated user
        $user = Auth::user();
        $employee = $user->employee;

        // Update user information
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->save();

        // Update employee information
        $employee->address = $request->input('address');
        $employee->save();

        // Redirect back with success message
        return redirect()->route('user.profile.edit')->with('success', 'Profile updated successfully!');
    }
}
