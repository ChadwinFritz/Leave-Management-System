<x-app-layout>

    <!-- Navigation Bar -->
    <x-superadmin.nav />

    <x-slot name="title">
        Manage Admins
    </x-slot>

    <div class="container mx-auto py-6 px-4">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-gray-900">Manage Admins</h1>
            <a href="{{ route('superadmin.create.admin') }}" class="bg-green-500 text-white px-4 py-2 rounded-md shadow hover:bg-green-600 transition">
                Add New Admin
            </a>
        </div>

        <!-- Admins Management Table -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-6 p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($admins as $admin)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $admin->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $admin->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('superadmin.edit.admin', $admin->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                <form action="{{ route('superadmin.delete.admin', $admin->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE') <!-- Add this line for DELETE method -->
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- End Admins Management Table -->
    </div>
</x-app-layout>
