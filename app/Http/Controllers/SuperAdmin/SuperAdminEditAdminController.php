<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminEditAdminController extends Controller
{
    /**
     * Display the edit form for an admin.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Find the admin user by ID
        $admin = User::where('role', 'admin')->findOrFail($id);

        return view('superadmin.superadmin_edit_admin', compact('admin'));
    }

    /**
     * Update the admin details.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate the input
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Find the admin user by ID
        $admin = User::where('role', 'admin')->findOrFail($id);

        // Update the admin details
        $admin->username = $validated['username'];
        $admin->email = $validated['email'];

        // Only update password if provided
        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()
            ->route('superadmin.admin.edit', $admin->id)
            ->with('success', 'Admin details updated successfully.');
    }
}
