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
        <div class="cert-paper px-5 pt-3 pb-4 mx-auto bg-white shadow-sm"
            style="
                max-width: 800px;
                border: 1px solid #cfcfcf;
                font-family: 'Times New Roman', Times, serif;
                color:#000;
            ">

            {{-- HEADER --}}
            <div class="text-center position-relative">

                {{-- LOGO --}}
                <img src="{{ asset('assets/images/logo.jpg') }}"
                    style="width: 70px; position: absolute; left: 65px; top: 0;">

                {{-- HEADER TEXT --}}
                <div style="line-height:1.2; font-size:13px;">
                    <div>Republic of the Philippines</div>
                    <div>Province of Antique</div>
                    <div>Municipality of Barbaza</div>
                    <div class="fw-semibold">BARANGAY SAN ANTONIO</div>
                    <div>-o0o-</div>
                </div>

                {{-- OFFICE --}}
                <div class="mt-2 fw-semibold" style="color:#1f3f75;font-size:13px;">
                    OFFICE OF THE PUNONG BARANGAY
                </div>

                {{-- LINE --}}
                <div class="mt-2 mb-2" style="border-top:2px solid #2c5f9e;">
                </div>

                {{-- TITLE --}}
                <div class="fw-semibold text-uppercase"
                    style="
                        font-size:20px;
                        letter-spacing:6px;
                        color:#1b1b1b;
                    ">
                    CERTIFICATION
                </div>

            </div>

            {{-- BODY --}}
            <div class="mt-5 px-2"
                style="
                    font-size:15px;
                    min-height: 10in;
                    line-height:2;
                    text-align:justify;
                ">

                <div class="fw-semibold mb-4" style="font-size:14px;">
                    TO WHOM IT MAY CONCERN:
                </div>

                <p style="text-indent:55px;">

                    This is to certify that

                    <strong>
                        MR.
                        {{ strtoupper($certification->first_name . ' ' . $certification->middle_name . ' ' . $certification->last_name) }}
                    </strong>

                    a Commercial Sand and Gravel permittee at
                    San Antonio, Barbaza, Antique has already finished
                    his protection levee along the Dalanas River for
                    security and safety of the residents of the said barangay.

                </p>

                <p class="mt-4" style="text-indent:55px;">

                    This certification is being issued upon the request
                    of the interested party for whatever legal purpose
                    it may serve.

                </p>

                <p class="mt-5 text-center" style="font-size:15px;">

                    Issued this

                    {{ \Carbon\Carbon::parse($certification->date_issued)->format('jS') }}

                    day of

                    {{ \Carbon\Carbon::parse($certification->date_issued)->format('F , Y') }}

                    at San Antonio, Barbaza, Antique.

                </p>
                {{-- SIGNATURE --}}
                <div class="d-flex justify-content-center mt-5">

                    <div class="text-center" style="width:240px;">

                        <div class="fw-semibold text-uppercase" style="font-size:14px;">
                            HON. EVARISTO D. MALE
                        </div>

                        <div style="font-size:13px;">
                            Punong Barangay
                        </div>

                    </div>

                </div>
            </div>



            {{-- BUTTON --}}
            <hr class="mt-5 mb-3" style="border-top:1px solid #000;">

            <div class="d-flex justify-content-end">

                <button onclick="window.print()" class="btn btn-dark px-4 py-2">

                    <i class="fas fa-print me-2"></i>
                    Print

                </button>

            </div>

        </div>

    </div>
@endsection
