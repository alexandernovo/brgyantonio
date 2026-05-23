<div class="modal fade" data-bs-backdrop="static" id="rbi2Modal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content border-0" style="border-radius: 12px; overflow: hidden;">

            <div class="modal-body p-2 bg-white">

                {{-- HEADER --}}
                <div class="position-relative text-center py-3 px-3 rounded" style="background-color: #184d35;">

                    <button type="button" class="btn-close btn-close-white position-absolute"
                        style="top:15px; right:15px;" data-bs-dismiss="modal">
                    </button>

                    <img src="{{ asset('assets/images/logo.png') }}"
                        style="width:100px; height:100px; object-fit:contain;">

                    <h2 class="text-white fw-bold mt-2 mb-0">
                        RECORDS OF BARANGAY INHABITANTS BY HOUSEHOLD
                    </h2>

                </div>

                <form id="rbiForm">

                    @csrf

                    <input type="hidden" name="household_id" id="household_id" value="0">

                    {{-- TOP DETAILS --}}
                    <div class="row mt-3">

                        <div class="col-md-6">

                            <h4 class="fw-bold mb-3">
                                RBI FORM A (Revised 2024)
                            </h4>

                            <div class="mb-2 d-flex align-items-center gap-2">
                                <label style="width:220px;">REGION:</label>
                                <input type="text" name="region" id="region"
                                    class="form-control form-control-sm" style="border: 1px solid #184d35">
                            </div>

                            <div class="mb-2 d-flex align-items-center gap-2">
                                <label style="width:220px;">PROVINCE:</label>
                                <input type="text" name="province" id="province" value="Antique"
                                    class="form-control form-control-sm" style="border: 1px solid #184d35">
                            </div>

                            <div class="mb-2 d-flex align-items-center gap-2">
                                <label style="width:220px;">CITY/MUNICIPALITY:</label>
                                <input type="text" name="municipality" id="municipality" value="Barbaza"
                                    class="form-control form-control-sm" style="border: 1px solid #184d35">
                            </div>

                            <div class="mb-2 d-flex align-items-center gap-2">
                                <label style="width:220px;">BARANGAY:</label>
                                <input type="text" name="barangay" id="barangay"
                                    class="form-control form-control-sm" style="border: 1px solid #184d35">
                            </div>

                            <div class="mb-2 d-flex align-items-center gap-2">
                                <label style="width:220px;">HOUSEHOLD ADDRESS:</label>
                                <input type="text" name="household_address" id="household_address"
                                    class="form-control form-control-sm" style="border: 1px solid #184d35">
                            </div>

                            <div class="mb-2 d-flex align-items-center gap-2">
                                <label style="width:220px;">NO. OF HOUSEHOLD MEMBERS:</label>
                                <input type="number" name="no_household_members" id="no_household_members"
                                    class="form-control form-control-sm" style="border: 1px solid #184d35">
                            </div>

                        </div>

                    </div>

                    {{-- TABLE --}}
                    <div class="table-responsive mt-4">

                        <table class="table table-bordered align-middle text-center" id="householdTable">
                            <thead style="background-color:#184d35; color:white;">
                                <tr>
                                    <th class="text-white">No.</th>
                                    <th class="text-white">Last Name</th>
                                    <th class="text-white">First Name</th>
                                    <th class="text-white">Middle Name</th>
                                    <th class="text-white">Ext.</th>
                                    <th class="text-white">Place of Birth</th>
                                    <th class="text-white">Date of Birth</th>
                                    <th class="text-white">Age</th>
                                    <th class="text-white">Sex</th>
                                    <th class="text-white">Civil Status</th>
                                    <th class="text-white">Citizenship</th>
                                    <th class="text-white">Occupation</th>
                                    <th class="text-white">Action</th>
                                </tr>

                            </thead>

                            <tbody>

                            </tbody>

                        </table>
                    </div>
                    {{-- ADD BUTTON --}}
                    <div class="mb-4">

                        <button id="addRowBtn" type="button" class="btn text-white fw-semibold py-2"
                            style="background-color: #1b3f2f; border-radius: 6px;">
                            Add Member
                        </button>

                    </div>

                    {{-- SIGNATURE --}}
                    <div class="row text-center">

                        <div class="col-md-4">

                            <label class="fw-semibold d-block text-start">
                                Prepared by:
                            </label>

                            <input type="text" name="prepared_by" class="form-control border-success mb-2">

                            <div class="fw-bold">
                                Name of Household/Head Member
                            </div>

                            <div>
                                (Signature over Printed Name)
                            </div>

                        </div>

                        <div class="col-md-4">

                            <label class="fw-semibold d-block text-start">
                                Certified Correct:
                            </label>

                            <input type="text" name="certified_by" class="form-control border-success mb-2">

                            <div class="fw-bold">
                                Barangay Secretary
                            </div>

                            <div>
                                (Signature over Printed Name)
                            </div>

                        </div>

                        <div class="col-md-4">

                            <label class="fw-semibold d-block text-start">
                                Validated by:
                            </label>

                            <input type="text" name="validated_by" class="form-control border-success mb-2">

                            <div class="fw-bold">
                                Punong Barangay
                            </div>

                            <div>
                                (Signature over Printed Name)
                            </div>

                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="mt-4 small">

                        I hereby certify that the above information are true and correct to the best of my knowledge.

                    </div>

                    {{-- BUTTONS --}}
                    <div class="row mt-4">

                        <div class="col-md-4">
                            <button onclick="printRBIForm()" type="button"
                                class="btn w-100 text-white fw-semibold py-2"
                                style="background-color: #1b3f2f; border-radius: 6px;">
                                Print
                            </button>

                        </div>



                        <div class="col-md-4">

                            <button type="submit" class="btn w-100 text-white fw-semibold py-2"
                                style="background-color: #1a222b; border-radius: 6px;">

                                Save

                            </button>

                        </div>

                        <div class="col-md-4">

                            <button type="button" class="btn w-100 text-white fw-semibold py-2"
                                data-bs-dismiss="modal" style="background-color: #8b0000; border-radius: 6px;">

                                Cancel

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

