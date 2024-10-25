<nav class="bg-blue-600 p-4 shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo/Brand -->
        <div>
            <a href="{{ route('superadmin.dashboard') }}" class="text-black text-2xl font-bold">
                Super Admin Dashboard
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex space-x-4">
            <!-- Super Admin Dashboard Link -->
            <a href="{{ route('superadmin.dashboard') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('superadmin.dashboard') ? 'font-semibold' : '' }}">
                Dashboard
            </a>

            <!-- Manage Admins Link -->
            <a href="{{ route('superadmin.manage.admins') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('superadmin.manage.admins') ? 'font-semibold' : '' }}">
                Manage Admins
            </a>

            <!-- Create Admin Link -->
            <a href="{{ route('superadmin.create.admin') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('superadmin.create.admin') ? 'font-semibold' : '' }}">
                Create Admin
            </a>

            <!-- System Settings Link -->
            <a href="{{ route('superadmin.system.settings') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('superadmin.system.settings') ? 'font-semibold' : '' }}">
                System Settings
            </a>

            <!-- Audit Logs Link -->
            <a href="{{ route('superadmin.audit.logs') }}" 
               class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded 
               {{ request()->routeIs('superadmin.audit.logs') ? 'font-semibold' : '' }}">
                Audit Logs
            </a>

            <!-- Logout Button -->
            <form action="{{ route('superadmin.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-gray-500 text-white hover:bg-gray-600 flex items-center px-4 py-2 rounded">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>
