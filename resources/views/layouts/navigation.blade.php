<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm border-bottom">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            {{ config('app.name', 'OfficeKormi') }}
        </a>

        <!-- Hamburger Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar (Primary Links) -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    {{-- x-nav-link কম্পোনেন্টটি পরে Bootstrap স্টাইলে আপডেট করে নিয়েন, আপাতত সাধারণ<a> ট্যাগ দিয়ে বুটস্ট্রাপ ক্লাস দিলাম --}}
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        {{ __('Dashboard') }}
                    </a>
                </li>
                
                <!-- এখানে ভবিষ্যতে Document, File, Dak এর মেনু আইটেমগুলো যোগ হবে -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="documentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Documents
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="documentDropdown">
                        <li><a class="dropdown-item" href="#">Templates</a></li>
                        <li><a class="dropdown-item" href="#">Generate New</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Right Side Of Navbar (User Settings) -->
            <ul class="navbar-nav ms-auto align-items-md-center">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="navbarDropdown">
                        <h6 class="dropdown-header small text-muted">
                            {{ Auth::user()->email }}
                        </h6>
                        
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-cog fa-sm fa-fw me-2 text-gray-400"></i> {{ __('Profile') }}
                        </a>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>