<x-app-layout>
    <!-- Navigation Bar -->
    <x-admin.nav />

    <!-- PAGE TITLE -->
    <div class="page-title py-6 bg-gray-100 border-b border-gray-300">
        <h2 class="text-3xl font-bold text-gray-900 text-center">Department Leave Report</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap py-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">

                <!-- Department Leave Report Section -->
                <div class="mb-8">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Department Leave Report Overview</h3>
                    <p class="text-sm text-gray-500">This table displays the total leave taken and pending leave requests for each department.</p>
                </div>

                <!-- Department Leave Report Table -->
                <div class="overflow-x-auto border border-gray-300 rounded-lg shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Department</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Total Leave Taken</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Pending Requests</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($departments as $department)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">{{ $department->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-green-600 font-bold">
                                        {{ $department->total_leave_taken }} days
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-yellow-500 font-semibold">
                                        {{ $department->pending_requests }} requests
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">No department data available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- End Department Leave Report Table -->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->

</x-app-layout>
