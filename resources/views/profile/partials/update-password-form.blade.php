<section>
    <header class="mb-4">
        <h4 class="h5 fw-bold text-dark mb-1">
            {{ __('পাসওয়ার্ড পরিবর্তন করুন') }}
        </h4>
        <p class="text-muted small mb-0">
            {{ __('নিরাপত্তা বজায় রাখতে আপনার অ্যাকাউন্টে একটি দীর্ঘ এবং জটিল পাসওয়ার্ড ব্যবহার করুন।') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">{{ __('বর্তমান পাসওয়ার্ড') }}</label>
            <div class="input-group">
                <input id="update_password_current_password" 
                       name="current_password" 
                       type="password" 
                       class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                       autocomplete="current-password"
                       placeholder="••••••••">
                <button class="btn btn-outline-secondary toggle-password-btn" type="button" data-target="update_password_current_password" style="border-color: #ced4da;">
                    <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                    </svg>
                    <svg class="eye-closed d-none" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                        <path d="M11.297 9.127a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                        <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
                    </svg>
                </button>
                @error('current_password', 'updatePassword')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- New Password -->
        <div class="mb-3">
            <label for="update_password_password" class="form-label">{{ __('নতুন পাসওয়ার্ড') }}</label>
            <div class="input-group">
                <input id="update_password_password" 
                       name="password" 
                       type="password" 
                       class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                       autocomplete="new-password"
                       placeholder="••••••••">
                <button class="btn btn-outline-secondary toggle-password-btn" type="button" data-target="update_password_password" style="border-color: #ced4da;">
                    <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                    </svg>
                    <svg class="eye-closed d-none" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                        <path d="M11.297 9.127a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                        <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
                    </svg>
                </button>
                @error('password', 'updatePassword')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">{{ __('কনফার্ম পাসওয়ার্ড') }}</label>
            <div class="input-group">
                <input id="update_password_password_confirmation" 
                       name="password_confirmation" 
                       type="password" 
                       class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                       autocomplete="new-password"
                       placeholder="••••••••">
                <button class="btn btn-outline-secondary toggle-password-btn" type="button" data-target="update_password_password_confirmation" style="border-color: #ced4da;">
                    <svg class="eye-open" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                    </svg>
                    <svg class="eye-closed d-none" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                        <path d="M11.297 9.127a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                        <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
                    </svg>
                </button>
                @error('password_confirmation', 'updatePassword')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Submit Button & Saved Status -->
        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary px-4">
                {{ __('সংরক্ষণ করুন') }}
            </button>

            @if (session('status') === 'password-updated')
                <div id="password-saved-alert" class="text-success small fw-medium d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                    </svg>
                    {{ __('পাসওয়ার্ড সফলভাবে সংরক্ষিত হয়েছে!') }}
                </div>
                <!-- অটো-হাইড স্ক্রিপ্ট -->
                <script>
                    setTimeout(() => {
                        const alertBox = document.getElementById('password-saved-alert');
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

    <!-- ৩টি পাসওয়ার্ড ফিল্ডের জন্যই টগল স্ক্রিপ্ট -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.toggle-password-btn').forEach(function (button) {
                button.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');
                    const targetInput = document.getElementById(targetId);
                    const eyeOpen = this.querySelector('.eye-open');
                    const eyeClosed = this.querySelector('.eye-closed');

                    if (targetInput) {
                        const isPassword = targetInput.getAttribute('type') === 'password';
                        targetInput.setAttribute('type', isPassword ? 'text' : 'password');
                        
                        eyeOpen.classList.toggle('d-none');
                        eyeClosed.classList.toggle('d-none');
                    }
                });
            });
        });
    </script>
</section>