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
        SystemSetting::create([
            'key' => 'site_name',
            'value' => 'My Application',
        ]);

        SystemSetting::create([
            'key' => 'admin_email',
            'value' => 'admin@example.com',
        ]);
    }
}
