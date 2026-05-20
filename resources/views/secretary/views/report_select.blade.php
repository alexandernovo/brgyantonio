@extends('layout.mainlayout')

@section('content')
    @include('secretary.css.certificationcss')
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
                <h3 class="mb-0">CERTIFICATION</h3>
                <p>Dashboard | Certification</p>
            </div>
        </div>

        <div class="cert-card p-2">
            <div class="card-header-green rounded">
                <span class="close-icon"><i class="fas fa-times-circle"></i></span>
                <img src="{{ asset('assets/images/logo.png') }}" class="logo-img" alt="Logo">
                <h2>CERTIFICATION</h2>
            </div>

            <div class="card-content">
                <label class="form-label">Certification Type:</label>

                <div class="input-group-custom">
                    <div class="input-group-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white"
                            stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                        </svg>
                    </div>
                    <select class="select-field" id="cert_type">
                        <option selected disabled>Please Select</option>
                        <option>Certificate of Barangay</option>
                        <option>Certificate of Barangay Clearance</option>
                        <option>Certificate of Trees</option>
                        <option>Certificate of First Time Job Seeker</option>
                        <option>Certificate of Good Moral Character</option>
                        <option>Certificate of Indigency</option>
                        <option>Certificate of Livestock</option>
                        <option>Certificate of Lot</option>
                        <option>Certificate of Motorcycle</option>
                        <option>Certificate of Piggery</option>
                        <option>Certificate of Quarry</option>
                    </select>
                </div>

                <button type="button" class="btn-submit">View Certification</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('secretary.js.certificationjs')
@endsection
