<div class="modal fade" data-bs-backdrop="static" id="treesModal" tabindex="-1" aria-labelledby="treesModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px">
        <div class="modal-content border-0" style="border-radius: 15px; overflow: hidden;">
            <div class="modal-body p-2">
                <div class="text-center p-4 position-relative rounded" style="background-color: #1b3f2f;">
                    <button type="button" class="btn-close btn-close-white position-absolute" data-bs-dismiss="modal"
                        aria-label="Close" style="top: 15px; right: 15px;"></button>
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo"
                        style="width: 120px; height: auto; margin-bottom: 10px;">
                    <h3 class="text-white fw-semibold mb-0" style="letter-spacing: 1px;">TREES CERTIFICATION FORM
                    </h3>
                </div>

                <div class="py-3 px-2">
                    <h5 class="fw-semibold mb-4" style="color: #000;">REQUESTER INFORMATION:</h5>

                    <form id="certificationForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="certification_type" value="trees" id="certification_type">
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

                        <div class="d-flex align-items-center mb-3">
                            <label class="fw-semibold" style="width: 140px; flex-shrink: 0;">Civil Status:</label>
                            <div class="input-group" style="width: 750px;">
                                <select name="civil_status" id="civil_status" class="form-select rounded"
                                    style="border: 2px solid #1b3f2f; border-radius: 0 6px 6px 0;" required>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                            </div>
                            <label class="fw-semibold text-end px-3 text-nowrap" style="width: 130px;">OR Number</label>
                            <div class="input-group flex-grow-1">
                                <span class="input-group-text text-white"
                                    style="background-color: #1A412F; border: 2px solid #1b3f2f; border-right: none;"><i
                                        class="bi bi-receipt"></i></span>
                                <input type="text" name="or_number" id="or_number" class="form-control"
                                    placeholder="OR Number"
                                    style="border: 2px solid #1b3f2f; border-radius: 0 6px 6px 0;" required>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label class="fw-semibold" style="width: 140px; flex-shrink: 0;">Name of Tree:</label>
                            <div class="input-group flex-grow-1">
                                <span class="input-group-text text-white"
                                    style="background-color: #1A412F; border: 2px solid #1b3f2f; border-right: none;"><i
                                        class="bi bi-tree-fill"></i></span>
                                <input type="text" name="name_of_tree" id="name_of_tree" class="form-control"
                                    placeholder="Name of Tree"
                                    style="border: 2px solid #1b3f2f; border-radius: 0 6px 6px 0;" require>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label class="fw-semibold" style="width: 140px; flex-shrink: 0;">Number of Trees:</label>
                            <div class="input-group" style="width: 750px;">
                                <input type="text" name="no_of_tree" id="no_of_tree" class="form-control"
                                    placeholder="Number of Trees"
                                    style="border: 2px solid #1b3f2f; border-radius: 6px;" required>
                            </div>
                            <label class="fw-semibold text-end px-3 text-nowrap" style="width: 130px;">Date
                                Issued</label>
                            <div class="input-group flex-grow-1">
                                <span class="input-group-text text-white"
                                    style="background-color: #1A412F; border: 2px solid #1b3f2f; border-right: none;"><i
                                        class="bi bi-calendar-fill"></i></span>
                                <input type="date" name="date_issued" id="date_issued" class="form-control"
                                    style="border: 2px solid #1b3f2f; border-radius: 0 6px 6px 0;" required>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <label class="fw-semibold" style="width: 140px; flex-shrink: 0;">Address:</label>
                            <div class="d-flex gap-2 w-100">
                                <input type="text" name="barangay" id="barangay" class="form-control"
                                    placeholder="Barangay"
                                    style="border: 2px solid #1b3f2f; border-radius: 6px; flex: 1;">
                                <input type="text" name="municipality" id="municipality" class="form-control"
                                    placeholder="Municipality"
                                    style="border: 2px solid #1b3f2f; border-radius: 6px; flex: 1;">
                                <input type="text" name="province" id="province" class="form-control"
                                    placeholder="Province"
                                    style="border: 2px solid #1b3f2f; border-radius: 6px; flex: 1;">
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
