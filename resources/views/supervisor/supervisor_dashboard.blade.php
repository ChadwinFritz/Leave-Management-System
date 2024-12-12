<x-app-layout>
    <!-- Ensure CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Navigation Bar -->
    <x-supervisor.nav />

    <!-- PAGE TITLE -->
    <div class="page-title py-6">
        <h2 class="text-3xl font-bold text-gray-900 text-center">Supervisor Dashboard</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap py-8">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Pending Leave Approvals -->
            <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-xl font-semibold text-gray-900">Pending Leave Approvals</h3>
                <p class="text-sm text-gray-600 mt-2">{{ $pendingApprovalsCount ?? 0 }} leave requests are waiting for your approval.</p>
                <a href="{{ route('supervisor.team_leave') }}" class="mt-4 block text-indigo-600 hover:underline font-medium">Review Requests</a>
            </div>

            <!-- Team Availability -->
            <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-xl font-semibold text-gray-900">Team Availability</h3>
                <p class="text-sm text-gray-600 mt-2">{{ $availableMembersCount ?? 0 }} team members are currently available.</p>
                <a href="{{ route('supervisor.team_availability') }}" class="mt-4 block text-indigo-600 hover:underline font-medium">View Details</a>
            </div>

            <!-- Task Assignments -->
            <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-xl font-semibold text-gray-900">Task Assignments</h3>
                <p class="text-sm text-gray-600 mt-2">{{ $tasksAssignedCount ?? 0 }} tasks have been assigned this month.</p>
                <a href="{{ route('supervisor.assign_tasks') }}" class="mt-4 block text-indigo-600 hover:underline font-medium">Assign New Task</a>
            </div>

        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->

</x-app-layout>
