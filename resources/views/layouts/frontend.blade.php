<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="bg-white shadow-md" x-data="{ isOpen: false }">
            <nav class="container px-6 py-8 mx-auto md:flex md:justify-between md:items-center">
                <div class="flex items-center justify-between">
                    <a class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 md:text-2xl hover:text-green-400"
                    href="#">
                    TailFood
                    </a>
                    <!-- Mobile menu button -->
                    <div @click="isOpen = !isOpen" class="flex md:hidden">
                        <button type="button" class="text-gray-800 hover:text-gray-400 focus:outline-none focus:text-gray-400"
                            aria-label="toggle menu">
                            <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd"
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
                <div :class="isOpen ? 'flex' : 'hidden'"
                    class="flex-col mt-8 space-y-4 md:flex md:space-y-0 md:flex-row md:items-center md:space-x-10 md:mt-0">
                    {{-- <a class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400"
                    href="/">Home</a>
                    <a class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400"
                    href="{{ route('category.index') }}">Categories</a>
                    <a class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400"
                    href="{{ route('menu.index') }}">Our Menu</a>
                    <a class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400"
                    href="{{ route('reservation.stepone') }}">Make Reservation</a> --}}
                    <x-frontend-nav-link :href="route('frontent.index')" :active="request()->routeIs('frontent.index')">
                        {{ __('Home') }}
                    </x-frontend-nav-link>
                    <x-frontend-nav-link :href="route('category.index')" :active="request()->routeIs('category.index')">
                        {{ __('Categories') }}
                    </x-frontend-nav-link>
                    <x-frontend-nav-link :href="route('menu.index')" :active="request()->routeIs('menu.index')">
                        {{ __('Menus') }}
                    </x-frontend-nav-link>
                    <x-frontend-nav-link :href="route('reservation.stepone')" :active="request()->routeIs('reservation.stepone')">
                        {{ __('Make Reservation') }}
                    </x-frontend-nav-link>
                </div>
            </nav>
        </div>
        <div class="font-sans text-gray-900 antialiased min-h-screen">
            <div>
                @if (session()->has('danger'))
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                        role="alert">
                        <span class="font-medium">{{ session()->get('danger') }}!</span>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                        role="alert">
                        <span class="font-medium">{{ session()->get('success') }}!</span>
                    </div>
                @endif
                @if (session()->has('warning'))
                    <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
                        role="alert">
                        <span class="font-medium">{{ session()->get('warning') }}!</span>
                    </div>
                @endif
            </div>
            {{ $slot }}
        </div>
        <footer class="bg-gray-800 border-t border-gray-200">
            <div class="container flex flex-wrap items-center justify-center px-4 py-8 mx-auto lg:justify-between">
              <div class="flex flex-wrap justify-center">
                <ul class="flex items-center space-x-4 text-white">
                    <a href="/"><li>Home</li></a>
                    <a href="{{ route('category.index') }}"><li>Categories</li></a>
                    <a href="{{ route('menu.index') }}"><li>Our Menu</li></a>
                    <a href="{{ route('reservation.stepone') }}"><li>Make Reservation</li></a>
                </ul>
              </div>
            </div>
        </footer>
    </body>
</html>
