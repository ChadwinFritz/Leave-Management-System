<x-app-layout>
    <!-- Navigation Bar -->
    <x-superadmin.nav />

    <x-slot name="title">
        System Settings
    </x-slot>

    <div class="container mx-auto py-6 px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-900">System Settings</h1>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- System Settings Form -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form action="{{ route('superadmin.system.settings.update') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Maintenance Mode -->
                    <div>
                        <label for="maintenance_mode" class="block text-sm font-medium text-gray-700">Maintenance Mode</label>
                        <select name="maintenance_mode" id="maintenance_mode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="1" {{ old('maintenance_mode', $settings->maintenance_mode) == 1 ? 'selected' : '' }}>Enabled</option>
                            <option value="0" {{ old('maintenance_mode', $settings->maintenance_mode) == 0 ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>

                    <!-- Default Language -->
                    <div>
                        <label for="default_language" class="block text-sm font-medium text-gray-700">Default Language</label>
                        <select name="default_language" id="default_language" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="en" {{ old('default_language', $settings->default_language) == 'en' ? 'selected' : '' }}>English</option>
                            <option value="af" {{ old('default_language', $settings->default_language) == 'af' ? 'selected' : '' }}>Afrikaans</option>
                            <option value="zu" {{ old('default_language', $settings->default_language) == 'zu' ? 'selected' : '' }}>Zulu</option>
                        </select>
                    </div>

                    <!-- Theme -->
                    <div>
                        <label for="theme" class="block text-sm font-medium text-gray-700">Theme</label>
                        <select name="theme" id="theme" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="light" {{ old('theme', $settings->theme) == 'light' ? 'selected' : '' }}>Light</option>
                            <option value="dark" {{ old('theme', $settings->theme) == 'dark' ? 'selected' : '' }}>Dark</option>
                        </select>
                    </div>

                    <!-- Time Zone -->
                    <div>
                        <label for="time_zone" class="block text-sm font-medium text-gray-700">Time Zone</label>
                        <select name="time_zone" id="time_zone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="Africa/Johannesburg" {{ old('time_zone', $settings->time_zone) == 'Africa/Johannesburg' ? 'selected' : '' }}>South Africa (UTC+2)</option>
                            <option value="Africa/Cape_Town" {{ old('time_zone', $settings->time_zone) == 'Africa/Cape_Town' ? 'selected' : '' }}>Cape Town</option>
                            <option value="Africa/Durban" {{ old('time_zone', $settings->time_zone) == 'Africa/Durban' ? 'selected' : '' }}>Durban</option>
                            <option value="Africa/Johannesburg" {{ old('time_zone', $settings->time_zone) == 'Africa/Johannesburg' ? 'selected' : '' }}>Johannesburg</option>
                            <option value="Africa/Pretoria" {{ old('time_zone', $settings->time_zone) == 'Africa/Pretoria' ? 'selected' : '' }}>Pretoria</option>
                            <option value="Africa/Bloemfontein" {{ old('time_zone', $settings->time_zone) == 'Africa/Bloemfontein' ? 'selected' : '' }}>Bloemfontein</option>
                            <option value="Africa/Port_Elizabeth" {{ old('time_zone', $settings->time_zone) == 'Africa/Port_Elizabeth' ? 'selected' : '' }}>Port Elizabeth</option>
                            <option value="Africa/East_London" {{ old('time_zone', $settings->time_zone) == 'Africa/East_London' ? 'selected' : '' }}>East London</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-md shadow hover:bg-blue-600 transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
        <!-- End System Settings Form -->
    </div>
</x-app-layout>
