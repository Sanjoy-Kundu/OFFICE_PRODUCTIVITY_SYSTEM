<x-guest-layout>

    <div class="text-center mb-4">
        <h3 class="h4 text-dark">{{ __('ইমেইল যাচাইকরণ') }}</h3>
        <p class="text-muted small">
            {{ __('নিবন্ধন করার জন্য ধন্যবাদ! ব্যবহারের পূর্বে, আমরা আপনার ইমেইলে যে ভেরিফিকেশন লিঙ্কটি পাঠিয়েছি সেটিতে ক্লিক করে অনুগ্রহ করে ইমেইল ঠিকানাটি নিশ্চিত করুন। ইমেইলটি না পেয়ে থাকলে আমরা পুনরায় লিঙ্ক পাঠাতে পারি।') }}
        </p>
    </div>

    <!-- Session Status / Alert -->
    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success small mb-4 text-center" role="alert">
            {{ __('নিবন্ধনের সময় আপনার প্রদান করা ইমেইল ঠিকানায় একটি নতুন যাচাইকরণ লিঙ্ক পাঠানো হয়েছে।') }}
        </div>
    @endif

    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mt-4">
        <!-- Resend Verification Email Form -->
        <form method="POST" action="{{ route('verification.send') }}" class="w-100 w-sm-auto">
            @csrf
            <button type="submit" class="btn btn-primary w-100">
                {{ __('পুনরায় লিঙ্ক পাঠান') }}
            </button>
        </form>

        <!-- Logout Form -->
        <form method="POST" action="{{ route('logout') }}" class="mt-2 mt-sm-0">
            @csrf
            <button type="submit" class="btn btn-link text-decoration-none text-muted small p-0">
                {{ __('লগআউট করুন') }}
            </button>
        </form>
    </div>

</x-guest-layout>