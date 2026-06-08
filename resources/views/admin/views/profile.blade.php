@extends('layout.mainlayout')

@section('content')
    @include('secretary.css.certificationcss')
    @include('treasurer.css.treasurercss')
    @include('kagawad.css.kagawadcss')
    <div class="page-container p-4">
        <div class="top-header mb-3">
            <div class="icon-container">
                <i class="bi bi-person-circle" style="font-size: 40px"></i>
            </div>
            <div>
                <h3 class="mb-0">PROFILE</h3>
                <p>Dashboard | Profile</p>
            </div>
        </div>
        <div class="d-flex justify-content-between">

        </div>
    </div>
@endsection

@section('js')
    @include('admin.js.report_adminjs')
@endsection
