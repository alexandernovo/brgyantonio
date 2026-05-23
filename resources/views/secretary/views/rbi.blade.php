@extends('layout.mainlayout')

@section('content')
    @include('secretary.css.certificationcss')
    @include('secretary.modals.rbiModal')
    @include('secretary.modals.rbi2Modal')

    <div class="page-container p-4">
        <div class="top-header mb-3">
            <div class="icon-container">
                <i class="bi bi-archive-fill" style="font-size: 40px"></i>
            </div>
            <div>
                <h3 class="mb-0" style="color: black">BARANGAY RBI</h3>
                <p style="color: black">Dashboard | Barangay RBI</p>
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
                        <button class="btn-edit-table px-4" id="allIndiInhabitants">
                            <i class="bi bi-plus-circle"></i>
                            All Inhabitants
                        </button>
                        <button class="btn-add-table px-4" id="addRbi" style="padding:10px 20px !important">
                            <i class="bi bi-plus-circle"></i>
                            Add Inhabitant
                        </button>
                    </div>
                </div>

                <div class="p-3">
                    <table id="certificationTableRbi" class="table data_table table-bordered table-hover w-100 mb-0">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>NAME</th>
                                <th>BIRTHDATE</th>
                                <th>BIRTHPLACE</th>
                                <th>SEX</th>
                                <th>CIVIL STATUS</th>
                                <th>RELIGION</th>
                                <th>BARANGAY</th>
                                <th>MUNCIPALITY</th>
                                <th>PROVINCE</th>
                                <th>REGION</th>
                                <th>RESIDENCE ADDRESS</th>
                                <th>HOUSEHOLD ADDRESS</th>
                                <th>NO. OF HOUSEHOLD MEMBERS</th>
                                <th>PROFESSION/OCCUPATION</th>
                                <th>CONTACT NUMBER</th>
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
    @include('secretary.js.rbi')
@endsection
