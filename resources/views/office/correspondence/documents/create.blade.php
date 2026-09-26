@extends('layouts.app')

@push('styles')
<style>
    /* প্রিমিয়াম ডেইরি ক্রিম / আইভরি কালার প্যালেট */
    :root {
        --cream-bg: #fbf7ee;          /* নরম আভিজাত্যপূর্ণ ক্রিম ব্যাকগ্রাউন্ড */
        --cream-card: #fdfaf3;        /* কার্ড ব্যাকগ্রাউন্ড */
        --cream-border: #ece3d2;      /* ক্রিম বর্ডার */
        --govt-green: #065f46;        /* অফিসিয়াল ডিপ গ্রিন */
        --govt-navy: #1e3a8a;         /* ইংরেজি সেকশনের ডিপ নেভি ব্লু */
    }

    body {
        background-color: var(--cream-bg) !important;
        transition: background-color 0.3s ease;
    }

    /* ক্রিম ব্যাকগ্রাউন্ড রিমুভ (সাদা থিম মোড) */
    body.white-theme-mode {
        background-color: #f8fafc !important;
    }
    body.white-theme-mode .cream-card {
        background-color: #ffffff !important;
        border-color: #e2e8f0 !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04) !important;
    }
    body.white-theme-mode .paper-viewport-wrapper {
        background: #e2e8f0 !important;
        border-color: #cbd5e1 !important;
    }
    body.white-theme-mode .word-toolbar {
        background: #f1f5f9 !important;
        border-color: #cbd5e1 !important;
    }

    .animate-fade-in {
        animation: fadeInSlide 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes fadeInSlide {
        from { opacity: 0; transform: translateY(18px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .cream-card {
        background-color: var(--cream-card);
        border: 1px solid var(--cream-border);
        box-shadow: 0 4px 15px rgba(180, 140, 72, 0.05);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    /* প্রিভিউ স্ক্রল র‍্যাপার */
    .paper-viewport-wrapper {
        background: #e9e4d9;
        padding: 30px 15px;
        border-radius: 8px;
        overflow-x: auto;
        display: flex;
        justify-content: center;
        border: 1px solid #ded6c5;
        transition: background-color 0.3s ease;
    }

    /* সরকারি লেটারহেড প্যাড প্রিভিউ পেপার */
    .official-letter-paper {
        background: #ffffff;
        border: 1px solid #dcd3c1;
        box-shadow: 0 12px 35px rgba(70, 50, 20, 0.12);
        border-radius: 3px;
        color: #1a1a1a;
        position: relative;
        transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
        margin: 0 auto;
    }

    .font-bangla {
        font-family: 'SolaimanLipi', 'Kalpurush', 'Nikosh', 'Arial', sans-serif;
    }

    .font-english {
        font-family: 'Times New Roman', 'Calibri', 'Arial', sans-serif;
    }

    /* পেপার সাইজ ক্লাসেস */
    .paper-a4 { width: 210mm; min-height: 297mm; max-width: 100%; }
    .paper-letter { width: 215.9mm; min-height: 279.4mm; max-width: 100%; }
    .paper-legal { width: 215.9mm; min-height: 355.6mm; max-width: 100%; }
    .paper-a5 { width: 148mm; min-height: 210mm; max-width: 100%; }

    /* মার্জিন ক্লাসেস */
    .margin-normal { padding: 60px 50px; }
    .margin-narrow { padding: 35px 25px; }
    .margin-pad-space { padding: 120px 50px 60px 50px; }

    /* টেমপ্লেট চিপ বাটন */
    .template-chip {
        cursor: pointer;
        padding: 5px 12px;
        border-radius: 20px;
        border: 1px solid var(--cream-border);
        background: #ffffff;
        font-size: 0.82rem;
        transition: all 0.2s ease;
        display: inline-block;
        font-weight: 500;
    }

    .template-chip:hover, .template-chip.active {
        background: var(--govt-green);
        color: #ffffff;
        border-color: var(--govt-green);
        transform: translateY(-2px);
    }

    .template-chip-en:hover, .template-chip-en.active {
        background: var(--govt-navy) !important;
        color: #ffffff !important;
        border-color: var(--govt-navy) !important;
    }

    /* MS Word স্টাইলের রিচ এডিটর ও টুলবার */
    .word-toolbar {
        background: #f4eee1;
        border: 1px solid #dfd3be;
        border-bottom: none;
        border-radius: 6px 6px 0 0;
        padding: 6px 8px;
        transition: background-color 0.3s ease;
    }

    .rich-editor-box {
        background: #ffffff;
        border: 1px solid #dfd3be;
        border-radius: 0 0 6px 6px;
        min-height: 180px;
        max-height: 360px;
        overflow-y: auto;
        padding: 12px;
        outline: none;
        font-family: inherit;
        line-height: 1.8;
    }
    .rich-editor-box:focus {
        border-color: var(--govt-green);
        box-shadow: 0 0 0 2px rgba(6, 95, 70, 0.15);
    }

    /* অ্যাকর্ডিয়ন স্টাইল */
    .accordion-button:not(.collapsed) {
        background-color: #f1ebd9;
        color: var(--govt-green);
        font-weight: 600;
    }
    .accordion-button:focus {
        box-shadow: none;
    }

    /* সেকশন ডিভাইডার ব্যানার */
    .section-divider-banner {
        background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
        color: #ffffff;
        border-radius: 12px;
        padding: 20px 25px;
        box-shadow: 0 8px 25px rgba(30, 58, 138, 0.18);
    }

    /* প্রিন্ট ও পেজ-ব্রেক হ্যান্ডলিং */
    @media print {
        body * { visibility: hidden; }
        .print-target, .print-target * { visibility: visible; }
        .print-target {
            position: absolute;
            left: 0;
            top: 0;
            width: 100% !important;
            margin: 0 !important;
            box-shadow: none !important;
            border: none !important;
        }
        .keep-together {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-3 animate-fade-in">

    <!-- কুইক নেভিগেশন বার ও ব্যাকগ্রাউন্ড টগল -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 small">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('office.correspondence.index') }}" class="text-decoration-none text-muted">পত্র যোগাযোগ</a></li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">ডকুমেন্ট জেনারেটর</li>
                </ol>
            </nav>
            <h3 class="fw-bold mb-0 text-dark">
                <i class="fas fa-file-signature text-success me-2"></i> অফিসিয়াল চিঠি ও ডকুমেন্ট জেনারেটর
            </h3>
        </div>

        <div class="d-flex flex-wrap gap-2 align-items-center">
            <a href="#banglaSection" class="btn btn-sm btn-outline-success">
                🇧🇩 বাংলা চিঠি সেকশন
            </a>
            <a href="#englishSection" class="btn btn-sm btn-outline-primary">
                🇬🇧 English Letter Section
            </a>
            <button type="button" id="themeToggleBtn" class="btn btn-sm btn-outline-dark" onclick="toggleCreamBackground()" title="ক্রিম এবং সাদা ব্যাকগ্রাউন্ড পরিবর্তন করুন">
                <i class="fas fa-palette me-1 text-warning"></i> <span id="themeToggleText">ক্রিম থিম: চালু</span>
            </button>
        </div>
    </div>


    <!-- ========================================================================= -->
    <!-- ১. বাংলা দাপ্তরিক চিঠি জেনারেটর সেকশন (BENGALI OFFICIAL LETTER SECTION) -->
    <!-- ========================================================================= -->
    <div id="banglaSection" class="mb-5">
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold text-success mb-0">
                <span class="badge bg-success me-2">১ম সেকশন</span> 🇧🇩 বাংলা দাপ্তরিক চিঠি ও স্মারক জেনারেটর
            </h4>
            <div class="d-flex gap-2">
                <button type="button" id="copyBtn" class="btn btn-primary btn-sm shadow-xs px-3" onclick="copyLetterToClipboard()">
                    <i class="fas fa-copy me-1"></i> <span id="copyBtnText">MS Word / ইমেইলে হুবহু কপি</span>
                </button>
                <button type="button" class="btn btn-success btn-sm shadow-xs px-3" onclick="printDocument('printableLetter')">
                    <i class="fas fa-print me-1"></i> প্রিন্ট / PDF
                </button>
            </div>
        </div>

        <!-- কপি সাকসেস অ্যালার্ট (বাংলা) -->
        <div id="copyAlert" class="alert alert-success d-none alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle fa-lg me-2 text-success"></i> <strong>বাংলা চিঠি ফরম্যাটিং সহ কপি হয়েছে!</strong> MS Word বা ইমেইলে <b>Ctrl + V</b> চাপুন।
            <button type="button" class="btn-close" onclick="document.getElementById('copyAlert').classList.add('d-none')"></button>
        </div>

        <!-- বাংলা কন্ট্রোল টুলবার -->
        <div class="card cream-card border-0 mb-4 p-3">
            <div class="row g-3 align-items-center">
                <div class="col-xl-6 col-lg-12">
                    <span class="fw-bold text-dark small me-2"><i class="fas fa-layer-group text-warning me-1"></i> টেমপ্লেট:</span>
                    <span class="template-chip active" onclick="setTemplate('সরকারি পত্র')">সরকারি পত্র / স্মারক</span>
                    <span class="template-chip" onclick="setTemplate('অফিস আদেশ')">অফিস আদেশ</span>
                    <span class="template-chip" onclick="setTemplate('ছুটির আবেদন')">ছুটির আবেদন</span>
                    <span class="template-chip" onclick="setTemplate('অফিসিয়াল নোটিশ')">নোটিশ</span>
                    <span class="template-chip" onclick="setTemplate('কারণ দর্শানোর নোটিশ')">শোকজ</span>
                </div>
                <div class="col-xl-6 col-lg-12 text-xl-end">
                    <div class="d-inline-flex align-items-center gap-2">
                        <span class="fw-semibold text-dark small"><i class="fas fa-file-alt text-primary me-1"></i> পেপার:</span>
                        <select id="paperSizeSelect" class="form-select form-select-sm border-secondary-subtle" style="width: 130px;" onchange="onPaperSizeSelectChange(this.value)">
                            <option value="paper-a4|a4" selected>A4 (ডিফল্ট)</option>
                            <option value="paper-letter|letter">Letter</option>
                            <option value="paper-legal|legal">Legal (লম্বা)</option>
                            <option value="paper-a5|a5">A5 (ছোট)</option>
                        </select>
                        <select id="marginSelect" class="form-select form-select-sm border-secondary-subtle" style="width: 135px;" onchange="setMargin(this.value)">
                            <option value="margin-normal">স্বাভাবিক মার্জিন</option>
                            <option value="margin-narrow">কম্প্যাক্ট মার্জিন</option>
                            <option value="margin-pad-space">ছাপা প্যাড স্পেস</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- বাংলা ফর্ম ও লাইভ প্রিভিউ -->
        <div class="row g-4">
            <!-- বাম পাশ: বাংলা ফর্ম -->
            <div class="col-lg-5">
                <div class="card cream-card border-0 p-4 h-100">
                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                        <i class="fas fa-edit text-success me-2"></i> বাংলা চিঠির তথ্য পূরণ করুন
                    </h5>
                    <form id="letterForm" onsubmit="event.preventDefault()">
                        <div class="accordion" id="banglaFormAccordion">
                            <!-- ১. হেডার তথ্য -->
                            <div class="accordion-item border mb-2 rounded overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button py-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHeader">
                                        <i class="fas fa-landmark text-primary me-2"></i> ১. দপ্তরের প্যাড / হেডার তথ্য
                                    </button>
                                </h2>
                                <div id="collapseHeader" class="accordion-collapse collapse show">
                                    <div class="accordion-body p-3 bg-white">
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">প্রধান শিরোনাম</label>
                                            <input type="text" id="inputGovtName" class="form-control form-control-sm" value="গণপ্রজাতন্ত্রী বাংলাদেশ সরকার" oninput="updatePreview()">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">মন্ত্রণালয় / বিভাগ</label>
                                            <input type="text" id="inputMinistry" class="form-control form-control-sm" value="স্বরাষ্ট্র মন্ত্রণালয়" oninput="updatePreview()">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">কার্যালয় / শাখা</label>
                                            <input type="text" id="inputOffice" class="form-control form-control-sm" value="উপজেলা নির্বাহী অফিসারের কার্যালয় / জেলা প্রশাসন" oninput="updatePreview()">
                                        </div>
                                        <div>
                                            <label class="form-label small fw-semibold">ওয়েবসাইট</label>
                                            <input type="text" id="inputWebsite" class="form-control form-control-sm" value="www.officekormi.gov.bd" oninput="updatePreview()">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ২. স্মারক ও তারিখ -->
                            <div class="accordion-item border mb-2 rounded overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed py-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMemo">
                                        <i class="fas fa-calendar-alt text-info me-2"></i> ২. স্মারক ও তারিখ
                                    </button>
                                </h2>
                                <div id="collapseMemo" class="accordion-collapse collapse">
                                    <div class="accordion-body p-3 bg-white">
                                        <div class="row g-2 mb-2">
                                            <div class="col-md-5">
                                                <label class="form-label small fw-semibold">স্মারক লেবেল</label>
                                                <input type="text" id="inputMemoLabel" class="form-control form-control-sm" value="স্মারক নং:" oninput="updatePreview()">
                                            </div>
                                            <div class="col-md-7">
                                                <label class="form-label small fw-semibold">স্মারক নম্বর</label>
                                                <input type="text" id="inputMemo" class="form-control form-control-sm" value="০৫.০০.০০০০.০১.২৬.০০১" oninput="updatePreview()">
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-md-5">
                                                <label class="form-label small fw-semibold">তারিখ লেবেল</label>
                                                <input type="text" id="inputDateLabel" class="form-control form-control-sm" value="তারিখ:" oninput="updatePreview()">
                                            </div>
                                            <div class="col-md-7">
                                                <label class="form-label small fw-semibold">তারিখ নির্বাচন</label>
                                                <input type="date" id="inputDate" class="form-control form-control-sm" onchange="updatePreview()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ৩. প্রাপক -->
                            <div class="accordion-item border mb-2 rounded overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed py-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRecipient">
                                        <i class="fas fa-user-tie text-secondary me-2"></i> ৩. প্রাপকের বিবরণ ও ঠিকানা
                                    </button>
                                </h2>
                                <div id="collapseRecipient" class="accordion-collapse collapse">
                                    <div class="accordion-body p-3 bg-white">
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">সম্বোধন</label>
                                            <input type="text" id="inputRecipientSalutation" class="form-control form-control-sm" value="বরাবর," oninput="updatePreview()">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">প্রাপকের পদবি ও দপ্তর</label>
                                            <input type="text" id="inputRecipient" class="form-control form-control-sm" value="যুগ্মসচিব (প্রশাসন), জনপ্রশাসন মন্ত্রণালয়" oninput="updatePreview()">
                                        </div>
                                        <div>
                                            <label class="form-label small fw-semibold">প্রাপকের ঠিকানা</label>
                                            <input type="text" id="inputRecipientAddress" class="form-control form-control-sm" value="বাংলাদেশ সচিবালয়, ঢাকা।" oninput="updatePreview()">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ৪. বিষয় ও সূত্র -->
                            <div class="accordion-item border mb-2 rounded overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed py-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSubject">
                                        <i class="fas fa-bookmark text-warning me-2"></i> ৪. বিষয় ও সূত্র
                                    </button>
                                </h2>
                                <div id="collapseSubject" class="accordion-collapse collapse">
                                    <div class="accordion-body p-3 bg-white">
                                        <div class="row g-2 mb-2">
                                            <div class="col-md-4">
                                                <label class="form-label small fw-semibold">বিষয় লেবেল</label>
                                                <input type="text" id="inputSubjectLabel" class="form-control form-control-sm" value="বিষয়:" oninput="updatePreview()">
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label small fw-semibold">বিষয়</label>
                                                <input type="text" id="inputSubject" class="form-control form-control-sm" value="বার্ষিক কর্মসম্পাদন চুক্তি সংক্রান্ত জরুরি প্রতিবেদন প্রেরণ।" oninput="updatePreview()">
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-md-4">
                                                <label class="form-label small fw-semibold">সূত্র লেবেল</label>
                                                <input type="text" id="inputReferenceLabel" class="form-control form-control-sm" value="সূত্র:" oninput="updatePreview()">
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label small fw-semibold">সূত্র টেক্সট</label>
                                                <input type="text" id="inputReference" class="form-control form-control-sm" placeholder="যেমন: স্মারক নং- ০৫.০৪..." oninput="updatePreview()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ৫. মূল বক্তব্য -->
                            <div class="accordion-item border mb-2 rounded overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button py-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBody">
                                        <i class="fas fa-align-left text-success me-2"></i> ৫. মূল বক্তব্য (চিঠির বডি)
                                    </button>
                                </h2>
                                <div id="collapseBody" class="accordion-collapse collapse show">
                                    <div class="accordion-body p-3 bg-white">
                                        <div class="word-toolbar d-flex flex-wrap align-items-center gap-1">
                                            <select id="fontSizeSelect" class="form-select form-select-sm py-0 px-1" style="width: 82px; font-size: 0.78rem; height: 26px;" onchange="applyTypography()">
                                                <option value="10pt">10 pt</option>
                                                <option value="11pt">11 pt</option>
                                                <option value="11.5pt" selected>11.5 pt</option>
                                                <option value="12pt">12 pt</option>
                                                <option value="14pt">14 pt</option>
                                                <option value="16pt">16 pt</option>
                                            </select>
                                            <select id="lineHeightSelect" class="form-select form-select-sm py-0 px-1" style="width: 88px; font-size: 0.78rem; height: 26px;" onchange="applyTypography()">
                                                <option value="1.4">1.4</option>
                                                <option value="1.6">1.6</option>
                                                <option value="1.8" selected>1.8</option>
                                                <option value="2.0">2.0</option>
                                            </select>
                                            <div class="btn-group btn-group-sm" style="height: 26px;">
                                                <button type="button" class="btn btn-outline-secondary py-0 px-2 fw-bold" onclick="execRichFormat('bold')">B</button>
                                                <button type="button" class="btn btn-outline-secondary py-0 px-2 text-decoration-underline" onclick="execRichFormat('underline')">U</button>
                                            </div>
                                            <div class="btn-group btn-group-sm ms-auto" style="height: 26px;">
                                                <button type="button" id="alignLeftBtn" class="btn btn-outline-secondary py-0 px-2" onclick="setTextAlign('left')"><i class="fas fa-align-left"></i></button>
                                                <button type="button" id="alignJustifyBtn" class="btn btn-secondary py-0 px-2 active" onclick="setTextAlign('justify')"><i class="fas fa-align-justify"></i></button>
                                            </div>
                                        </div>
                                        <div id="inputBody" contenteditable="true" class="rich-editor-box font-bangla" oninput="updatePreview()">
                                            উপর্যুক্ত বিষয় ও সূত্রের প্রেক্ষিতে জানানো যাচ্ছে যে, আপনার কার্যালয়ের চাহিত বার্ষিক কর্মসম্পাদন চুক্তি (APA) সংক্রান্ত ত্রৈমাসিক অগ্রগতি প্রতিবেদন পরবর্তী প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য এতদসঙ্গে প্রেরণ করা হলো।<br><br>
                                            এমতাবস্থায়, মহোদয়ের সদয় অবগতি ও পরবর্তী প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য অনুরোধ করা হলো।
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ৬. স্বাক্ষরকারী -->
                            <div class="accordion-item border mb-2 rounded overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed py-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSigner">
                                        <i class="fas fa-signature text-dark me-2"></i> ৬. স্বাক্ষরকারী
                                    </button>
                                </h2>
                                <div id="collapseSigner" class="accordion-collapse collapse">
                                    <div class="accordion-body p-3 bg-white">
                                        <div class="row g-2 mb-2">
                                            <div class="col-md-5">
                                                <label class="form-label small fw-semibold">স্ট্যাটাস</label>
                                                <input type="text" id="inputSignStatus" class="form-control form-control-sm" value="[স্বাক্ষরিত]" oninput="updatePreview()">
                                            </div>
                                            <div class="col-md-7">
                                                <label class="form-label small fw-semibold">নাম</label>
                                                <input type="text" id="inputSignerName" class="form-control form-control-sm" value="মোঃ রফিকুল ইসলাম" oninput="updatePreview()">
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <label class="form-label small fw-semibold">পদবি</label>
                                                <input type="text" id="inputSignerTitle" class="form-control form-control-sm" value="উপপরিচালক (প্রশাসন)" oninput="updatePreview()">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small fw-semibold">যোগাযোগ</label>
                                                <input type="text" id="inputSignerContact" class="form-control form-control-sm" value="ফোন: ০২-৯৯৯৯৯৯৯" oninput="updatePreview()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ৭. অনুলিপি -->
                            <div class="accordion-item border mb-2 rounded overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed py-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCopies">
                                        <i class="fas fa-copy text-danger me-2"></i> ৭. অনুলিপি / সদয় অবগতি
                                    </button>
                                </h2>
                                <div id="collapseCopies" class="accordion-collapse collapse">
                                    <div class="accordion-body p-3 bg-white">
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">অনুলিপি শিরোনাম</label>
                                            <input type="text" id="inputCopiesHeading" class="form-control form-control-sm" value="সদয় অবগতি ও কার্যার্থে অনুলিপি প্রেরণ করা হলো:" oninput="updatePreview()">
                                        </div>
                                        <div class="word-toolbar d-flex flex-wrap align-items-center gap-1">
                                            <select id="copiesFontSizeSelect" class="form-select form-select-sm py-0 px-1" style="width: 82px; font-size: 0.78rem; height: 26px;" onchange="applyCopiesTypography()">
                                                <option value="9pt">9 pt</option>
                                                <option value="10pt" selected>10 pt</option>
                                                <option value="11pt">11 pt</option>
                                            </select>
                                            <select id="copiesLineHeightSelect" class="form-select form-select-sm py-0 px-1" style="width: 88px; font-size: 0.78rem; height: 26px;" onchange="applyCopiesTypography()">
                                                <option value="1.4">1.4</option>
                                                <option value="1.6" selected>1.6</option>
                                                <option value="1.8">1.8</option>
                                            </select>
                                            <div class="btn-group btn-group-sm" style="height: 26px;">
                                                <button type="button" class="btn btn-outline-secondary py-0 px-2 fw-bold" onclick="execCopiesRichFormat('bold')">B</button>
                                                <button type="button" class="btn btn-outline-secondary py-0 px-2 text-decoration-underline" onclick="execCopiesRichFormat('underline')">U</button>
                                            </div>
                                        </div>
                                        <div id="inputCopies" contenteditable="true" class="rich-editor-box font-bangla" style="min-height: 110px; max-height: 180px;" oninput="updatePreview()">
                                            ১. সচিব মহোদয়ের একান্ত সচিব, জনপ্রশাসন মন্ত্রণালয়।<br>
                                            ২. সিস্টেম এনালিস্ট (ওয়েবসাইটে প্রকাশের অনুরোধসহ)।<br>
                                            ৩. অফিস কপি / গার্ড ফাইল।
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ডান পাশ: বাংলা লাইভ প্রিভিউ -->
            <div class="col-lg-7">
                <div class="d-flex justify-content-between align-items-center mb-2 px-1">
                    <span class="small text-muted fw-semibold">
                        <i class="fas fa-eye me-1"></i> বাংলা প্রিভিউ: <b id="currentSizeText" class="text-dark">A4 Format</b>
                    </span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle small">অফিশিয়াল ফরমেট</span>
                </div>

                <div class="paper-viewport-wrapper">
                    <div id="printableLetter" class="official-letter-paper paper-a4 margin-normal font-bangla print-target">
                        <div class="text-center mb-4">
                            <h5 class="fw-bold mb-0 text-dark" id="previewGovtName">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h5>
                            <p class="mb-0 fw-semibold small text-dark" id="previewMinistry">স্বরাষ্ট্র মন্ত্রণালয়</p>
                            <p class="mb-0 text-muted small" id="previewOffice">উপজেলা নির্বাহী অফিসারের কার্যালয় / জেলা প্রশাসন</p>
                            <p class="mb-0 text-muted small" id="previewWebsite">www.officekormi.gov.bd</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-start border-bottom pb-2 mb-3 small">
                            <div><strong id="previewMemoLabel">স্মারক নং:</strong> <span id="previewMemo">০৫.০০.০০০০.০১.২৬.০০১</span></div>
                            <div class="text-end">
                                <div><strong id="previewDateLabel">তারিখ:</strong> <span id="previewDateBangla"></span></div>
                                <div class="text-muted fw-semibold" id="previewBanglaDate">স্বয়ংক্রিয় বাংলা তারিখ...</div>
                            </div>
                        </div>
                        <div class="mb-3 small">
                            <div><strong id="previewRecipientSalutation">বরাবর,</strong></div>
                            <div id="previewRecipient" class="fw-semibold">যুগ্মসচিব (প্রশাসন), জনপ্রশাসন মন্ত্রণালয়</div>
                            <div class="text-muted" id="previewRecipientAddress">বাংলাদেশ সচিবালয়, ঢাকা।</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold text-dark">
                                <u><span id="previewSubjectLabel">বিষয়:</span> <span id="previewSubject">বার্ষিক কর্মসম্পাদন চুক্তি সংক্রান্ত জরুরি প্রতিবেদন প্রেরণ।</span></u>
                            </div>
                            <div id="previewRefContainer" class="small text-muted mt-1" style="display: none;">
                                <span id="previewReferenceLabel">সূত্র:</span> <span id="previewReference"></span>
                            </div>
                        </div>
                        <div id="previewBody" class="mb-5" style="line-height: 1.8; font-size: 11.5pt; text-align: justify;"></div>
                        <div class="d-flex justify-content-end mb-4 keep-together">
                            <div class="text-center" style="min-width: 220px;">
                                <div class="text-muted fst-italic mb-1 small" id="previewSignStatus">[স্বাক্ষরিত]</div>
                                <div class="fw-bold text-dark" id="previewSignerName">মোঃ রফিকুল ইসলাম</div>
                                <div class="small text-muted" id="previewSignerTitle">উপপরিচালক (প্রশাসন)</div>
                                <div class="small text-muted" id="previewSignerContact">ফোন: ০২-৯৯৯৯৯৯৯</div>
                            </div>
                        </div>
                        <div id="previewCopiesContainer" class="small border-top pt-3 text-muted keep-together">
                            <div class="fw-bold mb-1 text-dark" id="previewCopiesHeading">সদয় অবগতি ও কার্যার্থে অনুলিপি প্রেরণ করা হলো:</div>
                            <div id="previewCopies" style="text-align: left; line-height: 1.6; font-size: 10pt;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- ========================================================================= -->
    <!-- সেকশন ডিভাইডার (ENGLISH SECTION HEADER BANNER) -->
    <!-- ========================================================================= -->
    <div class="section-divider-banner d-flex flex-wrap justify-content-between align-items-center my-5" id="englishSection">
        <div>
            <span class="badge bg-warning text-dark px-3 py-1 mb-2 fw-semibold">২য় সেকশন</span>
            <h4 class="fw-bold mb-1">🇬🇧 Official English Letter & Memo Generator</h4>
            <p class="mb-0 small text-light opacity-75">Generate official letters in standard English Commonwealth/Bangladesh Govt format.</p>
        </div>
        <div class="d-flex gap-2 mt-3 mt-md-0">
            <button type="button" id="copyBtnEn" class="btn btn-warning btn-sm fw-bold shadow-xs px-3" onclick="copyLetterToClipboardEn()">
                <i class="fas fa-copy me-1"></i> <span id="copyBtnTextEn">Copy to Word (English)</span>
            </button>
            <button type="button" class="btn btn-outline-light btn-sm shadow-xs px-3" onclick="printDocument('printableLetterEn')">
                <i class="fas fa-print me-1"></i> Print / PDF
            </button>
        </div>
    </div>


    <!-- ========================================================================= -->
    <!-- ২. ইংরেজি দাপ্তরিক চিঠি জেনারেটর সেকশন (ENGLISH LETTER GENERATOR) -->
    <!-- ========================================================================= -->
    <div class="mb-5">

        <!-- কপি সাকসেস অ্যালার্ট (English) -->
        <div id="copyAlertEn" class="alert alert-success d-none alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle fa-lg me-2 text-success"></i> <strong>English Letter copied successfully with formatting!</strong> Paste into MS Word or Email with <b>Ctrl + V</b>.
            <button type="button" class="btn-close" onclick="document.getElementById('copyAlertEn').classList.add('d-none')"></button>
        </div>

        <!-- ইংরেজি কন্ট্রোল টুলবার -->
        <div class="card cream-card border-0 mb-4 p-3">
            <div class="row g-3 align-items-center">
                <div class="col-xl-6 col-lg-12">
                    <span class="fw-bold text-dark small me-2"><i class="fas fa-layer-group text-primary me-1"></i> English Templates:</span>
                    <span class="template-chip template-chip-en active" onclick="setTemplateEn('Official Letter')">Official Letter / Memo</span>
                    <span class="template-chip template-chip-en" onclick="setTemplateEn('Office Order')">Office Order</span>
                    <span class="template-chip template-chip-en" onclick="setTemplateEn('Leave Approval')">Leave Approval</span>
                    <span class="template-chip template-chip-en" onclick="setTemplateEn('Meeting Notice')">Meeting Notice</span>
                    <span class="template-chip template-chip-en" onclick="setTemplateEn('Show Cause')">Show Cause</span>
                </div>
                <div class="col-xl-6 col-lg-12 text-xl-end">
                    <div class="d-inline-flex align-items-center gap-2">
                        <span class="fw-semibold text-dark small"><i class="fas fa-file-alt text-primary me-1"></i> Paper:</span>
                        <select id="paperSizeSelectEn" class="form-select form-select-sm border-secondary-subtle" style="width: 130px;" onchange="onPaperSizeSelectChangeEn(this.value)">
                            <option value="paper-a4|a4" selected>A4 (Default)</option>
                            <option value="paper-letter|letter">Letter</option>
                            <option value="paper-legal|legal">Legal (Long)</option>
                            <option value="paper-a5|a5">A5 (Half)</option>
                        </select>
                        <select id="marginSelectEn" class="form-select form-select-sm border-secondary-subtle" style="width: 135px;" onchange="setMarginEn(this.value)">
                            <option value="margin-normal">Normal Margin</option>
                            <option value="margin-narrow">Compact Margin</option>
                            <option value="margin-pad-space">Pad Spacing</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- ইংরেজি ফর্ম ও লাইভ প্রিভিউ -->
        <div class="row g-4">
            
            <!-- বাম পাশ: ইংরেজি ফর্ম -->
            <div class="col-lg-5">
                <div class="card cream-card border-0 p-4 h-100">
                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                        <i class="fas fa-edit text-primary me-2"></i> Fill English Letter Details
                    </h5>

                    <form id="letterFormEn" onsubmit="event.preventDefault()">
                        <div class="accordion" id="englishFormAccordion">
                            
                            <!-- ১. ইংরেজি হেডার প্যাড -->
                            <div class="accordion-item border mb-2 rounded overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button py-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHeaderEn">
                                        <i class="fas fa-landmark text-primary me-2"></i> 1. Department Header / Pad Info
                                    </button>
                                </h2>
                                <div id="collapseHeaderEn" class="accordion-collapse collapse show">
                                    <div class="accordion-body p-3 bg-white">
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">Primary Title / Country</label>
                                            <input type="text" id="inputGovtNameEn" class="form-control form-control-sm" value="Government of the People's Republic of Bangladesh" oninput="updatePreviewEn()">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">Ministry / Department</label>
                                            <input type="text" id="inputMinistryEn" class="form-control form-control-sm" value="Ministry of Home Affairs" oninput="updatePreviewEn()">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">Office / Directorate</label>
                                            <input type="text" id="inputOfficeEn" class="form-control form-control-sm" value="Office of the Upazila Nirbahi Officer / Deputy Commissioner" oninput="updatePreviewEn()">
                                        </div>
                                        <div>
                                            <label class="form-label small fw-semibold">Website / Contact</label>
                                            <input type="text" id="inputWebsiteEn" class="form-control form-control-sm" value="www.officekormi.gov.bd" oninput="updatePreviewEn()">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ২. স্মারক ও তারিখ (English) -->
                            <div class="accordion-item border mb-2 rounded overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed py-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMemoEn">
                                        <i class="fas fa-calendar-alt text-info me-2"></i> 2. Memo No. & Date
                                    </button>
                                </h2>
                                <div id="collapseMemoEn" class="accordion-collapse collapse">
                                    <div class="accordion-body p-3 bg-white">
                                        <div class="row g-2 mb-2">
                                            <div class="col-md-5">
                                                <label class="form-label small fw-semibold">Memo Label</label>
                                                <input type="text" id="inputMemoLabelEn" class="form-control form-control-sm" value="Memo No:" oninput="updatePreviewEn()">
                                            </div>
                                            <div class="col-md-7">
                                                <label class="form-label small fw-semibold">Memo Number</label>
                                                <input type="text" id="inputMemoEn" class="form-control form-control-sm" value="05.00.0000.01.26.001" oninput="updatePreviewEn()">
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-md-5">
                                                <label class="form-label small fw-semibold">Date Label</label>
                                                <input type="text" id="inputDateLabelEn" class="form-control form-control-sm" value="Date:" oninput="updatePreviewEn()">
                                            </div>
                                            <div class="col-md-7">
                                                <label class="form-label small fw-semibold">Select Date</label>
                                                <input type="date" id="inputDateEn" class="form-control form-control-sm" onchange="updatePreviewEn()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ৩. প্রাপক (English) -->
                            <div class="accordion-item border mb-2 rounded overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed py-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRecipientEn">
                                        <i class="fas fa-user-tie text-secondary me-2"></i> 3. Recipient Info & Address
                                    </button>
                                </h2>
                                <div id="collapseRecipientEn" class="accordion-collapse collapse">
                                    <div class="accordion-body p-3 bg-white">
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">Salutation</label>
                                            <input type="text" id="inputRecipientSalutationEn" class="form-control form-control-sm" value="To," oninput="updatePreviewEn()">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">Designation & Department</label>
                                            <input type="text" id="inputRecipientEn" class="form-control form-control-sm" value="Joint Secretary (Administration), Ministry of Public Administration" oninput="updatePreviewEn()">
                                        </div>
                                        <div>
                                            <label class="form-label small fw-semibold">Address / Office</label>
                                            <input type="text" id="inputRecipientAddressEn" class="form-control form-control-sm fw-semibold" value="Bangladesh Secretariat, Dhaka." oninput="updatePreviewEn()">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ৪. বিষয় ও সূত্র (English) -->
                            <div class="accordion-item border mb-2 rounded overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed py-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSubjectEn">
                                        <i class="fas fa-bookmark text-warning me-2"></i> 4. Subject & Reference
                                    </button>
                                </h2>
                                <div id="collapseSubjectEn" class="accordion-collapse collapse">
                                    <div class="accordion-body p-3 bg-white">
                                        <div class="row g-2 mb-2">
                                            <div class="col-md-4">
                                                <label class="form-label small fw-semibold">Subject Label</label>
                                                <input type="text" id="inputSubjectLabelEn" class="form-control form-control-sm" value="Subject:" oninput="updatePreviewEn()">
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label small fw-semibold">Subject Text</label>
                                                <input type="text" id="inputSubjectEn" class="form-control form-control-sm" value="Submission of Urgent Quarterly Report on Annual Performance Agreement (APA)." oninput="updatePreviewEn()">
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-md-4">
                                                <label class="form-label small fw-semibold">Ref Label</label>
                                                <input type="text" id="inputReferenceLabelEn" class="form-control form-control-sm" value="Ref:" oninput="updatePreviewEn()">
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label small fw-semibold">Reference Text</label>
                                                <input type="text" id="inputReferenceEn" class="form-control form-control-sm" placeholder="e.g. Memo No: 05.04..." oninput="updatePreviewEn()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ৫. মূল বক্তব্য (English Rich Editor) -->
                            <div class="accordion-item border mb-2 rounded overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button py-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBodyEn">
                                        <i class="fas fa-align-left text-success me-2"></i> 5. Main Body Content
                                    </button>
                                </h2>
                                <div id="collapseBodyEn" class="accordion-collapse collapse show">
                                    <div class="accordion-body p-3 bg-white">
                                        <div class="word-toolbar d-flex flex-wrap align-items-center gap-1">
                                            <select id="fontSizeSelectEn" class="form-select form-select-sm py-0 px-1" style="width: 82px; font-size: 0.78rem; height: 26px;" onchange="applyTypographyEn()">
                                                <option value="10pt">10 pt</option>
                                                <option value="11pt">11 pt</option>
                                                <option value="12pt" selected>12 pt (Default)</option>
                                                <option value="14pt">14 pt</option>
                                                <option value="16pt">16 pt</option>
                                            </select>
                                            <select id="lineHeightSelectEn" class="form-select form-select-sm py-0 px-1" style="width: 88px; font-size: 0.78rem; height: 26px;" onchange="applyTypographyEn()">
                                                <option value="1.15">1.15</option>
                                                <option value="1.5" selected>1.5 (Standard)</option>
                                                <option value="1.75">1.75</option>
                                                <option value="2.0">2.0</option>
                                            </select>
                                            <div class="btn-group btn-group-sm" style="height: 26px;">
                                                <button type="button" class="btn btn-outline-secondary py-0 px-2 fw-bold" onclick="execRichFormatEn('bold')">B</button>
                                                <button type="button" class="btn btn-outline-secondary py-0 px-2 text-decoration-underline" onclick="execRichFormatEn('underline')">U</button>
                                                <button type="button" class="btn btn-outline-secondary py-0 px-2 fst-italic" onclick="execRichFormatEn('italic')">I</button>
                                            </div>
                                            <div class="btn-group btn-group-sm ms-auto" style="height: 26px;">
                                                <button type="button" id="alignLeftBtnEn" class="btn btn-outline-secondary py-0 px-2" onclick="setTextAlignEn('left')"><i class="fas fa-align-left"></i></button>
                                                <button type="button" id="alignJustifyBtnEn" class="btn btn-secondary py-0 px-2 active" onclick="setTextAlignEn('justify')"><i class="fas fa-align-justify"></i></button>
                                            </div>
                                        </div>
                                        <div id="inputBodyEn" contenteditable="true" class="rich-editor-box font-english" oninput="updatePreviewEn()">
                                            With reference to the subject and reference mentioned above, I am directed to submit herewith the quarterly progress report on the Annual Performance Agreement (APA) of this office for your kind perusal and necessary action.<br><br>
                                            This is submitted for your kind information and necessary record.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ৬. স্বাক্ষরকারী (English) -->
                            <div class="accordion-item border mb-2 rounded overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed py-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSignerEn">
                                        <i class="fas fa-signature text-dark me-2"></i> 6. Signatory Info
                                    </button>
                                </h2>
                                <div id="collapseSignerEn" class="accordion-collapse collapse">
                                    <div class="accordion-body p-3 bg-white">
                                        <div class="row g-2 mb-2">
                                            <div class="col-md-5">
                                                <label class="form-label small fw-semibold">Signature Status</label>
                                                <input type="text" id="inputSignStatusEn" class="form-control form-control-sm" value="[Signed]" oninput="updatePreviewEn()">
                                            </div>
                                            <div class="col-md-7">
                                                <label class="form-label small fw-semibold">Officer Name</label>
                                                <input type="text" id="inputSignerNameEn" class="form-control form-control-sm" value="Md. Rafiqul Islam" oninput="updatePreviewEn()">
                                            </div>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <label class="form-label small fw-semibold">Designation & Dept</label>
                                                <input type="text" id="inputSignerTitleEn" class="form-control form-control-sm" value="Deputy Director (Administration)" oninput="updatePreviewEn()">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small fw-semibold">Contact / Phone</label>
                                                <input type="text" id="inputSignerContactEn" class="form-control form-control-sm" value="Phone: +880-2-9999999" oninput="updatePreviewEn()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ৭. অনুলিপি (English) -->
                            <div class="accordion-item border mb-2 rounded overflow-hidden">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed py-2 small" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCopiesEn">
                                        <i class="fas fa-copy text-danger me-2"></i> 7. Copy Forwarded (To)
                                    </button>
                                </h2>
                                <div id="collapseCopiesEn" class="accordion-collapse collapse">
                                    <div class="accordion-body p-3 bg-white">
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold">Heading / Title</label>
                                            <input type="text" id="inputCopiesHeadingEn" class="form-control form-control-sm" value="Copy forwarded for kind information and necessary action to:" oninput="updatePreviewEn()">
                                        </div>
                                        <div class="word-toolbar d-flex flex-wrap align-items-center gap-1">
                                            <select id="copiesFontSizeSelectEn" class="form-select form-select-sm py-0 px-1" style="width: 82px; font-size: 0.78rem; height: 26px;" onchange="applyCopiesTypographyEn()">
                                                <option value="9pt">9 pt</option>
                                                <option value="10pt" selected>10 pt</option>
                                                <option value="11pt">11 pt</option>
                                            </select>
                                            <select id="copiesLineHeightSelectEn" class="form-select form-select-sm py-0 px-1" style="width: 88px; font-size: 0.78rem; height: 26px;" onchange="applyCopiesTypographyEn()">
                                                <option value="1.2">1.2</option>
                                                <option value="1.4" selected>1.4</option>
                                                <option value="1.6">1.6</option>
                                            </select>
                                            <div class="btn-group btn-group-sm" style="height: 26px;">
                                                <button type="button" class="btn btn-outline-secondary py-0 px-2 fw-bold" onclick="execCopiesRichFormatEn('bold')">B</button>
                                                <button type="button" class="btn btn-outline-secondary py-0 px-2 text-decoration-underline" onclick="execCopiesRichFormatEn('underline')">U</button>
                                            </div>
                                        </div>
                                        <div id="inputCopiesEn" contenteditable="true" class="rich-editor-box font-english" style="min-height: 110px; max-height: 180px;" oninput="updatePreviewEn()">
                                            1. Private Secretary to Secretary, Ministry of Public Administration.<br>
                                            2. System Analyst (with request to publish on the official website).<br>
                                            3. Office Copy / Master File.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ডান পাশ: ইংরেজি লাইভ প্রিভিউ -->
            <div class="col-lg-7">
                <div class="d-flex justify-content-between align-items-center mb-2 px-1">
                    <span class="small text-muted fw-semibold">
                        <i class="fas fa-eye me-1"></i> English Preview: <b id="currentSizeTextEn" class="text-dark">A4 Format</b>
                    </span>
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle small">Official Commonwealth Standard</span>
                </div>

                <div class="paper-viewport-wrapper">
                    <div id="printableLetterEn" class="official-letter-paper paper-a4 margin-normal font-english print-target">
                        <div class="text-center mb-4">
                            <h5 class="fw-bold mb-0 text-dark" id="previewGovtNameEn">Government of the People's Republic of Bangladesh</h5>
                            <p class="mb-0 fw-semibold small text-dark" id="previewMinistryEn">Ministry of Home Affairs</p>
                            <p class="mb-0 text-muted small" id="previewOfficeEn">Office of the Upazila Nirbahi Officer / Deputy Commissioner</p>
                            <p class="mb-0 text-muted small" id="previewWebsiteEn">www.officekormi.gov.bd</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-start border-bottom pb-2 mb-3 small">
                            <div><strong id="previewMemoLabelEn">Memo No:</strong> <span id="previewMemoEn">05.00.0000.01.26.001</span></div>
                            <div class="text-end">
                                <div><strong id="previewDateLabelEn">Date:</strong> <span id="previewDateEn"></span></div>
                            </div>
                        </div>
                        <div class="mb-3 small">
                            <div><strong id="previewRecipientSalutationEn">To,</strong></div>
                            <div id="previewRecipientEn" class="fw-semibold">Joint Secretary (Administration), Ministry of Public Administration</div>
                            <div class="text-muted" id="previewRecipientAddressEn">Bangladesh Secretariat, Dhaka.</div>
                        </div>
                        <div class="mb-3">
                            <div class="fw-bold text-dark">
                                <u><span id="previewSubjectLabelEn">Subject:</span> <span id="previewSubjectEn">Submission of Urgent Quarterly Report on Annual Performance Agreement (APA).</span></u>
                            </div>
                            <div id="previewRefContainerEn" class="small text-muted mt-1" style="display: none;">
                                <span id="previewReferenceLabelEn">Ref:</span> <span id="previewReferenceEn"></span>
                            </div>
                        </div>
                        <div id="previewBodyEn" class="mb-5" style="line-height: 1.5; font-size: 12pt; text-align: justify;"></div>
                        <div class="d-flex justify-content-end mb-4 keep-together">
                            <div class="text-center" style="min-width: 240px;">
                                <div class="text-muted fst-italic mb-1 small" id="previewSignStatusEn">[Signed]</div>
                                <div class="fw-bold text-dark" id="previewSignerNameEn">Md. Rafiqul Islam</div>
                                <div class="small text-muted" id="previewSignerTitleEn">Deputy Director (Administration)</div>
                                <div class="small text-muted" id="previewSignerContactEn">Phone: +880-2-9999999</div>
                            </div>
                        </div>
                        <div id="previewCopiesContainerEn" class="small border-top pt-3 text-muted keep-together">
                            <div class="fw-bold mb-1 text-dark" id="previewCopiesHeadingEn">Copy forwarded for kind information and necessary action to:</div>
                            <div id="previewCopiesEn" style="text-align: left; line-height: 1.4; font-size: 10pt;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    // =========================================================================
    // বাংলা সেকশন স্ক্রিপ্ট (BENGALI LOGIC)
    // =========================================================================
    let currentFontSize = '11.5pt';
    let currentLineHeight = '1.8';
    let currentTextAlign = 'justify';
    let currentCopiesFontSize = '10pt';
    let currentCopiesLineHeight = '1.6';
    let currentCopiesTextAlign = 'left';
    let isCreamTheme = true;

    function toggleCreamBackground() {
        isCreamTheme = !isCreamTheme;
        const btnText = document.getElementById('themeToggleText');
        if (isCreamTheme) {
            document.body.classList.remove('white-theme-mode');
            btnText.innerText = 'ক্রিম থিম: চালু';
        } else {
            document.body.classList.add('white-theme-mode');
            btnText.innerText = 'সাদা থিম: চালু';
        }
    }

    function onPaperSizeSelectChange(value) {
        const parts = value.split('|');
        setPaperSize(parts[0], parts[1]);
    }

    function setPaperSize(sizeClass, label) {
        const paper = document.getElementById('printableLetter');
        paper.classList.remove('paper-a4', 'paper-letter', 'paper-legal', 'paper-a5');
        paper.classList.add(sizeClass);
        document.getElementById('currentSizeText').innerText = label.toUpperCase() + ' Format';
    }

    function setMargin(marginClass) {
        const paper = document.getElementById('printableLetter');
        paper.classList.remove('margin-normal', 'margin-narrow', 'margin-pad-space');
        paper.classList.add(marginClass);
    }

    function toBanglaNumber(number) {
        const banglaDigits = {'0': '০', '1': '১', '2': '২', '3': '৩', '4': '৪', '5': '৫', '6': '৬', '7': '৭', '8': '৮', '9': '৯'};
        return String(number).replace(/[0-9]/g, char => banglaDigits[char]);
    }

    function getGregorianDateInBangla(gregorianDate) {
        const date = new Date(gregorianDate);
        const banglaMonthNames = ['জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];
        return `${toBanglaNumber(date.getDate())} ${banglaMonthNames[date.getMonth()]} ${toBanglaNumber(date.getFullYear())} খ্রি.`;
    }

    function getBangabdaDate(gregorianDate) {
        const date = new Date(gregorianDate);
        const day = date.getDate();
        const month = date.getMonth();
        const year = date.getFullYear();
        const banglaMonths = ['বৈশাখ', 'জ্যৈষ্ঠ', 'আষাঢ়', 'শ্রাবণ', 'ভাদ্র', 'আশ্বিন', 'কার্তিক', 'অগ্রহায়ণ', 'পৌষ', 'মাঘ', 'ফাল্গুন', 'চৈত্র'];
        const isLeapYear = (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
        const daysInMonths = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, isLeapYear ? 30 : 29, 30];
        let banglaYear = (month < 3 || (month === 3 && day < 14)) ? year - 594 : year - 593;
        const boishakhStart = new Date(year, 3, 14);
        let diffDays = Math.floor((date - boishakhStart) / (1000 * 60 * 60 * 24));
        if (diffDays < 0) {
            const prevBoishakh = new Date(year - 1, 3, 14);
            diffDays = Math.floor((date - prevBoishakh) / (1000 * 60 * 60 * 24));
        }
        let banglaMonthIndex = 0;
        let banglaDay = diffDays + 1;
        for (let i = 0; i < 12; i++) {
            if (banglaDay <= daysInMonths[i]) {
                banglaMonthIndex = i;
                break;
            }
            banglaDay -= daysInMonths[i];
        }
        return `${toBanglaNumber(banglaDay)} ${banglaMonths[banglaMonthIndex]} ${toBanglaNumber(banglaYear)} বঙ্গাব্দ`;
    }

    function updatePreview() {
        document.getElementById('previewGovtName').innerText = document.getElementById('inputGovtName').value || '';
        document.getElementById('previewMinistry').innerText = document.getElementById('inputMinistry').value || '';
        document.getElementById('previewOffice').innerText = document.getElementById('inputOffice').value || '';
        document.getElementById('previewWebsite').innerText = document.getElementById('inputWebsite').value || '';

        document.getElementById('previewMemoLabel').innerText = document.getElementById('inputMemoLabel').value || '';
        document.getElementById('previewMemo').innerText = document.getElementById('inputMemo').value || '';
        document.getElementById('previewDateLabel').innerText = document.getElementById('inputDateLabel').value || '';

        const inputDateVal = document.getElementById('inputDate').value;
        if (inputDateVal) {
            document.getElementById('previewDateBangla').innerText = getGregorianDateInBangla(inputDateVal);
            document.getElementById('previewBanglaDate').innerText = getBangabdaDate(inputDateVal);
        }

        document.getElementById('previewRecipientSalutation').innerText = document.getElementById('inputRecipientSalutation').value || '';
        document.getElementById('previewRecipient').innerText = document.getElementById('inputRecipient').value || '';
        document.getElementById('previewRecipientAddress').innerText = document.getElementById('inputRecipientAddress').value || '';

        document.getElementById('previewSubjectLabel').innerText = document.getElementById('inputSubjectLabel').value || '';
        document.getElementById('previewSubject').innerText = document.getElementById('inputSubject').value || '';

        const refVal = document.getElementById('inputReference').value;
        const refContainer = document.getElementById('previewRefContainer');
        if (refVal.trim() !== '') {
            refContainer.style.display = 'block';
            document.getElementById('previewReferenceLabel').innerText = document.getElementById('inputReferenceLabel').value || 'সূত্র:';
            document.getElementById('previewReference').innerText = refVal;
        } else {
            refContainer.style.display = 'none';
        }

        document.getElementById('previewBody').innerHTML = document.getElementById('inputBody').innerHTML;

        document.getElementById('previewSignStatus').innerText = document.getElementById('inputSignStatus').value || '';
        document.getElementById('previewSignerName').innerText = document.getElementById('inputSignerName').value || '';
        document.getElementById('previewSignerTitle').innerText = document.getElementById('inputSignerTitle').value || '';
        document.getElementById('previewSignerContact').innerText = document.getElementById('inputSignerContact').value || '';

        document.getElementById('previewCopiesHeading').innerText = document.getElementById('inputCopiesHeading').value || '';
        document.getElementById('previewCopies').innerHTML = document.getElementById('inputCopies').innerHTML;

        applyTypography();
        applyCopiesTypography();
    }

    function execRichFormat(command) {
        document.getElementById('inputBody').focus();
        document.execCommand(command, false, null);
        updatePreview();
    }

    function execCopiesRichFormat(command) {
        document.getElementById('inputCopies').focus();
        document.execCommand(command, false, null);
        updatePreview();
    }

    function applyTypography() {
        const bodyPreview = document.getElementById('previewBody');
        currentFontSize = document.getElementById('fontSizeSelect').value;
        currentLineHeight = document.getElementById('lineHeightSelect').value;
        bodyPreview.style.fontSize = currentFontSize;
        bodyPreview.style.lineHeight = currentLineHeight;
        bodyPreview.style.textAlign = currentTextAlign;
    }

    function applyCopiesTypography() {
        const previewCopiesEl = document.getElementById('previewCopies');
        const inputCopiesEl = document.getElementById('inputCopies');
        currentCopiesFontSize = document.getElementById('copiesFontSizeSelect').value;
        currentCopiesLineHeight = document.getElementById('copiesLineHeightSelect').value;
        if (previewCopiesEl) {
            previewCopiesEl.style.fontSize = currentCopiesFontSize;
            previewCopiesEl.style.lineHeight = currentCopiesLineHeight;
            previewCopiesEl.style.textAlign = currentCopiesTextAlign;
        }
        if (inputCopiesEl) {
            inputCopiesEl.style.fontSize = currentCopiesFontSize;
            inputCopiesEl.style.lineHeight = currentCopiesLineHeight;
        }
    }

    function setTextAlign(align) {
        currentTextAlign = align;
        ['left', 'justify'].forEach(a => {
            const btn = document.getElementById(`align${a.charAt(0).toUpperCase() + a.slice(1)}Btn`);
            if (btn) {
                if (a === align) {
                    btn.classList.replace('btn-outline-secondary', 'btn-secondary');
                    btn.classList.add('active');
                } else {
                    btn.classList.replace('btn-secondary', 'btn-outline-secondary');
                    btn.classList.remove('active');
                }
            }
        });
        applyTypography();
    }

    function setTemplate(type) {
        document.querySelectorAll('.template-chip:not(.template-chip-en)').forEach(el => el.classList.remove('active'));
        event.target.classList.add('active');
        const editor = document.getElementById('inputBody');
        const copiesEditor = document.getElementById('inputCopies');
        if (type === 'অফিস আদেশ') {
            document.getElementById('inputSubject').value = 'অফিস আদেশ: কর্মকর্তা/কর্মচারীদের দায়িত্ব পুনর্বণ্টন।';
            editor.innerHTML = 'এতদ্বারা সংশ্লিষ্ট সকলের অবগতির জন্য জানানো যাচ্ছে যে, দাপ্তরিক কাজ সুষ্ঠুভাবে পরিচালনার স্বার্থে নিম্নবর্ণিত কর্মচারীদের কর্মবণ্টন পরবর্তী নির্দেশ না দেওয়া পর্যন্ত কার্যকর করা হলো।<br><br>১. জনাব করিম - প্রশাসন ও সংস্থাপন শাখা।<br>২. জনাব রহিম - হিসাব ও অডিট শাখা।<br><br><b>এ আদেশ অবিলম্বে কার্যকর হবে।</b>';
            copiesEditor.innerHTML = '১. <b>সচিব মহোদয়</b>, জনপ্রশাসন মন্ত্রণালয়।<br>২. <b>উপপরিচালক (প্রশাসন)</b>, অত্র দপ্তর।<br>৩. অফিস কপি / মাস্টার ফাইল।';
        } else if (type === 'ছুটির আবেদন') {
            document.getElementById('inputSubject').value = 'নৈমিত্তিক/অর্জিত ছুটির আবেদন প্রসঙ্গে।';
            editor.innerHTML = 'বিনীত নিবেদন এই যে, আমার ব্যক্তিগত ও পারিবারিক জরুরি প্রয়োজনের কারণে আগামী ০১/১০/২০২৬ হতে ০৩/১০/২০২৬ তারিখ পর্যন্ত মোট ০৩ (তিন) দিনের <u>নৈমিত্তিক ছুটি</u> প্রয়োজন।<br><br>অতএব, মহোদয়ের নিকট বিনীত প্রার্থনা উক্ত ছুটির দিনগুলোর জন্য ছুটি মঞ্জুর করে বাধিত করবেন।';
            copiesEditor.innerHTML = '১. অফিস কপি / গার্ড ফাইল।';
        } else if (type === 'অফিসিয়াল নোটিশ') {
            document.getElementById('inputSubject').value = 'বিজ্ঞপ্তি: মাসিক সমন্বয় সভা অনুষ্ঠানের নোটিশ।';
            editor.innerHTML = 'এতদ্বারা অত্র দপ্তরের সকল কর্মকর্তা ও কর্মচারীকে জানানো যাচ্ছে যে, আগামী <b>২৭ সেপ্টেম্বর ২০২৬</b> তারিখ সকাল ১১.০০ ঘটিকায় সভাকক্ষে মাসিক সমন্বয় সভা অনুষ্ঠিত হবে।<br><br>উক্ত সভায় সংশ্লিষ্ট সকলকে যথাসময়ে উপস্থিত থাকার জন্য অনুরোধ করা হলো।';
            copiesEditor.innerHTML = '১. সকল শাখা প্রধান, অত্র দপ্তর।<br>২. নোটিশ বোর্ড / ওয়েবসাইট।';
        } else {
            document.getElementById('inputSubject').value = 'বার্ষিক কর্মসম্পাদন চুক্তি সংক্রান্ত জরুরি প্রতিবেদন প্রেরণ।';
            editor.innerHTML = 'উপর্যুক্ত বিষয় ও সূত্রের প্রেক্ষিতে জানানো যাচ্ছে যে, আপনার কার্যালয়ের চাহিত বার্ষিক কর্মসম্পাদন চুক্তি (APA) সংক্রান্ত ত্রৈমাসিক অগ্রগতি প্রতিবেদন পরবর্তী প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য এতদসঙ্গে প্রেরণ করা হলো।<br><br>এমতাবস্থায়, মহোদয়ের সদয় অবগতি ও পরবর্তী প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য অনুরোধ করা হলো।';
            copiesEditor.innerHTML = '১. <b>সচিব মহোদয়ের একান্ত সচিব</b>, জনপ্রশাসন মন্ত্রণালয়।<br>২. <u>সিস্টেম এনালিস্ট</u> (ওয়েবসাইটে প্রকাশের অনুরোধসহ)।<br>৩. অফিস কপি / গার্ড ফাইল।';
        }
        updatePreview();
    }

    async function copyLetterToClipboard() {
        const copyBtnText = document.getElementById('copyBtnText');
        const copyAlert = document.getElementById('copyAlert');
        const govtName = document.getElementById('inputGovtName').value || '';
        const ministry = document.getElementById('inputMinistry').value || '';
        const office = document.getElementById('inputOffice').value || '';
        const website = document.getElementById('inputWebsite').value || '';
        const memoLabel = document.getElementById('inputMemoLabel').value || 'স্মারক নং:';
        const memo = document.getElementById('inputMemo').value || '';
        const dateLabel = document.getElementById('inputDateLabel').value || 'তারিখ:';
        const dateBanglaStr = document.getElementById('previewDateBangla').innerText;
        const bangabdaDateStr = document.getElementById('previewBanglaDate').innerText;
        const salutation = document.getElementById('inputRecipientSalutation').value || 'বরাবর,';
        const recipient = document.getElementById('inputRecipient').value || '';
        const recipientAddress = document.getElementById('inputRecipientAddress').value || '';
        const subjectLabel = document.getElementById('inputSubjectLabel').value || 'বিষয়:';
        const subject = document.getElementById('inputSubject').value || '';
        const refLabel = document.getElementById('inputReferenceLabel').value || 'সূত্র:';
        const refVal = document.getElementById('inputReference').value || '';
        const bodyHtml = document.getElementById('inputBody').innerHTML;
        const signStatus = document.getElementById('inputSignStatus').value || '';
        const signerName = document.getElementById('inputSignerName').value || '';
        const signerTitle = document.getElementById('inputSignerTitle').value || '';
        const signerContact = document.getElementById('inputSignerContact').value || '';
        const copiesHeading = document.getElementById('inputCopiesHeading').value || '';
        const copiesHtml = document.getElementById('inputCopies').innerHTML;
        const refRow = (refVal.trim() !== '') ? `<div style="font-size: 11pt; color: #555; margin-top: 4px;">${refLabel} ${refVal}</div>` : '';

        const wordFriendlyHTML = `
            <div style="font-family: 'Nikosh', 'SolaimanLipi', 'Kalpurush', 'Times New Roman', Arial, sans-serif; font-size: 12pt; color: #000000; line-height: 1.6; max-width: 650px; margin: 0 auto;">
                <div style="text-align: center; margin-bottom: 25px;">
                    <div style="font-size: 15pt; font-weight: bold;">${govtName}</div>
                    <div style="font-size: 12pt; font-weight: bold; color: #222;">${ministry}</div>
                    <div style="font-size: 11pt; color: #444;">${office}</div>
                    <div style="font-size: 10pt; color: #666;">${website}</div>
                </div>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 20px; border-bottom: 1px solid #999; padding-bottom: 6px;">
                    <tr>
                        <td align="left" valign="top" style="font-size: 11pt;"><b>${memoLabel}</b> ${memo}</td>
                        <td align="right" valign="top" style="font-size: 11pt; text-align: right;"><div><b>${dateLabel}</b> ${dateBanglaStr}</div><div style="color: #444; font-size: 10pt;">${bangabdaDateStr}</div></td>
                    </tr>
                </table>
                <div style="margin-bottom: 18px; font-size: 12pt;">
                    <div><b>${salutation}</b></div>
                    <div style="font-weight: bold;">${recipient}</div>
                    <div style="color: #444;">${recipientAddress}</div>
                </div>
                <div style="margin-bottom: 18px;"><div style="font-size: 12pt; font-weight: bold;"><u>${subjectLabel} ${subject}</u></div>${refRow}</div>
                <div style="font-size: ${currentFontSize}; text-align: ${currentTextAlign}; line-height: ${currentLineHeight}; margin-bottom: 40px;">${bodyHtml}</div>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 30px;">
                    <tr><td width="60%"></td><td width="40%" align="center" style="text-align: center; font-size: 11pt;"><div style="color: #666; font-style: italic;">${signStatus}</div><div style="font-weight: bold; font-size: 12pt;">${signerName}</div><div style="color: #444;">${signerTitle}</div><div style="color: #555; font-size: 10pt;">${signerContact}</div></td></tr>
                </table>
                <div style="border-top: 1px solid #aaa; padding-top: 10px; font-size: ${currentCopiesFontSize}; line-height: ${currentCopiesLineHeight}; color: #333; text-align: ${currentCopiesTextAlign};"><div style="font-weight: bold; margin-bottom: 4px;">${copiesHeading}</div><div>${copiesHtml}</div></div>
            </div>`;

        try {
            const blobHtml = new Blob([wordFriendlyHTML], { type: 'text/html' });
            const blobText = new Blob([document.getElementById('printableLetter').innerText], { type: 'text/plain' });
            await navigator.clipboard.write([new ClipboardItem({ 'text/html': blobHtml, 'text/plain': blobText })]);
            copyBtnText.innerText = 'কপি সফল! ✓';
            copyAlert.classList.remove('d-none');
            setTimeout(() => { copyBtnText.innerText = 'MS Word / ইমেইলে হুবহু কপি'; }, 3000);
            setTimeout(() => { copyAlert.classList.add('d-none'); }, 5000);
        } catch (err) {
            navigator.clipboard.writeText(document.getElementById('printableLetter').innerText);
            copyAlert.classList.remove('d-none');
        }
    }


    // =========================================================================
    // ২. ইংরেজি সেকশন স্ক্রিপ্ট (ENGLISH SECTION LOGIC)
    // =========================================================================
    let currentFontSizeEn = '12pt';
    let currentLineHeightEn = '1.5';
    let currentTextAlignEn = 'justify';
    let currentCopiesFontSizeEn = '10pt';
    let currentCopiesLineHeightEn = '1.4';

    function onPaperSizeSelectChangeEn(value) {
        const parts = value.split('|');
        const paper = document.getElementById('printableLetterEn');
        paper.classList.remove('paper-a4', 'paper-letter', 'paper-legal', 'paper-a5');
        paper.classList.add(parts[0]);
        document.getElementById('currentSizeTextEn').innerText = parts[1].toUpperCase() + ' Format';
    }

    function setMarginEn(marginClass) {
        const paper = document.getElementById('printableLetterEn');
        paper.classList.remove('margin-normal', 'margin-narrow', 'margin-pad-space');
        paper.classList.add(marginClass);
    }

    function updatePreviewEn() {
        document.getElementById('previewGovtNameEn').innerText = document.getElementById('inputGovtNameEn').value || '';
        document.getElementById('previewMinistryEn').innerText = document.getElementById('inputMinistryEn').value || '';
        document.getElementById('previewOfficeEn').innerText = document.getElementById('inputOfficeEn').value || '';
        document.getElementById('previewWebsiteEn').innerText = document.getElementById('inputWebsiteEn').value || '';

        document.getElementById('previewMemoLabelEn').innerText = document.getElementById('inputMemoLabelEn').value || 'Memo No:';
        document.getElementById('previewMemoEn').innerText = document.getElementById('inputMemoEn').value || '';
        document.getElementById('previewDateLabelEn').innerText = document.getElementById('inputDateLabelEn').value || 'Date:';

        const inputDateValEn = document.getElementById('inputDateEn').value;
        if (inputDateValEn) {
            const dateObj = new Date(inputDateValEn);
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            document.getElementById('previewDateEn').innerText = dateObj.toLocaleDateString('en-GB', options);
        }

        document.getElementById('previewRecipientSalutationEn').innerText = document.getElementById('inputRecipientSalutationEn').value || 'To,';
        document.getElementById('previewRecipientEn').innerText = document.getElementById('inputRecipientEn').value || '';
        document.getElementById('previewRecipientAddressEn').innerText = document.getElementById('inputRecipientAddressEn').value || '';

        document.getElementById('previewSubjectLabelEn').innerText = document.getElementById('inputSubjectLabelEn').value || 'Subject:';
        document.getElementById('previewSubjectEn').innerText = document.getElementById('inputSubjectEn').value || '';

        const refValEn = document.getElementById('inputReferenceEn').value;
        const refContainerEn = document.getElementById('previewRefContainerEn');
        if (refValEn.trim() !== '') {
            refContainerEn.style.display = 'block';
            document.getElementById('previewReferenceLabelEn').innerText = document.getElementById('inputReferenceLabelEn').value || 'Ref:';
            document.getElementById('previewReferenceEn').innerText = refValEn;
        } else {
            refContainerEn.style.display = 'none';
        }

        document.getElementById('previewBodyEn').innerHTML = document.getElementById('inputBodyEn').innerHTML;

        document.getElementById('previewSignStatusEn').innerText = document.getElementById('inputSignStatusEn').value || '';
        document.getElementById('previewSignerNameEn').innerText = document.getElementById('inputSignerNameEn').value || '';
        document.getElementById('previewSignerTitleEn').innerText = document.getElementById('inputSignerTitleEn').value || '';
        document.getElementById('previewSignerContactEn').innerText = document.getElementById('inputSignerContactEn').value || '';

        document.getElementById('previewCopiesHeadingEn').innerText = document.getElementById('inputCopiesHeadingEn').value || '';
        document.getElementById('previewCopiesEn').innerHTML = document.getElementById('inputCopiesEn').innerHTML;

        applyTypographyEn();
        applyCopiesTypographyEn();
    }

    function execRichFormatEn(command) {
        document.getElementById('inputBodyEn').focus();
        document.execCommand(command, false, null);
        updatePreviewEn();
    }

    function execCopiesRichFormatEn(command) {
        document.getElementById('inputCopiesEn').focus();
        document.execCommand(command, false, null);
        updatePreviewEn();
    }

    function applyTypographyEn() {
        const bodyPreview = document.getElementById('previewBodyEn');
        currentFontSizeEn = document.getElementById('fontSizeSelectEn').value;
        currentLineHeightEn = document.getElementById('lineHeightSelectEn').value;
        bodyPreview.style.fontSize = currentFontSizeEn;
        bodyPreview.style.lineHeight = currentLineHeightEn;
        bodyPreview.style.textAlign = currentTextAlignEn;
    }

    function applyCopiesTypographyEn() {
        const previewCopiesEl = document.getElementById('previewCopiesEn');
        const inputCopiesEl = document.getElementById('inputCopiesEn');
        currentCopiesFontSizeEn = document.getElementById('copiesFontSizeSelectEn').value;
        currentCopiesLineHeightEn = document.getElementById('copiesLineHeightSelectEn').value;
        if (previewCopiesEl) {
            previewCopiesEl.style.fontSize = currentCopiesFontSizeEn;
            previewCopiesEl.style.lineHeight = currentCopiesLineHeightEn;
        }
        if (inputCopiesEl) {
            inputCopiesEl.style.fontSize = currentCopiesFontSizeEn;
            inputCopiesEl.style.lineHeight = currentCopiesLineHeightEn;
        }
    }

    function setTextAlignEn(align) {
        currentTextAlignEn = align;
        ['left', 'justify'].forEach(a => {
            const btn = document.getElementById(`align${a.charAt(0).toUpperCase() + a.slice(1)}BtnEn`);
            if (btn) {
                if (a === align) {
                    btn.classList.replace('btn-outline-secondary', 'btn-secondary');
                    btn.classList.add('active');
                } else {
                    btn.classList.replace('btn-secondary', 'btn-outline-secondary');
                    btn.classList.remove('active');
                }
            }
        });
        applyTypographyEn();
    }

    function setTemplateEn(type) {
        document.querySelectorAll('.template-chip-en').forEach(el => el.classList.remove('active'));
        event.target.classList.add('active');
        const editor = document.getElementById('inputBodyEn');
        const copiesEditor = document.getElementById('inputCopiesEn');

        if (type === 'Office Order') {
            document.getElementById('inputSubjectEn').value = 'Office Order: Redistribution of Duties and Responsibilities.';
            editor.innerHTML = 'For smooth functioning of official duties, the responsibilities of the following officials have been rearranged until further notice:<br><br>1. Mr. A - Administration Branch.<br>2. Mr. B - Accounts & Audit Branch.<br><br><b>This order shall take effect immediately.</b>';
            copiesEditor.innerHTML = '1. <b>Secretary</b>, Ministry of Public Administration.<br>2. <b>Deputy Director</b>, Administration.<br>3. Office Copy / Master File.';
        } else if (type === 'Leave Approval') {
            document.getElementById('inputSubjectEn').value = 'Grant of Casual/Earned Leave.';
            editor.innerHTML = 'With reference to the application dated 20/09/2026, sanction is hereby accorded for 03 (three) days casual leave with permission to leave station.<br><br>This order is issued with the approval of the competent authority.';
            copiesEditor.innerHTML = '1. Accounts Officer.<br>2. Personal File / Office Copy.';
        } else if (type === 'Meeting Notice') {
            document.getElementById('inputSubjectEn').value = 'Notice: Monthly Coordination Meeting.';
            editor.innerHTML = 'This is to inform all concerned that the Monthly Coordination Meeting will be held on <b>28 September 2026</b> at 11:00 AM in the Conference Room.<br><br>All concerned officers are requested to attend the meeting on time.';
            copiesEditor.innerHTML = '1. All Section Heads.<br>2. Notice Board / Website.';
        } else {
            document.getElementById('inputSubjectEn').value = 'Submission of Urgent Quarterly Report on Annual Performance Agreement (APA).';
            editor.innerHTML = 'With reference to the subject and reference mentioned above, I am directed to submit herewith the quarterly progress report on the Annual Performance Agreement (APA) of this office for your kind perusal and necessary action.<br><br>This is submitted for your kind information and necessary record.';
            copiesEditor.innerHTML = '1. <b>Private Secretary to Secretary</b>, Ministry of Public Administration.<br>2. <u>System Analyst</u> (with request to publish on the website).<br>3. Office Copy / Master File.';
        }
        updatePreviewEn();
    }

    async function copyLetterToClipboardEn() {
        const copyBtnText = document.getElementById('copyBtnTextEn');
        const copyAlert = document.getElementById('copyAlertEn');
        const govtName = document.getElementById('inputGovtNameEn').value || '';
        const ministry = document.getElementById('inputMinistryEn').value || '';
        const office = document.getElementById('inputOfficeEn').value || '';
        const website = document.getElementById('inputWebsiteEn').value || '';
        const memoLabel = document.getElementById('inputMemoLabelEn').value || 'Memo No:';
        const memo = document.getElementById('inputMemoEn').value || '';
        const dateLabel = document.getElementById('inputDateLabelEn').value || 'Date:';
        const dateStr = document.getElementById('previewDateEn').innerText;
        const salutation = document.getElementById('inputRecipientSalutationEn').value || 'To,';
        const recipient = document.getElementById('inputRecipientEn').value || '';
        const recipientAddress = document.getElementById('inputRecipientAddressEn').value || '';
        const subjectLabel = document.getElementById('inputSubjectLabelEn').value || 'Subject:';
        const subject = document.getElementById('inputSubjectEn').value || '';
        const refLabel = document.getElementById('inputReferenceLabelEn').value || 'Ref:';
        const refVal = document.getElementById('inputReferenceEn').value || '';
        const bodyHtml = document.getElementById('inputBodyEn').innerHTML;
        const signStatus = document.getElementById('inputSignStatusEn').value || '';
        const signerName = document.getElementById('inputSignerNameEn').value || '';
        const signerTitle = document.getElementById('inputSignerTitleEn').value || '';
        const signerContact = document.getElementById('inputSignerContactEn').value || '';
        const copiesHeading = document.getElementById('inputCopiesHeadingEn').value || '';
        const copiesHtml = document.getElementById('inputCopiesEn').innerHTML;
        const refRow = (refVal.trim() !== '') ? `<div style="font-size: 11pt; color: #555; margin-top: 4px;">${refLabel} ${refVal}</div>` : '';

        const wordFriendlyHTML = `
            <div style="font-family: 'Times New Roman', 'Calibri', Arial, sans-serif; font-size: 12pt; color: #000000; line-height: 1.5; max-width: 650px; margin: 0 auto;">
                <div style="text-align: center; margin-bottom: 25px;">
                    <div style="font-size: 14pt; font-weight: bold;">${govtName}</div>
                    <div style="font-size: 12pt; font-weight: bold; color: #222;">${ministry}</div>
                    <div style="font-size: 11pt; color: #444;">${office}</div>
                    <div style="font-size: 10pt; color: #666;">${website}</div>
                </div>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 20px; border-bottom: 1px solid #999; padding-bottom: 6px;">
                    <tr>
                        <td align="left" valign="top" style="font-size: 11pt;"><b>${memoLabel}</b> ${memo}</td>
                        <td align="right" valign="top" style="font-size: 11pt; text-align: right;"><div><b>${dateLabel}</b> ${dateStr}</div></td>
                    </tr>
                </table>
                <div style="margin-bottom: 18px; font-size: 12pt;">
                    <div><b>${salutation}</b></div>
                    <div style="font-weight: bold;">${recipient}</div>
                    <div style="color: #444;">${recipientAddress}</div>
                </div>
                <div style="margin-bottom: 18px;"><div style="font-size: 12pt; font-weight: bold;"><u>${subjectLabel} ${subject}</u></div>${refRow}</div>
                <div style="font-size: ${currentFontSizeEn}; text-align: ${currentTextAlignEn}; line-height: ${currentLineHeightEn}; margin-bottom: 40px;">${bodyHtml}</div>
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 30px;">
                    <tr><td width="60%"></td><td width="40%" align="center" style="text-align: center; font-size: 11pt;"><div style="color: #666; font-style: italic;">${signStatus}</div><div style="font-weight: bold; font-size: 12pt;">${signerName}</div><div style="color: #444;">${signerTitle}</div><div style="color: #555; font-size: 10pt;">${signerContact}</div></td></tr>
                </table>
                <div style="border-top: 1px solid #aaa; padding-top: 10px; font-size: ${currentCopiesFontSizeEn}; line-height: ${currentCopiesLineHeightEn}; color: #333;"><div style="font-weight: bold; margin-bottom: 4px;">${copiesHeading}</div><div>${copiesHtml}</div></div>
            </div>`;

        try {
            const blobHtml = new Blob([wordFriendlyHTML], { type: 'text/html' });
            const blobText = new Blob([document.getElementById('printableLetterEn').innerText], { type: 'text/plain' });
            await navigator.clipboard.write([new ClipboardItem({ 'text/html': blobHtml, 'text/plain': blobText })]);
            copyBtnText.innerText = 'Copied! ✓';
            copyAlert.classList.remove('d-none');
            setTimeout(() => { copyBtnText.innerText = 'Copy to Word (English)'; }, 3000);
            setTimeout(() => { copyAlert.classList.add('d-none'); }, 5000);
        } catch (err) {
            navigator.clipboard.writeText(document.getElementById('printableLetterEn').innerText);
            copyAlert.classList.remove('d-none');
        }
    }

    // প্রিন্ট ফাংশন (যেকোনো একটি নির্দিষ্ট সেকশন প্রিন্ট করার জন্য)
    function printDocument(elementId) {
        document.querySelectorAll('.official-letter-paper').forEach(el => el.classList.remove('print-target'));
        document.getElementById(elementId).classList.add('print-target');
        window.print();
    }

    // পেজ লোড হলে দুটি সেকশনেরই আজকের তারিখ ও প্রিভিউ চালু করা
    document.addEventListener('DOMContentLoaded', function () {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('inputDate').value = today;
        document.getElementById('inputDateEn').value = today;
        updatePreview();
        updatePreviewEn();
    });
</script>
@endpush