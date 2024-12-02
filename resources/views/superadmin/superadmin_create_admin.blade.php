<x-app-layout>
    <!-- Navigation Bar -->
    <x-superadmin.nav />

    <x-slot name="title">
        Add New Admin
    </x-slot>

    <div class="container mx-auto py-6 px-4">
        <h1 class="text-3xl font-semibold text-gray-900">Add New Admin</h1>

        <!-- Display any success or error messages -->
        <div class="mt-4">
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @elseif ($errors->any())
                <div class="bg-red-100 text-red-800 p-4 rounded-md mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Admin Creation Form -->
        <form action="{{ route('superadmin.admin.store') }}" method="POST" class="space-y-6 mt-6">
            @csrf

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('username') 
                    <span class="text-red-600 text-xs">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('email') 
                    <span class="text-red-600 text-xs">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('password') 
                    <span class="text-red-600 text-xs">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('password_confirmation') 
                    <span class="text-red-600 text-xs">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Create Admin
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
