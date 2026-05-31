@extends('layout.mainlayout')

@section('content')
    @include('secretary.css.certificationcss')
    @include('secretary.modals.otpQuarryModal')

    <div class="page-container p-4">
        <div class="top-header mb-3">
            <div class="icon-container">
                 <img src="{{ asset('assets/images/new/QUARRY.png') }}" alt=""
                    style="width: 40px; height: 40px; filter: invert(1)">
            </div>
            <div>
                <h3 class="mb-0" style="color: black">BARANGAY OTP QUARRY</h3>
                <p style="color: black">Dashboard | Barangay OTP Quarry</p>
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
                        <button class="btn-add-table px-4" id="addQuarryOtp" style="padding:10px 20px !important">
                            <i class="bi bi-plus-circle"></i>
                            Add Quarry Request
                        </button>
                    </div>
                </div>

                <div class="p-3">
                    <table id="certificationTableQuarryOtp" class="table data_table table-bordered table-hover w-100 mb-0">
                        <thead>
                            <tr>
                                <th>BL NO.</th>
                                <th>MARKS</th>
                                <th>NUMBERS</th>
                                <th>NO. OF PACKAGES</th>
                                <th>CUBIC METER</th>
                                <th>KIND OF PARCEL</th>
                                <th>WEIGHT IN KILOGRAM</th>
                                <th>VALUE</th>
                                <th>SHIPPER</th>
                                <th>CONSIGNEE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('secretary.js.certificationjs')
    @include('secretary.js.quarry')
@endsection
