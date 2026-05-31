@extends('layout.mainlayout')

@section('content')
    @include('treasurer.css.treasurercss')
    <div class="page-container p-4">
        <div class="top-header p-1">
            <div class="icon-container">
                <img src="{{ asset('assets/images/new/PESO.png') }}" alt=""
                    style="width: 30px; height: 30px;">
            </div>
            <div>
                <h3 class="mb-0">COLLECTION FEE</h3>
                <p>Dashboard | Collection Fee</p>
            </div>
        </div>

        <div class="cert-card p-2">
            <div class="card-header-green rounded">
                <span class="close-icon"><i class="fas fa-times-circle"></i></span>
                <img src="{{ asset('assets/images/logo.png') }}" class="logo-img" alt="Logo">
                <h2>COLLECTION FEE</h2>
            </div>

            <div class="card-content">
                <label class="form-label">Nature of Collection:</label>

                <div class="input-group-custom">
                    <div class="input-group-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white"
                            stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                        </svg>
                    </div>
                    <select class="select-field" id="collection_type">
                        <option selected disabled>Please Select</option>
                        <option>Barangay Clearance</option>
                        <option>Barangay Certification</option>
                        <option>Summon</option>
                        <option>Barangay ID</option>
                        <option>Barangay Business Clearance</option>
                    </select>
                </div>

                <button type="button" class="btn-submit-collection">View Certification</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('treasurer.js.collectionjs')
@endsection
