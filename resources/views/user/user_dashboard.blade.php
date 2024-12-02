<x-app-layout>
    <x-user.nav />

    <!-- Dashboard Welcome Section -->
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-semibold text-gray-900">Welcome, {{ Auth::user()->name }}</h1>
        <p class="text-gray-600 mt-2">Here is an overview of your leave information.</p>

        <!-- Dashboard Overview Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            <!-- Total Leaves Taken -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900">Total Leaves Taken</h2>
                <p class="text-lg text-gray-600 mt-2">{{ $totalLeavesTaken ?? 'No data' }} days</p>
            </div>

            <!-- Remaining Leave Balance -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900">Remaining Leave Balance</h2>
                <p class="text-lg text-gray-600 mt-2">{{ $remainingLeave ?? 'No data' }} days</p>
            </div>

            <!-- Leave Types Overview -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900">Leave Types Overview</h2>
                <canvas id="leaveTypesChart"></canvas>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="flex justify-center space-x-6 mt-8">
            <a href="{{ route('user.leave.application') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-700 transition">
                Apply for Leave
            </a>
            <a href="{{ route('user.leave.history') }}" class="bg-green-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-green-700 transition">
                View Leave History
            </a>
            <a href="{{ route('user.profile') }}" class="bg-yellow-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-yellow-700 transition">
                Update Profile
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const leaveTypes = @json($leaveTypes);
        const takenDays = @json($takenDays);
        const remainingDays = @json($remainingDays);

        const ctx = document.getElementById('leaveTypesChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: leaveTypes.map(type => type.name),
                datasets: [
                    {
                        label: 'Days Taken',
                        data: takenDays,
                        backgroundColor: 'rgba(75, 192, 192, 0.3)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    },
                    {
                        label: 'Days Remaining',
                        data: remainingDays,
                        backgroundColor: 'rgba(255, 99, 132, 0.3)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                    }
                ],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        },
                    },
                },
            },
        });
    </script>
</x-app-layout>
