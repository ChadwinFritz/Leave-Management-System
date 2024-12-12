<nav class="bg-blue-600 p-4 shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo/Brand -->
        <div>
            <a href="{{ route('supervisor.dashboard') }}" class="text-black text-2xl font-bold">
                Supervisor
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex space-x-4">
            <!-- Supervisor Dashboard Link -->
            <a href="{{ route('supervisor.dashboard') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('supervisor.dashboard') ? 'font-semibold' : '' }}">
                Dashboard
            </a>

            <!-- Team Report Link -->
            <a href="{{ route('supervisor.team_report') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('supervisor.team_report') ? 'font-semibold' : '' }}">
                Team Reports
            </a>

            <!-- Approve Leave Link -->
            <a href="{{ route('supervisor.approve_leave') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('supervisor.approve_leave') ? 'font-semibold' : '' }}">
                Approve Leave
            </a>

            <!-- Assign Tasks Link -->
            <a href="{{ route('supervisor.assign_tasks') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('supervisor.assign_tasks') ? 'font-semibold' : '' }}">
                Assign Tasks
            </a>

            <!-- Escalation Requests Link -->
            <a href="{{ route('supervisor.escalation_requests') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('supervisor.escalation_requests') ? 'font-semibold' : '' }}">
                Escalation Requests
            </a>

            <!-- Logout Button -->
            <form action="{{ route('supervisor.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>
