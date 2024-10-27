<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemSetting;

class SystemSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a default system setting record
        SystemSetting::create([
            'maintenance_mode' => false,                  // Default maintenance mode
            'default_language' => 'en',                   // Default language set to English
            'theme' => 'light',                           // Default theme
            'time_zone' => 'Africa/Johannesburg'         // Default time zone set to South Africa
        ]);

        // Seed additional languages and time zones
        SystemSetting::create([
            'maintenance_mode' => false,
            'default_language' => 'fr',                   // French
            'theme' => 'light',
            'time_zone' => 'Europe/Paris'                 // Paris Time
        ]);

        SystemSetting::create([
            'maintenance_mode' => false,
            'default_language' => 'es',                   // Spanish
            'theme' => 'light',
            'time_zone' => 'Europe/Madrid'                // Madrid Time
        ]);

        SystemSetting::create([
            'maintenance_mode' => false,
            'default_language' => 'de',                   // German
            'theme' => 'light',
            'time_zone' => 'Europe/Berlin'                // Berlin Time
        ]);

        SystemSetting::create([
            'maintenance_mode' => false,
            'default_language' => 'it',                   // Italian
            'theme' => 'light',
            'time_zone' => 'Europe/Rome'                  // Rome Time
        ]);

        SystemSetting::create([
            'maintenance_mode' => false,
            'default_language' => 'zh',                   // Chinese
            'theme' => 'light',
            'time_zone' => 'Asia/Shanghai'                // Shanghai Time
        ]);

        SystemSetting::create([
            'maintenance_mode' => false,
            'default_language' => 'ja',                   // Japanese
            'theme' => 'light',
            'time_zone' => 'Asia/Tokyo'                   // Tokyo Time
        ]);

        SystemSetting::create([
            'maintenance_mode' => false,
            'default_language' => 'ar',                   // Arabic
            'theme' => 'light',
            'time_zone' => 'Asia/Riyadh'                  // Riyadh Time
        ]);

        SystemSetting::create([
            'maintenance_mode' => false,
            'default_language' => 'pt',                   // Portuguese
            'theme' => 'light',
            'time_zone' => 'America/Sao_Paulo'           // São Paulo Time
        ]);

        SystemSetting::create([
            'maintenance_mode' => false,
            'default_language' => 'ru',                   // Russian
            'theme' => 'light',
            'time_zone' => 'Europe/Moscow'                // Moscow Time
        ]);

        SystemSetting::create([
            'maintenance_mode' => false,
            'default_language' => 'hi',                   // Hindi
            'theme' => 'light',
            'time_zone' => 'Asia/Kolkata'                 // Kolkata Time
        ]);
    }
}
