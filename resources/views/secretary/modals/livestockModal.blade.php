<div class="modal fade" data-bs-backdrop="static" id="livestockModal" tabindex="-1" aria-labelledby="livestockModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 730px">
        <div class="modal-content border-0" style="border-radius: 15px; overflow: hidden;">
            <div class="modal-body p-2">
                <div class="text-center p-4 position-relative rounded" style="background-color: #1b3f2f;">
                    <button type="button" class="btn-close btn-close-white position-absolute" data-bs-dismiss="modal"
                        aria-label="Close" style="top: 15px; right: 15px;"></button>
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo"
                        style="width: 120px; height: auto; margin-bottom: 10px;">
                    <h3 class="text-white fw-semibold mb-0" style="letter-spacing: 1px;">
                        LIVESTOCK CERTIFICATION FORM
                    </h3>
                </div>

                <div class="py-3 px-2">
                    <h5 class="fw-semibold mb-4" style="color: #000;">REQUESTER INFORMATION:</h5>

                    <form id="certificationForm" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="certification_type" value="livestock" id="certification_type">
                        <input type="hidden" name="certification_id" value="0" id="certification_id">

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

                        {{-- OR NUMBER --}}
                        <div class="d-flex align-items-center mb-3">
                            <label class="fw-semibold" style="width: 170px; flex-shrink: 0;">
                                OR Number:
                            </label>

                            <div class="input-group">
                                <span class="input-group-text text-white"
                                    style="background-color: #1A412F; border: 2px solid #1b3f2f; border-right: none;">
                                    <i class="bi bi-receipt"></i>
                                </span>

                                <input type="text" name="or_number" id="or_number" class="form-control"
                                    style="border: 2px solid #1b3f2f; border-radius: 0 6px 6px 0;" required>
                            </div>
                        </div>

                        {{-- ADDRESS --}}
                        <div class="d-flex align-items-center mb-3">
                            <label class="fw-semibold" style="width: 170px; flex-shrink: 0;">
                                Address:
                            </label>

                            <div class="d-flex gap-2 w-100">
                                <input type="text" name="barangay" id="barangay" class="form-control"
                                    placeholder="Barangay" value="San Antonio"
                                    style="border: 2px solid #1b3f2f; border-radius: 6px;">

                                <input type="text" name="municipality" id="municipality" class="form-control"
                                    placeholder="Municipality" value="Barbaza"
                                    style="border: 2px solid #1b3f2f; border-radius: 6px;">

                                <input type="text" name="province" id="province" class="form-control"
                                    placeholder="Province" value="Antique"
                                    style="border: 2px solid #1b3f2f; border-radius: 6px;">
                            </div>
                        </div>

                        {{-- LIVESTOCK --}}
                        <div class="d-flex align-items-center mb-3">

                            <label class="fw-semibold text-nowrap" style="width: 170px; flex-shrink: 0;">
                                Name of Livestock:
                            </label>

                            <input type="text" name="namelivestock" id="namelivestock" class="form-control"
                                style="border: 2px solid #1b3f2f; border-radius: 6px;" required>

                            <label class="fw-semibold text-nowrap px-2">
                                Number of Livestock:
                            </label>

                            <input type="number" name="nolivestock" id="nolivestock" class="form-control"
                                style="border: 2px solid #1b3f2f; border-radius: 6px;" required>
                        </div>

                        {{-- AGE CLASS / COLOR --}}
                        <div class="d-flex align-items-center mb-3">

                            <label class="fw-semibold text-nowrap" style="width: 170px; flex-shrink: 0;">
                                Age Classes:
                            </label>

                            {{-- <select name="ageclasses" id="ageclasses" class="form-select"
                                style="border: 2px solid #1b3f2f; border-radius: 6px;" required>

                                <option value="">Select</option>
                                <option value="Young">Young</option>
                                <option value="Adult">Adult</option>
                                <option value="Old">Old</option>

                            </select> --}}
                            <input type="text" name="ageclasses" id="ageclasses" class="form-control"
                                style="border: 2px solid #1b3f2f; border-radius: 6px;" required>
                            <label class="fw-semibold text-nowrap px-2">
                                Color:
                            </label>

                            <input type="text" name="color" id="color" class="form-control"
                                style="border: 2px solid #1b3f2f; border-radius: 6px;" required>
                        </div>

                        {{-- SEX LIVESTOCK --}}
                        <div class="d-flex align-items-center mb-3">

                            <label class="fw-semibold text-nowrap" style="width: 170px; flex-shrink: 0;">
                                Sex (Livestock):
                            </label>

                            <div class="form-check me-2">
                                <input class="form-check-input" type="radio" name="sexlivestock" value="Male"
                                    id="sexlivestockMale">

                                <label class="form-check-label" for="sexlivestockMale">
                                    Male
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sexlivestock" value="Female"
                                    id="sexlivestockFemale">

                                <label class="form-check-label" for="sexlivestockFemale">
                                    Female
                                </label>
                            </div>
                        </div>

                        {{-- DATE ISSUED --}}
                        <div class="d-flex align-items-center mb-4">
                            <label class="fw-semibold" style="width: 170px; flex-shrink: 0;">
                                Date Issued:
                            </label>

                            <div class="input-group">
                                <span class="input-group-text text-white"
                                    style="background-color: #1A412F; border: 2px solid #1b3f2f; border-right: none;">
                                    <i class="bi bi-calendar-event"></i>
                                </span>

                                <input type="date" name="date_issued" id="date_issued" class="form-control"
                                    style="border: 2px solid #1b3f2f; border-radius: 0 6px 6px 0;" required>
                            </div>
                            <label class="fw-semibold text-nowrap px-2">
                                Livestock Owner:
                            </label>
                            <input type="text" name="livestockowner" id="livestockowner" class="form-control"
                                placeholder="Livestock Owner" style="border: 2px solid #1b3f2f; border-radius: 6px;">
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
