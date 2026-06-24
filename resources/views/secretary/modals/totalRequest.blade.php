<div class="modal fade" id="totalRequestModal" tabindex="-1" aria-labelledby="totalRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-bottom m-0"
        style="max-width:97vw;width:100vw;height:55vh;position:fixed;bottom:28px;left:50%; transform:translateX(-50%)">

        <div class="modal-content rounded-top-4" style="height:100%;border-radius:25px 25px 0 0;">

            {{-- <div class="modal-header">
                <h1 class="modal-title fs-5" id="totalRequestModalLabel">
                    Modal title
                </h1>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div> --}}

            <div class="modal-body overflow-auto">
                @php
                    $cards = [
                        ['title' => 'Barangay Certification', 'count' => $brgy],
                        ['title' => 'Barangay Clearance Certification', 'count' => $clearance],
                        ['title' => 'Tree Certification', 'count' => $trees],
                        ['title' => 'First Time Job Seeker', 'count' => $jobseeker],
                        ['title' => 'Good Moral Character', 'count' => $goodmoral],
                        ['title' => 'Certificate of Indigency', 'count' => $indigency],
                        ['title' => 'Livestock Certification', 'count' => $livestock],
                        ['title' => 'Motorcycle Certification', 'count' => $motorcycle],
                        ['title' => 'Piggery Certification', 'count' => $piggery],
                        ['title' => 'Barangay Quarry Certification', 'count' => $quarry],
                        ['title' => 'Lot Certification', 'count' => $lot],
                    ];
                @endphp

                <div class="row mx-auto g-3">
                    @foreach ($cards as $card)
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 px-1">
                            <div class="w-100 position-relative rounded-4 p-3 text-center text-white shadow-sm"
                                style="background-color:#1A412F; min-height:220px;">

                                <h4 class="fw-normal mb-4 text-white" style="font-size: 24px">
                                    {{ $card['title'] }}
                                </h4>

                                <div class="display-1 fw-bold position-absolute"
                                    style="left: 50%; top: 60%; transform:translate(-50%, -50%); font-size: 60px">
                                    {{ $card['count'] }}
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- <div class="modal-footer">
                <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Close
                </button>

                <button type="button"
                    class="btn btn-primary">
                    Save changes
                </button>
            </div> --}}

        </div>
    </div>
</div>
