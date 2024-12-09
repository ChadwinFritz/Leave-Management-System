<x-app-layout>
    <!-- Navigation Bar -->
    <x-admin.nav />

    <!-- PAGE TITLE -->
    <div class="page-title py-6 bg-gray-100">
        <h2 class="text-3xl font-bold text-gray-900 text-center">Admin Dashboard</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap py-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">

                <!-- Quick Overview Section -->
                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Quick Overview</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Pending Requests -->
                        <div class="flex items-center justify-between bg-blue-100 border border-blue-400 rounded-lg p-6 shadow">
                            <div>
                                <h4 class="text-xl font-semibold text-blue-700">Pending Requests</h4>
                                <p class="text-3xl font-bold text-blue-900 mt-2">{{ $pendingRequestsCount }}</p>
                            </div>
                        </div>

                        <!-- Approved Leaves -->
                        <div class="flex items-center justify-between bg-green-100 border border-green-400 rounded-lg p-6 shadow">
                            <div>
                                <h4 class="text-xl font-semibold text-green-700">Approved Leaves</h4>
                                <p class="text-3xl font-bold text-green-900 mt-2">{{ $approvedLeavesCount }}</p>
                            </div>
                        </div>

                        <!-- Rejected Leaves -->
                        <div class="flex items-center justify-between bg-red-100 border border-red-400 rounded-lg p-6 shadow">
                            <div>
                                <h4 class="text-xl font-semibold text-red-700">Rejected Leaves</h4>
                                <p class="text-3xl font-bold text-red-900 mt-2">{{ $rejectedLeavesCount }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Quick Overview Section -->

                <!-- Recent Leave Applications Section -->
                <div class="mt-8">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Recent Leave Applications</h3>
                    <div class="overflow-x-auto border border-gray-200 rounded-lg shadow">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Employee</th>
                                    <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Leave Type</th>
                                    <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Start Date</th>
                                    <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">End Date</th>
                                    <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentLeaveApplications as $application)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $application->employee->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $application->leaveType->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $application->start_date->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $application->end_date->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($application->status === 'pending')
                                                <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Pending</span>
                                            @elseif($application->status === 'approved')
                                                <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded">Approved</span>
                                            @elseif($application->status === 'rejected')
                                                <span class="inline-block bg-red-100 text-red-800 px-2 py-1 rounded">Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No recent leave applications found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Recent Leave Applications Section -->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->

</x-app-layout>
