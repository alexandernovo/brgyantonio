<div class="modal fade" data-bs-backdrop="static" id="rbi1Modal" tabindex="-1" aria-labelledby="rbi1ModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" style="max-width: 920px;">

        <div class="modal-content border-0" style="border-radius: 15px; overflow: hidden;">

            <div class="modal-body p-2">

                {{-- HEADER --}}
                <div class="text-center p-3 position-relative rounded" style="background-color: #1b3f2f;">

                    <button type="button" class="btn-close btn-close-white position-absolute" data-bs-dismiss="modal"
                        aria-label="Close" style="top: 15px; right: 15px;">
                    </button>

                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo"
                        style="width: 95px; height: auto; margin-bottom: 8px;">

                    <h3 class="text-white fw-semibold mb-0" style="letter-spacing: .5px; font-size: 22px;">

                        INDIVIDUAL RECORDS OF BARANGAY INHABITANT

                    </h3>

                </div>

                {{-- BODY --}}
                <div class="py-3 px-3">

                    <form id="residentForm" enctype="multipart/form-data">

                        @csrf

                        <input type="hidden" value="0" name="resident_id" id="resident_id">
                        <input type="hidden" value="single" name="resident_type" id="resident_type">

                        {{-- TITLE --}}
                        <div class="fw-bold mb-2" style="font-size: 16px;">

                            RBI FORM A (Revised 2024)

                        </div>

                        {{-- HEADER FIELDS --}}
                        <div class="row g-2 mb-3">

                            <div class="col-md-6">

                                <div class="d-flex align-items-center gap-2 mb-1">

                                    <label style="width: 90px;" class="fw-semibold">

                                        REGION:

                                    </label>

                                    <input type="text" name="region" id="region"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                </div>

                                <div class="d-flex align-items-center gap-2">

                                    <label style="width: 90px;" class="fw-semibold">

                                        PROVINCE:

                                    </label>

                                    <input type="text" name="province" id="province"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="d-flex align-items-center gap-2 mb-1">

                                    <label style="width: 150px;" class="fw-semibold text-nowrap">

                                        CITY/MUNICIPALITY:

                                    </label>

                                    <input type="text" name="city_municipality" id="city_municipality"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                </div>

                                <div class="d-flex align-items-center gap-2">

                                    <label style="width: 150px;" class="fw-semibold">

                                        BARANGAY:

                                    </label>

                                    <input type="text" name="barangay" id="barangay"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                </div>

                            </div>

                        </div>

                        {{-- PERSONAL INFORMATION --}}
                        <div class="border border-dark p-3 mb-3">

                            <div class="text-center fw-bold mb-3" style="font-size: 18px;">

                                PERSONAL INFORMATION

                            </div>

                            {{-- PHILSYS --}}
                            <div class="mb-3 text-center">

                                <input type="text" name="philsys_card_no" id="philsys_card_no"
                                    class="form-control form-control-sm mx-auto"
                                    style="max-width: 260px; border: 2px solid #444;">

                                <small>(PhilSys Card No.)</small>

                            </div>

                            {{-- NAME --}}
                            <div class="row g-2 mb-2">

                                <div class="col-md-4">

                                    <input type="text" name="last_name" id="last_name"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                    <div class="text-center small">

                                        (Last Name)

                                    </div>

                                </div>

                                <div class="col-md-2">

                                    <input type="text" name="suffix" id="suffix"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                    <div class="text-center small">

                                        (Suffix)

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <input type="text" name="first_name" id="first_name"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                    <div class="text-center small">

                                        (First Name)

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <input type="text" name="middle_name" id="middle_name"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                    <div class="text-center small">

                                        (Middle Name)

                                    </div>

                                </div>

                            </div>

                            {{-- DETAILS --}}
                            <div class="row g-2 mb-2">

                                <div class="col-md-3">

                                    <input type="date" name="birth_date" id="birth_date"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                    <div class="text-center small">

                                        (Birth Date)

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <input type="text" name="birth_place" id="birth_place"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                    <div class="text-center small">

                                        (Birth Place)

                                    </div>

                                </div>

                                <div class="col-md-1">

                                    <select name="sex" id="sex" class="form-select form-select-sm"
                                        style="border: 2px solid #444;">

                                        <option value=""></option>
                                        <option value="Male">M</option>
                                        <option value="Female">F</option>

                                    </select>

                                    <div class="text-center small">

                                        (Sex)

                                    </div>

                                </div>

                                <div class="col-md-2">

                                    <input type="text" name="civil_status" id="civil_status"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                    <div class="text-center small">

                                        (Civil Status)

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <input type="text" name="religion" id="religion"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                    <div class="text-center small">

                                        (Religion)

                                    </div>

                                </div>

                            </div>

                            {{-- ADDRESS --}}
                            <div class="row g-2 mb-2">

                                <div class="col-md-9">

                                    <input type="text" name="residence_address" id="residence_address"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                    <div class="text-center small">

                                        (Residence Address)

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <input type="text" name="citizenship" id="citizenship" value="Filipino"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                    <div class="text-center small">

                                        (Citizenship)

                                    </div>

                                </div>

                            </div>

                            {{-- CONTACT --}}
                            <div class="row g-2 mb-3">

                                <div class="col-md-4">

                                    <input type="text" name="profession_occupation" id="profession_occupation"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                    <div class="text-center small">

                                        (Profession/Occupation)

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <input type="text" name="contact_number" id="contact_number"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                    <div class="text-center small">

                                        (Contact Number)

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <input type="email" name="email_address" id="email_address"
                                        class="form-control form-control-sm" style="border: 2px solid #444;">

                                    <div class="text-center small">

                                        (E-mail Address)

                                    </div>

                                </div>

                            </div>

                            {{-- EDUCATIONAL --}}
                            <div class="mb-3" style="font-size: 13px;">

                                <span class="fw-semibold">

                                    HIGHEST EDUCATIONAL ATTAINMENT:

                                </span>

                                <div class="d-flex flex-wrap gap-3 mt-2">

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            name="highest_educational_attainment" value="ELEMENTARY">
                                        <label class="form-check-label">
                                            ELEMENTARY
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            name="highest_educational_attainment" value="HIGH SCHOOL">
                                        <label class="form-check-label">
                                            HIGH SCHOOL
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            name="highest_educational_attainment" value="COLLEGE">
                                        <label class="form-check-label">
                                            COLLEGE
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            name="highest_educational_attainment" value="POST GRAD">
                                        <label class="form-check-label">
                                            POST GRAD
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                            name="highest_educational_attainment" value="VOCATIONAL">
                                        <label class="form-check-label">
                                            VOCATIONAL
                                        </label>
                                    </div>

                                </div>

                            </div>

                            {{-- EDUCATIONAL STATUS --}}
                            <div class="d-flex align-items-center justify-content-center gap-4 mb-3">

                                <span class="fst-italic">

                                    Please Specify:

                                </span>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="educational_status"
                                        value="Graduate">

                                    <label class="form-check-label">

                                        Graduate

                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="educational_status"
                                        value="Undergraduate">

                                    <label class="form-check-label">

                                        Undergraduate

                                    </label>
                                </div>

                            </div>

                            {{-- CONSENT --}}
                            <div style="font-size: 13px; line-height: 1.6; text-align: justify;">

                                I hereby certify that the above information is true and correct
                                to the best of my knowledge. I understand that for the Barangay
                                to carry out its mandate pursuant to Section 394 (d) (6) of the
                                Local Government Code of 1991, they must necessarily process my
                                personal information for easy identification of inhabitants, as a
                                tool in planning, and as an updated reference in the number of
                                inhabitants of the Barangay. Therefore, I grant my consent and
                                recognize the authority of the Barangay to process my personal
                                information, subject to the provision of the Philippine Data
                                Privacy Act of 2012.

                            </div>

                        </div>

                        {{-- FOOTER BUTTONS --}}
                        <div class="d-flex gap-3">

                            <button onclick="printRBIForm()" type="button"
                                class="btn w-100 text-white fw-semibold py-2"
                                style="background-color: #1b3f2f; border-radius: 6px;">
                                Print
                            </button>

                            <button type="submit" class="btn w-100 text-white fw-semibold py-2"
                                style="background-color: #1a222b; border-radius: 6px;">

                                Save

                            </button>

                            <button type="button" class="btn w-100 text-white fw-semibold py-2"
                                data-bs-dismiss="modal" style="background-color: #8b0000; border-radius: 6px;">

                                Cancel

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
