<x-app-layout>

    <!-- Navigation Bar -->
    <x-user.nav />

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">Welcome, {{ Auth::user()->name }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Total Leaves Taken -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold">Total Leaves Taken</h2>
                <p class="text-gray-600 mt-2">{{ $totalLeavesTaken ?? 'Loading...' }}</p>
            </div>

            <!-- Remaining Leave Balance -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold">Remaining Leave Balance</h2>
                <p class="text-gray-600 mt-2">{{ $remainingLeave ?? 'Loading...' }}</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center space-x-6 mt-6">
            <a href="{{ route('user.leave.application') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600 transition">
                Apply for Leave
            </a>
            <a href="{{ route('user.leave.history') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md shadow hover:bg-green-600 transition">
                View Leave History
            </a>
            <a href="{{ route('user.profile') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md shadow hover:bg-yellow-600 transition">
                Update Profile
            </a>
        </div>
    </div>
</x-app-layout>
