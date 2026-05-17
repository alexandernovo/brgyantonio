<div class="modal fade" data-bs-backdrop="static" id="quarryModal" tabindex="-1" aria-labelledby="quarryModalLabel"
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
                        BARANGAY QUARRY CERTIFICATION FORM
                    </h3>
                </div>

                <div class="py-3 px-2">
                    <h5 class="fw-semibold mb-4" style="color: #000;">REQUESTER INFORMATION:</h5>

                    <form id="certificationForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="certification_type" value="quarry" id="certification_type">
                        <input type="hidden" name="certification_id" value="0" id="certification_id">

                        <div class="d-flex align-items-center mb-3">
                            <label class="fw-semibold" style="width: 140px; flex-shrink: 0;">Complete Name:</label>
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

                        <div class="d-flex align-items-center flex-grow-1 mb-3">
                            <label class="fw-semibold text-end px-3 text-nowrap" style="width: 140px;">
                                Date Issued:
                            </label>
                            <div class="input-group" style="flex: 1">
                                <span class="input-group-text text-white"
                                    style="background-color: #1A412F; border: 2px solid #1b3f2f; border-right: none;"><i
                                        class="bi bi-calendar-event"></i></span>
                                <input type="date" name="date_issued" id="date_issued" class="form-control"
                                    style="border: 2px solid #1b3f2f; border-radius: 0 6px 6px 0;" required>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn w-100 text-white fw-semibold py-2"
                                style="background-color: #1a222b; border-radius: 6px;">Save</button>
                            <button type="button" class="btn w-100 text-white fw-semibold py-2"
                                data-bs-dismiss="modal"
                                style="background-color: #8b0000; border-radius: 6px;">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
