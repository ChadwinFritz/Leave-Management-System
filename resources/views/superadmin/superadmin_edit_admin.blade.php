<x-app-layout>
    <!-- Navigation Bar -->
    <x-superadmin.nav />

    <x-slot name="title">
        Edit Admin
    </x-slot>

    <div class="container mx-auto py-6 px-4">
        <h1 class="text-3xl font-semibold text-gray-900">Edit Admin: {{ $admin->username }}</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mt-4 mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('superadmin.admin.update', $admin->id) }}" method="POST" class="mt-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Username Field -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username', $admin->username) }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('username')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('email')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field (Leave Blank for No Change) -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password (leave blank to keep current password)</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('password')
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600 transition-all duration-300">
                Update Admin
            </button>
        </form>
    </div>
</x-app-layout>
