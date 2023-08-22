<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <header class="h-20 flex justify-between px-28 items-center bg-[#3B82F6]">
        <div>
            <h2 class="text-2xl font-semibold text-white">
                <a href="{{ url('/') }}">ContentFlowHub</a>
            </h2>
        </div>
        <nav>
            <ul class="flex">
                <li class="mx-3">
                    <a href="{{ route('about-me') }}" class="text-white text-lg ">About Me</a>
                </li>
                @if (Auth::user())
                <li class="mx-3">
                    <a href="{{ route('dashboard') }}" class="text-white text-lg ">Dashboard</a>
                </li>
                @else
                <li class="mx-3">
                    <a href="{{ route('register') }}" class=" text-base text-blach rounded-lg bg-white px-6 py-2 ">Register</a>
                </li>
                <li class="mx-3">
                    <a href="{{ route('login') }}" class=" text-base text-blach rounded-lg bg-white px-6 py-2 ">Login</a>
                </li>
                @endif
            </ul>
        </nav>
    </header>
    <div class="flex px-28 py-8">
        {{ $slot }}
    </div>
    <footer class="bg-gray-900 h-28">

    </footer>
</body>

</html>