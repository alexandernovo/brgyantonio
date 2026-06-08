@php
    $type = request()->query('type');

    $titlesArray = [
        'clearance' => 'BARANGAY CLEARANCE REPORT OF COLLECTION AND DEPOSITS AS OF',
        'certification' => 'BARANGAY CERTIFICATION REPORT OF COLLECTION AND DEPOSITS AS OF',
        'summon' => 'SUMMON REPORT OF COLLECTION AND DEPOSITS AS OF',
        'barangay_id' => 'BARANGAY ID REPORT OF COLLECTION AND DEPOSITS AS OF',
        'businessclearance' => 'BARANGAY BUSINESS CLEARANCE REPORT OF COLLECTION AND DEPOSITS AS OF',
    ];

    $title = $titlesArray[$type] ?? '';
@endphp
@extends('layout.mainlayout')

@section('content')
    @include('secretary.css.certificationcss')
    <style>
        .table {
            font-size: 11px;
            margin-bottom: 0;
        }

        .table th,
        .table td {
            border: 1px solid #000 !important;
            padding: 2px 4px !important;
            vertical-align: middle;
        }

        .table th {
            text-align: center;
            font-weight: bold;
        }

        @media print {
            .table {
                font-size: 10px;
            }

            .container-fluid {
                width: 100%;
            }
        }

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

        .page {
            width: 8.5in
        }
    </style>
    <div class="page-container p-4">
        <div class="card-body bg-white p-1" style="border-radius: 8px">

            <div class="report-header-bg d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                <form method="GET" action="{{ url()->current() }}">

                    <div class="d-flex flex-column align-items-start gap-2">

                        <label for="monthYearSelect" class="text-white text-nowrap mb-0 fsemiw-bold" style="font-size: 14px;">
                            Select Month and Year
                        </label>

                        <div class="input-group">
                            <input type="hidden" value="{{ request('type') }}" name="type">
                            <input type="month" name="month" id="monthYearSelect" class="form-control form-control-sm"
                                value="{{ request('month') }}" style="width: 250px; height: 30px; background-color: white"
                                onchange="this.form.submit()">

                        </div>

                    </div>

                </form>
                <div class="d-flex align-items-center gap-3">
                    <button class="btn-print-report d-flex align-items-center gap-2">
                        <i class="bi bi-printer"></i> Print Report
                    </button>
                    <div class="d-flex align-items-center gap-2 text-white">
                        <span style="font-size: 14px;">Download</span>
                        <a href="#" class="download-icon text-danger"><i class="bi bi-file-earmark-pdf-fill"></i></a>
                        <a href="#" class="download-icon text-primary"><i
                                class="bi bi-file-earmark-word-fill"></i></a>
                        <a href="#" class="download-icon text-success"><i
                                class="bi bi-file-earmark-excel-fill"></i></a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="page border mt-3">

                    {{-- REPORT TITLE --}}
                    <div class="text-center p-3 border-top border-end border-start border-dark mb-0">
                        <h4 class="fw-semibold mb-0" style="color: #9a3838">REPORT OF COLLECTION AND DEPOSITS</h4>
                    </div>

                    {{-- HEADER DETAILS --}}
                    <table class="table table-bordered mb-0">
                        <tr>
                            <td width="40%">
                                <strong>Name of Barangay Treasurer:</strong>
                                ROLDAN P. RAMOS
                            </td>
                            <td width="30%">
                                <strong>Date:</strong>
                                {{ request('month') ? \Carbon\Carbon::parse(request('month'))->format('F Y') : now()->format('F Y') }}
                            </td>
                            <td width="30%">
                                <strong>RCD No.:</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Barangay:</strong> SAN ANTONIO
                            </td>
                            <td colspan="2"></td>
                        </tr>
                    </table>

                    {{-- SECTION A --}}
                    <table class="table table-bordered mb-0">
                        <tr>
                            <th colspan="5" class="text-start">
                                A. COLLECTION RECORDS
                            </th>
                        </tr>

                        <tr>
                            <th width="15%">Date</th>
                            <th width="15%">OR Number</th>
                            <th width="35%">Payor</th>
                            <th width="20%">Nature of Collection</th>
                            <th width="15%">Amount</th>
                        </tr>

                        @php
                            $grandTotal = 0;
                        @endphp

                        @forelse($data as $item)
                            @php
                                $grandTotal += $item->payment_amount;
                            @endphp

                            <tr>
                                <td class="text-center">
                                    {{ $item->payment_date ? \Carbon\Carbon::parse($item->payment_date)->format('n/j/Y') : '' }}
                                </td>

                                <td class="text-center">{{ $item->or_number }}</td>

                                <td>
                                    {{ strtoupper(
                                        trim($item->last_name . ', ' . $item->first_name . ($item->middle_name ? ' ' . $item->middle_name : '')),
                                    ) }}
                                </td>

                                <td>
                                    {{ strtoupper(str_replace('_', ' ', $item->collection_type)) }}
                                </td>

                                <td class="text-end">
                                    {{ number_format($item->payment_amount, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    No Collection Records Found
                                </td>
                            </tr>
                        @endforelse

                        <tr>
                            <th colspan="4" class="text-end">
                                TOTAL
                            </th>
                            <th class="text-end">
                                {{ number_format($grandTotal, 2) }}
                            </th>
                        </tr>
                    </table>

                    {{-- SECTION B --}}
                    <table class="table table-bordered mb-0">
                        <tr>
                            <th colspan="3" class="text-start">
                                B. DEPOSITS/REMITTANCES
                            </th>
                        </tr>

                        <tr>
                            <th>Name of Accountable Officer/Bank/Branch</th>
                            <th>Reference</th>
                            <th>Amount</th>
                        </tr>

                        <tr>
                            <td>Land Bank of the Philippines - San Jose, Antique</td>
                            <td>Unvalidated Deposit Slip</td>
                            <td></td>
                        </tr>
                    </table>

                    {{-- SECTION C --}}
                    <table class="table table-bordered mb-0">
                        <tr>
                            <th colspan="5" class="text-start">
                                C. SUMMARY OF COLLECTION AND DEPOSITS/REMITTANCES
                            </th>
                        </tr>

                        <tr>
                            <th width="40%">Description</th>
                            <th width="20%">Check No.</th>
                            <th width="20%">Payee</th>
                            <th width="20%">Amount</th>
                        </tr>

                        <tr>
                            <td>Beginning Balance</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Add: Collections</td>
                            <td></td>
                            <td></td>
                            <td>{{ number_format($grandTotal, 2) }}</td>
                        </tr>

                        <tr>
                            <td>Cash</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Checks</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Total</td>
                            <td></td>
                            <td></td>
                            <td>{{ number_format($grandTotal, 2) }}</td>
                        </tr>

                        <tr>
                            <td>Less: Remittance/Deposit</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Ending Balance</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>

                    {{-- SECTION D --}}
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="10" class="text-start">
                                D. ACCOUNTABILITY FOR ACCOUNTABLE FORMS
                            </th>
                        </tr>

                        <tr>
                            <th rowspan="2">Name of Form and No.</th>

                            <th colspan="3">Beginning Balance</th>
                            <th colspan="3">Receipts Issued</th>
                            <th colspan="3">Ending Balance</th>
                        </tr>

                        <tr>
                            <th>Qty</th>
                            <th>From</th>
                            <th>To</th>

                            <th>Qty</th>
                            <th>From</th>
                            <th>To</th>

                            <th>Qty</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>

                        <tr>
                            <td>Money Value Tickets / Cash Tickets</td>

                            <td></td>
                            <td></td>
                            <td></td>

                            <td></td>
                            <td></td>
                            <td></td>

                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('secretary.js.certificationjs')
@endsection
