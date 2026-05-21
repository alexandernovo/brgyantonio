<div class="modal fade" data-bs-backdrop="static" id="quarryModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" style="max-width: 1450px;">

        <div class="modal-content border-0" style="border-radius: 15px; overflow: hidden;">

            <div class="modal-body p-2">

                {{-- HEADER --}}
                <div class="text-center p-3 position-relative rounded" style="background-color: #1b3f2f;">

                    <button type="button" class="btn-close btn-close-white position-absolute" data-bs-dismiss="modal"
                        style="top:15px; right:15px;">
                    </button>

                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo"
                        style="width:95px; margin-bottom:8px;">

                    <h2 class="text-white fw-semibold mb-0">

                        BARANGAY OTP QUARRY

                    </h2>

                </div>

                {{-- BODY --}}
                <div class="p-3">

                    <div class="text-center mb-4">

                        <h2 class="fw-semibold mb-0" style="font-size: 20px">

                            REPUBLIC OF THE PHILIPPINES

                        </h2>

                        <h2 class="fw-semibold" style="font-size: 20px">

                            COASTING MANIFEST

                        </h2>

                    </div>

                    <form id="quarryForm">

                        @csrf

                        <input type="hidden" name="quarry_id" id="quarry_id" value="0">

                        {{-- TOP SECTION --}}
                        <div class="mb-4" style="font-size:18px; line-height:2;">

                            <div class="d-flex align-items-center flex-wrap gap-2 mb-2">

                                <span>FORM NO. 72</span>

                            </div>

                            <div class="d-flex align-items-center flex-wrap gap-2">

                                <span>

                                    MANIFEST OF THE whole cargo laden on board the

                                </span>

                                <input type="text" name="truck_or_vessel_name" id="truck_or_vessel_name"
                                    class="form-control form-control-sm" style="width:350px; border:2px solid #333;">

                                <span>

                                    class coasting vessel

                                </span>

                                <input type="text" name="vehicle_class" id="vehicle_class"
                                    class="form-control form-control-sm" style="width:350px; border:2px solid #333;">

                            </div>

                            <div class="d-flex align-items-center flex-wrap gap-2 ms-5">

                                <span>

                                    License No.

                                </span>

                                <input type="text" name="quarry_license_no" id="quarry_license_no"
                                    class="form-control form-control-sm" style="width:220px; border:2px solid #333;">

                                <span>

                                    Licensed

                                </span>

                                <input type="text" name="permit_holder" id="permit_holder"
                                    class="form-control form-control-sm" style="width:300px; border:2px solid #333;">

                                <span>

                                    propelled by

                                </span>

                                <input type="text" name="engine_or_propulsion" id="engine_or_propulsion"
                                    class="form-control form-control-sm" style="width:170px; border:2px solid #333;">

                                <span>

                                    voyage no.

                                </span>

                                <input type="text" name="trip_or_voyage_no" id="trip_or_voyage_no"
                                    class="form-control form-control-sm" style="width:170px; border:2px solid #333;">

                            </div>

                            <div class="d-flex align-items-center flex-wrap gap-2 ms-5">

                                <span>

                                    Whereof is

                                </span>

                                <input type="text" name="driver_or_operator" id="driver_or_operator"
                                    class="form-control form-control-sm" style="width:220px; border:2px solid #333;">

                                <span>
                                    burden
                                </span>

                                <input type="text" name="carrying_burden" id="carrying_burden"
                                    class="form-control form-control-sm" style="width:150px; border:2px solid #333;">

                                <span>
                                    Tons
                                </span>

                                <input type="text" name="tonnage_capacity" id="tonnage_capacity"
                                    class="form-control form-control-sm" style="width:120px; border:2px solid #333;">
                                <span>
                                    crew board from
                                </span>
                                <input type="text" name="crew_origin" id="crew_origin"
                                    class="form-control form-control-sm" style="width:390px; border:2px solid #333;">
                            </div>

                            <div class="d-flex align-items-center gap-2 mb-1 ms-5">

                                <span>

                                    for

                                </span>

                                <input type="text" name="destination_place" id="destination_place"
                                    class="form-control form-control-sm" style="width:700px; border:2px solid #333;">

                            </div>

                            <div class="text-center">

                                (here give port of call)

                            </div>

                        </div>

                        {{-- TABLE LIKE SECTION --}}
                        <div class="mt-5">

                            {{-- ROW 1 --}}
                            <div class="row g-3 mb-4">

                                <div class="col-md-3">

                                    <div class="d-flex align-items-center gap-2">

                                        <label style="width:120px;">

                                            BL No:

                                        </label>

                                        <input type="text" name="delivery_receipt_or_bl_no"
                                            id="delivery_receipt_or_bl_no" class="form-control"
                                            style="border:2px solid #333;">

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="d-flex align-items-center gap-2">

                                        <label class="text-nowrap">

                                            No. of Packages:

                                        </label>

                                        <input type="number" name="no_of_packages" id="no_of_packages"
                                            class="form-control" style="border:2px solid #333;">

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="d-flex align-items-center gap-2">

                                        <label>

                                            Weighted in Kilogram:

                                        </label>

                                        <input type="number" name="weight_kg" id="weight_kg" class="form-control"
                                            style="border:2px solid #333;">

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="d-flex align-items-center gap-2">

                                        <label>

                                            Consignee:

                                        </label>

                                        <input type="text" name="consignee" id="consignee" class="form-control"
                                            style="border:2px solid #333;">

                                    </div>

                                </div>

                            </div>

                            {{-- ROW 2 --}}
                            <div class="row g-3 mb-4">

                                <div class="col-md-3">

                                    <div class="d-flex align-items-center gap-2">

                                        <label style="width:120px;">

                                            Marks:

                                        </label>

                                        <input type="text" name="load_marks" id="load_marks" class="form-control"
                                            style="border:2px solid #333;">

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="d-flex align-items-center gap-2">

                                        <label>

                                            Cubic Meter:

                                        </label>

                                        <input type="number" name="cubic_meter" id="cubic_meter"
                                            class="form-control" style="border:2px solid #333;">

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="d-flex align-items-center gap-2">

                                        <label>

                                            Value:

                                        </label>

                                        <input type="text" name="market_value" id="market_value"
                                            class="form-control" style="border:2px solid #333;">

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="d-flex align-items-center gap-2">

                                        <label>

                                            Address:

                                        </label>

                                        <input type="text" name="delivery_address" id="delivery_address"
                                            class="form-control" style="border:2px solid #333;">

                                    </div>

                                </div>

                            </div>

                            {{-- ROW 3 --}}
                            <div class="row g-3 mb-5">

                                <div class="col-md-3">

                                    <div class="d-flex align-items-center gap-2">

                                        <label style="width:120px;">

                                            Numbers:

                                        </label>

                                        <input type="number" name="load_numbers" id="load_numbers"
                                            class="form-control" style="border:2px solid #333;">

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="d-flex align-items-center gap-2">

                                        <label>

                                            Kind of Parcel:

                                        </label>

                                        <input type="text" name="material_type" id="material_type"
                                            class="form-control" style="border:2px solid #333;">

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="d-flex align-items-center gap-2">

                                        <label>

                                            Shipper:

                                        </label>

                                        <input type="text" name="quarry_operator_or_shipper"
                                            id="quarry_operator_or_shipper" class="form-control"
                                            style="border:2px solid #333;">

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- FOOTER BUTTONS --}}
                        <div class="d-flex gap-3">

                            <button onclick="printQuaryForm()" type="button"
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
