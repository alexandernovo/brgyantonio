<div class="modal fade" data-bs-backdrop="static" id="collectionSummonModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" style="max-width: 520px;">

        <div class="modal-content border-0 p-2"
            style="
                border-radius: 18px;
                overflow: hidden;
                background: #efefef;
            ">

            {{-- HEADER --}}
            <div class="position-relative text-center px-3 pt-2 pb-3"
                style="
                    background: linear-gradient(180deg,#184d35,#123926);
                    border-radius: 14px;
                ">

                <button type="button" class="btn-close btn-close-white position-absolute" style="top:12px; right:12px;"
                    data-bs-dismiss="modal">
                </button>

                <img src="{{ asset('assets/images/logo.png') }}"
                    style="
                        width:120px;
                        height:120px;
                        object-fit:contain;
                    ">

                <h2 class="text-white fw-semibold mb-0"
                    style="
                        font-size: 20px;
                        letter-spacing: .5px;
                    ">
                    SUMMON FEE
                </h2>

            </div>

            {{-- BODY --}}
            <div class="p-3">

                <form id="collectionForm">

                    @csrf

                    <input type="hidden" name="collection_id" id="collection_id" value="0">
                    <input type="hidden" name="collection_type" id="collection_type" value="summon">

                    {{-- DATE --}}
                    <div class="mb-3">

                        <label class="fw-semibold mb-1 d-block" style="font-size:15px;">
                            Date:
                        </label>

                        <div class="input-group">

                            <span class="input-group-text text-white"
                                style="
                                    background:#184d35;
                                    border:2px solid #184d35;
                                    min-width:48px;
                                    justify-content:center;
                                ">
                                <i class="bi bi-calendar-event-fill"></i>
                            </span>

                            <input type="date" name="payment_date" id="payment_date" class="form-control"
                                style="
                                    border:2px solid #184d35;
                                    height:45px;
                                ">

                        </div>

                    </div>

                    {{-- OR NUMBER --}}
                    <div class="mb-3">

                        <label class="fw-semibold mb-1 d-block" style="font-size:15px;">
                            OR Number:
                        </label>

                        <div class="input-group">

                            <span class="input-group-text text-white"
                                style="
                                    background:#184d35;
                                    border:2px solid #184d35;
                                    min-width:48px;
                                    justify-content:center;
                                ">
                                <i class="bi bi-receipt-cutoff"></i>
                            </span>

                            <input type="text" name="or_number" id="or_number" class="form-control"
                                style="
                                    border:2px solid #184d35;
                                    height:45px;
                                ">

                        </div>

                    </div>

                    {{-- PAYOR NAME --}}
                    <div class="mb-3">

                        <label class="fw-semibold mb-2 d-block" style="font-size:15px;">
                            Payor’s Name:
                        </label>

                        <div class="row g-2">

                            <div class="col-4">

                                <input type="text" name="first_name" id="first_name" class="form-control text-center"
                                    placeholder="First Name"
                                    style="
                                        border:2px solid #184d35;
                                        height:48px;
                                    ">

                            </div>

                            <div class="col-4">

                                <input type="text" name="middle_name" id="middle_name"
                                    class="form-control text-center" placeholder="Middle Name"
                                    style="
                                        border:2px solid #184d35;
                                        height:48px;
                                    ">

                            </div>

                            <div class="col-4">

                                <input type="text" name="last_name" id="last_name" class="form-control text-center"
                                    placeholder="Last Name"
                                    style="
                                        border:2px solid #184d35;
                                        height:48px;
                                    ">

                            </div>

                        </div>

                    </div>

                    {{-- AMOUNT + STATUS --}}
                    <div class="row g-3 mb-4">

                        {{-- AMOUNT --}}
                        <div class="col-6">

                            <label class="fw-semibold mb-1 d-block" style="font-size:15px;">
                                Amount:
                            </label>

                            <div class="input-group">

                                <span class="input-group-text text-white"
                                    style="
                                        background:#184d35;
                                        border:2px solid #184d35;
                                        min-width:48px;
                                        justify-content:center;
                                    ">
                                    ₱
                                </span>

                                <input type="number" name="payment_amount" id="payment_amount" class="form-control"
                                    style="
                                        border:2px solid #184d35;
                                        height:45px;
                                    ">

                            </div>

                        </div>

                        {{-- STATUS --}}
                        <div class="col-6">

                            <label class="fw-semibold mb-1 d-block" style="font-size:15px;">
                                Payment Status:
                            </label>

                            <div class="input-group">

                                <span class="input-group-text text-white"
                                    style="
                                        background:#184d35;
                                        border:2px solid #184d35;
                                        min-width:48px;
                                        justify-content:center;
                                    ">
                                    ₱
                                </span>

                                <select name="payment_status" id="payment_status" class="form-select"
                                    style="
                                        border:2px solid #184d35;
                                        height:45px;
                                    ">

                                    <option value="Paid">Paid</option>
                                    <option value="Unpaid">Unpaid</option>

                                </select>

                            </div>

                        </div>

                    </div>

                    {{-- BUTTONS --}}
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

                            <button type="button" data-bs-dismiss="modal" class="btn w-100 text-white fw-semibold"
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
