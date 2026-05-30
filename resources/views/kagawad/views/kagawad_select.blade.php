@extends('layout.mainlayout')

@section('content')
    @include('kagawad.css.kagawadcss')
    <div class="page-container p-4">
        <div class="top-header p-1">
            <div class="icon-container">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                </svg>
            </div>
            <div>
                <h3 class="mb-0">REPORT</h3>
                <p>Dashboard | Report</p>
            </div>
        </div>

        <div class="cert-card p-2" style="max-width: 580px !important">
            <div class="card-header-green rounded">
                <span class="close-icon"><i class="fas fa-times-circle"></i></span>
                <img src="{{ asset('assets/images/logo.png') }}" class="logo-img" alt="Logo">
                <h2 style="font-size: 23px">RECORDS REPORT</h2>
            </div>

            <div class="card-content">
                <label class="form-label mb-0">Report Type:</label>

                <div class="input-group-custom mb-2">
                    <div class="input-group-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white"
                            stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                        </svg>
                    </div>
                    <select class="select-field" id="report_type">
                        <option selected disabled>Please Select</option>
                        <option data-type="blotter">Blotter Complaints</option>
                        <option data-type="borrowed">Borrowed Equipment</option>
                    </select>
                </div>
                <label class="form-label mb-0">Select Month:</label>
                <div class="input-group-custom mb-3">
                    <div class="input-group-icon">
                        <i class="bi bi-calendar-fill text-white" style="font-size: 17px"></i>
                    </div>
                    <input type="month" value="{{ date('Y-m') }}" class="select-field" id="month_kagawad">
                </div>

                <button type="button" class="btn-report-kagawad">View Report</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('kagawad.js.kagawadjs')
@endsection
