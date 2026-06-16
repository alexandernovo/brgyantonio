@extends('layout.mainlayout')

@section('content')
    @include('treasurer.css.treasurercss')
    @include('admin.modals.userModal')
    <div class="page-container p-4">
        <div class="top-header mb-3">
            <div class="icon-container">
                <i class="bi bi-person-fill" style="font-size: 39px"></i>
            </div>
            <div>
                <h3 class="mb-0">USERS</h3>
                <p>Dashboard | Users</p>
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
                            <i class="bi bi-person-fill text-white" style="font-size: 28px"></i>
                            <p class="mb-0 text-white" style="font-size: 25px">USERS</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3">

                        <button class="btn-add-table px-4" id="addUser">
                            <i class="bi bi-plus-circle"></i>
                            Add User
                        </button>
                    </div>
                </div>

                <div class="p-3">
                    <table id="tableUser" class="table userTable table-bordered table-hover w-100 mb-0">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>NAME</th>
                                <th>USERNAME</th>
                                <th>USER-ROLE</th>
                                <th>DATE CREATED</th>
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
    @include('admin.js.userjs')
@endsection
