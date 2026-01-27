<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans antialiased bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page Heading (kalau ada header dari controller) -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Main Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 dark:bg-black text-gray-300 py-8 mt-auto">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p class="text-lg">&copy; {{ date('Y') }} CV Luwes. All rights reserved.</p>
                <p class="mt-2 text-sm">Dibuat dengan ❤️ oleh badbr0 🥷</p>
            </div>
        </footer>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Dark Mode Toggle (opsional, bisa dipindah ke navbar kalau mau) -->
    <button id="dark-toggle"
        class="fixed bottom-6 right-6 z-50 p-3 rounded-full bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition shadow-lg">
        <svg class="w-6 h-6 sun-icon text-gray-800 dark:text-gray-200" fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M17.293 13.293A1 1 0 0116.707 13.293l-5.293-5.293a1 1 0 111.414-1.414L17.707 11.586l4.293-4.293a1 1 0 111.414 1.414l-5 5a1 1 0 01-1.414 0z" />
        </svg>
        <svg class="w-6 h-6 moon-icon hidden text-gray-800 dark:text-gray-200" fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm11.161 11.161a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 111.414-1.414l.707.707z" />
        </svg>
    </button>
</body>

</html>
