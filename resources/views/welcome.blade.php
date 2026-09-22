<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'OfficeKormi') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles (Bootstrap 5 loaded via vite) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Figtree', sans-serif;
                background-color: #f8f9fa;
                height: 100vh;
                display: flex;
                flex-direction: column;
            }
            .main-hero {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 2rem;
            }
            .hero-content {
                max-width: 600px;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                padding: 3rem;
                border-radius: 20px;
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            }
            .hero-content h1 {
                font-weight: 700;
                font-size: 3.5rem;
                margin-bottom: 1rem;
            }
            .hero-content p {
                font-size: 1.25rem;
                margin-bottom: 2rem;
                opacity: 0.9;
            }
            .btn-custom-login {
                padding: 0.75rem 2rem;
                font-weight: 600;
                border-radius: 50px;
                transition:all 0.3s;
            }
            .btn-custom-login:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            }
            .footer {
                padding: 1rem;
                text-align: center;
                background-color: white;
                border-top: 1px solid #eaeaea;
            }
        </style>
    </head>
    <body>

        <!-- Hero Section -->
        <div class="main-hero">
            <div class="hero-content">
                <h1>দাপ্তরি</h1> <!-- Project Name in Bengali -->
                <p>আপনার দৈনন্দিন অফিসিয়াল কাজগুলোকে আরও দ্রুত, সহজ এবং সুশৃঙ্খল করতে আমাদের সহায়তা নিন।</p>
                
                @if (Route::has('login'))
                    <div class="mt-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-light btn-lg btn-custom-login shadow">ড্যাশবোর্ডে যান</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg btn-custom-login me-3">লগইন করুন</a>

                            {{-- যদি ওপেন সোর্সে পাবলিক রেজিস্ট্রেশন রাখতে চান, তবে এটি uncomment করুন --}}
                            {{-- @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-light btn-lg btn-custom-login">রেজিস্ট্রেশন</a>
                            @endif --}}
                        @endauth
                    </div>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <span class="text-muted">
                    &copy; {{ date('Y') }} {{ config('app.name', 'OfficeKormi') }}. Open Source Project.
                </span>
            </div>
        </footer>

    </body>
</html>