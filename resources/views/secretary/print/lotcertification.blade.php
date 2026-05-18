@extends('layout.mainlayout')

@section('content')
    @include('secretary.css.certificationcss')

    <div class="page-container-print p-4">

        {{-- TOP HEADER --}}
        <div class="top-header p-1 d-flex align-items-center mb-4">
            <div class="icon-container me-3">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                </svg>
            </div>

            <div>
                <h3 class="mb-0">CERTIFICATION</h3>
                <p class="mb-0 text-muted">Dashboard | Certification</p>
            </div>
        </div>

        {{-- CERTIFICATE --}}
        <div class="cert-paper px-5 pt-4 pb-4 mx-auto bg-white shadow-sm"
            style="
                max-width: 800px;
                border: 1px solid #cfcfcf;
                font-family: 'Times New Roman', Times, serif;
                color:#000;
                min-height: 1050px;
            ">

            {{-- HEADER --}}
            <div class="text-center position-relative">

                {{-- LOGO --}}
                <img src="{{ asset('assets/images/logo.jpg') }}" style="width: 70px;position: absolute;left: 60px;top: 0;">

                {{-- HEADER TEXT --}}
                <div style="line-height:1.2; font-size:13px;">
                    <div>Republic of the Philippines</div>
                    <div>Province of Antique</div>
                    <div>Municipality of Barbaza</div>
                    <div class="fw-semibold">Barangay SAN ANTONIO</div>
                    <div>-o0o-</div>
                </div>

                {{-- OFFICE --}}
                <div class="mt-2 fw-semibold" style="color:#1f4e79;font-size:13px;">
                    OFFICE OF THE PUNONG BARANGAY
                </div>

                {{-- LINE --}}
                <div class="mt-2 mb-2" style="border-top:2px solid #355d8a;">
                </div>

                {{-- TITLE --}}
                <div class="fw-semibold text-uppercase"
                    style="
                        font-size:20px;
                        color:#1f2f5f;
                        letter-spacing:5px;
                    ">
                    CERTIFICATION
                </div>

            </div>

            {{-- BODY --}}
            <div class="mt-5 px-3"
                style="
                    font-size:14px;
                    line-height:1.9;
                    text-align:justify;
                ">

                <div class="fw-semibold mb-4" style="font-size:14px;">
                    TO WHOM IT MAY CONCERN:
                </div>

                <p style="text-indent:55px;">

                    This is to certify that the identified land registered in the name

                    <strong>
                        {{ strtoupper($certification->first_name . ' ' . $certification->middle_name . ' ' . $certification->last_name) }}
                    </strong>

                    covered by OCT/TCT No.

                    <strong>
                        {{ $certification->octnumber }}
                    </strong>

                    with an area of

                    <strong>
                        {{ $certification->lotarea }}
                    </strong>

                    square meters located at

                    <strong>
                        {{ $certification->lotlocation }}
                    </strong>,

                    or declared under Tax Declaration No.

                    <strong>
                        {{ $certification->taxdeclarationnumber }}
                    </strong>

                    had undergone verification and the results are as follows:

                    <br>

                    <span style="font-size:13px;">
                        (please check the appropriate box)
                    </span>

                </p>

                {{-- CHECKLIST --}}
                <div class="mt-3"
                    style="
                        padding-left: 25px;
                        font-size:14px;
                        line-height:1.8;
                    ">

                    <div class="d-flex align-items-start mb-2">
                        <div
                            style="
                                width:16px;
                                height:16px;
                                border:1px solid #000;
                                margin-right:10px;
                                margin-top:4px;
                                flex-shrink:0;
                            ">
                        </div>

                        <div>
                            There are agricultural tenants/ leaseholders,
                            farmworkers, actual tillers and other workers
                            directly tilling on the subject land;
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-2">
                        <div
                            style="
                                width:16px;
                                height:16px;
                                border:1px solid #000;
                                margin-right:10px;
                                margin-top:4px;
                                flex-shrink:0;
                            ">
                        </div>

                        <div>
                            There are no agricultural tenants/leaseholders,
                            actual tillers and other workers directly tilling
                            on the subject land;
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-2">
                        <div
                            style="
                                width:16px;
                                height:16px;
                                border:1px solid #000;
                                margin-right:10px;
                                margin-top:4px;
                                flex-shrink:0;
                            ">
                        </div>

                        <div>
                            There are no erected/ ongoing constructions of
                            the building or non-agricultural related
                            development/ activities which would warrant the
                            filing of an illegal conversion or premature
                            conversion case pursuant to R.A.6657, as amended
                            by R.A. 9700 R.A. 8435 and its pertinent rules
                            and regulations and
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <div
                            style="
                                width:16px;
                                height:16px;
                                border:1px solid #000;
                                margin-right:10px;
                                margin-top:4px;
                                flex-shrink:0;
                            ">
                        </div>

                        <div>
                            There are no conflict of claims involving the
                            subject land by and between the families or
                            third person claimant.
                        </div>
                    </div>

                </div>

                {{-- ISSUED --}}
                <p class="mt-5 text-center" style="font-size:14px;">

                    Given this

                    {{ \Carbon\Carbon::parse($certification->date_issued)->format('jS') }}

                    day of

                    {{ \Carbon\Carbon::parse($certification->date_issued)->format('F, Y') }}

                    at Barangay San Antonio, Barbaza, Antique, Philippines.

                </p>

            </div>

            {{-- SIGNATURE --}}
            <div class="d-flex justify-content-center mt-5">

                <div class="text-center" style="width:250px;">

                    <div class="fw-semibold text-uppercase" style="font-size:15px;">
                        HON. EVARISTO D. MALE
                    </div>

                    <div style="font-size:13px;">
                        Punong Barangay
                    </div>

                </div>

            </div>

            {{-- OR DETAILS --}}
            <div class="mt-5"
                style="
                    font-size:13px;
                    line-height:1.5;
                ">

                <div>
                    Paid Under O.R No
                    {{ $certification->or_number ?? '9647786' }}
                </div>

                <div>
                    Issued ON:
                    {{ \Carbon\Carbon::parse($certification->date_issued)->format('F j, Y') }}
                </div>

                <div>
                    At San Antonio., Barbaza, Antique
                </div>

            </div>

            {{-- BUTTON --}}
            <hr class="mt-4 mb-3" style="border-top:1px solid #000;">

            <div class="d-flex justify-content-end">

                <button onclick="window.print()" class="btn btn-dark px-4 py-2">

                    <i class="fas fa-print me-2"></i>
                    Print

                </button>

            </div>

        </div>

    </div>
@endsection
