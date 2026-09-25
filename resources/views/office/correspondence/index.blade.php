@extends('layouts.app')

@push('styles')
    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <style>
        /* ডাটাটেবিল কাস্টম স্টাইল */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0 !important;
            margin: 0 2px;
        }
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 6px;
            padding: 5px 10px;
            border: 1px solid #ced4da;
        }
        .dataTables_wrapper .dataTables_length select {
            border-radius: 6px;
            padding: 4px 8px;
            border: 1px solid #ced4da;
        }
        table.dataTable thead th {
            background-color: #f8fafc;
            color: #334155;
            font-weight: 600;
        }
    </style>
@endpush

@section('content')

<div class="container-fluid py-4">

    {{-- পেজ হেডার --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1 text-dark">
                <i class="fas fa-envelope-open-text text-primary me-2"></i>
                পত্র যোগাযোগ ব্যবস্থাপনা
            </h3>
            <p class="text-muted mb-0 small">
                অফিসের আগত ও প্রেরিত চিঠিপত্র ট্র্যাকিং ও রেজিস্টার ব্যবস্থাপনা করুন।
            </p>
        </div>

        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>
            ড্যাশবোর্ডে ফিরে যান
        </a>
    </div>

    {{-- পরিসংখ্যান কার্ডসমূহ --}}
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small fw-medium mb-1">মোট আগত চিঠি</p>
                            <h3 class="fw-bold mb-0 text-dark" id="totalIncoming">০</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                            <i class="fas fa-inbox fa-2x"></i>
                        </div>
                    </div>
                    <small class="text-muted d-block mt-3 border-top pt-2">অফিসে প্রাপ্ত মোট চিঠি</small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small fw-medium mb-1">মোট প্রেরিত চিঠি</p>
                            <h3 class="fw-bold mb-0 text-dark" id="totalOutgoing">০</h3>
                        </div>
                        <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                            <i class="fas fa-paper-plane fa-2x"></i>
                        </div>
                    </div>
                    <small class="text-muted d-block mt-3 border-top pt-2">অফিস থেকে প্রেরিত মোট চিঠি</small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small fw-medium mb-1">অপেক্ষমাণ চিঠি</p>
                            <h3 class="fw-bold mb-0 text-dark" id="pendingLetters">০</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                    <small class="text-muted d-block mt-3 border-top pt-2">পরবর্তী কার্যক্রমের অপেক্ষায়</small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100 rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small fw-medium mb-1">আজকের চিঠিপত্র</p>
                            <h3 class="fw-bold mb-0 text-dark" id="todayLetters">০</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 text-info rounded-3 p-3">
                            <i class="fas fa-calendar-day fa-2x"></i>
                        </div>
                    </div>
                    <small class="text-muted d-block mt-3 border-top pt-2">আজকের আগত ও প্রেরিত চিঠি</small>
                </div>
            </div>
        </div>
    </div>

    {{-- দ্রুত কার্যক্রম বাটন --}}
    <div class="card border-0 shadow-sm mb-4 rounded-3">
        <div class="card-header bg-white py-3 border-0">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fas fa-bolt text-warning me-2"></i>
                দ্রুত কার্যক্রম
            </h5>
        </div>
        <div class="card-body pt-0">
            <div class="row g-3">
                <div class="col-xl-3 col-md-6">
                    <a href="{{ url('/office/correspondence/incoming/create') }}" class="btn btn-primary w-100 py-3 rounded-3 shadow-xs">
                        <i class="fas fa-plus-circle me-2"></i>
                        নতুন আগত চিঠি
                    </a>
                </div>
                <div class="col-xl-3 col-md-6">
                    <a href="{{ url('/office/correspondence/incoming') }}" class="btn btn-outline-primary w-100 py-3 rounded-3">
                        <i class="fas fa-book me-2"></i>
                        আগত চিঠি রেজিস্টার
                    </a>
                </div>
                <div class="col-xl-3 col-md-6">
                    <a href="{{ url('/office/correspondence/outgoing/create') }}" class="btn btn-success w-100 py-3 rounded-3 shadow-xs">
                        <i class="fas fa-plus-circle me-2"></i>
                        নতুন প্রেরিত চিঠি
                    </a>
                </div>
                <div class="col-xl-3 col-md-6">
                    <a href="{{ url('/office/correspondence/outgoing') }}" class="btn btn-outline-success w-100 py-3 rounded-3">
                        <i class="fas fa-book-open me-2"></i>
                        প্রেরিত চিঠি রেজিস্টার
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ১. সাম্প্রতিক আগত চিঠি (DataTable) --}}
    <div class="card border-0 shadow-sm mb-4 rounded-3">
        <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2 border-bottom">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fas fa-inbox text-primary me-2"></i>
                সাম্প্রতিক আগত চিঠিপত্র
            </h5>
            <a href="{{ url('/office/correspondence/incoming/create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus-circle me-1"></i> নতুন চিঠি এন্ট্রি
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="incomingTable" class="table table-hover align-middle w-100">
                    <thead>
                        <tr>
                            <th style="width: 15%;">ডায়েরি নম্বর</th>
                            <th style="width: 15%;">প্রাপ্তির তারিখ</th>
                            <th style="width: 25%;">প্রেরক</th>
                            <th style="width: 30%;">বিষয়</th>
                            <th style="width: 15%;">অবস্থা</th>
                        </tr>
                    </thead>
                    <tbody id="incomingTableBody">
                        {{-- ডাটাসেট না থাকলে DataTables স্বয়ংক্রিয়ভাবে বাংলা Empty Message দেখাবে --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ২. সাম্প্রতিক প্রেরিত চিঠি (DataTable) --}}
    <div class="card border-0 shadow-sm mb-4 rounded-3">
        <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2 border-bottom">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fas fa-paper-plane text-success me-2"></i>
                সাম্প্রতিক প্রেরিত চিঠিপত্র
            </h5>
            <a href="{{ url('/office/correspondence/outgoing/create') }}" class="btn btn-sm btn-success">
                <i class="fas fa-plus-circle me-1"></i> নতুন চিঠি ইস্যু
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="outgoingTable" class="table table-hover align-middle w-100">
                    <thead>
                        <tr>
                            <th style="width: 15%;">ইস্যু নম্বর</th>
                            <th style="width: 15%;">প্রেরণের তারিখ</th>
                            <th style="width: 25%;">প্রাপক</th>
                            <th style="width: 30%;">বিষয়</th>
                            <th style="width: 15%;">অবস্থা</th>
                        </tr>
                    </thead>
                    <tbody id="outgoingTableBody">
                        {{-- ডাটাসেট না থাকলে DataTables স্বয়ংক্রিয়ভাবে বাংলা Empty Message দেখাবে --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <!-- jQuery (DataTables এর জন্য আবশ্যক) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables JS & Bootstrap 5 Bundle -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            // বাংলা ভাষা কনফিগারেশন
            const banglaDataTableLang = {
                search: "_INPUT_",
                searchPlaceholder: "এখানে সার্চ করুন...",
                lengthMenu: "_MENU_ টি রেকর্ড দেখুন",
                info: "মোট _TOTAL_ টির মধ্যে _START_ থেকে _END_ দেখানো হচ্ছে",
                infoEmpty: "কোনো তথ্য নেই",
                infoFiltered: "(মোট _MAX_ টি রেকর্ড থেকে ফিল্টার করা)",
                zeroRecords: "কোনো মেলানো চিঠি পাওয়া যায়নি",
                emptyTable: `
                    <div class="py-4 text-center text-muted">
                        <i class="fas fa-folder-open fa-3x text-secondary opacity-50 mb-2"></i>
                        <h6 class="fw-bold text-dark mb-1">কোনো চিঠিপত্র পাওয়া যায়নি</h6>
                        <p class="small text-muted mb-0">এখনও কোনো চিঠিপত্র সিস্টেমে এন্ট্রি করা হয়নি।</p>
                    </div>
                `,
                paginate: {
                    first: "প্রথম",
                    previous: "&laquo; পূর্ববর্তী",
                    next: "পরবর্তী &raquo;",
                    last: "শেষ"
                }
            };

            // আগত চিঠি ডাটাটেবিল চালু
            $('#incomingTable').DataTable({
                language: banglaDataTableLang,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                responsive: true
            });

            // প্রেরিত চিঠি ডাটাটেবিল চালু
            $('#outgoingTable').DataTable({
                language: banglaDataTableLang,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                responsive: true
            });
        });
    </script>
@endpush