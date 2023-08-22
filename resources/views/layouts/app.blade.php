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
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
</head>

<body class="font-['Poppins'] antialiased">
    <div class="min-h-screen bg-gray-100 flex">
        @include('layouts.sidemenu')
        <main class="w-full lg:w-4/5 bg-white p-8">
            <div class="flex items-center justify-end mb-4" x-data="{ open : false }">
                <div class="mr-3 flex flex-col items-end">
                    <p>{{ Auth::user()->name }}</p>
                    <p class="text-sm">Setting</p>
                </div>
                <div class="rounded-full bg-slate-600 w-10 h-10" @click="open = !open">

                </div>
                <div class="absolute top-20 bg-white rounded-md px-6 py-2 drop-shadow-md" :class="{'hidden' : !open}">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-xs">Logout</button>
                    </form>
                </div>
            </div>
            {{ $slot }}
        </main>
    </div>
</body>

</html>