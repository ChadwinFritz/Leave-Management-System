<x-app-layout>
    <!-- Navigation Bar -->
    <x-supervisor.nav />

    <!-- PAGE TITLE -->
    <div class="page-title py-6">
        <h2 class="text-3xl font-bold text-gray-900 text-center">Team Leave Status</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap py-8">
        <div class="max-w-7xl mx-auto">
            
            <!-- Display success or error messages -->
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Leave Status Table -->
            <div class="bg-white shadow-lg rounded-lg p-8">

                <!-- Table Header -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($employees as $employee) <!-- Assuming employees are passed from controller -->
                                @foreach($employee->leaveApplications as $application)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $application->leaveType->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($application->start_date)->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($application->end_date)->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-medium {{ $application->status === 'approved' ? 'text-green-800 bg-green-200' : 'text-red-800 bg-red-200' }} rounded">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Leave Status Table -->

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->

</x-app-layout>
