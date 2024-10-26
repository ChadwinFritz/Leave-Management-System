<nav class="bg-blue-600 p-4 shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo/Brand -->
        <div>
            <a href="{{ route('user.dashboard') }}" class="text-black text-2xl font-bold">
                Employee
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex space-x-4">
            <!-- User Dashboard Link -->
            <a href="{{ route('user.dashboard') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('user.dashboard') ? 'font-semibold' : '' }}">
                Dashboard
            </a>

            <!-- User Profile Link -->
            <a href="{{ route('user.profile') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('user.profile') ? 'font-semibold' : '' }}">
                Profile
            </a>

            <!-- Leave History Link -->
            <a href="{{ route('user.leave.history') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('user.leave.history') ? 'font-semibold' : '' }}">
                Leave History
            </a>

            <!-- Leave Application Link -->
            <a href="{{ route('user.leave.application') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('user.leave.application') ? 'font-semibold' : '' }}">
                Apply for Leave
            </a>

            <!-- Logout Button -->
            <form action="{{ route('user.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-gray-500 text-black hover:bg-gray-600 flex items-center px-4 py-2 rounded">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>
