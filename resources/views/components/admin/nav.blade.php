<!-- resources/views/components/admin/nav.blade.php -->
<nav class="bg-blue-600 p-4 shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo/Brand -->
        <div>
            <a href="{{ route('admin.dashboard') }}" class="text-black text-2xl font-bold">
                Admin
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex space-x-4">
            <!-- Dashboard Link -->
            <a href="{{ route('admin.dashboard') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('admin.dashboard') ? 'font-semibold' : '' }}">
                Dashboard
            </a>

            <!-- Department Report -->
            <a href="{{ route('admin.department.report') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('admin.department.report') ? 'font-semibold' : '' }}">
                Department Report
            </a>

            <!-- Manage Users -->
            <a href="{{ route('admin.manage.users') }}" 
            class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
            {{ request()->routeIs('admin.manage.users') ? 'font-semibold' : '' }}">
                Manage Users
            </a>

            <!-- Pending Users -->
            <a href="{{ route('admin.pending.users') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('users.pending') ? 'font-semibold' : '' }}">
                Pending Users
            </a>

            <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>
