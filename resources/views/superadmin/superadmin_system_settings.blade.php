<x-app-layout>

    <!-- Navigation Bar -->
    <x-superadmin.nav />

    <x-slot name="title">
        System Settings
    </x-slot>

    <div class="container mx-auto py-6 px-4">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-gray-900">System Settings</h1>
        </div>

        <!-- System Settings Form -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-6 p-6">
            <form action="{{ route('superadmin.system.settings.update') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="site_name" class="block text-sm font-medium text-gray-700">Site Name</label>
                        <input type="text" name="site_name" id="site_name" value="{{ $settings->site_name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="admin_email" class="block text-sm font-medium text-gray-700">Admin Email</label>
                        <input type="email" name="admin_email" id="admin_email" value="{{ $settings->admin_email }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-gray-500 text-black px-4 py-2 rounded-md shadow hover:bg-blue-600 transition">Save Changes</button>
                </div>
            </form>
        </div>
        <!-- End System Settings Form -->
    </div>
</x-app-layout>
