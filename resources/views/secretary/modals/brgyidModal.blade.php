<div class="modal fade" data-bs-backdrop="static" id="brgyIdModal" tabindex="-1" aria-labelledby="brgyIdModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" style="max-width: 730px">

        <div class="modal-content border-0" style="border-radius: 15px; overflow: hidden;">

            <div class="modal-body p-2">

                {{-- HEADER --}}
                <div class="text-center p-4 position-relative rounded" style="background-color: #1b3f2f;">

                    <button type="button" class="btn-close btn-close-white position-absolute" data-bs-dismiss="modal"
                        aria-label="Close" style="top: 15px; right: 15px;">
                    </button>

                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo"
                        style="width: 120px; height: auto; margin-bottom: 10px;">

                    <h3 class="text-white fw-semibold mb-0" style="letter-spacing: 1px;">

                        BARANGAY ID REQUEST FORM

                    </h3>

                </div>

                {{-- BODY --}}
                <div class="py-3 px-2">

                    <h5 class="fw-semibold mb-4" style="color: #000;">
                        REQUESTER INFORMATION:
                    </h5>

                    <form id="brgyIdForm" enctype="multipart/form-data">
                        <input type="hidden" value="0" name="brgy_id" id="brgy_id">
                        @csrf

                        {{-- COMPLETE NAME --}}
                        <div class="d-flex align-items-center mb-3">

                            <label class="fw-semibold" style="width: 170px; flex-shrink: 0;">

                                Complete Name:

                            </label>

                            <div class="d-flex gap-2 w-100">

                                <input type="text" name="first_name" id="first_name" class="form-control"
                                    placeholder="First Name" style="border: 2px solid #1b3f2f; border-radius: 6px;"
                                    required>

                                <input type="text" name="middle_name" id="middle_name" class="form-control"
                                    placeholder="Middle Name" style="border: 2px solid #1b3f2f; border-radius: 6px;">

                                <input type="text" name="last_name" id="last_name" class="form-control"
                                    placeholder="Last Name" style="border: 2px solid #1b3f2f; border-radius: 6px;"
                                    required>

                            </div>

                        </div>

                        {{-- ID NUMBER / CONTACT NUMBER --}}
                        <div class="d-flex align-items-center mb-3">

                            <label class="fw-semibold text-nowrap" style="width: 170px; flex-shrink: 0;">

                                ID Number:

                            </label>

                            <input type="text" name="idnumber" id="idnumber" class="form-control"
                                style="border: 2px solid #1b3f2f; border-radius: 6px;" required>

                            <label class="fw-semibold text-nowrap px-2">

                                Contact Number:

                            </label>

                            <input type="text" name="contact_number" id="contact_number" class="form-control"
                                style="border: 2px solid #1b3f2f; border-radius: 6px;" required>

                        </div>

                        {{-- GUIDANCE / GUIDANCE CONTACT --}}
                        <div class="d-flex align-items-center mb-3">

                            <label class="fw-semibold text-nowrap" style="width: 170px; flex-shrink: 0;">

                                Guidance:

                            </label>

                            <input type="text" name="guidance" id="guidance" class="form-control"
                                style="border: 2px solid #1b3f2f; border-radius: 6px;" required>

                            <label class="fw-semibold text-nowrap px-2">

                                Contact Number:

                            </label>

                            <input type="number" name="guidance_contact" id="guidance_contact" class="form-control"
                                style="border: 2px solid #1b3f2f; border-radius: 6px;" required>

                        </div>

                        {{-- DATE EXPIRED / DATE CLAIM --}}
                        <div class="d-flex align-items-center mb-3">

                            <label class="fw-semibold text-nowrap" style="width: 170px; flex-shrink: 0;">

                                Date Expired:

                            </label>

                            <input type="datetime-local" name="dateexpired" id="dateexpired" class="form-control"
                                style="border: 2px solid #1b3f2f; border-radius: 6px; width: 28.5%;" required>

                            <label class="fw-semibold text-nowrap px-2 flex-shrink-0" style="width: 130px;">

                                Date Claim:

                            </label>

                            <input type="datetime-local" name="dateclaim" id="dateclaim" class="form-control"
                                style="border: 2px solid #1b3f2f; border-radius: 6px; width: 28.5%;" required>

                        </div>

                        {{-- BIRTHDATE --}}
                        <div class="d-flex align-items-center mb-4">

                            <label class="fw-semibold" style="width: 170px; flex-shrink: 0;">

                                Birthdate:

                            </label>

                            <div class="input-group">

                                <input type="date" name="birthdate" id="birthdate" class="form-control"
                                    style="border: 2px solid #1b3f2f; border-radius: 6px;" required>

                            </div>

                        </div>

                        {{-- BUTTONS --}}
                        <div class="d-flex gap-3">

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
