@extends('layout.mainlayout')

@section('content')
    @include('kagawad.css.kagawadcss')
    @include('kagawad.modals.borrowedModal')

    <div class="page-container p-4">
        <div class="top-header mb-3">
            <div class="icon-container">
                <img src="{{ asset('assets/images/new/BORROWED EQUIPMENT.png') }}" alt=""
                    style="width: 40px; height: 40px; filter: invert(1)">
            </div>
            <div>
                <h3 class="mb-0" style="color: black">BORROWED EQUIPMENT</h3>
                <p style="color: black">Dashboard | Borrowed Equipment</p>
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
                    </div>
                    <div class="d-flex gap-3">
                        <button class="btn-edit-table px-4 returnedUnreturnBlotter" data-status="Unreturned">
                            <i class="bi bi-x-circle"></i>
                            Unreturned
                        </button>
                        <button class="btn-edit-table px-4 returnedUnreturnBlotter active-btn" data-status="Returned">
                            <i class="bi bi-check-circle"></i>
                            Returned
                        </button>
                        <button class="btn-add-table px-4" id="addBorrowed">
                            <i class="bi bi-plus-circle"></i>
                            Add Borrower
                        </button>
                    </div>
                </div>

                <div class="p-3">
                    <table id="tableBorrowed" class="table data_table table-bordered table-hover w-100 mb-0">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>TRANSACTION CODE</th>
                                <th>BORROWER</th>
                                <th>BORROWED EQUIPMENT</th>
                                <th>QUANTITY</th>
                                <th>BORROWED STATUS</th>
                                <th>DATE OF BORROWED</th>
                                <th>DATE OF RETURNED</th>
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
    @include('kagawad.js.kagawadjs')
    @include('kagawad.js.borrowed')
@endsection
