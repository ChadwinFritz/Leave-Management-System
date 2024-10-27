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
            'maintenance_mode' => 'required|boolean',
            'default_language' => 'required|string|max:2', // Assuming you are using ISO language codes
            'theme' => 'required|string|in:light,dark', // Validate theme
            'time_zone' => 'required|string', // Add time zone validation
        ]);

        // Retrieve the current settings from the database
        $settings = SystemSetting::first();

        // Update settings with the new values
        $settings->maintenance_mode = $request->maintenance_mode;
        $settings->default_language = $request->default_language;
        $settings->theme = $request->theme;
        $settings->time_zone = $request->time_zone;

        // Save the changes to the database
        $settings->save();

        // Redirect with a success message
        return redirect()->route('superadmin.system.settings')->with('success', 'Settings updated successfully.');
    }
}
