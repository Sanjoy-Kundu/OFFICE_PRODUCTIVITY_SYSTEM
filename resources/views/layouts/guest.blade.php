<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Google Fonts (ঐচ্ছিক) -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center py-4 px-3">
            <!-- App Logo -->
            <div class="mb-3">
                <a href="/">
                    <x-application-logo width="55" height="55" />
                </a>
            </div>

            <!-- Login / Auth Card Box -->
            <div class="card shadow-sm border-0 w-100" style="max-width: 430px; border-radius: 12px;">
                <div class="card-body p-4 p-sm-5">
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer (ঐচ্ছিক) -->
            <div class="text-center mt-4 text-muted small">
                &copy; {{ date('Y') }} {{ config('app.name', 'OfficeKormi') }}. সর্বস্বত্ব সংরক্ষিত।
            </div>
        </div>

        <!-- Bootstrap 5 JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>