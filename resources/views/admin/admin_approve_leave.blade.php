<x-app-layout>
    <!-- Navigation Bar -->
    <x-admin.nav />

    <!-- PAGE TITLE -->
    <div class="page-title py-6 bg-gray-100">
        <h2 class="text-3xl font-bold text-gray-900 text-center">Approve Leave Requests</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap py-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">
                <!-- Flash Message -->
                @if(session('message'))
                    <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-2 rounded mb-6">
                        {{ session('message') }}
                    </div>
                @endif
                <!-- End Flash Message -->

                <!-- Leave Requests Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Leave Type</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Start Date</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">End Date</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-center font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($leaveApplications as $application)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $application->employee->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $application->leaveType->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $application->start_date->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $application->end_date->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($application->status === 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        @elseif($application->status === 'approved')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                Approved
                                            </span>
                                        @elseif($application->status === 'rejected')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                Rejected
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($application->status === 'pending')
                                            <div class="flex justify-center space-x-4">
                                                <form action="{{ route('leave.approve', $application->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700">
                                                        Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('leave.reject', $application->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">
                                                        Reject
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-gray-500 italic">No Actions</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        No leave requests to display.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- End Leave Requests Table -->

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $leaveApplications->links() }}
                </div>
                <!-- End Pagination -->
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</x-app-layout>
