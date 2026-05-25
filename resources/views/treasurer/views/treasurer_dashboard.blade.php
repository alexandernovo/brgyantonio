@extends('layout.mainlayout')
@section('content')
    @include('treasurer.css.treasurercss')

    <div class="page-container p-4">
        <div class="top-header mb-3">
            <div class="icon-container">
                <i class="bi bi-grid-fill" style="font-size: 40px"></i>
            </div>
            <div>
                <h3 class="mb-0" style="color: black">DASHBOARD</h3>
                <p style="color: black">Certification, Barangay ID, Barangay RBI, Barangay OTP Quarry</p>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
