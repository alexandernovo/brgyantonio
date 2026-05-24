@extends('layout.mainlayout')
@section('content')
    @include('secretary.css.certificationcss')
    @php
        $dashboardCards = [
            [
                'title' => 'Total of Records',
                'subtitle' => '(Barangay Inhabitants by Household)',
                'icon' => asset('assets/images/new/HOUSEHOLD INHABITANT.png'),
                'iconColor' => '#1f2937',
                'total' => 4,
            ],
            [
                'title' => 'Total of Requests',
                'subtitle' => '(Barangay Certification)',
                'icon' => asset('assets/images/new/CERTIFICATION.png'),
                'iconColor' => '#1f2937',
                'total' => 10,
            ],
            [
                'title' => 'Total of Requests',
                'subtitle' => '(Barangay ID)',
                'icon' => asset('assets/images/new/BRGY ID.png'),
                'iconColor' => '#d1d5db',
                'total' => 7,
            ],
            [
                'title' => 'Total of Requests',
                'subtitle' => '(Barangay OTP Quarry)',
                'icon' => asset('assets/images/new/QUARRY.png'),
                'iconColor' => '#1f2937',
                'total' => 8,
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
        <div class="d-flex gap-3 flex-wrap">

            @foreach ($dashboardCards as $card)
                <div class="flex-fill text-center shadow-sm px-3 py-2"
                    style="
                background:#f3f3f3;
                border-radius:10px;
                min-width:260px;
            ">

                    <div class="fw-semibold"
                        style="
                    font-size:18px;
                    color:#212529;
                    line-height:1.1;
                ">
                        {{ $card['title'] }}
                    </div>

                    <div style="
                font-size:13px;
                color:#4b5563;
            ">
                        {{ $card['subtitle'] }}
                    </div>

                    <div class="d-flex justify-content-center align-items-center gap-3 mt-2">
                        <div style="width: 70px; height: 70px; ">
                            <img src="{{ $card['icon'] }}" style="filter: invert(1)" alt=""
                                class="w-100 h-100 object-fit-contain">
                        </div>
                        <div class="fw-semibold"
                            style="
                        font-size:52px;
                        color:#111827;
                        line-height:1;
                    ">
                            {{ $card['total'] }}
                        </div>

                    </div>

                </div>
            @endforeach

        </div>

        <div class="card-content bg-white mt-3 rounded p-2">
            <div class="p-3">
                <table id="certificationTableDashboard" class="table data_table table-bordered table-hover w-100 mb-0">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>REQUESTER</th>
                            <th>OR NUMBER</th>
                            <th>TYPE CERTIFICATION</th>
                            <th>DATE ISSUED</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="card border-0 mt-3 shadow-sm mb-4 p-3" style="border-radius: 8px; overflow: hidden;">
            <div class="d-flex justify-content-between align-items-center py-3 px-4 rounded" style="background-color: #184d35;">
                <h5 class="text-white fw-bold mb-0 tracking-wide" style="font-size: 1.1rem;">STATISTIC DATA CHART</h5>

                <div class="d-flex gap-2">
                    <select name="certification_type_dashboard" id="certification_type_dashboard" class="form-select text-white">
                        <option class="text-dark" value="" selected disabled>Select Certification Type</option>
                        <option class="text-dark" value="all">All Certification</option>
                        <option class="text-dark" value="brgy">Certificate of Barangay</option>
                        <option class="text-dark" value="clearance">Certificate of Barangay Clearance</option>
                        <option class="text-dark" value="trees">Certificate of Trees</option>
                        <option class="text-dark" value="jobseeker">Certificate of First Time Job Seeker</option>
                        <option class="text-dark" value="goodmoral">Certificate of Good Moral Character</option>
                        <option class="text-dark" value="indigency">Certificate of Indigency</option>
                        <option class="text-dark" value="livestock">Certificate of Livestock</option>
                        <option class="text-dark" value="motorcycle">Certificate of Motorcycle</option>
                        <option class="text-dark" value="piggery">Certificate of Piggery</option>
                        <option class="text-dark" value="quarry">Certificate of Quarry</option>
                        <option class="text-dark" value="lot">Certificate of Lot</option>
                    </select>
                    <select id="filterMonth" class="form-select bg-transparent text-white border-white"
                        style="width: 140px; font-size: 0.85rem; border-radius: 4px;">
                        <option value="all" class="text-dark" selected>All Months</option>
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" class="text-dark">{{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endfor
                    </select>

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
    @include('secretary.js.certificationjs')
    @include('secretary/js/dashboardJS')
@endsection
