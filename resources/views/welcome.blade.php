<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Leave Management System</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-styles.css') }}"> <!-- Example -->
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <header class="text-center py-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
        <h1 class="text-5xl font-extrabold">Welcome to the Leave Management System</h1>
    </header>

    <nav class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="space-x-4">
                <a href="{{ route('auth.login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                <a href="{{ route('auth.register.create') }}" class="text-gray-700 hover:text-blue-600">Register</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto text-center my-10">

        <section class="p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-3xl font-semibold text-gray-800">About the System</h2>
            <p class="mt-4 text-gray-600 leading-relaxed">The Leave Management System is designed to simplify the management of employee leaves for both admins and users. With an intuitive interface, admins can easily manage leave requests, oversee employees, and handle various leave types. Users can submit leave requests seamlessly and view their profile information in a user-friendly environment.</p>
            <p class="mt-2 text-gray-600 leading-relaxed">Our goal is to enhance efficiency and ensure that leave management is a straightforward process for everyone involved.</p>
        </section>
    </div>

    <footer class="text-center py-4 bg-gray-800 text-white">
        <p>&copy; {{ date('Y') }} Leave Management System. All rights reserved.</p>
    </footer>
    
</body>
</html>
