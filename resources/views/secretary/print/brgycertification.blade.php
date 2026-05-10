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

                    <div
                        style="width: 120px; height: 120px; border: 1px solid #000; position: absolute; right: 50px; top: 15px; overflow: hidden;">
                        @if ($certification->image_path)
                            <img src="{{ asset('uploads/certifications/' . $certification->image_path) }}"
                                class="w-100 h-100 object-fit-cover" alt="Resident Photo">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 text-muted">No Photo</div>
                        @endif
                    </div>

                    <h5 class="mt-5 fw-semibold" style="font-size: 15px">OFFICE OF THE PUNONG BARANGAY</h5>
                    <h4 class="fw-semibold mt-2" style="letter-spacing: 2px; text-transform: uppercase;">
                        BARANGAY CERTIFICATION
                    </h4>
                </div>

                <div class="mt-5 px-4">
                    <p class="fw-semibold">To Whom It May Concern:</p>

                    <p style="text-indent: 50px; text-align: justify; line-height: 1.6;">
                        This is to certify that the person whose name, photo, signature/thumbmark appears herein is a
                        Bonafide
                        resident of Barangay San Antonio, Barbaza, Antique.
                    </p>

                    <div class="mt-4 ms-5">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="30%" class="fw-semibold">FULLNAME</td>
                                <td class="fw-semibold">:
                                    {{ strtoupper($certification->first_name . ' ' . $certification->middle_name . ' ' . $certification->last_name) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">ADDRESS</td>
                                <td class="fw-semibold">:
                                    {{ strtoupper($certification->barangay . ', ' . $certification->municipality . ', ' . $certification->province) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">DATE OF BIRTH</td>
                                <td class="fw-semibold">:
                                    {{ \Carbon\Carbon::parse($certification->date_of_birth)->format('F j, Y') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">PLACE OF BIRTH</td>
                                <td class="fw-semibold">: {{ strtoupper($certification->place_of_birth) }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">SEX</td>
                                <td class="fw-semibold">: {{ strtoupper($certification->sex) }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">NATIONALITY</td>
                                <td class="fw-semibold">: {{ strtoupper($certification->nationality) }}</td>
                            </tr>
                        </table>
                    </div>

                    <p class="mt-4" style="text-indent: 50px; text-align: justify;">
                        This Certification is being issued upon the request of
                        <strong>{{ strtoupper($certification->first_name . ' ' . $certification->last_name) }}</strong> to
                        process his/her PhilSys (National ID) Registration.
                    </p>

                    <p class="mt-4">
                        Done this {{ \Carbon\Carbon::parse($certification->date_issued)->format('jS \of F, Y') }} at San
                        Antonio, Barbaza, Antique.
                    </p>
                </div>

                <div class="mt-2 pt-2 px-4">
                    <div class="d-flex flex-column align-items-start">
                        <div class="text-center" style="width: 250px;">
                            <div style="position: relative;">
                                <img src="{{ asset('images/punong-barangay-signature.png') }}"
                                    style="height: 50px; position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%);"
                                    alt="">
                                <div
                                    style="border-bottom: 1px solid #000; margin-bottom: 5px; position: relative; z-index: 2;">
                                    <span class="fw-semibold">HON. EVARISTO D. MALE</span>
                                </div>
                            </div>
                            <p class="mb-0">Punong Barangay</p>
                        </div>
                        <div class="text-center mt-3" style="width: 250px;">
                            <div style="border-bottom: 1px solid #000; margin-bottom: 5px;">
                                <span
                                    class="fw-semibold">{{ strtoupper($certification->first_name . ' ' . $certification->last_name) }}</span>
                            </div>
                            <small>Registrant/Client</small>
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
