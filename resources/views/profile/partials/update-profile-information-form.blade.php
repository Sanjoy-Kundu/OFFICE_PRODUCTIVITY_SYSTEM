<section>
    <header class="mb-4">
        <h4 class="h5 fw-bold text-dark mb-1">
            {{ __('প্রোফাইল তথ্য') }}
        </h4>
        <p class="text-muted small mb-0">
            {{ __('আপনার অ্যাকাউন্টের প্রোফাইল তথ্য এবং ইমেইল ঠিকানা আপডেট করুন।') }}
        </p>
    </header>

    <!-- Separate Verification Form -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Profile Update Form -->
    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('নাম') }}</label>
            <input id="name" name="name" type="text" 
                   class="form-control @error('name') is-invalid @enderror" 
                   value="{{ old('name', $user->name) }}" 
                   required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('ইমেইল') }}</label>
            <input id="email" name="email" type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   value="{{ old('email', $user->email) }}" 
                   required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <!-- Email Verification Notice -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning p-3 mt-3 small rounded-3" role="alert">
                    <div class="d-flex align-items-center mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2 flex-shrink-0" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                        <span>{{ __('আপনার ইমেইল ঠিকানাটি এখনও যাচাই করা হয়নি।') }}</span>
                    </div>

                    <button form="send-verification" type="submit" class="btn btn-link p-0 align-baseline text-decoration-underline text-dark small fw-semibold">
                        {{ __('যাচাইকরণ লিংক পুনরায় পাঠাতে এখানে ক্লিক করুন।') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <div class="text-success fw-medium mt-2">
                            {{ __('আপনার ইমেইলে একটি নতুন যাচাইকরণ লিংক পাঠানো হয়েছে।') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Submit Button & Saved Status -->
        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary px-4">
                {{ __('সংরক্ষণ করুন') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div id="saved-alert" class="text-success small fw-medium d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                    </svg>
                    {{ __('সফলভাবে সংরক্ষিত হয়েছে!') }}
                </div>
                <!-- অটো-হাইড করার স্ক্রিপ্ট (AlpineJS এর ওপর নির্ভরতা ছাড়াই) -->
                <script>
                    setTimeout(() => {
                        const alertBox = document.getElementById('saved-alert');
                        if (alertBox) {
                            alertBox.style.transition = 'opacity 0.5s ease';
                            alertBox.style.opacity = '0';
                            setTimeout(() => alertBox.remove(), 500);
                        }
                    }, 2500);
                </script>
            @endif
        </div>
    </form>
</section>