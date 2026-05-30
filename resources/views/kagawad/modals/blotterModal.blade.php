<div class="modal fade" data-bs-backdrop="static" id="blotterModal" tabindex="-1" aria-labelledby="blotterModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-top" style="max-width: 630px">
        <div class="modal-content border-0" style="border-radius: 15px; overflow: hidden;">

            <!-- Modal Header Based on Image -->
            <div class="modal-body p-2">
                <div class="text-center p-4 position-relative rounded" style="background-color: #1b3f2f;">
                    <button type="button" class="btn-close btn-close-white position-absolute" data-bs-dismiss="modal"
                        aria-label="Close" style="top: 15px; right: 15px;"></button>
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo"
                        style="width: 120px; height: auto; margin-bottom: 10px;">
                    <h3 class="text-white fw-semibold mb-0" style="letter-spacing: 1px;">
                        BLOTTER COMPLAINT FORM
                    </h3>
                </div>

                <!-- Form Fields Matching Image and Migration Schema -->
                <div class="py-3 px-3">
                    <form id="blotterComplaintForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="record_type" value="blotter">
                        <input type="hidden" name="record_id" value="0">
                        
                        <div class="mb-1">
                            <label class="fw-semibold mb-1">Case Code:</label>
                            <input type="text" name="code" id="code" class="form-control"
                                style="border: 2px solid #1b3f2f; border-radius: 6px;">
                        </div>

                        <!-- Complainant Fields -->
                        <div class="mb-1">
                            <label class="fw-semibold mb-1">Complainant:</label>
                            <div class="d-flex gap-2">
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

                        <!-- Respondent Fields -->
                        <div class="mb-1">
                            <label class="fw-semibold mb-1">Respondent:</label>
                            <div class="d-flex gap-2">
                                <input type="text" name="respondent_first_name" id="respondent_first_name"
                                    class="form-control" placeholder="First Name"
                                    style="border: 2px solid #1b3f2f; border-radius: 6px;">
                                <input type="text" name="respondent_middle_name" id="respondent_middle_name"
                                    class="form-control" placeholder="Middle Name"
                                    style="border: 2px solid #1b3f2f; border-radius: 6px;">
                                <input type="text" name="respondent_last_name" id="respondent_last_name"
                                    class="form-control" placeholder="Last Name"
                                    style="border: 2px solid #1b3f2f; border-radius: 6px;">
                            </div>
                        </div>

                        <!-- Nature of Case -->
                        <div class="mb-1">
                            <label class="fw-semibold mb-1">Nature of Case:</label>
                            <input type="text" name="nature_case" id="nature_case" class="form-control"
                                style="border: 2px solid #1b3f2f; border-radius: 6px;">
                        </div>

                        <!-- Dates Side-by-Side Block -->
                        <div class="row mb-3">
                            <!-- Date of Complaints -->
                            <div class="col-md-6">
                                <label class="fw-semibold mb-1">Date of Complaints:</label>
                                <div class="input-group">
                                    <span class="input-group-text text-white"
                                        style="background-color: #1A412F; border: 2px solid #1b3f2f; border-right: none;">
                                        <i class="bi bi-calendar-event"></i>
                                    </span>
                                    <input type="date" name="date_of_complaints" id="date_of_complaints"
                                        class="form-control"
                                        style="border: 2px solid #1b3f2f; border-radius: 0 6px 6px 0;">
                                </div>
                            </div>

                            <!-- Date of Resolved -->
                            <div class="col-md-6">
                                <label class="fw-semibold mb-1">Date of Resolved:</label>
                                <div class="input-group">
                                    <span class="input-group-text text-white"
                                        style="background-color: #1A412F; border: 2px solid #1b3f2f; border-right: none;">
                                        <i class="bi bi-calendar-event"></i>
                                    </span>
                                    <input type="date" name="date_of_resolve" id="date_of_resolve"
                                        class="form-control"
                                        style="border: 2px solid #1b3f2f; border-radius: 0 6px 6px 0;">
                                </div>
                            </div>
                        </div>

                        <!-- Case Status Select Dropdown -->
                        <div class="mb-4">
                            <label class="fw-semibold mb-1">Case Status:</label>
                            <select name="status" id="status" class="form-select text-muted"
                                style="border: 2px solid #1b3f2f; border-radius: 6px;">
                                <option value="" selected disabled>Please Select</option>
                                <option value="Resolved">Resolved</option>
                                <option value="Unresolved">Unresolved</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row g-3">

                            <div class="col-6">

                                <button type="submit" class="btn w-100 text-white fw-semibold"
                                    style="
                                    background:#161f2d;
                                    height:58px;
                                    border-radius:8px;
                                    font-size:18px;
                                ">

                                    Save

                                </button>

                            </div>

                            <div class="col-6">

                                <button type="button" data-bs-dismiss="modal"
                                    class="btn w-100 text-white fw-semibold"
                                    style="
                                    background:#a40000;
                                    height:58px;
                                    border-radius:8px;
                                    font-size:18px;
                                ">

                                    Cancel

                                </button>

                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
