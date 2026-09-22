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

        <!-- Scripts & Styles (Bootstrap 5 via app.css) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-light">
        
        <!-- Bootstrap Navigation Bar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <x-application-logo width="36" height="36" class="d-inline-block align-text-top" />
                </a>
                
                <!-- Hamburger Menu for Mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                {{ __('Dashboard') }}
                            </a>
                        </li>
                        <!-- ভবিষ্যতে এখানে অন্যান্য মেনু আইটেম যোগ হবে -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    {{ __('Profile') }}
                                </a>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-sm mb-4">
                <div class="container py-3">
                    <h2 class="h4 mb-0 text-gray-800">
                        {{ $header }}
                    </h2>
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="container pb-5">
            {{ $slot }}
        </main>

        <!-- Bootstrap JS is already imported in resources/js/app.js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
    </body>
</html>