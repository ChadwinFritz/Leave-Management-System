<x-app-layout>
    <!-- Navigation Bar -->
    <x-superadmin.nav />

    <x-slot name="title">
        Super Admin Dashboard
    </x-slot>

    <div class="container mx-auto py-6 px-4">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-gray-900">Super Admin Dashboard</h1>
        </div>

        <!-- Dashboard Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <!-- Total Employees -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <div class="text-center">
                    <h2 class="text-2xl font-semibold text-gray-800">Total Employees</h2>
                    <p class="text-gray-600 mt-2 text-3xl font-bold">{{ $totalEmployees ?? 'Loading...' }}</p>
                </div>
            </div>

            <!-- Pending Leave Requests -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <div class="text-center">
                    <h2 class="text-2xl font-semibold text-gray-800">Pending Leave Requests</h2>
                    <p class="text-gray-600 mt-2 text-3xl font-bold">{{ $pendingLeaveRequests ?? 'Loading...' }}</p>
                </div>
            </div>

            <!-- Total Departments -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 hover:shadow-2xl transition-shadow duration-300">
                <div class="text-center">
                    <h2 class="text-2xl font-semibold text-gray-800">Total Departments</h2>
                    <p class="text-gray-600 mt-2 text-3xl font-bold">{{ $totalDepartments ?? 'Loading...' }}</p>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-8 p-6 hover:shadow-2xl transition-shadow duration-300">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Activities</h2>
            <ul class="list-disc list-inside text-gray-600">
                @if(!empty($recentActivities))
                    @foreach($recentActivities as $activity)
                        <li class="mb-2">{{ $activity }}</li>
                    @endforeach
                @else
                    <li>No recent activities.</li>
                @endif
            </ul>
        </div>
    </div>
</x-app-layout>
