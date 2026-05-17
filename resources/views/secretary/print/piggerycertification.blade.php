@extends('layout.mainlayout')

@section('content')
    @include('secretary.css.certificationcss')

    <div class="page-container-print p-4">

        {{-- TOP HEADER --}}
        <div class="top-header p-1 d-flex align-items-center mb-4">
            <div class="icon-container me-3">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
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
        <div class="cert-paper px-5 pt-3 pb-4 mx-auto bg-white shadow-sm"
            style="
                max-width: 800px;
                border: 1px solid #cfcfcf;
                font-family: 'Times New Roman', Times, serif;
                color:#000;
            ">

            {{-- HEADER --}}
            <div class="text-center">

                <div style="line-height:1.2; font-size:13px;">
                    <div class="fw-semibold">REPUBLIC OF THE PHILIPPINES</div>
                    <div class="fw-semibold">MUNICIPALITY OF BARBAZA</div>
                    <div>PROVINCE OF ANTIQUE</div>

                    <div class="mt-1 fw-semibold"
                        style="color:#163d8f;">
                        BARANGAY SAN ANTONIO
                    </div>
                </div>

                {{-- TITLE --}}
                <div class="mt-2 fw-semibold text-uppercase"
                    style="font-size:30px; letter-spacing:1px;">
                    BARANGAY BUSINESS CLEARANCE
                </div>

            </div>

            {{-- BUSINESS INFO BOXES --}}
            <div class="mt-4">

                <div class="text-center mb-1"
                    style="font-size:17px;">
                    Clearance is hereby granted to:
                </div>

                {{-- OWNER --}}
                <div class="border border-dark text-center fw-semibold py-1"
                    style="font-size:17px; border-radius:4px;">
                    {{ strtoupper($certification->first_name . ' ' . $certification->middle_name . ' ' . $certification->last_name) }}
                </div>

                <div class="text-center mb-3"
                    style="font-size:13px;">
                    PROPRIETOR
                </div>

                {{-- ADDRESS --}}
                <div class="border border-dark text-center fw-semibold py-1"
                    style="font-size:17px; border-radius:4px;">
                    {{ strtoupper($certification->municipality . ', ' . $certification->province) }}
                </div>

                <div class="text-center mb-3"
                    style="font-size:13px;">
                    ADDRESS
                </div>

                {{-- BUSINESS --}}
                <div class="border border-dark text-center fw-semibold py-1"
                    style="font-size:17px; border-radius:4px;">
                    {{ strtoupper($certification->businesstradename) }}
                </div>

                <div class="text-center mb-3"
                    style="font-size:13px;">
                    BUSINESS / TRADE NAME
                </div>

                {{-- LOCATION --}}
                <div class="border border-dark text-center fw-semibold py-1"
                    style="font-size:17px; border-radius:4px;">
                    {{ strtoupper($certification->businesslocation) }}
                </div>

                <div class="text-center mb-4"
                    style="font-size:13px;">
                    LOCATION
                </div>

            </div>

            {{-- BODY --}}
            <div style="font-size:18px; line-height:1.8; text-align:justify;">

                <div class="fw-semibold mb-2">
                    TO WHOM IT MAY CONCERN:
                </div>

                <p style="text-indent:50px;">

                    This is to certify that this business is located within geographical area /
                    jurisdiction of Barangay San Antonio, Barbaza, Antique and is therefore issued
                    this Barangay Business Clearance as a prerequisite in doing business prior to
                    securing Mayor's Permit, Business License, etc. pursuant to Section 152 Article 4
                    Republic Act No. 7160 otherwise known as the New Local Government Code of 1991.

                </p>

                <p style="text-indent:50px;">

                    Issued upon the request of Owner / Manager of aforementioned business whose
                    signature and Community Tax Certificate Number appears hereunder, this

                    {{ \Carbon\Carbon::parse($certification->date_issued)->format('jS') }}

                    day of

                    {{ \Carbon\Carbon::parse($certification->date_issued)->format('F, Y') }}

                    at San Antonio, Barbaza, Antique.

                </p>

            </div>

            {{-- CHECKBOXES --}}
            <div class="mt-5 ms-2"
                style="font-size:16px; line-height:1.8;">

                <div>
                    ☐ New Business
                </div>

                <div>
                    ☐ Change Location
                </div>

                <div>
                    ☐ Change of Commercial Name
                </div>

                <div>
                    ☐ Renewal of Permit
                </div>

            </div>

            {{-- SIGNATURE --}}
            <div class="d-flex justify-content-end mt-4 pe-5">

                <div class="text-center">

                    <div class="fw-semibold text-uppercase"
                        style="font-size:20px;">
                        HON. EVARISTO D. MALE
                    </div>

                    <div style="font-size:16px;">
                        Punong Barangay
                    </div>

                </div>

            </div>

            {{-- FOOTER --}}
            <div class="mt-5"
                style="font-size:15px; line-height:1.5;">

                <div>
                    <strong>Paid Under O.R No.</strong>
                    {{ $certification->or_number ?? '9647792' }}
                </div>

                <div>
                    Issued ON:
                    {{ \Carbon\Carbon::parse($certification->date_issued)->format('F d, Y') }}
                </div>

                <div>
                    At San Antonio, Barbaza, Antique
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