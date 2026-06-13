@extends('layout.mainlayout')

@section('content')
    @include('secretary.css.certificationcss')

    <style>
        .report-header-bg {
            background-color: #0b4028;
            /* Dark green top bar */
            color: #ffffff;
            border-radius: 8px;
        }

        .report-card {
            border: 1px solid #ced4da;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            background: #fff;
        }

        .btn-print-report {
            background: transparent;
            color: #fff;
            border: 2px solid #fff;
            border-radius: 5px;
            padding: 6px 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-print-report:hover {
            background: #fff;
            color: #0b4028;
        }

        .download-icon {
            font-size: 24px;
            text-decoration: none;
            transition: transform 0.2s;
        }

        .download-icon:hover {
            transform: scale(1.1);
        }

        .brgy-title {
            color: #ff0000;
            /* Red title font */
            font-weight: 600;
            letter-spacing: 1px;
        }

        .report-subtitle {
            font-weight: 600;
            color: #000;
            letter-spacing: 0.5px;
        }

        .custom-table thead th {
            background-color: #0b4028 !important;
            /* Dark green table header */
            color: #ffffff !important;
            text-align: center;
            font-size: 13px;
            vertical-align: middle;
            border: 1px solid #dee2e6 !important;
        }

        .custom-table tbody td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #dee2e6;
            font-size: 14px;
        }

        .secretary-signature-block {
            margin-top: 40px;
            padding-right: 20px;
        }
    </style>

    <div class="page-container p-4">
        <div class="card-body bg-white p-1" style="border-radius: 8px">

            <div class="report-header-bg d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                <form method="GET" action="{{ url()->current() }}">

                    <div class="d-flex flex-column align-items-start gap-2">

                        <label for="monthYearSelect" class="text-white text-nowrap mb-0 fw-bold" style="font-size: 14px;">
                            Select Month and Year
                        </label>

                        <div class="input-group">

                            <input type="month" name="month" id="monthYearSelect" class="form-control form-control-sm"
                                value="{{ request('month') }}" style="width: 250px; height: 30px; background-color: white"
                                onchange="this.form.submit()">

                        </div>

                    </div>

                </form>
                <div class="d-flex align-items-center gap-3">
                    <button id="btnPrintCertification" class="btn-print-report d-flex align-items-center gap-2">
                        <i class="bi bi-printer"></i> Print Report
                    </button>
                    <div class="d-flex align-items-center gap-2 text-white">
                        <span style="font-size: 14px;">Download</span>
                        <a href="#" id="btnPdf" class="download-icon text-danger">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                        </a>

                        <a href="#" id="btnWord" class="download-icon text-primary">
                            <i class="bi bi-file-earmark-word-fill"></i>
                        </a>

                        <a href="#" id="btnExcel" class="download-icon text-success">
                            <i class="bi bi-file-earmark-excel-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div id="printArea">
                <div class="d-flex justify-content-center pt-3 align-items-center mb-2 position-relative text-center">
                    <div class="px-3">
                        <img src="{{ asset('assets/images/logo.jpg') }}" alt="Municipality Seal"
                            style="height: 90px; width: auto;" onerror="this.style.display='none'">
                    </div>

                    <div>
                        <h6 class="mb-0 text-muted" style="font-size: 15px;">Republic of the Philippines</h6>
                        <h6 class="mb-0 text-muted" style="font-size: 15px;">Province of Antique</h6>
                        <h5 class="fw-bold my-1 text-dark" style="font-size: 18px;">MUNICIPALITY OF BARBAZA</h5>
                    </div>

                    <div class="px-3">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Barangay Seal"
                            style="height: 90px; width: auto;" onerror="this.style.display='none'">
                    </div>
                </div>

                <div class="text-center mb-4">
                    <h3 class="brgy-title mb-2">BARANGAY SAN ANTONIO</h3>
                    <h4 class="report-subtitle text-uppercase">LIST OF TREE CERTIFICATION AS OF
                        {{ request('month') ? \Carbon\Carbon::parse(request('month'))->format('F Y') : now()->format('F Y') }}
                    </h4>
                </div>

                <div class="table-responsive px-2">
                    <table id="certificationTableBrgy" class="table custom-table table-bordered w-100 mb-0">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>REQUESTER</th>
                                <th>CIVIL STATUS</th>
                                <th>OR NUMBER</th>
                                <th>NAME OF TREE</th>
                                <th>NUMBER OF TREE</th>
                                <th>ADDRESS</th>
                                <th>DATE OF ISSUED</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ trim($item->first_name . ' ' . ($item->middle_name ? $item->middle_name . ' ' : '') . $item->last_name) }}
                                    </td>

                                    <td>{{ $item->civil_status ?? '-' }}</td>

                                    <td>{{ $item->or_number ?? '-' }}</td>

                                    <td>{{ $item->name_of_tree ?? '-' }}</td>

                                    <td>{{ $item->no_of_tree ?? '-' }}</td>

                                    <td>
                                        @php
                                            $addressParts = array_filter([
                                                $item->purok ? 'Purok ' . $item->purok : null,
                                                $item->barangay,
                                                $item->municipality,
                                                $item->province,
                                            ]);
                                            echo !empty($addressParts) ? implode(', ', $addressParts) : '-';
                                        @endphp
                                    </td>

                                    <td>
                                        {{ $item->date_issued ? \Carbon\Carbon::parse($item->date_issued)->format('F d, Y') : '-' }}
                                    </td>
                                </tr>
                            @endforeach

                            @if (count($data) == 0)
                                <tr>
                                    <td colspan="8" class="text-center">No Data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end secretary-signature-block text-center mt-5 mb-3">
                    <div style="min-width: 250px;">
                        <h5 class="mb-0 fw-bold text-dark" style="text-transform: uppercase;">GLORYBELLE V. DECENILLA</h5>
                        <p class="text-muted mb-0" style="font-size: 15px; border-top: 1px solid #000; pt-1;">Barangay
                            Secretary</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('secretary.js.certificationjs')
    @include('secretary.js.printingReport')
@endsection
