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
            ">

            {{-- HEADER --}}
            <div class="text-center position-relative">

                {{-- LOGO --}}
                <img src="{{ asset('assets/images/logo.jpg') }}" style="width: 85px;position: absolute;left: 40px;top: 0;">

                {{-- HEADER TEXT --}}
                <div style="line-height:1.3; font-size:15px;">
                    <div>Republic of the Philippines</div>
                    <div>Province of Antique</div>
                    <div>Municipality of Barbaza</div>
                    <div class="semifw-bold">Barangay SAN ANTONIO</div>
                </div>

                {{-- OFFICE --}}
                <div class="mt-3 fw-semibold" style="color:#2d628d;font-size:14px;">
                    OFFICE OF THE PUNONG BARANGAY
                </div>

                {{-- LINE --}}
                <div class="mt-2 mb-2" style="border-top:2px solid #3a5f87;"></div>

                {{-- TITLE (CHANGED ONLY THIS) --}}
                <div class="fw-semibold text-uppercase" style="font-size:30px;color:#1e3d92;letter-spacing:.5px;">
                    CERTIFICATION
                </div>

            </div>

            {{-- BODY (UPDATED ONLY CONTENT) --}}
            <div class="mt-5 px-3" style="font-size:18px;line-height:2;text-align:justify;">

                <div class="fsemiw-bold mb-4">
                    TO WHOM IT MAY CONCERN:
                </div>

                <p style="text-indent:60px;">

                    This is to CERTIFY that

                    <strong>
                        {{ strtoupper($certification->first_name . ' ' . $certification->middle_name . ' ' . $certification->last_name) }}
                    </strong>,
                    resident of
                    {{ strtoupper($certification->barangay . ', ' . $certification->municipality . ', ' . $certification->province) }}
                    bought {{ $certification->ageclasses }} year old color {{ $certification->color }}
                    {{ $certification->sexlivestock }} {{ $certification->namelivestock }} with
                    {{ $certification->livestockowner }} at San
                    Antonio, Barbaza, Antique.
                </p>

                <p class="mt-3" style="text-indent:60px;">
                    This certification is being issued upon the request of the interested party for whatever
                    legal purpose it may serve.
                </p>

                <p class="mt-5 text-start">

                    Done this 30th day of January, 2026

                    {{ \Carbon\Carbon::parse($certification->date_issued)->format('jS') }}

                    day of

                    {{ \Carbon\Carbon::parse($certification->date_issued)->format('F Y') }}

                    at at San Antonio Barbaza, Antique, Philippines.
                </p>

            </div>

            {{-- SIGNATURE --}}
            <div class="d-flex justify-content-end mt-5 pe-5 me-5">

                <div class="text-center" style="width:260px;padding:20px 10px 12px;">

                    <div class="fw-semibold text-uppercase" style="font-size:16px;">
                        HON. EVARISTO D. MALE
                    </div>

                    <div style="font-size:15px;">
                        Punong Barangay
                    </div>

                </div>

            </div>
            {{-- OR NUMBER --}}
            <div class="mt-5">

                <div
                    style="
                        width:300px;
                        padding:15px;
                        font-size:15px;
                        line-height:1.7;
                    ">

                    <div>
                        <strong>Paid Under O.R No.</strong>
                        {{ $certification->or_number ?? '9647788' }}
                    </div>

                    <div>
                        Issued On:
                        {{ \Carbon\Carbon::parse($certification->date_issued)->format('F j, Y') }}
                    </div>

                    <div>
                        At
                        {{ $certification->barangay }},
                        {{ $certification->municipality }},
                        {{ $certification->province }}
                    </div>

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
