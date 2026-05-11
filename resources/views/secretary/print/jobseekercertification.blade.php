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

            <div style="min-height:11in;">

                {{-- HEADER --}}
                <div class="text-center position-relative">

                    {{-- LOGO --}}
                    <img src="{{ asset('assets/images/logo.jpg') }}"
                        style="
                            width:70px;
                            position:absolute;
                            left:70px;
                            top:5px;
                        ">

                    {{-- HEADER TEXT --}}
                    <div style="font-size:15px; line-height:1.2;" class="fw-semibold">

                        <div>Republic of the Philippines</div>
                        <div>Province of Antique</div>
                        <div>Municipality of Barbaza</div>
                        <div>Barangay SAN ANTONIO</div>

                    </div>


                    {{-- OFFICE TITLE --}}
                    <div class="mt-4">

                        <div class="fw-bold" style="font-size:17px; color: #2f6b9f">
                            OFFICE OF THE PUNONG BARANGAY
                        </div>

                        <div class="mt-2"
                            style="
                                height:3px;
                                background:#0d6efd;
                            ">
                        </div>

                        <div class="fw-bold text-danger"
                            style="
                                font-size:22px;
                                letter-spacing:.5px;
                                text-shadow:.5px .5px #0d47a1;
                            ">

                            BARANGAY CERTIFICATION

                        </div>

                    </div>

                </div>


                {{-- BODY --}}
                <div class="mt-4 px-4" style="font-size:16px; line-height:1.9;">

                    <p class="fw-bold mb-4">
                        TO WHOM IT MAY CONCERN:
                    </p>

                    <p class="fw-semibold" style="text-indent:60px; text-align:justify;">

                        This is to certify that

                        <strong>
                            {{ strtoupper($certification->first_name . ' ' . $certification->middle_name . ' ' . $certification->last_name) }}
                        </strong>,

                        of legal age,

                        {{ strtolower($certification->civil_status) }},

                        resident of Purok
                        {{ $certification->purok }},
                        Barangay San Antonio, Barbaza, Antique
                        for {{ $certification->age }} years and is qualified to avail of RA 11261 or the First Time
                        Jobseekers Act of 2019.

                    </p>

                    <p class="mt-4 fw-semibold" style="text-indent:60px; text-align:justify;">

                        This certification further that the holder was informed of his rights,
                        including the duties and responsibilities accorded by RA 11261 through
                        the act of understanding he/she has signed and executed in our presence.

                    </p>

                    <p class="mt-5 fw-bold text-center">

                        Given this

                        {{ \Carbon\Carbon::parse($certification->date_issued)->format('jS') }}

                        day of

                        {{ \Carbon\Carbon::parse($certification->date_issued)->format('F, Y') }}

                        at Barangay
                        {{ $certification->barangay }},
                        {{ $certification->municipality }},
                        {{ $certification->province }},
                        Philippines.

                    </p>

                </div>

                {{-- SIGNATURE --}}
                <div class="mt-5 d-flex justify-content-center">

                    <div class="text-center" style="width:280px;">

                        <div style="border-bottom:1px solid #000;">

                            <span class="fw-semibold" style="font-size:14px;">

                                HON. EVARISTO D. MALE

                            </span>

                        </div>

                        <div class="fw-semibold" style="font-size:13px;">

                            Punong Barangay

                        </div>

                    </div>
                </div>
            </div>


            {{-- PRINT BUTTON --}}
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
