@extends('layouts.app')

@section('header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <div class="d-flex align-items-center gap-2">
                <span class="govt-emblem-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.464 9.99a11.8 11.8 0 0 0 4.04 3.19c.14.07.28.13.42.18.04.02.08.03.12.04.05.02.1.03.15.04l.03.01.03-.01c.05-.01.1-.02.15-.04.04-.01.08-.02.12-.04.14-.05.28-.11.42-.18a11.8 11.8 0 0 0 4.04-3.19c1.677-2.195 3.06-5.513 2.464-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0"/>
                    </svg>
                </span>
                <h2 class="h4 fw-bold text-govt-dark mb-0">{{ __('দাপ্তরিক ডিজিটাল ড্যাশবোর্ড') }}</h2>
            </div>
            <small class="text-muted ps-4">{{ __('অফিসকর্মী: স্বয়ংক্রিয় দাপ্তরিক ও নথি ব্যবস্থাপনা সিস্টেম') }}</small>
        </div>
        <div class="text-end">
            <span class="badge govt-status-pill px-3 py-2 rounded-pill shadow-xs">
                {{ date('d M, Y') }} | {{ __('দাপ্তরিক পোর্টালে সংযুক্ত') }}
            </span>
        </div>
    </div>
@endsection

@section('content')

    <!-- ড্যাশবোর্ড কনটেইনার -->
    <div class="govt-dashboard-wrapper">
        
        <!-- Welcome Banner Card -->
        <div class="card govt-welcome-card border-0 mb-4 rounded-3 shadow-sm overflow-hidden">
            <div class="card-body p-4 position-relative">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <div class="govt-avatar-box rounded-circle d-flex align-items-center justify-content-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h5 class="fw-bold text-govt-dark mb-1">
                            {{ __('স্বাগতম, :name!', ['name' => Auth::user()->name]) }}
                        </h5>
                        <p class="text-muted mb-0 small">
                            {{ __('আপনার দৈনন্দিন দাপ্তরিক চিঠিপত্র, নথি ট্র্যাকিং ও কার্যক্রম সম্পন্ন করতে নিচের মডিউলগুলো ব্যবহার করুন।') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Summary Stat Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card govt-stat-card border-0 rounded-3 shadow-sm h-100">
                    <div class="card-body p-3 border-start border-4 border-govt-primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted small fw-semibold">{{ __('আজকের আগত ডাক') }}</span>
                                <h3 class="fw-bold text-govt-primary mt-1 mb-0">০</h3>
                            </div>
                            <span class="stat-icon-wrap bg-govt-light text-govt-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card govt-stat-card border-0 rounded-3 shadow-sm h-100">
                    <div class="card-body p-3 border-start border-4 border-warning">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted small fw-semibold">{{ __('অনিষ্পন্ন নথি') }}</span>
                                <h3 class="fw-bold text-dark mt-1 mb-0">০</h3>
                            </div>
                            <span class="stat-icon-wrap bg-warning-subtle text-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a2 2 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card govt-stat-card border-0 rounded-3 shadow-sm h-100">
                    <div class="card-body p-3 border-start border-4 border-info">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted small fw-semibold">{{ __('চলমান কার্যতালিকা') }}</span>
                                <h3 class="fw-bold text-dark mt-1 mb-0">০</h3>
                            </div>
                            <span class="stat-icon-wrap bg-info-subtle text-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card govt-stat-card border-0 rounded-3 shadow-sm h-100">
                    <div class="card-body p-3 border-start border-4 border-success">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted small fw-semibold">{{ __('নিষ্পত্তিকৃত পত্র') }}</span>
                                <h3 class="fw-bold text-success mt-1 mb-0">০</h3>
                            </div>
                            <span class="stat-icon-wrap bg-success-subtle text-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- মডিউল সেকশন টাইটেল -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold text-govt-dark mb-0">
                    <span class="text-govt-primary me-1">■</span> {{ __('সফটওয়্যারের মূল ফিচার ও মডিউলসমূহ') }}
                </h5>
                <small class="text-muted">{{ __('অগ্রাধিকার ও ক্রম অনুযায়ী বিস্তারিত কার্যতালিকা') }}</small>
            </div>
            <span class="badge bg-white text-secondary border px-3 py-1 rounded-pill">মোট ৮টি মডিউল</span>
        </div>

        <!-- মূল ৮টি কার্ড গ্রিড (তালিকা সহ) -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3 mb-5">
            
            <!-- ১. ডাক ও ডায়েরি ব্যবস্থাপনা -->
            <div class="col">
                <div class="card govt-module-card border-0 h-100 rounded-3 shadow-sm">
                    <div class="card-header bg-white border-0 pt-3 px-3 pb-0 d-flex justify-content-between align-items-center">
                        <span class="badge bg-govt-primary text-white px-2 py-1 rounded-pill small">১. মডিউল</span>
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle small fw-semibold">প্রথমে তৈরি করবে</span>
                    </div>
                    <div class="card-body p-3 d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="module-icon-sm bg-govt-light text-govt-primary rounded-2 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1z"/>
                                </svg>
                            </div>
                            <h6 class="fw-bold text-govt-dark mb-0">ডাক ও ডায়েরি ব্যবস্থাপনা</h6>
                        </div>
                        <small class="text-muted fst-italic mb-2">(Inward / Outward Register)</small>
                        
                        <!-- ফিচার অর্ডার লিস্ট -->
                        <ul class="list-unstyled govt-feature-list small mb-3 flex-grow-1">
                            <li><span class="bullet-check">✓</span> আগত চিঠি এন্ট্রি ও স্বয়ংক্রিয় ডায়েরি নম্বর।</li>
                            <li><span class="bullet-check">✓</span> প্রেরিত চিঠির ইস্যু নম্বর ও তারিখ।</li>
                            <li><span class="bullet-check">✓</span> প্রেরক, প্রাপক, বিষয়, স্মারক নম্বর, সংযুক্তি।</li>
                            <li><span class="bullet-check">✓</span> কোন কর্মকর্তা বা শাখার কাছে পাঠানো হয়েছে।</li>
                            <li><span class="bullet-check">✓</span> তারিখ, নম্বর বা বিষয় দিয়ে সার্চ এবং প্রিন্ট।</li>
                        </ul>

                        <a href="{{ url('/office/correspondence') }}" class="btn btn-govt-primary btn-sm rounded-2 w-100">
                            প্রবেশ করুন &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- ২. অফিসিয়াল চিঠি ও ডকুমেন্ট জেনারেটর -->
            <div class="col">
                <div class="card govt-module-card border-0 h-100 rounded-3 shadow-sm">
                    <div class="card-header bg-white border-0 pt-3 px-3 pb-0 d-flex justify-content-between align-items-center">
                        <span class="badge bg-govt-primary text-white px-2 py-1 rounded-pill small">২. মডিউল</span>
                        <span class="badge bg-warning-subtle text-dark border border-warning small fw-semibold">অত্যন্ত গুরুত্বপূর্ণ</span>
                    </div>
                    <div class="card-body p-3 d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="module-icon-sm bg-success bg-opacity-10 text-success rounded-2 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
                                </svg>
                            </div>
                            <h6 class="fw-bold text-govt-dark mb-0">চিঠি ও ডকুমেন্ট জেনারেটর</h6>
                        </div>
                        <small class="text-muted fst-italic mb-2">(Official Letter Generator)</small>

                        <!-- ফিচার অর্ডার লিস্ট -->
                        <ul class="list-unstyled govt-feature-list small mb-3 flex-grow-1">
                            <li><span class="bullet-check text-success">✓</span> সরকারি পত্র, স্মারক, অফিস আদেশ, ছুটির আবেদন, নোটিশ।</li>
                            <li><span class="bullet-check text-success">✓</span> পূর্বনির্ধারিত টেমপ্লেট থেকে চিঠি তৈরি।</li>
                            <li><span class="bullet-check text-success">✓</span> অফিসের নাম, ঠিকানা, স্মারক নম্বর ও তারিখ অটো বসবে।</li>
                            <li><span class="bullet-check text-success">✓</span> বাংলা ও ইংরেজি কনটেন্ট, DOCX/PDF ডাউনলোড এবং প্রিন্ট।</li>
                            <li><span class="bullet-check text-success">✓</span> আগের চিঠি কপি করে নতুন চিঠি তৈরি।</li>
                        </ul>

                        <a href="{{url('/documents/generator')}}" class="btn btn-outline-success btn-sm rounded-2 w-100">
                            চিঠি তৈরি করুন &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- ৩. নথি ও ফাইল ম্যানেজমেন্ট -->
            <div class="col">
                <div class="card govt-module-card border-0 h-100 rounded-3 shadow-sm">
                    <div class="card-header bg-white border-0 pt-3 px-3 pb-0 d-flex justify-content-between align-items-center">
                        <span class="badge bg-govt-primary text-white px-2 py-1 rounded-pill small">৩. মডিউল</span>
                        <span class="badge bg-secondary-subtle text-secondary small">ট্র্যাকিং ও নথি</span>
                    </div>
                    <div class="card-body p-3 d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="module-icon-sm bg-warning bg-opacity-10 text-warning rounded-2 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a2 2 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3"/>
                                </svg>
                            </div>
                            <h6 class="fw-bold text-govt-dark mb-0">নথি ও ফাইল ম্যানেজমেন্ট</h6>
                        </div>
                        <small class="text-muted fst-italic mb-2">(File Movement & Tracking)</small>

                        <!-- ফিচার অর্ডার লিস্ট -->
                        <ul class="list-unstyled govt-feature-list small mb-3 flex-grow-1">
                            <li><span class="bullet-check text-warning">✓</span> ফাইল নম্বর, শাখা, বিষয়, খোলার তারিখ।</li>
                            <li><span class="bullet-check text-warning">✓</span> ফাইলের মধ্যে একাধিক চিঠি বা সংযুক্তি রাখা।</li>
                            <li><span class="bullet-check text-warning">✓</span> কোন ফাইল কার কাছে আছে তার রেকর্ড।</li>
                            <li><span class="bullet-check text-warning">✓</span> ফাইলের অবস্থান: শাখায়, কর্মকর্তার কাছে, নিষ্পত্তি ইত্যাদি।</li>
                            <li><span class="bullet-check text-warning">✓</span> স্ক্যান করা PDF আপলোড ও ফাইল সার্চ।</li>
                        </ul>

                        <a href="#" class="btn btn-outline-warning text-dark btn-sm rounded-2 w-100">
                            নথি দেখুন &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- ৪. ডাটা এন্ট্রি ও রিপোর্ট মডিউল -->
            <div class="col">
                <div class="card govt-module-card border-0 h-100 rounded-3 shadow-sm">
                    <div class="card-header bg-white border-0 pt-3 px-3 pb-0 d-flex justify-content-between align-items-center">
                        <span class="badge bg-govt-primary text-white px-2 py-1 rounded-pill small">৪. মডিউল</span>
                        <span class="badge bg-info-subtle text-info small">রিপোর্ট ও ডাটা</span>
                    </div>
                    <div class="card-body p-3 d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="module-icon-sm bg-info bg-opacity-10 text-info rounded-2 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M4 11H2v3h2zm5-4H7v7h2zm5-5h-2v12h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                </svg>
                            </div>
                            <h6 class="fw-bold text-govt-dark mb-0">ডাটা এন্ট্রি ও রিপোর্ট</h6>
                        </div>
                        <small class="text-muted fst-italic mb-2">(Data Entry & Reports)</small>

                        <!-- ফিচার অর্ডার লিস্ট -->
                        <ul class="list-unstyled govt-feature-list small mb-3 flex-grow-1">
                            <li><span class="bullet-check text-info">✓</span> কর্মচারী, অফিস, শাখা ও যোগাযোগের তথ্য।</li>
                            <li><span class="bullet-check text-info">✓</span> Excel/CSV থেকে ডাটা Import ও Export।</li>
                            <li><span class="bullet-check text-info">✓</span> মাসিক ডাক বিবরণী, পত্র নিষ্পত্তির রিপোর্ট।</li>
                            <li><span class="bullet-check text-info">✓</span> দৈনিক, মাসিক ও তারিখভিত্তিক রিপোর্ট।</li>
                            <li><span class="bullet-check text-info">✓</span> Print-ready টেবিল ও PDF রিপোর্ট।</li>
                        </ul>

                        <a href="#" class="btn btn-outline-info btn-sm rounded-2 w-100">
                            রিপোর্ট দেখুন &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- ৫. সভা ও নোটিশ ব্যবস্থাপনা -->
            <div class="col">
                <div class="card govt-module-card border-0 h-100 rounded-3 shadow-sm">
                    <div class="card-header bg-white border-0 pt-3 px-3 pb-0 d-flex justify-content-between align-items-center">
                        <span class="badge bg-govt-primary text-white px-2 py-1 rounded-pill small">৫. মডিউল</span>
                        <span class="badge bg-secondary-subtle text-secondary small">মিটিং ও নোটিশ</span>
                    </div>
                    <div class="card-body p-3 d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="module-icon-sm bg-danger bg-opacity-10 text-danger rounded-2 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </div>
                            <h6 class="fw-bold text-govt-dark mb-0">সভা ও নোটিশ ব্যবস্থাপনা</h6>
                        </div>
                        <small class="text-muted fst-italic mb-2">(Meeting & Minutes)</small>

                        <!-- ফিচার অর্ডার লিস্ট -->
                        <ul class="list-unstyled govt-feature-list small mb-3 flex-grow-1">
                            <li><span class="bullet-check text-danger">✓</span> সভার তারিখ, সময়, স্থান ও আলোচ্যসূচি।</li>
                            <li><span class="bullet-check text-danger">✓</span> সভার নোটিশ ও উপস্থিতি তালিকা।</li>
                            <li><span class="bullet-check text-danger">✓</span> কার্যবিবরণী (Meeting Minutes) তৈরি।</li>
                            <li><span class="bullet-check text-danger">✓</span> সিদ্ধান্ত, দায়িত্বপ্রাপ্ত ব্যক্তি ও সময়সীমা সংরক্ষণ।</li>
                        </ul>

                        <a href="#" class="btn btn-outline-danger btn-sm rounded-2 w-100">
                            সভা সূচি &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- ৬. দৈনিক কাজ ও Task Management -->
            <div class="col">
                <div class="card govt-module-card border-0 h-100 rounded-3 shadow-sm">
                    <div class="card-header bg-white border-0 pt-3 px-3 pb-0 d-flex justify-content-between align-items-center">
                        <span class="badge bg-govt-primary text-white px-2 py-1 rounded-pill small">৬. মডিউল</span>
                        <span class="badge bg-secondary-subtle text-secondary small">টাস্ক ও অগ্রগতি</span>
                    </div>
                    <div class="card-body p-3 d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="module-icon-sm bg-secondary bg-opacity-10 text-secondary rounded-2 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                </svg>
                            </div>
                            <h6 class="fw-bold text-govt-dark mb-0">দৈনিক কাজ ও টাস্ক</h6>
                        </div>
                        <small class="text-muted fst-italic mb-2">(Daily Task Management)</small>

                        <!-- ফিচার অর্ডার লিস্ট -->
                        <ul class="list-unstyled govt-feature-list small mb-3 flex-grow-1">
                            <li><span class="bullet-check text-secondary">✓</span> কর্মকর্তার নির্দেশে কাজের তালিকা তৈরি।</li>
                            <li><span class="bullet-check text-secondary">✓</span> কাজের দায়িত্ব, ডেডলাইন ও অগ্রগতি।</li>
                            <li><span class="bullet-check text-secondary">✓</span> Pending, In Progress, Completed স্ট্যাটাস।</li>
                            <li><span class="bullet-check text-secondary">✓</span> কোন কাজের সময়সীমা শেষ হচ্ছে তার Reminder।</li>
                        </ul>

                        <a href="#" class="btn btn-outline-secondary btn-sm rounded-2 w-100">
                            কাজের তালিকা &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- ৭. স্টেশনারি ও স্টক রেজিস্টার -->
            <div class="col">
                <div class="card govt-module-card border-0 h-100 rounded-3 shadow-sm">
                    <div class="card-header bg-white border-0 pt-3 px-3 pb-0 d-flex justify-content-between align-items-center">
                        <span class="badge bg-govt-primary text-white px-2 py-1 rounded-pill small">৭. মডিউল</span>
                        <span class="badge bg-secondary-subtle text-secondary small">মজুত রেজিস্টার</span>
                    </div>
                    <div class="card-body p-3 d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="module-icon-sm bg-success bg-opacity-10 text-success rounded-2 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24z"/>
                                </svg>
                            </div>
                            <h6 class="fw-bold text-govt-dark mb-0">স্টেশনারি ও স্টক রেজিস্টার</h6>
                        </div>
                        <small class="text-muted fst-italic mb-2">(Stationery & Stock Register)</small>

                        <!-- ফিচার অর্ডার লিস্ট -->
                        <ul class="list-unstyled govt-feature-list small mb-3 flex-grow-1">
                            <li><span class="bullet-check text-success">✓</span> কলম, কাগজ, টোনারসহ অফিস সামগ্রীর তালিকা।</li>
                            <li><span class="bullet-check text-success">✓</span> স্টক ইন, স্টক আউট ও বর্তমান মজুত।</li>
                            <li><span class="bullet-check text-success">✓</span> সরবরাহ গ্রহণ ও বিতরণের রেকর্ড।</li>
                            <li><span class="bullet-check text-success">✓</span> স্টক রিপোর্ট ও কম মজুতের সতর্কতা।</li>
                        </ul>

                        <a href="#" class="btn btn-outline-success btn-sm rounded-2 w-100">
                            স্টক রেজিস্টার &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- ৮. অফিস সেটিংস ও ইউজার পারমিশন -->
            <div class="col">
                <div class="card govt-module-card border-0 h-100 rounded-3 shadow-sm">
                    <div class="card-header bg-white border-0 pt-3 px-3 pb-0 d-flex justify-content-between align-items-center">
                        <span class="badge bg-govt-primary text-white px-2 py-1 rounded-pill small">৮. মডিউল</span>
                        <span class="badge bg-dark-subtle text-dark small">প্রশাসন ও নিরাপত্তা</span>
                    </div>
                    <div class="card-body p-3 d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="module-icon-sm bg-dark bg-opacity-10 text-dark rounded-2 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.464 9.99a11.8 11.8 0 0 0 4.04 3.19c.14.07.28.13.42.18.04.02.08.03.12.04.05.02.1.03.15.04l.03.01.03-.01c.05-.01.1-.02.15-.04.04-.01.08-.02.12-.04.14-.05.28-.11.42-.18a11.8 11.8 0 0 0 4.04-3.19c1.677-2.195 3.06-5.513 2.464-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0"/>
                                </svg>
                            </div>
                            <h6 class="fw-bold text-govt-dark mb-0">সেটিংস ও পারমিশন</h6>
                        </div>
                        <small class="text-muted fst-italic mb-2">(Settings & User Permission)</small>

                        <!-- ফিচার অর্ডার লিস্ট -->
                        <ul class="list-unstyled govt-feature-list small mb-3 flex-grow-1">
                            <li><span class="bullet-check text-dark">✓</span> অফিসের নাম, লোগো, ঠিকানা ও যোগাযোগ।</li>
                            <li><span class="bullet-check text-dark">✓</span> শাখা, কর্মকর্তা, পদবি ও কর্মচারী ব্যবস্থাপনা।</li>
                            <li><span class="bullet-check text-dark">✓</span> Admin, Office Assistant, Officer ইত্যাদি রোল।</li>
                            <li><span class="bullet-check text-dark">✓</span> কে চিঠি তৈরি, অনুমোদন বা ডিলিট করতে পারবে।</li>
                            <li><span class="bullet-check text-dark">✓</span> Audit log: কে কখন কী পরিবর্তন করেছে।</li>
                        </ul>

                        <a href="#" class="btn btn-outline-dark btn-sm rounded-2 w-100">
                            সেটিংস দেখুন &rarr;
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- দাপ্তরিক / গভর্নমেন্ট থিম কালার স্টাইল (CSS) -->
    <style>
        :root {
            --govt-green-dark: #064e3b;
            --govt-green-primary: #047857;
            --govt-green-light: #ecfdf5;
            --govt-slate-bg: #f0f4f3;
            --govt-text-dark: #1e293b;
        }

        body {
            background-color: var(--govt-slate-bg) !important;
        }

        .text-govt-dark {
            color: var(--govt-text-dark);
        }

        .text-govt-primary {
            color: var(--govt-green-primary) !important;
        }

        .bg-govt-primary {
            background-color: var(--govt-green-primary) !important;
        }

        .bg-govt-light {
            background-color: var(--govt-green-light) !important;
        }

        .border-govt-primary {
            border-color: var(--govt-green-primary) !important;
        }

        .btn-govt-primary {
            background-color: var(--govt-green-primary);
            color: #ffffff;
            border: 1px solid var(--govt-green-primary);
            font-weight: 500;
        }
        .btn-govt-primary:hover {
            background-color: var(--govt-green-dark);
            color: #ffffff;
        }

        .govt-emblem-badge {
            background: var(--govt-green-light);
            color: var(--govt-green-primary);
            padding: 5px 7px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
        }

        .govt-status-pill {
            background-color: #ffffff;
            color: var(--govt-green-dark);
            border: 1px solid #d1fae5;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .govt-welcome-card {
            background: linear-gradient(135deg, #ffffff 0%, #f7faf8 100%);
            border: 1px solid #e2ece7 !important;
        }

        .govt-avatar-box {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--govt-green-primary), var(--govt-green-dark));
            box-shadow: 0 4px 8px rgba(4, 120, 87, 0.25);
        }

        .govt-module-card {
            background: #ffffff;
            border: 1px solid #e5ede8 !important;
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }
        .govt-module-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 22px rgba(6, 78, 59, 0.08) !important;
            border-color: #bbf7d0 !important;
        }

        .govt-feature-list li {
            padding: 3px 0;
            color: #475569;
            font-size: 0.84rem;
            line-height: 1.45;
            display: flex;
            align-items: flex-start;
        }
        .bullet-check {
            font-weight: bold;
            margin-right: 7px;
            color: var(--govt-green-primary);
            flex-shrink: 0;
        }

        .stat-icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

@endsection