@extends('layout.mainlayout')

@section('content')
    @include('kagawad.css.kagawadcss')
    @include('kagawad.modals.blotterModal')

    <div class="page-container p-4">
        <div class="top-header mb-3">
            <div class="icon-container">
                <img src="{{asset('assets/images/new/BLOTTER COMPLAINTS.png')}}" alt="" style="width: 42px; height: 42px">
            </div>
            <div>
                <h3 class="mb-0" style="color: black">BLOTTER COMPLAINTS</h3>
                <p style="color: black">Dashboard | Blotter Complaints</p>
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
                        <button class="btn-edit-table px-4 resolvedUnresolvedBlotter" data-status="Unresolved">
                            <i class="bi bi-x-circle"></i>
                            Unresolved
                        </button>
                        <button class="btn-edit-table px-4 resolvedUnresolvedBlotter active-btn" data-status="Resolved">
                            <i class="bi bi-check-circle"></i>
                            Resolved
                        </button>
                        <button class="btn-add-table px-4" id="addComplaint">
                            <i class="bi bi-plus-circle"></i>
                            Add Complaint
                        </button>
                    </div>
                </div>

                <div class="p-3">
                    <table id="tableBlotter" class="table data_table table-bordered table-hover w-100 mb-0">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>CASE CODE</th>
                                <th>COMPLAINANT</th>
                                <th>RESPONDENT</th>
                                <th>NATURE OF CASE</th>
                                <th>CASE STATUS</th>
                                <th>DATE OF COMPLAINTS</th>
                                <th>DATE OF RESOLVED</th>
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
    @include('kagawad.js.blotter')
@endsection
