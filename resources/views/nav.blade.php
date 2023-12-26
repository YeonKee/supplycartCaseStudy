<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body>
    {{-- Header --}}
    <nav class="bg-navigation">
        <div class="flex items-center justify-content h-16">
            <div class="flex">
                <a href="/users/loginPage" class="text-white px-3 py-2 mx-2 rounded-md text-sm font-medium hover:bg-gray-700">Login</a>
                <a href="/users/registerPage" class="text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Register</a>
            </div>
        </div>
    </nav>
    @include('sweetalert::alert')
    @yield('body')
</body>

</html>
