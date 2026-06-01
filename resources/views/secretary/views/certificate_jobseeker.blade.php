@extends('layout.mainlayout')

@section('content')
    @include('secretary.css.certificationcss')
    @include('secretary.modals.jobseekerModal')

    <div class="page-container p-4">
        @if (Auth::user()->type == 'admin')
            <div class="top-header mb-3">
                <div class="icon-container">
                    <img src="{{ asset('assets/images/users/secretary.png') }}" alt=""
                        style="width: 40px; height: 50px;">
                </div>
                <div>
                    <h3 class="mb-0">SECRETARY</h3>
                    <p>Dashboard | Secretary</p>
                </div>
            </div>
        @else
            <div class="top-header mb-3">
                <div class="icon-container">
                    <img src="{{ asset('assets/images/new/CERTIFICATION.png') }}" alt=""
                        style="width: 40px; height: 40px; filter: invert(1)">
                </div>
                <div>
                    <h3 class="mb-0" style="color: black">CERTIFICATION</h3>
                    <p style="color: black">Dashboard | Certification</p>
                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-body p-0">
                <div class="primary-bg-new d-flex justify-content-between p-3">
                    <div class="d-flex gap-3">
                        <button class="btn-reload-table px-4">
                            <i class="bi bi-arrow-clockwise"></i>
                            Reload
                        </button>
                        <div class="d-flex gap-2 align-items-center">
                            <img src="{{ asset('assets/images/new/CERTIFICATION.png') }}" alt=""
                                style="width: 40px; height: 40px">
                            <p class="mb-0 text-white" style="font-size: 25px">FIRST TIME JOB SEEKER</p>
                        </div>
                    </div>
                    @if (Auth::user()->type != 'admin')
                        <div class="d-flex gap-3">
                            <button class="btn-edit-table px-4" id="editCertificationSeeker">
                                <i class="bi bi-pen-fill"></i>
                                Edit Certification
                            </button>
                            <button class="btn-add-table px-4" id="addCertificationSeeker">
                                <i class="bi bi-plus-circle"></i>
                                Add Certification
                            </button>
                        </div>
                    @endif
                </div>

                <div class="p-3">
                    <table id="certificationTableSeeker" class="table data_table table-bordered table-hover w-100 mb-0">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>REQUESTER</th>
                                <th>CIVIL STATUS</th>
                                <th>AGE</th>
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
    @include('secretary.js.jobseekerCertification')
@endsection
