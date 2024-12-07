<x-app-layout>
    <x-user.nav />

    <!-- Header Section -->
    <header class="bg-gradient-to-r from-blue-500 to-indigo-600 text-black py-8">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-extrabold">Welcome, {{ Auth::user()->name }}</h1>
            <p class="mt-4 text-xl font-medium">Here is an overview of your leave information</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <div class="container mx-auto px-6 py-8">
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
    </div>

    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white py-6 text-center">
        <p>&copy; {{ date('Y') }} Leave Management System. All rights reserved.</p>
    </footer>

    <!-- Chart.js Script -->
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
