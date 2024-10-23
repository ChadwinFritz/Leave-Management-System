<x-app-layout>

    <!-- Navigation Bar -->
    <x-user.nav />

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold">Leave History</h1>

        <div class="bg-white shadow-md rounded-lg mt-6">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leaveHistory as $leave)
                        <tr class="border-b">
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $leave->leaveType ? $leave->leaveType->name : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $leave->start_date->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $leave->end_date->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $leave->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
