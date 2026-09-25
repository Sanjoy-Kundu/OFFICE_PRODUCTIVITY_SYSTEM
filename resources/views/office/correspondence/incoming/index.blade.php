@extends('layouts.app')

@push('styles')
    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <style>
        .table-govt thead th {
            background-color: #f1f5f9;
            color: #1e293b;
            font-weight: 600;
            border-bottom: 2px solid #cbd5e1;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid py-4">

    <!-- পেজ হেডার -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1 small">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('office.correspondence.index') }}" class="text-decoration-none">পত্র যোগাযোগ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">আগত ডাক</li>
                </ol>
            </nav>
            <h3 class="fw-bold mb-0 text-dark">
                <i class="fas fa-inbox text-primary me-2"></i> আগত ডাক রেজিস্টার
            </h3>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('office.correspondence.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> ফিরে যান
            </a>
            <a href="{{ route('office.correspondence.incoming.create') }}" class="btn btn-primary shadow-xs">
                <i class="fas fa-plus-circle me-1"></i> নতুন ডাক এন্ট্রি
            </a>
        </div>
    </div>

    <!-- API অ্যালার্ট বক্স (এরর বা সাকসেসের জন্য) -->
    <div id="tableAlert" class="alert d-none alert-dismissible fade show shadow-sm" role="alert">
        <span id="tableAlertMessage"></span>
        <button type="button" class="btn-close" onclick="document.getElementById('tableAlert').classList.add('d-none')"></button>
    </div>

    <!-- ডাটাটেবিল কার্ড -->
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="fas fa-list text-secondary me-2"></i> সকল আগত চিঠির বিবরণী
            </h5>
            <button id="refreshBtn" class="btn btn-sm btn-outline-secondary" onclick="fetchIncomingLetters()">
                <i class="fas fa-sync-alt me-1"></i> রিলোড
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="incomingTable" class="table table-hover align-middle table-govt w-100">
                    <thead>
                        <tr>
                            <th style="width: 12%;">ডায়েরি নম্বর</th>
                            <th style="width: 15%;">প্রাপ্তির তারিখ ও স্মারক</th>
                            <th style="width: 20%;">প্রেরক ও অফিস</th>
                            <th style="width: 25%;">বিষয়</th>
                            <th style="width: 15%;">দায়িত্বপ্রাপ্ত শাখা</th>
                            <th style="width: 8%;">অগ্রাধিকার</th>
                            <th style="width: 5%; text-align: center;">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody id="incomingTableBody">
                        {{-- API থেকে জাভাস্ক্রিপ্ট দিয়ে রো লোড হবে --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
    <!-- jQuery & DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        let dataTableInstance = null;

        $(document).ready(function () {
            // ডাটাটেবিল ইনিশিয়ালাইজ
            dataTableInstance = $('#incomingTable').DataTable({
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "ডায়েরি নম্বর, প্রেরক বা বিষয় দিয়ে খুঁজুন...",
                    lengthMenu: "_MENU_ টি চিঠি প্রদর্শন",
                    info: "মোট _TOTAL_ টির মধ্যে _START_ থেকে _END_ দেখানো হচ্ছে",
                    infoEmpty: "কোনো তথ্য মেলেনি",
                    infoFiltered: "(ফিল্টারকৃত মোট _MAX_ টি চিঠি থেকে)",
                    zeroRecords: "কোনো চিঠি পাওয়া যায়নি",
                    emptyTable: `
                        <div class="py-5 text-center text-muted">
                            <i class="fas fa-folder-open fa-3x text-secondary opacity-50 mb-3"></i>
                            <h6 class="fw-bold text-dark mb-1">কোনো আগত চিঠি পাওয়া যায়নি</h6>
                            <p class="small text-muted mb-3">এখনও কোনো চিঠিপত্র সিস্টেমে এন্ট্রি করা হয়নি।</p>
                            <a href="{{ route('office.correspondence.incoming.create') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus me-1"></i> প্রথম চিঠি এন্ট্রি করুন
                            </a>
                        </div>
                    `,
                    paginate: {
                        first: "প্রথম",
                        previous: "&laquo; পূর্ববর্তী",
                        next: "পরবর্তী &raquo;",
                        last: "শেষ"
                    }
                },
                pageLength: 10,
                ordering: true,
                responsive: true
            });

            // পেজ লোড হলে API থেকে ডাটা কল হবে
            fetchIncomingLetters();
        });

        // API থেকে ডাটা আনার ফাংশন (Try-Catch সহ)
        async function fetchIncomingLetters() {
            const alertBox = document.getElementById('tableAlert');
            const alertMsg = document.getElementById('tableAlertMessage');

            try {
                // আপনার API এন্ডপয়েন্ট এখানে বসাবেন (যেমন: '/api/office/correspondence/incoming')
                /*
                const response = await fetch('/api/office/correspondence/incoming', {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error('API রিকোয়েস্টে ত্রুটি ঘটেছে। স্ট্যাটাস: ' + response.status);
                }

                const data = await response.json();

                // ডাটাটেবিলে ডাটা লোড করা
                dataTableInstance.clear();
                if (data && data.length > 0) {
                    data.forEach(item => {
                        dataTableInstance.row.add([
                            `<span class="badge bg-light text-dark border">${item.diary_no}</span>`,
                            `<div>${item.received_date}</div><small class="text-muted">${item.memo_no ?? '-'}</small>`,
                            `<div class="fw-semibold">${item.sender_name}</div><small class="text-muted">${item.sender_office ?? ''}</small>`,
                            item.subject,
                            `<span class="badge bg-info-subtle text-dark">${item.department}</span>`,
                            `<span class="badge ${item.priority === 'জরুরি' ? 'bg-danger' : 'bg-secondary'}">${item.priority}</span>`,
                            `<div class="text-center"><a href="/office/correspondence/incoming/${item.id}" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a></div>`
                        ]);
                    });
                }
                dataTableInstance.draw();
                */

            } catch (error) {
                console.error('Error fetching incoming letters:', error);
                alertBox.className = 'alert alert-danger alert-dismissible fade show shadow-sm';
                alertMsg.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i> ডাটা লোড করতে সমস্যা হয়েছে: ' + error.message;
            }
        }
    </script>
@endpush