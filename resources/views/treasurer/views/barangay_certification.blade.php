@extends('layout.mainlayout')

@section('content')
    @include('treasurer.css.treasurercss')
    @include('treasurer.modals.collectioncertificationModal')

    <div class="page-container p-4">
        <div class="top-header mb-3">
            <div class="icon-container">
                <i class="bi bi-archive-fill" style="font-size: 40px"></i>
            </div>
            <div>
                <h3 class="mb-0" style="color: black">COLLECTION FEE</h3>
                <p style="color: black">Dashboard | Collection Fee</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="primary-bg-new d-flex justify-content-between p-3">
                    <div class="d-flex gap-3">
                        <button class="btn-reload-table px-4">
                            <i class="bi bi-arrow-clockwise"></i>
                            Reload
                        </button>
                        <div class="d-flex gap-2 align-items-center">
                            <i class="bi bi-archive-fill text-white" style="font-size: 32px"></i>
                            <p class="mb-0 text-white" style="font-size: 25px">BARANGAY CERTIFICATION</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <button class="btn-edit-table px-4 paidUnpaidCollectionClearance" data-status="Unpaid">
                            <i class="bi bi-x-circle"></i>
                            Unpaid Payor
                        </button>
                        <button class="btn-edit-table px-4 paidUnpaidCollectionClearance active-btn" data-status="Paid">
                            <i class="bi bi-check-circle"></i>
                            Paid Payor
                        </button>
                        <button class="btn-add-table px-4" id="addCollectionClearance">
                            <i class="bi bi-plus-circle"></i>
                            Add Certification
                        </button>
                    </div>
                </div>

                <div class="p-3">
                    <table id="CollectionTableCertification" class="table data_table table-bordered table-hover w-100 mb-0">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>DATE</th>
                                <th>OR NUMBER</th>
                                <th>PAYOR</th>
                                <th>AMOUNT</th>
                                <th>PAYMENT STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('treasurer.js.collectionjs')
    @include('treasurer.js.barangay_certification')
@endsection
