<x-guest-layout>

    <div class="text-center mb-4">
        <h3 class="h4 text-dark">{{ __('পাসওয়ার্ড পুনরুদ্ধার') }}</h3>
        <p class="text-muted small">
            {{ __('পাসওয়ার্ড ভুলে গেছেন? কোনো সমস্যা নেই। আপনার নিবন্ধিত ইমেইল ঠিকানাটি দিন, আমরা সেখানে পাসওয়ার্ড রিসেট করার একটি লিংক পাঠিয়ে দেব।') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-3 alert alert-success" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('ইমেইল') }}</label>
            <input id="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required autofocus 
                   placeholder="name@example.com">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary btn-lg">
                {{ __('রিসেট লিংক পাঠান') }}
            </button>
        </div>

        <!-- Back to Login Link -->
        <div class="text-center mt-3 text-muted small">
            <a href="{{ route('login') }}" class="text-decoration-none text-primary">
                &larr; {{ __('লগইন পেজে ফিরে যান') }}
            </a>
        </div>
    </form>

</x-guest-layout>