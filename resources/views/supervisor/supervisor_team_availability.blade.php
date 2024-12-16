<x-app-layout>
    <!-- Navigation Bar -->
    <x-supervisor.nav />

    <!-- PAGE TITLE -->
    <div class="page-title py-6">
        <h2 class="text-3xl font-bold text-gray-900 text-center">Team Availability</h2>
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

            <!-- Team Availability Table -->
            <div class="bg-white shadow-lg rounded-lg p-8">

                <!-- Table Header -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Employee</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Task</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Availability</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($employees as $employee)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $employee->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($employee->availability)
                                            <span class="px-2 py-1 text-xs font-medium {{ $employee->availability->status === 'Available' ? 'text-green-800 bg-green-200' : 'text-red-800 bg-red-200' }} rounded">
                                                {{ $employee->availability->status }}
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-medium text-gray-400 bg-gray-200 rounded">
                                                No Data
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $employee->availability ? $employee->availability->current_task : 'None' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $employee->availability ? $employee->availability->availability_hours . ' hrs/day' : 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No team members available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End Team Availability Table -->

        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->

</x-app-layout>
