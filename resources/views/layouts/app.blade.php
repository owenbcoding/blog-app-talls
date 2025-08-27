<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav class="bg-gray-800">
        <div class="container mx-auto flex flex-wrap items-center justify-between p-4">
            <a class="text-white text-xl font-semibold" href="{{ route('home') }}">Blog-app</a>
            <div class="space-x-4">
                <a class="text-gray-300 hover:text-white" href="{{ route('home') }}">Blog</a>
                <a class="text-gray-300 hover:text-white" href="{{ route('about') }}">About</a>
                <a class="text-gray-300 hover:text-white" href="{{ route('contact') }}">Contact</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="py-5 bg-gray-800">
        <div class="container mx-auto">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
</body>

</html>