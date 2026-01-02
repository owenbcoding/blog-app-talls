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
        <div class="container mx-auto flex flex-wrap items-center justify-between p-4 max-w-7xl">
            <a class="text-white text-xl font-semibold" href="{{ route('home') }}">Blog-app</a>
            <div class="space-x-4">
                <a class="text-gray-300 hover:text-white" href="{{ route('home') }}">Blog</a>
                <a class="text-gray-300 hover:text-white" href="{{ route('about') }}">About</a>
                <a class="text-gray-300 hover:text-white" href="{{ route('contact') }}">Contact</a>
            </div>
        </div>
    </nav>
    
    <header class="py-5 bg-gray-100 border-b mb-4 h-60">
        <div class="container mx-auto text-center mt-16">
            <h1 class="text-3xl font-bold">A Personal Blog Site</h1>
            <p class="text-lg text-gray-700 mb-0">Blog app carousel.</p>
        </div>
    </header>
    <main>
        @yield('content')
    </main>

    <footer class="py-5 bg-gray-800 mt-10">
        <div class="container mx-auto">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
</body>
</html>