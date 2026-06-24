@extends('layout.mainlayout')
@section('content')
    @include('treasurer.css.treasurercss')
    @include('treasurer.modals.collectioncertificationModal')
    @include('treasurer.modals.collectionclearanceModal')
    @include('treasurer.modals.collectionBarangayIDModal')
    @include('treasurer.modals.collectionBusinessClearanceModal')
    @include('treasurer.modals.collectionsummonModal')
    @include('treasurer.modals.totalCollected')

    @php
        $dashboardCards = [
            [
                'title' => 'Total Collected and Deposits',
                'subtitle' => '(Barangay Document Services)',
                'icon' => asset('assets/images/new/PESO.png'),
                'iconColor' => '#212529',
                'total' => $total_amount,
                'type' => 'img',
                'modal' => 'totalCollectedModal',
            ],
            [
                'title' => 'Total of Requests',
                'subtitle' => '(Barangay Document Services)',
                'icon' => 'bi-people-fill',
                'iconColor' => '#212529',
                'total' => $total_collection,
            ],
            [
                'title' => 'Unpaid Payor',
                'subtitle' => '(Barangay Document Services)',
                'icon' => 'bi-x-circle',
                'iconColor' => '#212529',
                'total' => $unpaid,
            ],
            [
                'title' => 'Paid Payor',
                'subtitle' => '(Barangay Document Services)',
                'icon' => 'bi-check-circle',
                'iconColor' => '#212529',
                'total' => $paid,
            ],
        ];

    @endphp
    <div class="page-container p-4">
        <div class="top-header mb-3">
            <div class="icon-container">
                <i class="bi bi-grid-fill" style="font-size: 40px"></i>
            </div>
            <div>
                <h3 class="mb-0" style="color: black">DASHBOARD</h3>
                <p style="color: black">Certification, Barangay ID, Barangay RBI, Barangay OTP Quarry</p>
            </div>
        </div>
        <div class="row g-3">

            @foreach ($dashboardCards as $card)
                <div class="col-lg-3 col-md-6">

                    <div class="shadow-sm h-100 px-3 py-2"
                        @if (!empty($card['modal'])) data-bs-toggle="modal"
                        data-bs-target="#{{ $card['modal'] }}" @endif
                        style="
                        background:#ffff;
                        border-radius:8px;
                        {{!empty($card['modal']) ? "cursor:pointer" : ''}}

                    ">

                        <div class="fw-semibold text-center"
                            style="
                            font-size:16px;
                            color:#212529;
                            line-height:1.1;
                        ">
                            {{ $card['title'] }}
                        </div>

                        <div class="text-center"
                            style="
                            font-size:12px;
                            color:#4b5563;
                            line-height:1;
                        ">
                            {{ $card['subtitle'] }}
                        </div>

                        <div class="d-flex justify-content-center align-items-center gap-2 mt-2">
                            @if (empty($card['type']))
                                <i class="bi {{ $card['icon'] }}"
                                    style="
                                    font-size:42px;
                                    color:{{ $card['iconColor'] }};
                                ">
                                </i>
                            @else
                                <img src="{{ $card['icon'] }}" class="mt-1" style="width: 36px; height; 36px"
                                    alt="">
                            @endif

                            <div class="fw-bold"
                                style="
                                font-size:26px;
                                color:#111827;
                                line-height:1;
                            ">
                                {{ $card['total'] }}
                            </div>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>
        <div class="card-content bg-white mt-3 rounded p-2">
            <div class="p-3">
                <table id="tableDashboard" class="table data_table table-bordered table-hover w-100 mb-0">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>DATE</th>
                            <th>OR NUMBER</th>
                            <th>PAYOR</th>
                            <th>NATURE OF COLLECTION</th>
                            <th>PAYMENT STATUS</th>
                            <th>AMOUNT</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="card border-0 mt-3 shadow-sm mb-4 p-3" style="border-radius: 8px; overflow: hidden;">
            <div class="d-flex justify-content-between align-items-center py-3 px-4 rounded"
                style="background-color: #184d35;">
                <h5 class="text-white fw-bold mb-0 tracking-wide" style="font-size: 1.1rem;">STATISTIC DATA CHART</h5>

                <div class="d-flex gap-2">
                    <select name="certification_type_dashboard" id="certification_type_dashboard"
                        class="form-select text-white">
                        <option class="text-dark" value="" selected disabled>Select Nature of Collection</option>
                        <option class="text-dark" value="all">All</option>
                        <option class="text-dark" value="clearance">Barangay Clearance</option>
                        <option class="text-dark" value="certification">Barangay Certification</option>
                        <option class="text-dark" value="summon">Summon</option>
                        <option class="text-dark" value="barangay_id">Barangay ID</option>
                        <option class="text-dark" value="businessclearance">Barangay Business Clearance</option>
                    </select>
                    {{-- <select id="filterMonth" class="form-select bg-transparent text-white border-white"
                        style="width: 140px; font-size: 0.85rem; border-radius: 4px;">
                        <option value="all" class="text-dark" selected>All Months</option>
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" class="text-dark">{{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endfor
                    </select> --}}

                    <select id="filterYear" class="form-select bg-transparent text-white border-white"
                        style="width: 100px; font-size: 0.85rem; border-radius: 4px;">
                        @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                            <option value="{{ $y }}" class="text-dark" {{ $y == date('Y') ? 'selected' : '' }}>
                                {{ $y }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="card-body bg-white p-2">
                <div id="statisticsApexChart" style="min-height: 380px;"></div>
            </div>
        </div>

        <style>
            .form-select {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
            }
        </style>
    </div>
@endsection

@section('js')
    @include('treasurer.js.collectionjs')
    @include('treasurer/js/dashboardJS')
@endsection
