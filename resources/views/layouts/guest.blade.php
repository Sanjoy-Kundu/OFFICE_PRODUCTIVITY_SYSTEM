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
    <body class="bg-light font-sans antialiased">
        
        <!-- Center alignment using Bootstrap Flexbox classes -->
        <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center pt-5 pt-sm-0">
            
            {{-- 
               ==========================================================
               মূল পরিবর্তন এখানে:
               লোগোর এই পুরো ব্লকটি ( <div class="mb-4"> ... </div> ) 
               মুছে ফেলা হয়েছে অথবা কমেন্ট আউট করা হয়েছে।
               ফলে এখন সরাসরি লগইন কার্ডটি পেজের মাঝখানে দেখাবে।
               ==========================================================
            --}}

            <!-- Content Card -->
            <div class="w-100" style="max-width: 400px;">
                <div class="card shadow-sm border-0 rounded-lg p-4">
                    {{ $slot }}
                </div>
            </div>
        </div>

    </body>
</html>