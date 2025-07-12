<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Siloker') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .auth-background {
            background-image: url('https://source.unsplash.com/random/1600x900/?office,workspace,city');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .auth-background::after {
            content: '';
            position: absolute;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="auth-background min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">



        <!-- Login/Register Form -->
        <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-lg overflow-hidden sm:rounded-lg border border-gray-200 z-10">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
