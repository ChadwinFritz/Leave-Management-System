<x-app-layout>
    <!-- Navigation Bar -->
    <x-supervisor.nav />
    
    <div class="max-w-7xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Approve Leave Requests</h1>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-md mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Pending Leave Requests Table -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Pending Leave Requests</h2>

            @if ($leaveApplications->isEmpty())
                <p class="text-gray-600">No pending leave requests at the moment.</p>
            @else
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2 text-left">Employee</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Leave Type</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Start Date</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">End Date</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Reason</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaveApplications as $application)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $application->employee->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $application->leaveType->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $application->start_date->format('Y-m-d') }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $application->end_date->format('Y-m-d') }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $application->reason }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <span class="font-semibold {{ $application->status === 'pending' ? 'text-yellow-600' : ($application->status === 'approved' ? 'text-green-600' : 'text-red-600') }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                                    <!-- Approve Button -->
                                    <form action="{{ route('supervisor.approve.leave', $application->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button 
                                            type="submit" 
                                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                                            {{ $application->status !== 'pending' ? 'disabled' : '' }}>
                                            Approve
                                        </button>
                                    </form>

                                    <!-- Reject Button -->
                                    <form action="{{ route('supervisor.reject.leave', $application->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button 
                                            type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                                            {{ $application->status !== 'pending' ? 'disabled' : '' }}>
                                            Reject
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
