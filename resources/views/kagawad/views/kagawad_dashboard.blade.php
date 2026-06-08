@extends('layout.mainlayout')
@section('content')
    @include('kagawad.css.kagawadcss')
    @php

        $dashboardCards = [
            [
                'title' => 'Total of Resolved',
                'style' => 'margin-top: -15px !important',
                'subtitle' => '(Blotter Complaints)',
                'icon' => asset('assets/images/new/BLOTTER RESOLVED.png'),
                'iconColor' => '#212529',
                'total' => $total_resolved,
                'type' => 'img',
            ],
            [
                'title' => 'Total of Unresolved',
                'subtitle' => '(Blotter Complaints)',
                'icon' => asset('assets/images/new/BLOTTER UNRESOLVED.png'),
                'iconColor' => '#212529',
                'style' => 'filter: invert(1)',
                'total' => $total_unresolved,
                'type' => 'img',
            ],
            [
                'title' => 'Total Returned',
                'subtitle' => '(Borrowed Equipment)',
                'icon' => asset('assets/images/new/RETURNED EQUIPMENT.png'),
                'iconColor' => '#212529',
                'style' => 'filter: invert(1)',
                'total' => $total_returned,
                'type' => 'img',
            ],
            [
                'title' => 'Total of Unreturned',
                'subtitle' => '(Borrowed Equipment)',
                'icon' => 'bi-x-lg',
                'style' => 'font-weight: 600',
                'iconColor' => '#212529',
                'total' => $total_unreturned,
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
                <div class="col-lg-3 col-md-6">

                    <div class="shadow-sm h-100 px-3 py-2"
                        style="
                        background:#ffff;
                        border-radius:8px;
                    ">

                        <div class="fw-semibold text-center"
                            style="
                            font-size:21px;
                            color:#212529;
                            line-height:1.1;
                        ">
                            {{ $card['title'] }}
                        </div>

                        <div class="text-center"
                            style="
                            font-size:15px;
                            color:#4b5563;
                            line-height:1;
                        ">
                            {{ $card['subtitle'] }}
                        </div>

                        <div class="d-flex justify-content-center align-items-center gap-2 mt-2">
                            @if (empty($card['type']))
                                <i class="bi {{ $card['icon'] }}"
                                    style="
                                    font-size:38px;
                                    color:{{ $card['iconColor'] }};
                                ">
                                </i>
                            @else
                                <img src="{{ $card['icon'] }}" class="mt-1"
                                    style="width: 40px; height; 40px; {{ $card['style'] ?? '' }}" alt="">
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
        <div class="dashboard-charts row mx-auto">

            <div class="chart-card col-6">
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
            <div class="chart-card col-6">
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
