<x-app-layout>

    <!-- Navigation Bar -->
    <x-superadmin.nav />
    
    <x-slot name="title">
        Add New Admin
    </x-slot>

    <div class="container mx-auto py-6 px-4">
        <h1 class="text-3xl font-semibold text-gray-900">Add New Admin</h1>

        <form action="{{ route('superadmin.admin.store') }}" method="POST" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>

            <button type="submit" class="bg-gray-500 text-black px-4 py-2 rounded-md shadow hover:bg-blue-600 transition">Create Admin</button>
        </form>
    </div>
</x-app-layout>
