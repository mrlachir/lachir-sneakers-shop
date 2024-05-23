<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ Storage::url('Sneaker-favicon.png') }}" type="image/x-icon">

    <title>LACHIR</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    

    <!-- Scripts -->
    <style>
        *{
            /* font-family: sans-serif; */
        }
        main {
            margin: 0;
            background-color: #fff;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen ">
        {{-- @include('layouts.navigation') --}}
        {{-- @include('layouts.sidebarmenu') --}}


        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow flex items-center justify-center">
            <div class="max-w-7xl mx-auto pt-10 px-4 sm:px-6 lg:px-8 text-center text-4xl">
                {{ $header }}
            </div>
        </header>
        
        @endif

        <!-- Page Content -->
        <main >
            {{ $slot }}
        </main>

    </div>
    @stack('scripts')
</body>

</html> 

