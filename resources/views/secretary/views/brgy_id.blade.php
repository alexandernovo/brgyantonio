@extends('layout.mainlayout')

@section('content')
    @include('secretary.css.certificationcss')
    @include('secretary.modals.brgyidModal')

    <div class="page-container p-4">
        <div class="top-header mb-3">
            <div class="icon-container">
                <i class="bi bi-archive-fill" style="font-size: 40px"></i>
            </div>
            <div>
                <h3 class="mb-0" style="color: black">BARANGAY ID</h3>
                <p style="color: black">Dashboard | Barangay ID</p>
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
                        <button class="btn-add-table px-4" id="addBrgyId" style="padding:10px 20px !important">
                            <i class="bi bi-plus-circle"></i>
                            Add Barangay ID
                        </button>
                    </div>
                </div>

                <div class="p-3">
                    <table id="certificationTableBrgyId" class="table data_table table-bordered table-hover w-100 mb-0">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>ID NUMBER</th>
                                <th>REQUESTER</th>
                                <th>CONTACT NUMBER</th>
                                <th>GUIDANCE</th>
                                <th>CONTACT NUMBER</th>
                                <th>DATE OF EXPIRED</th>
                                <th>DATE OF CLAIM</th>
                                <th>BIRTHDATE</th>
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
    @include('secretary.js.brgyID')
@endsection
