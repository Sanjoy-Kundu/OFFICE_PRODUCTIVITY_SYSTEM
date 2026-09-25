@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- ব্রেডক্রাম্ব ও হেডার -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 small">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('office.correspondence.index') }}" class="text-decoration-none">পত্র যোগাযোগ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('office.correspondence.incoming.index') }}" class="text-decoration-none">আগত ডাক</a></li>
                    <li class="breadcrumb-item active" aria-current="page">নতুন এন্ট্রি</li>
                </ol>
            </nav>
            <h3 class="fw-bold mb-0 text-dark">
                <i class="fas fa-plus-circle text-primary me-2"></i> নতুন আগত চিঠি নিবন্ধন
            </h3>
        </div>

        <a href="{{ route('office.correspondence.incoming.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> রেজিস্টারে ফিরে যান
        </a>
    </div>

    <!-- API রেসপন্স অ্যালার্ট -->
    <div id="formAlert" class="alert d-none alert-dismissible fade show shadow-sm" role="alert">
        <span id="formAlertMessage"></span>
        <button type="button" class="btn-close" onclick="document.getElementById('formAlert').classList.add('d-none')"></button>
    </div>

    <!-- ফর্ম কার্ড -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fas fa-pen-nib text-secondary me-2"></i> ডাক বিবরণী ফর্ম
            </h5>
        </div>

        <div class="card-body p-4">
            <form id="incomingLetterForm" enctype="multipart/form-data">
                
                <!-- সেকশন ১: ডায়েরি ও তারিখ সংক্রান্ত -->
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <h6 class="fw-bold text-primary border-bottom pb-2">
                            ১. ডায়েরি ও তারিখের বিবরণ
                        </h6>
                    </div>

                    <div class="col-md-3">
                        <label for="diary_no" class="form-label fw-semibold">ডায়েরি নম্বর <span class="text-danger">*</span></label>
                        <input type="text" id="diary_no" name="diary_no" class="form-control bg-light fw-bold text-primary" placeholder="উদা: D-2025-0001" required>
                    </div>

                    <div class="col-md-3">
                        <label for="memo_no" class="form-label fw-semibold">মূল স্মারক নম্বর</label>
                        <input type="text" id="memo_no" name="memo_no" class="form-control" placeholder="চিঠিতে উল্লেখিত স্মারক নম্বর">
                    </div>

                    <div class="col-md-3">
                        <label for="letter_date" class="form-label fw-semibold">পত্রের তারিখ</label>
                        <input type="date" id="letter_date" name="letter_date" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label for="received_date" class="form-label fw-semibold">প্রাপ্তির তারিখ <span class="text-danger">*</span></label>
                        <input type="date" id="received_date" name="received_date" class="form-control" required>
                    </div>
                </div>

                <!-- সেকশন ২: প্রেরক ও প্রাপক সংক্রান্ত তথ্য -->
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <h6 class="fw-bold text-primary border-bottom pb-2">
                            ২. প্রেরক ও প্রাপক সংক্রান্ত তথ্য
                        </h6>
                    </div>

                    <div class="col-md-4">
                        <label for="sender_name" class="form-label fw-semibold">প্রেরকের নাম / পদবি <span class="text-danger">*</span></label>
                        <input type="text" id="sender_name" name="sender_name" class="form-control" placeholder="যেমন: মো: রহিম মিয়া, সচিব" required>
                    </div>

                    <div class="col-md-4">
                        <label for="sender_office" class="form-label fw-semibold">প্রেরকের দপ্তর / অফিস</label>
                        <input type="text" id="sender_office" name="sender_office" class="form-control" placeholder="যেমন: জনপ্রশাসন মন্ত্রণালয়">
                    </div>

                    <div class="col-md-4">
                        <label for="department" class="form-label fw-semibold">প্রাপক শাখা <span class="text-danger">*</span></label>
                        <select id="department" name="department" class="form-select" required>
                            <option value="">-- শাখা নির্বাচন করুন --</option>
                            <option value="প্রশাসন শাখা">প্রশাসন শাখা</option>
                            <option value="হিসাব ও অর্থ শাখা">হিসাব ও অর্থ শাখা</option>
                            <option value="আইন শাখা">আইন শাখা</option>
                            <option value="পরিকল্পনা ও মূল্যায়ন শাখা">পরিকল্পনা ও মূল্যায়ন শাখা</option>
                            <option value="আইসিটি শাখা">আইসিটি শাখা</option>
                        </select>
                    </div>
                </div>

                <!-- সেকশন ৩: চিঠির বিষয় ও সারসংক্ষেপ -->
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <h6 class="fw-bold text-primary border-bottom pb-2">
                            ৩. চিঠির বিষয় ও সারসংক্ষেপ
                        </h6>
                    </div>

                    <div class="col-md-8">
                        <label for="subject" class="form-label fw-semibold">পত্রের বিষয় <span class="text-danger">*</span></label>
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="চিঠির মূল বিষয় লিখুন" required>
                    </div>

                    <div class="col-md-4">
                        <label for="priority" class="form-label fw-semibold">অগ্রাধিকারের মাত্রা</label>
                        <select id="priority" name="priority" class="form-select">
                            <option value="সাধারণ">সাধারণ</option>
                            <option value="জরুরি">জরুরি</option>
                            <option value="অতি জরুরি">অতি জরুরি</option>
                            <option value="গোপনীয়">গোপনীয়</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="summary" class="form-label fw-semibold">সংক্ষিপ্ত বিবরণ বা মন্তব্য</label>
                        <textarea id="summary" name="summary" rows="3" class="form-control" placeholder="কোনো বিশেষ নির্দেশনা বা মন্তব্য থাকলে লিখুন..."></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="attachment" class="form-label fw-semibold">স্ক্যান কপি / সংযুক্তি (PDF / Image)</label>
                        <input type="file" id="attachment" name="attachment" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.docx">
                        <div class="form-text">সর্বোচ্চ ফাইল সাইজ: ১০ মেগাবাইট</div>
                    </div>
                </div>

                <!-- বাটন সেকশন -->
                <div class="d-flex justify-content-end gap-2 border-top pt-4">
                    <a href="{{ route('office.correspondence.incoming.index') }}" class="btn btn-outline-secondary px-4">
                        বাতিল
                    </a>
                    <button type="submit" id="submitBtn" class="btn btn-primary px-4 shadow-xs">
                        <i class="fas fa-save me-1"></i> <span id="btnText">ডাক সংরক্ষণ করুন</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // ডিফল্ট আজকের তারিখ সেট করা
    document.addEventListener('DOMContentLoaded', function () {
        const receivedDateInput = document.getElementById('received_date');
        if (receivedDateInput) {
            receivedDateInput.value = new Date().toISOString().split('T')[0];
        }
    });

    // ফর্ম সাবমিট হ্যান্ডলার (Try-Catch সহ API কল)
    document.getElementById('incomingLetterForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const form = e.target;
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const alertBox = document.getElementById('formAlert');
        const alertMsg = document.getElementById('formAlertMessage');

        // বাটন লোডিং স্টেট
        submitBtn.disabled = true;
        btnText.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> সংরক্ষণ হচ্ছে...';

        try {
            const formData = new FormData(form);

            // আপনার API এন্ডপয়েন্ট এখানে কল করবেন:
            /*
            const response = await fetch('/api/office/correspondence/incoming', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'সংরক্ষণ ব্যর্থ হয়েছে।');
            }

            // সফল হলে
            alertBox.className = 'alert alert-success alert-dismissible fade show shadow-sm';
            alertMsg.innerHTML = '<i class="fas fa-check-circle me-2"></i> চিঠি সফলভাবে সংরক্ষণ হয়েছে!';
            form.reset();

            // কিছু সময় পর লিস্ট পেজে রিডাইরেক্ট (ঐচ্ছিক):
            // setTimeout(() => window.location.href = "{{ route('office.correspondence.incoming.index') }}", 1500);
            */

            // ডেমো সাকসেস মেসেজ (API না থাকা পর্যন্ত টেস্ট করার জন্য):
            alertBox.className = 'alert alert-success alert-dismissible fade show shadow-sm';
            alertMsg.innerHTML = '<i class="fas fa-check-circle me-2"></i> ফর্ম প্রস্তুত! API এন্ডপয়েন্ট যুক্ত করলে ডাটা সেভ হবে।';

        } catch (error) {
            console.error('Submission Error:', error);
            alertBox.className = 'alert alert-danger alert-dismissible fade show shadow-sm';
            alertMsg.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i> সমস্যা: ' + error.message;
        } finally {
            submitBtn.disabled = false;
            btnText.innerHTML = 'ডাক সংরক্ষণ করুন';
        }
    });
</script>
@endpush