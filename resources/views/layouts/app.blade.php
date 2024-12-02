<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Domain Marketplace</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">

<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<link href="{{asset('css/dashboard.css')}}" rel="stylesheet" />

<link href="{{asset('css/fontawesome.min.css')}}" rel="stylesheet" />

<!-- Scripts -->

@vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">

<div class="min-h-screen bg-white dark:bg-gray-900">

@include('layouts.navigation')

<!-- Page Heading -->

@isset($header)

<header class="bg-white dark:bg-gray-800 shadow">

<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

{{ $header }}

</div>

</header>

@endisset

<!-- Page Content -->
<main>

{{ $slot }}

<div class='text-gray-800 dark:text-white border-t-2 border-gray-100 dark:border-gray-800 py-4 px-4'>

<h6 class="text-center text-sm">&copy; 2024 Domainer Marketplace. All rights reserved</h6>
    
</div>

</main>
</div>
</body>
</html>
