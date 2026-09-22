<section>
    <header class="mb-3">
        <h4 class="h5 fw-bold text-danger mb-1">
            {{ __('অ্যাকাউন্ট মুছে ফেলুন') }}
        </h4>
        <p class="text-muted small mb-0">
            {{ __('একবার আপনার অ্যাকাউন্ট মুছে ফেলা হলে, এর সমস্ত তথ্য স্থায়ীভাবে মুছে যাবে। অ্যাকাউন্ট মুছে ফেলার আগে আপনার প্রয়োজনীয় ডেটা বা তথ্য ডাউনলোড করে সংরক্ষণ করুন।') }}
        </p>
    </header>

    <!-- Trigger Button -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        {{ __('অ্যাকাউন্ট মুছুন') }}
    </button>

    <!-- Bootstrap 5 Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold text-dark" id="confirmUserDeletionModalLabel">
                            {{ __('আপনি কি নিশ্চিত যে অ্যাকাউন্টটি মুছে ফেলতে চান?') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-3">
                        <p class="text-muted small mb-3">
                            {{ __('অ্যাকাউন্টটি মুছে ফেলা হলে সমস্ত তথ্য স্থায়ীভাবে মুছে যাবে। আপনি নিশ্চিত কি না তা যাচাই করার জন্য অনুগ্রহ করে আপনার পাসওয়ার্ডটি লিখুন।') }}
                        </p>

                        <!-- Password Input with Toggle -->
                        <div class="mb-3">
                            <label for="delete_account_password" class="form-label small fw-semibold text-secondary">{{ __('পাসওয়ার্ড') }}</label>
                            <div class="input-group">
                                <input id="delete_account_password" 
                                       name="password" 
                                       type="password" 
                                       class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                                       placeholder="{{ __('আপনার পাসওয়ার্ড লিখুন') }}">
                                <button class="btn btn-outline-secondary toggle-password-btn" type="button" data-target="delete_account_password" style="border-color: #ced4da;">
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
                                @error('password', 'userDeletion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('বাতিল') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            {{ __('অ্যাকাউন্ট মুছে ফেলুন') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- স্ক্রিপ্ট: পাসওয়ার্ড শো/হাইড ও এরর হলে মোডাল স্বয়ংক্রিয়ভাবে ওপেন রাখা -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // পাসওয়ার্ড টগল
            const toggleBtn = document.querySelector('.toggle-password-btn[data-target="delete_account_password"]');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    const input = document.getElementById('delete_account_password');
                    const eyeOpen = this.querySelector('.eye-open');
                    const eyeClosed = this.querySelector('.eye-closed');

                    if (input) {
                        const isPassword = input.getAttribute('type') === 'password';
                        input.setAttribute('type', isPassword ? 'text' : 'password');
                        eyeOpen.classList.toggle('d-none');
                        eyeClosed.classList.toggle('d-none');
                    }
                });
            }

            // পাসওয়ার্ড ভুল হলে পেজ রিলোডে মোডাল ওপেন রাখা
            @if ($errors->userDeletion->isNotEmpty())
                const deleteModalEl = document.getElementById('confirmUserDeletionModal');
                if (deleteModalEl && typeof bootstrap !== 'undefined') {
                    const deleteModal = new bootstrap.Modal(deleteModalEl);
                    deleteModal.show();
                }
            @endif
        });
    </script>
</section>