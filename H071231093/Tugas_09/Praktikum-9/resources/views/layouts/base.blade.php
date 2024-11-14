<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-indigo-600 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center" style="display: flex; justify-content:center;">
            <!-- Navigation Links -->
            <div class="space-x-4">
                <a href="{{ route('product.index') }}" class="text-white hover:text-gray-200">Products</a>
                <a href="{{ route('category.index') }}" class="text-white hover:text-gray-200">Categories</a>
                <a href="{{ route('inventorylog.index') }}" class="text-white hover:text-gray-200">Inventory Logs</a>
            </div>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="container mx-auto p-6">
        @yield('content')
    </div>

</body>
</html>