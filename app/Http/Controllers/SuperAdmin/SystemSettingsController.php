<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting; // Ensure to import the SystemSetting model
use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    // Display the system settings form
    public function edit()
    {
        // Retrieve current settings from the database
        $settings = SystemSetting::first();

        // Return the correct view with the settings
        return view('superadmin.superadmin_system_settings', compact('settings'));
    }

    // Update the system settings
    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'site_name' => 'required|string|max:255',
            'admin_email' => 'required|string|email|max:255',
        ]);

        // Retrieve the current settings from the database
        $settings = SystemSetting::first();

        // Update settings with the new values
        $settings->site_name = $request->site_name;
        $settings->admin_email = $request->admin_email;

        // Save the changes to the database
        $settings->save();

        // Redirect with a success message
        return redirect()->route('superadmin.system.settings')->with('success', 'Settings updated successfully.');
    }
}
