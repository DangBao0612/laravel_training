<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js, resources/scss/light-bootstrap-dashboard.scss'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

        <!-- Lang Switcher -->
        <div class="w-full max-w-7xl flex justify-end pr-8 mt-4">
            @php($cur = app()->getLocale())
            <div class="inline-flex rounded-md overflow-hidden border shadow-sm">
                <a href="{{ route('lang.switch', 'en') }}"
                   class="w-20 text-center py-2 text-sm font-semibold transition
                          {{ $cur === 'en'
                              ? 'bg-white text-gray-900'
                              : 'bg-indigo-900 text-white hover:bg-indigo-800' }}">
                    EN
                </a>
                <a href="{{ route('lang.switch', 'vi') }}"
                   class="w-20 text-center py-2 text-sm font-semibold transition
                          {{ $cur === 'vi'
                              ? 'bg-white text-gray-900'
                              : 'bg-indigo-900 text-white hover:bg-indigo-800' }}">
                    VI
                </a>
            </div>
        </div>

        <!-- Logo -->
        <div class="mt-6">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
            </a>
        </div>

        <!-- Form container -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800
                    shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
