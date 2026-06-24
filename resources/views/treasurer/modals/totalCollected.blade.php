<div class="modal fade" id="totalCollectedModal" tabindex="-1" aria-labelledby="totalCollectedModalLabel"
    aria-hidden="true">

    <div class="modal-dialog m-0"
        style="
            position:fixed;
            top:50%;
            left:50%;
            transform:translate(-50%, -50%);
            width:97vw;
            max-width:97vw;
            height:23vh;
        ">

        <div class="modal-content" style="
                height:100%;
                border-radius:25px;
            ">

            <div class="modal-body overflow-auto">

                @php
                    $cards = [
                        ['title' => 'Barangay Clearance', 'amount' => $brgy_clearance],
                        ['title' => 'Barangay Certification', 'amount' => $brgy_certification],
                        ['title' => 'Summon', 'amount' => $summon],
                        ['title' => 'Barangay ID', 'amount' => $brgy_id],
                        ['title' => 'Business Clearance', 'amount' => $business_clearance],
                    ];
                @endphp

                <div class="row mx-auto g-3">

                    @foreach ($cards as $card)
                        <div class="col-xl col-lg-3 col-md-4 col-sm-6 px-1">

                            <div class="rounded-4 shadow-sm text-center text-white p-4 d-flex flex-column justify-content-center"
                                style="background:#1A412F;min-height:170px;">

                                <h4 class="fw-semibold text-white mb-0" style="font-size:28px;line-height:1.15">
                                    {{ $card['title'] }}
                                </h4>

                                <div class="mb-3" style="color:#d9d9d9;font-size:18px;">
                                    (Total Collected Fee)
                                </div>

                                <div class="fw-bold" style="font-size:45px;line-height:1;">
                                    ₱ {{ number_format($card['amount'], 2) }}
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </div>

    </div>

</div>
