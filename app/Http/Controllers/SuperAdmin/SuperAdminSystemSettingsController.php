<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SuperAdminSystemSettingsController extends Controller
{
    /**
     * Display the system settings page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ensure only SuperAdmins can access this page
        $this->authorize('manageSystemSettings', auth()->user());

        // Load settings from cache or a configuration model
        $settings = $this->getSettings();

        return view('superadmin.superadmin_system_settings', compact('settings'));
    }

    /**
     * Update system settings.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Ensure only SuperAdmins can update settings
        $this->authorize('manageSystemSettings', auth()->user());

        // Validate the incoming request data
        $validated = $request->validate([
            'maintenance_mode' => 'required|boolean',
            'default_language' => 'required|string|in:en,af,zu',
            'theme' => 'required|string|in:light,dark',
            'time_zone' => 'required|string|timezone',
        ]);

        // Save the settings (could be in a database, cache, or configuration file)
        foreach ($validated as $key => $value) {
            Cache::forever("system_settings.{$key}", $value);
        }

        return redirect()
            ->route('superadmin.system.settings')
            ->with('success', 'System settings updated successfully.');
    }

    /**
     * Retrieve system settings from cache or default values.
     *
     * @return object
     */
    protected function getSettings()
    {
        return (object) [
            'maintenance_mode' => Cache::get('system_settings.maintenance_mode', 0),
            'default_language' => Cache::get('system_settings.default_language', 'en'),
            'theme' => Cache::get('system_settings.theme', 'light'),
            'time_zone' => Cache::get('system_settings.time_zone', 'Africa/Johannesburg'),
        ];
    }
}
