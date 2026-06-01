@extends('layout.mainlayout')

@section('content')
    @include('kagawad.css.kagawadcss')
    <div class="page-container p-4">
        <div class="top-header mb-3">
            <div class="icon-container">
                <img src="{{ asset('assets/images/users/kagawad.png') }}" alt="" style="width: 40px; height: 50px;">
            </div>
            <div>
                <h3 class="mb-0">KAGAWAD</h3>
                <p>Dashboard | Kagawad</p>
            </div>
        </div>

        <div class="cert-card p-2">
            <div class="card-header-green rounded">
                <span class="close-icon"><i class="fas fa-times-circle"></i></span>
                <div class="d-flex justify-content-center">
                    <div class="mb-2"
                        style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid white; padding: 7px">
                        <img src="{{ asset('assets/images/users/kagawad.png') }}"
                            class="w-100 h-100 object-fit-contain bg-white rounded-circle" alt="Logo">
                    </div>
                </div>

                <h2>KAGAWAD RECORDS</h2>
            </div>

            <div class="card-content">
                <label class="form-label mb-0">Document Record Type:</label>

                <div class="input-group-custom mb-4">
                    <div class="input-group-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white"
                            stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                        </svg>
                    </div>
                    <select class="select-field" id="kagawad_type">
                        <option selected disabled>Please Select</option>
                        <option data-type="blotter">Blotter Complaints</option>
                        <option data-type="borrowed">Borrowed Equipment</option>
                    </select>
                </div>

                <button type="button" class="btn-submit-kagawad">View Certification</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('admin.js.kagawad_select')
@endsection
