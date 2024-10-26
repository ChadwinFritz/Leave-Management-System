<x-app-layout>
    <!-- Navigation Bar -->
    <x-admin.nav />

    <!-- PAGE TITLE -->
    <div class="page-title py-6">
        <h2 class="text-3xl font-bold text-gray-900 text-center">Approve Leave Requests</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap py-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-lg rounded-lg p-8">

                <!-- Leave Requests Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($leaveApplications as $application)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $application->employee->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $application->leaveType->name }}</td> <!-- Updated to access leave type name -->
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $application->start_date->format('Y-m-d') }}</td> <!-- Formatting the date -->
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $application->end_date->format('Y-m-d') }}</td> <!-- Formatting the date -->
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $application->status }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('leave.approve', $application->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900">Approve</button>
                                        </form>
                                        <form action="{{ route('leave.reject', $application->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Leave Requests Table -->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->

</x-app-layout>
