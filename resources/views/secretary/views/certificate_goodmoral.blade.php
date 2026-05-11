@extends('layout.mainlayout')

@section('content')
    @include('secretary.css.certificationcss')
    @include('secretary.modals.goodmoralModal')

    <div class="page-container p-4">
        <div class="top-header mb-3">
            <div class="icon-container">
                <i class="bi bi-archive-fill" style="font-size: 40px"></i>
            </div>
            <div>
                <h3 class="mb-0" style="color: black">CERTIFICATION</h3>
                <p style="color: black">Dashboard | Certification</p>
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
                            <p class="mb-0 text-white" style="font-size: 25px">GOOD MORAL CHARACTER</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <button class="btn-edit-table px-4" id="editCertificationMoral">
                            <i class="bi bi-pen-fill"></i>
                            Edit Certification
                        </button>
                        <button class="btn-add-table px-4" id="addCertificationMoral">
                            <i class="bi bi-plus-circle"></i>
                            Add Certification
                        </button>
                    </div>
                </div>

                <div class="p-3">
                    <table id="certificationTableMoral" class="table data_table table-bordered table-hover w-100 mb-0">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>REQUESTER</th>
                                <th>OR NUMBER</th>
                                <th>CIVIL STATUS</th>
                                <th>SEX</th>
                                <th>PUROK</th>
                                <th>DATE OF ISSUED</th>
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
    @include('secretary.js.certificationjs')
    @include('secretary.js.goodMoralCertification')
@endsection
