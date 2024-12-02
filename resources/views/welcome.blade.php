<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Leave Management System</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-styles.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Header Section -->
    <header class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-8">
        <div class="container mx-auto text-center">
            <h1 class="text-5xl font-extrabold">Welcome to the Leave Management System</h1>
            <p class="mt-4 text-xl font-medium">Manage your leave requests and track your time off effortlessly</p>
        </div>
    </header>

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="space-x-6 text-lg">
                @guest
                    <a href="{{ route('auth.login') }}" class="text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out">Login</a>
                    <a href="{{ route('auth.register') }}" class="text-gray-700 hover:text-blue-600 transition duration-300 ease-in-out">Register</a>
                @else
                    <a href="{{ route('auth.logout') }}" 
                       class="text-gray-700 hover:text-red-600 transition duration-300 ease-in-out"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <main class="container mx-auto text-center py-10">
        <section class="bg-white p-8 rounded-lg shadow-lg space-y-6">
            <h2 class="text-3xl font-semibold text-gray-800">About the System</h2>
            <p class="text-lg text-gray-600 leading-relaxed">
                The Leave Management System is designed to simplify the management of employee leaves for both admins and users. 
                With an intuitive interface, admins can easily manage leave requests, oversee employees, and handle various leave types. 
                Users can submit leave requests seamlessly and view their profile information in a user-friendly environment.
            </p>
            <p class="text-lg text-gray-600 leading-relaxed">
                Our goal is to enhance efficiency and ensure that leave management is a straightforward process for everyone involved.
            </p>
        </section>
    </main>

    <!-- Call to Action Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-blue-500 py-10 text-center text-white">
        <div class="container mx-auto">
            <h3 class="text-2xl font-semibold">Ready to get started?</h3>
            <p class="mt-2 text-lg">Login or Register to begin managing your leave requests!</p>
            <div class="mt-6">
                @guest
                    <a href="{{ route('auth.login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out">Login</a>
                    <a href="{{ route('auth.register') }}" class="ml-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out">Register</a>
                @else
                    <p class="text-lg mt-4">Welcome back, {{ Auth::user()->name }}!</p>
                @endguest
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white py-6 text-center">
        <p>&copy; {{ date('Y') }} Leave Management System. All rights reserved.</p>
    </footer>

</body>
</html>
