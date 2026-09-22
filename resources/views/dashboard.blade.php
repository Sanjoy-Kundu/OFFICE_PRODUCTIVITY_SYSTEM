<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 fw-bold text-dark mb-0">
                {{ __('ড্যাশবোর্ড') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <!-- Welcome Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">
                                {{ __('স্বাগতম, :name!', ['name' => Auth::user()->name]) }}
                            </h5>
                            <p class="text-muted mb-0">
                                {{ __('আপনি সফলভাবে আপনার অ্যাকাউন্টে লগইন করেছেন!') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Optional: Quick Summary Cards (প্রয়োজনে ব্যবহারের জন্য ডেমো কার্ড) -->
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body p-3">
                            <span class="text-muted small">{{ __('মোট তথ্য') }}</span>
                            <h4 class="fw-bold mt-2 mb-0">০</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body p-3">
                            <span class="text-muted small">{{ __('চলমান কার্যক্রম') }}</span>
                            <h4 class="fw-bold mt-2 mb-0">০</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body p-3">
                            <span class="text-muted small">{{ __('সম্পন্ন কাজ') }}</span>
                            <h4 class="fw-bold mt-2 mb-0">০</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>