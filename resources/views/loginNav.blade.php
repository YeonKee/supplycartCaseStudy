<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/288dd6b8ec.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
</head>

<body>
    {{-- Header --}}
    <nav class="bg-navigation">
        <div class="flex items-center justify-between h-16">
            <div class="flex">
                <a href="/products/index" class="text-white px-3 py-2 mx-2 rounded-md text-sm font-medium hover:bg-gray-700">Products</a>
                <a href="/users/orders/cart" class="text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Cart</a>
                <a href="/users/orders/index" class="text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Orders</a>
                <a href="/users/logs/index" class="text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Logs</a>
                <a href="/users/logout" class="text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Logout</a>
            </div>
            <div class="flex justify-end pr-5">
                <p class="text-white font-bold">Welcome, {{ session('userName') }} ( {{ session('userRank') }} )</p>
            </div>
        </div>
    </nav>
    @include('sweetalert::alert')
    @yield('body')
</body>

</html>
