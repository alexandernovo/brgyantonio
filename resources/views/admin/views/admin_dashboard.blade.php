@extends('layout.mainlayout')
@section('content')
    @include('kagawad.css.kagawadcss')
    @php
        $dashboardCards = [
            [
                'title' => 'Barangay Certification',
                'style' => 'margin-top: -15px !important',
                'style2' => 'width:70px; height:60px; filter: invert(1)',
                'subtitle' => '(Blotter Complaints)',
                'icon' => asset('assets/images/users/secretary.png'),
                'icon2' => asset('assets/images/new/CERTIFICATION.png'),
                'iconColor' => '#212529',
                'total' => $totalCertification,
                'type' => 'img',
            ],
            [
                'title' => 'Collected and Deposits',
                'subtitle' => '(Blotter Complaints)',
                'icon' => asset('assets/images/users/treasurer.png'),
                'icon2' => asset('assets/images/new/PESO.png'),
                'iconColor' => '#212529',
                'style' => 'filter: invert(1)',
                'style2' => 'width:40px; height:40px;',
                'total' => $totalCollection,
                'type' => 'img',
            ],
            [
                'title' => 'Unreturned Equipment',
                'subtitle' => '(Borrowed Equipment)',
                'icon' => asset('assets/images/users/kagawad.png'),
                'icon2' => 'bi bi-x-lg',
                'iconColor' => '#212529',
                'style' => 'filter: invert(1)',
                'style2' => 'width:80px; height:80px; filter: invert(1)',
                'total' => $totalUnreturned,
                'type' => 'img',
                'textstyle' => 'color: #A10101;',
                'type2' => 'icon',
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
                <p style="color: black">Blotter Complaints & Borrowed Equipment</p>
            </div>
        </div>
        <div class="row g-3">

            @foreach ($dashboardCards as $card)
                <div class="col-lg-4 col-md-6">

                    <div class="shadow-sm h-100 p-2"
                        style="
                        background:#ffff;
                        border-radius:8px;
                    ">
                        <div class="d-flex justify-content-start align-items-center gap-2">
                            <div class="rounded p-3 d-flex align-items-center justify-content-center"
                                style="width: 110px; height: 110px; background-color: #1A212B">
                                <div style="width:80px; height:80px; border: 6px solid white" class="rounded-circle p-2">
                                    <img src="{{ $card['icon'] }}" class="mt-1 w-100 h-100 object-fit-contain"
                                        {{ $card['style'] ?? '' }}" alt="">
                                </div>

                            </div>

                            <div class="w-100 d-flex flex-column align-items-center">
                                <p class="fw-semibold mb-1" style="font-size: 20px;">{{ $card['title'] }}</p>
                                <div class="d-flex align-items-center gap-2">
                                    @if (!empty($card['type2']))
                                        <i style="font-size: 30px; color: #A10101" class="{{ $card['icon2'] }}"></i>
                                    @else
                                        <img src="{{ $card['icon2'] }}" class="mt-1" style="{{ $card['style2'] }}">
                                    @endif
                                    <div class="fw-semibold"
                                        style="
                                            font-size:44px;
                                            {{ $card['textstyle'] ?? '' }}
                                            line-height:1;
                                        ">
                                        {{ $card['total'] }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="dashboard-charts row mx-auto">

            <div class="chart-card col-6 ps-0">
                <div class="card-content bg-white mt-3 rounded p-2">

                    <h3 class="title_piechart">BLOTTER COMPLAINTS PIE CHART</h3>

                    <div class="chart-wrapper">
                        <div id="blotterChart"></div>

                        <!-- CENTER IMAGE (placeholder) -->
                        <img src="{{ asset('assets/images/new/BLOTTER COMPLAINTS.png') }}" class="chart-center-img"
                            alt="center image">
                    </div>
                </div>
            </div>

            <!-- BORROWED -->
            <div class="chart-card col-6 pe-0">
                <div class="card-content bg-white mt-3 rounded p-2">

                    <h3 class="title_piechart">BORROWED EQUIPMENT PIE CHART</h3>

                    <div class="chart-wrapper">
                        <div id="borrowedChart"></div>

                        <!-- CENTER IMAGE -->
                        <img src="{{ asset('assets/images/new/BORROWED EQUIPMENT.png') }}" class="chart-center-img"
                            alt="center image"style="left: 50%;">
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    @include('kagawad.js.kagawadjs')
    @include('kagawad/js/dashboardJS')
@endsection
