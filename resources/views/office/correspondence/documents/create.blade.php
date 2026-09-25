@extends('layouts.app')

@push('styles')
<style>
    /* প্রিমিয়াম ক্রিম / আইভরি কালার প্যালেট */
    :root {
        --cream-bg: #fbf7ee;          /* নরম আভিজাত্যপূর্ণ ক্রিম ব্যাকগ্রাউন্ড */
        --cream-card: #fdfaf3;        /* কার্ড ব্যাকগ্রাউন্ড */
        --cream-border: #ece3d2;      /* ক্রিম বর্ডার */
        --govt-green: #065f46;        /* অফিসিয়াল ডিপ গ্রিন */
    }

    body {
        background-color: var(--cream-bg) !important;
    }

    /* স্মুথ ফেড-ইন অ্যানিমেশন */
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
    }

    /* সরকারি লেটারহেড প্যাড প্রিভিউ পেপার (ডায়নামিক A4 সাইজ) */
    .official-letter-paper {
        background: #ffffff;
        border: 1px solid #e2d9c8;
        box-shadow: 0 10px 30px rgba(70, 50, 20, 0.08);
        border-radius: 4px;
        min-height: 900px;
        height: auto;
        padding: 60px 50px;
        font-family: 'SolaimanLipi', 'Kalpurush', 'Nikosh', 'Arial', sans-serif;
        color: #1a1a1a;
        position: relative;
        transition: all 0.3s ease;
    }

    /* টেমপ্লেট ব্যাজ বাটন */
    .template-chip {
        cursor: pointer;
        padding: 6px 14px;
        border-radius: 20px;
        border: 1px solid var(--cream-border);
        background: #ffffff;
        font-size: 0.85rem;
        transition: all 0.2s ease;
        display: inline-block;
    }

    .template-chip:hover, .template-chip.active {
        background: var(--govt-green);
        color: #ffffff;
        border-color: var(--govt-green);
        transform: translateY(-2px);
    }

    /* প্রিন্ট ও পেজ-ব্রেক হ্যান্ডলিং */
    @media print {
        body * {
            visibility: hidden;
        }
        #printableLetter, #printableLetter * {
            visibility: visible;
        }
        #printableLetter {
            position: absolute;
            left: 0;
            top: 0;
            width: 100% !important;
            padding: 30px 40px !important;
            margin: 0 !important;
            box-shadow: none !important;
            border: none !important;
        }

        .keep-together {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        @page {
            size: A4 portrait;
            margin: 20mm 15mm 20mm 15mm;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-3 animate-fade-in">

    <!-- ব্রেডক্রাম্ব ও অ্যাকশন বার -->
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

        <div class="d-flex gap-2">
            <a href="{{ route('office.correspondence.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> ফিরে যান
            </a>
            <!-- হুবহু কপি বাটন -->
            <button type="button" id="copyBtn" class="btn btn-outline-primary" onclick="copyLetterToClipboard()">
                <i class="fas fa-copy me-1"></i> <span id="copyBtnText">হুবহু কপি করুন</span>
            </button>
            <button type="button" class="btn btn-success shadow-xs px-3" onclick="window.print()">
                <i class="fas fa-print me-1"></i> প্রিন্ট / PDF
            </button>
        </div>
    </div>

    <!-- কপি সাকসেস ফ্লোটিং অ্যালার্ট -->
    <div id="copyAlert" class="alert alert-success d-none alert-dismissible fade show shadow-sm" role="alert">
        <i class="fas fa-check-double me-2"></i> <strong>সফলভাবে কপি হয়েছে!</strong> লেটারহেড প্যাডের পুরো চিঠি ফরম্যাটিং সহ কপি হয়েছে। এটি আপনি সরাসরি <b>MS Word, ইমেইল বা নোটে পেস্ট (Ctrl + V)</b> করতে পারবেন।
        <button type="button" class="btn-close" onclick="document.getElementById('copyAlert').classList.add('d-none')"></button>
    </div>

    <!-- টেমপ্লেট নির্বাচন সেকশন -->
    <div class="card cream-card border-0 mb-4 p-3">
        <div class="d-flex flex-wrap align-items-center gap-2">
            <span class="fw-bold text-dark small me-2"><i class="fas fa-layer-group text-warning me-1"></i> টেমপ্লেট নির্বাচন করুন:</span>
            <span class="template-chip active" onclick="setTemplate('সরকারি পত্র')">সরকারি পত্র / স্মারক</span>
            <span class="template-chip" onclick="setTemplate('অফিস আদেশ')">অফিস আদেশ</span>
            <span class="template-chip" onclick="setTemplate('ছুটির আবেদন')">ছুটির আবেদন / মঞ্জুরি</span>
            <span class="template-chip" onclick="setTemplate('অফিসিয়াল নোটিশ')">অফিস নোটিশ</span>
            <span class="template-chip" onclick="setTemplate('কারণ দর্শানোর নোটিশ')">শোকজ নোটিশ</span>
        </div>
    </div>

    <!-- মূল ওয়ার্কস্পেস -->
    <div class="row g-4">

        <!-- বাম পাশ: চিঠি এডিটর ফর্ম -->
        <div class="col-lg-5">
            <div class="card cream-card border-0 p-4 h-100">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                    <h5 class="fw-bold text-dark mb-0">
                        <i class="fas fa-edit text-success me-2"></i> চিঠির তথ্য পূরণ করুন
                    </h5>
                    <!-- ফন্ট সাইজ কন্ট্রোলার -->
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-outline-secondary" onclick="changeFontSize('small')" title="ফন্ট ছোট করুন">A-</button>
                        <button type="button" class="btn btn-outline-secondary active" onclick="changeFontSize('normal')" title="স্বাভাবিক ফন্ট">A</button>
                        <button type="button" class="btn btn-outline-secondary" onclick="changeFontSize('large')" title="ফন্ট বড় করুন">A+</button>
                    </div>
                </div>

                <form id="letterForm">
                    <!-- স্মারক ও তারিখ -->
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">স্মারক নম্বর</label>
                            <input type="text" id="inputMemo" class="form-control form-control-sm" value="০৫.০০.০০০০.০১.২৬.০০১" oninput="updatePreview()">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">তারিখ নির্বাচন করুন</label>
                            <input type="date" id="inputDate" class="form-control form-control-sm" onchange="updatePreview()">
                        </div>
                    </div>

                    <!-- প্রাপকের তথ্য -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">প্রাপক / পদবি ও দপ্তর</label>
                        <input type="text" id="inputRecipient" class="form-control form-control-sm" value="যুগ্মসচিব (প্রশাসন), জনপ্রশাসন মন্ত্রণালয়" placeholder="কার বরাবরে চিঠি যাবে..." oninput="updatePreview()">
                    </div>

                    <!-- বিষয় ও সূত্র -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">বিষয়</label>
                        <input type="text" id="inputSubject" class="form-control form-control-sm" value="বার্ষিক কর্মসম্পাদন চুক্তি সংক্রান্ত জরুরি প্রতিবেদন প্রেরণ।" oninput="updatePreview()">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">সূত্র (যদি থাকে)</label>
                        <input type="text" id="inputReference" class="form-control form-control-sm" placeholder="যেমন: স্মারক নং- ০৫.০৪... তারিখ: ১২/০১/২০২৬" oninput="updatePreview()">
                    </div>

                    <!-- মূল বক্তব্য -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">মূল বক্তব্য (চিঠির বডি)</label>
                        <textarea id="inputBody" rows="7" class="form-control form-control-sm" oninput="updatePreview()">উপর্যুক্ত বিষয় ও সূত্রের প্রেক্ষিতে জানানো যাচ্ছে যে, আপনার কার্যালয়ের চাহিত বার্ষিক কর্মসম্পাদন চুক্তি (APA) সংক্রান্ত ত্রৈমাসিক অগ্রগতি প্রতিবেদন পরবর্তী প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য এতদসঙ্গে প্রেরণ করা হলো।&#10;&#10;এমতাবস্থায়, মহোদয়ের সদয় অবগতি ও পরবর্তী প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য অনুরোধ করা হলো।</textarea>
                    </div>

                    <!-- স্বাক্ষরকারীর তথ্য -->
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">স্বাক্ষরকারীর নাম</label>
                            <input type="text" id="inputSignerName" class="form-control form-control-sm" value="মোঃ রফিকুল ইসলাম" oninput="updatePreview()">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">পদবি ও দপ্তর</label>
                            <input type="text" id="inputSignerTitle" class="form-control form-control-sm" value="উপপরিচালক (প্রশাসন)" oninput="updatePreview()">
                        </div>
                    </div>

                    <!-- অনুলিপি -->
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">অনুলিপি / সদয় অবগতি (প্রতি লাইনে একটি)</label>
                        <textarea id="inputCopies" rows="3" class="form-control form-control-sm" oninput="updatePreview()">১. সচিব মহোদয়ের একান্ত সচিব, জনপ্রশাসন মন্ত্রণালয়।&#10;২. সিস্টেম এনালিস্ট (ওয়েবসাইটে প্রকাশের অনুরোধসহ)।&#10;৩. অফিস কপি / গার্ড ফাইল।</textarea>
                    </div>
                </form>
            </div>
        </div>

        <!-- ডান পাশ: লাইভ অফিশিয়াল লেটারহেড প্যাড প্রিভিউ -->
        <div class="col-lg-7">
            <div class="d-flex justify-content-between align-items-center mb-2 px-1">
                <span class="small text-muted fw-semibold"><i class="fas fa-eye me-1"></i> লাইভ প্যাড প্রিভিউ (A4 Format)</span>
                <span class="badge bg-success-subtle text-success border border-success-subtle small">অফিশিয়াল ফরমেট রেডি</span>
            </div>

            <!-- প্রিভিউ পেপার কার্ড -->
            <div id="printableLetter" class="official-letter-paper">
                
                <!-- হেডার ও গণপ্রজাতন্ত্রী বাংলাদেশ সরকার মনোগ্রাম -->
                <div class="text-center mb-4">
                    <div class="mb-1">
                        <span class="badge rounded-circle p-2 bg-success text-white" style="width: 42px; height: 42px; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="fas fa-landmark fs-5"></i>
                        </span>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h5>
                    <p class="mb-0 text-muted small">উপজেলা নির্বাহী অফিসারের কার্যালয় / জেলা প্রশাসন</p>
                    <p class="mb-0 text-muted small">www.officekormi.gov.bd</p>
                </div>

                <!-- স্মারক ও তারিখ সেকশন -->
                <div class="d-flex justify-content-between align-items-start border-bottom pb-2 mb-3 small">
                    <div>
                        <strong>স্মারক নং:</strong> <span id="previewMemo">০৫.০০.০০০০.০১.২৬.০০১</span>
                    </div>
                    <div class="text-end">
                        <div><strong>তারিখ:</strong> <span id="previewDate"></span></div>
                        <div class="text-muted fw-semibold" id="previewBanglaDate">স্বয়ংক্রিয় বাংলা তারিখ লোড হচ্ছে...</div>
                    </div>
                </div>

                <!-- প্রাপক -->
                <div class="mb-3 small">
                    <div><strong>বরাবর,</strong></div>
                    <div id="previewRecipient" class="fw-semibold">যুগ্মসচিব (প্রশাসন), জনপ্রশাসন মন্ত্রণালয়</div>
                    <div class="text-muted">বাংলাদেশ সচিবালয়, ঢাকা।</div>
                </div>

                <!-- বিষয় ও সূত্র -->
                <div class="mb-3">
                    <div class="fw-bold text-dark">
                        <u>বিষয়: <span id="previewSubject">বার্ষিক কর্মসম্পাদন চুক্তি সংক্রান্ত জরুরি প্রতিবেদন প্রেরণ।</span></u>
                    </div>
                    <div id="previewRefContainer" class="small text-muted mt-1" style="display: none;">
                        সূত্র: <span id="previewReference"></span>
                    </div>
                </div>

                <!-- মূল বক্তব্য -->
                <div id="previewBody" class="mb-5" style="line-height: 1.8; text-align: justify; white-space: pre-line; font-size: 15px;">
                    উপর্যুক্ত বিষয় ও সূত্রের প্রেক্ষিতে জানানো যাচ্ছে যে, আপনার কার্যালয়ের চাহিত বার্ষিক কর্মসম্পাদন চুক্তি (APA) সংক্রান্ত ত্রৈমাসিক অগ্রগতি প্রতিবেদন পরবর্তী প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য এতদসঙ্গে প্রেরণ করা হলো।

                    এমতাবস্থায়, মহোদয়ের সদয় অবগতি ও পরবর্তী প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য অনুরোধ করা হলো।
                </div>

                <!-- স্বাক্ষর সেকশন -->
                <div class="d-flex justify-content-end mb-4 keep-together">
                    <div class="text-center" style="min-width: 220px;">
                        <div class="text-muted fst-italic mb-1 small">[স্বাক্ষরিত]</div>
                        <div class="fw-bold text-dark" id="previewSignerName">মোঃ রফিকুল ইসলাম</div>
                        <div class="small text-muted" id="previewSignerTitle">উপপরিচালক (প্রশাসন)</div>
                        <div class="small text-muted">ফোন: ০২-৯৯৯৯৯৯৯</div>
                    </div>
                </div>

                <!-- অনুলিপি সেকশন -->
                <div id="previewCopiesContainer" class="small border-top pt-3 text-muted keep-together">
                    <div class="fw-bold mb-1 text-dark">সদয় অবগতি ও কার্যার্থে অনুলিপি প্রেরণ করা হলো:</div>
                    <div id="previewCopies" style="white-space: pre-line;">
                        ১. সচিব মহোদয়ের একান্ত সচিব, জনপ্রশাসন মন্ত্রণালয়।
                        ২. সিস্টেম এনালিস্ট (ওয়েবসাইটে প্রকাশের অনুরোধসহ)।
                        ৩. অফিস কপি / গার্ড ফাইল।
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    // ১. ইংরেজি সংখ্যাকে বাংলা সংখ্যায় রূপান্তর
    function toBanglaNumber(number) {
        const banglaDigits = {'0': '০', '1': '১', '2': '২', '3': '৩', '4': '৪', '5': '৫', '6': '৬', '7': '৭', '8': '৮', '9': '৯'};
        return String(number).replace(/[0-9]/g, char => banglaDigits[char]);
    }

    // ২. সরকারি বাংলা একাডেমি ক্যালেন্ডার অনুযায়ী খ্রিস্টাব্দ থেকে বঙ্গাব্দ কনভার্টার
    function getBanglaDate(gregorianDate) {
        const date = new Date(gregorianDate);
        const day = date.getDate();
        const month = date.getMonth();
        const year = date.getFullYear();

        const banglaMonths = [
            'বৈশাখ', 'জ্যৈষ্ঠ', 'আষাঢ়', 'শ্রাবণ', 'ভাদ্র', 'আশ্বিন',
            'কার্তিক', 'অগ্রহায়ণ', 'পৌষ', 'মাঘ', 'ফাল্গুন', 'চৈত্র'
        ];

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

    // ৩. লাইভ প্রিভিউ আপডেট করার ফাংশন
    function updatePreview() {
        document.getElementById('previewMemo').innerText = document.getElementById('inputMemo').value || '---';
        document.getElementById('previewRecipient').innerText = document.getElementById('inputRecipient').value || '---';
        document.getElementById('previewSubject').innerText = document.getElementById('inputSubject').value || '---';
        document.getElementById('previewBody').innerText = document.getElementById('inputBody').value || '---';
        document.getElementById('previewSignerName').innerText = document.getElementById('inputSignerName').value || '---';
        document.getElementById('previewSignerTitle').innerText = document.getElementById('inputSignerTitle').value || '---';

        // তারিখ এবং অটোমেটিক বাংলা তারিখ হ্যান্ডলিং
        const inputDateVal = document.getElementById('inputDate').value;
        if (inputDateVal) {
            const d = new Date(inputDateVal);
            const options = { day: '2-digit', month: 'short', year: 'numeric' };
            document.getElementById('previewDate').innerText = d.toLocaleDateString('en-GB', options);
            document.getElementById('previewBanglaDate').innerText = getBanglaDate(inputDateVal);
        }

        // সূত্র হ্যান্ডলিং
        const refVal = document.getElementById('inputReference').value;
        const refContainer = document.getElementById('previewRefContainer');
        if (refVal.trim() !== '') {
            refContainer.style.display = 'block';
            document.getElementById('previewReference').innerText = refVal;
        } else {
            refContainer.style.display = 'none';
        }

        // অনুলিপি হ্যান্ডলিং
        document.getElementById('previewCopies').innerText = document.getElementById('inputCopies').value || '';
    }

    // ৪. লেখার সাইজ অ্যাডজাস্টার
    function changeFontSize(size) {
        const bodyEl = document.getElementById('previewBody');
        document.querySelectorAll('.btn-group button').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        if (size === 'small') {
            bodyEl.style.fontSize = '13.5px';
            bodyEl.style.lineHeight = '1.6';
        } else if (size === 'large') {
            bodyEl.style.fontSize = '16.5px';
            bodyEl.style.lineHeight = '1.9';
        } else {
            bodyEl.style.fontSize = '15px';
            bodyEl.style.lineHeight = '1.8';
        }
    }

    // ৫. পেজ লোড হলে আজকের তারিখ ও স্বয়ংক্রিয় বাংলা তারিখ বসানো
    document.addEventListener('DOMContentLoaded', function () {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('inputDate').value = today;
        updatePreview();
    });

    // ৬. টেমপ্লেট পরিবর্তন
    function setTemplate(type) {
        document.querySelectorAll('.template-chip').forEach(el => el.classList.remove('active'));
        event.target.classList.add('active');

        if (type === 'অফিস আদেশ') {
            document.getElementById('inputSubject').value = 'অফিস আদেশ: কর্মকর্তা/কর্মচারীদের দায়িত্ব পুনর্বণ্টন।';
            document.getElementById('inputBody').value = 'এতদ্বারা সংশ্লিষ্ট সকলের অবগতির জন্য জানানো যাচ্ছে যে, দাপ্তরিক কাজ সুষ্ঠুভাবে পরিচালনার স্বার্থে নিম্নবর্ণিত কর্মচারীদের কর্মবণ্টন পরবর্তী নির্দেশ না দেওয়া পর্যন্ত কার্যকর করা হলো।\n\n১. জনাব করিম - প্রশাসন ও সংস্থাপন শাখা।\n২. জনাব রহিম - হিসাব ও অডিট শাখা।\n\nএ আদেশ অবিলম্বে কার্যকর হবে।';
        } else if (type === 'ছুটির আবেদন') {
            document.getElementById('inputSubject').value = 'নৈমিত্তিক/অর্জিত ছুটির আবেদন প্রসঙ্গে।';
            document.getElementById('inputBody').value = 'বিনীত নিবেদন এই যে, আমার ব্যক্তিগত ও পারিবারিক জরুরি প্রয়োজনের কারণে আগামী ০১/১০/২০২৬ হতে ০৩/১০/২০২৬ তারিখ পর্যন্ত মোট ০৩ (তিন) দিনের নৈমিত্তিক ছুটি প্রয়োজন।\n\nঅতএব, মহোদয়ের নিকট বিনীত প্রার্থনা উক্ত ছুটির দিনগুলোর জন্য ছুটি মঞ্জুর করে বাধিত করবেন।';
        } else if (type === 'অফিসিয়াল নোটিশ') {
            document.getElementById('inputSubject').value = 'বিজ্ঞপ্তি: মাসিক সমন্বয় সভা অনুষ্ঠানের নোটিশ।';
            document.getElementById('inputBody').value = 'এতদ্বারা অত্র দপ্তরের সকল কর্মকর্তা ও কর্মচারীকে জানানো যাচ্ছে যে, আগামী ২৭/০৯/২০২৬ তারিখ সকাল ১১.০০ ঘটিকায় সভাকক্ষে মাসিক সমন্বয় সভা অনুষ্ঠিত হবে।\n\nউক্ত সভায় সংশ্লিষ্ট সকলকে যথাসময়ে উপস্থিত থাকার জন্য অনুরোধ করা হলো।';
        } else {
            document.getElementById('inputSubject').value = 'বার্ষিক কর্মসম্পাদন চুক্তি সংক্রান্ত জরুরি প্রতিবেদন প্রেরণ।';
            document.getElementById('inputBody').value = 'উপর্যুক্ত বিষয় ও সূত্রের প্রেক্ষিতে জানানো যাচ্ছে যে, আপনার কার্যালয়ের চাহিত বার্ষিক কর্মসম্পাদন চুক্তি (APA) সংক্রান্ত ত্রৈমাসিক অগ্রগতি প্রতিবেদন পরবর্তী প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য এতদসঙ্গে প্রেরণ করা হলো।\n\nএমতাবস্থায়, মহোদয়ের সদয় অবগতি ও পরবর্তী প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য অনুরোধ করা হলো।';
        }
        updatePreview();
    }

    // ৭. হুবহু লেটারহেড প্যাড ক্লিপবোর্ডে কপি করার মূল ফাংশন (Rich Text / Full HTML)
    async function copyLetterToClipboard() {
        const letterElement = document.getElementById('printableLetter');
        const copyBtnText = document.getElementById('copyBtnText');
        const copyAlert = document.getElementById('copyAlert');

        try {
            // পুরো লেটারহেড প্যাডের HTML এবং প্লেইন টেক্সট প্রস্তুত করা
            const htmlContent = letterElement.innerHTML;
            const textContent = letterElement.innerText;

            // আধুনিক Clipboard API দিয়ে ফরম্যাটিং সহ কপি করা
            const blobHtml = new Blob([htmlContent], { type: 'text/html' });
            const blobText = new Blob([textContent], { type: 'text/plain' });
            
            const clipboardItem = new ClipboardItem({
                'text/html': blobHtml,
                'text/plain': blobText
            });

            await navigator.clipboard.write([clipboardItem]);

            // সফল হলে বাটনে ও স্ক্রিনে ভিজ্যুয়াল ফিডব্যাক
            copyBtnText.innerText = 'কপি হয়েছে! ✓';
            document.getElementById('copyBtn').classList.replace('btn-outline-primary', 'btn-primary');
            copyAlert.classList.remove('d-none');

            // ৩ সেকেন্ড পর বাটন আগের অবস্থায় ফিরে আসবে
            setTimeout(() => {
                copyBtnText.innerText = 'হুবহু কপি করুন';
                document.getElementById('copyBtn').classList.replace('btn-primary', 'btn-outline-primary');
            }, 3000);

            // ৫ সেকেন্ড পর অ্যালার্ট নিজে থেকেই অদৃশ্য হবে
            setTimeout(() => {
                copyAlert.classList.add('d-none');
            }, 5000);

        } catch (err) {
            console.error('Copy failed: ', err);
            // ব্রাউজার যদি কোনো কারণে ClipboardItem ব্লক করে, তবে ফলব্যাক কপি পদ্ধতি
            const range = document.createRange();
            range.selectNode(letterElement);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand('copy');
            window.getSelection().removeAllRanges();

            copyBtnText.innerText = 'কপি হয়েছে! ✓';
            copyAlert.classList.remove('d-none');
            setTimeout(() => {
                copyBtnText.innerText = 'হুবহু কপি করুন';
                copyAlert.classList.add('d-none');
            }, 3000);
        }
    }
</script>
@endpush