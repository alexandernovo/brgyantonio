@extends('layout.mainlayout')

@section('content')
    @include('secretary.css.certificationcss')
    <div class="page-container-print p-4">
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

        <div class="cert-paper px-5 pt-5 pb-4 mx-auto bg-white shadow-sm"
            style="max-width: 800px; border: 1px solid #ddd; font-family: 'Times New Roman', Times, serif; color: #000;">
            <div style="min-height: 11in">
                <div class="text-center mb-4 position-relative">
                    <img src="{{ asset('assets/images/logo.jpg') }}"
                        style="width: 80px; position: absolute; left: 70px; top: 15px;" alt="Logo">

                    <div class="header-text">
                        <p class="mb-0">Republic of the Philippines</p>
                        <p class="mb-0">Province of Antique</p>
                        <p class="mb-0">Municipality of Barbaza</p>
                        <p class="mb-0">Barangay San Antonio</p>
                    </div>

                    <h5 class="mt-5 fw-semibold" style="font-size: 15px">OFFICE OF THE PUNONG BARANGAY</h5>
                    <h4 class="fw-semibold mt-2" style="letter-spacing: 2px; text-transform: uppercase;">
                        BARANGAY CERTIFICATION
                    </h4>
                </div>

                <div class="mt-5 px-4">
                    <p class="fw-semibold">To Whom It May Concern:</p>

                    <p style="text-indent: 50px; text-align: justify; line-height: 1.6;">
                        TO WHOM IT MAY CONCERN:
                        This is to CERTIFY that
                        <strong>{{ strtoupper($certification->first_name . ' ' . $certification->last_name) }}</strong> a
                        bonafide resident of
                        Barangay San Antonio, Barbaza, Antique, Philippines is personally, known to mea person
                        of good moral character and law-abiding citizen with good reputation in the community.
                        He/She has no pending administrative case filed against him/her.
                    </p>


                    <p class="mt-4" style="text-indent: 50px; text-align: justify;">
                        This CERTIFICATION is being issued upon the request of the interested party for
                        whatever legal purpose it may serve.
                        Issued this {{ \Carbon\Carbon::parse($certification->date_issued)->format('jS \of F, Y') }}, at
                        Barangay San Antonio, Barbaza, Antique,
                        Philippines.
                    </p>

                </div>

                <div class="mt-2 pt-2 px-4 d-flex justify-content-center">
                    <div class="d-flex flex-column align-items-center w-75 justify-content-center">
                        <p class="mb-0 align-self-start">Approved By:</p>
                        <div class="text-center mt-3" style="width: 250px;">
                            <div style="border-bottom: 1px solid #000; margin-bottom: 5px;">
                                <span class="fw-semibold">EVARISTO D. MALE</span>
                            </div>
                            <small>Punong Barangay</small>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-2 mb-0" style="border-top: 1px solid black">
            <div class="d-flex justify-content-end mt-4">
                <button onclick="window.print()" class="btn btn-dark px-4">
                    <i class="fas fa-print me-2"></i> Print Certification
                </button>
            </div>
        </div>


    </div>
@endsection
