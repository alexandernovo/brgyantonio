@extends('layout.mainlayout')

@section('content')
    @include('secretary.css.certificationcss')
    @include('treasurer.css.treasurercss')
    @include('kagawad.css.kagawadcss')
    <div class="page-container p-4">
        <div class="top-header mb-3">
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
        <div class="d-flex justify-content-between">
            <div class="bg-white rounded p-2  mb-4" style="width: 32%">
                <div class="card-header-green rounded">
                    <span class="close-icon"><i class="fas fa-times-circle"></i></span>
                    <div class="d-flex justify-content-center">
                        <div style="width: 140px; height: 140px; border-radius: 50%; border: 3px solid white"
                            class="p-2">
                            <img src="{{ asset('assets/images/users/secretary.png') }}"
                                class="w-100 bg-white h-100 object-fit-contain rounded-circle" alt="Logo">
                        </div>
                    </div>

                    <h2>SECRETARY REPORT</h2>
                </div>
                <div class="card-content">
                    <label class="form-label mb-0">Report Type:</label>

                    <div class="input-group-custom mb-1">
                        <div class="input-group-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white"
                                stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                            </svg>
                        </div>
                        <select class="select-field" id="report_type">
                            <option selected disabled>Please Select</option>
                            <option>Barangay ID</option>
                            <option>Barangay Certification</option>
                        </select>
                    </div>

                    <label class="form-label mb-0">Certification Report Type:</label>

                    <div class="input-group-custom mb-1">
                        <div class="input-group-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white"
                                stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                            </svg>
                        </div>
                        <select class="select-field" id="cert_type">
                            <option selected disabled value="">Please Select</option>
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

                    <label class="form-label mb-2">Select Month:</label>

                    <div class="input-group-custom mb-3">
                        <div class="input-group-icon">
                            <i class="bi bi-calendar-fill text-white" style="font-size: 17px"></i>
                        </div>
                        <input type="month" class="select-field" id="month">
                    </div>

                    <button type="button" class="btn-report">View Report</button>
                </div>
            </div>
            <div class="bg-white rounded p-2 col-4 mb-4" style="width: 32%">
                <div class="card-header-green rounded">
                    <span class="close-icon"><i class="fas fa-times-circle"></i></span>
                    <div class="d-flex justify-content-center">
                        <div style="width: 140px; height: 140px; border-radius: 50%; border: 3px solid white"
                            class="p-2">
                            <img src="{{ asset('assets/images/users/treasurer.png') }}"
                                class="w-100 bg-white h-100 object-fit-contain rounded-circle" alt="Logo">
                        </div>
                    </div>
                    <h2 style="font-size: 23px">TREASURER REPORT</h2>
                </div>

                <div class="card-content">
                    <label class="form-label mb-0">Nature of Collection:</label>

                    <div class="input-group-custom mb-2">
                        <div class="input-group-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white"
                                stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                            </svg>
                        </div>
                        <select class="select-field" id="collection_type">
                            <option selected disabled>Please Select</option>
                            <option data-type="clearance">Barangay Clearance</option>
                            <option data-type="certification">Barangay Certification</option>
                            <option data-type="summon">Summon</option>
                            <option data-type="barangay_id">Barangay ID</option>
                            <option data-type="clearance">Barangay Business Clearance</option>
                        </select>
                    </div>
                    <label class="form-label mb-0">Category of Collection:</label>
                    <div class="input-group-custom mb-2">
                        <div class="input-group-icon">
                            <img src="{{ asset('assets/images/new/PESO.png') }}"
                                style="width: 23px; height: 23px; filter: invert(1)" alt="">
                        </div>
                        <select class="select-field" id="category_collection_type">
                            <option selected disabled>Please Select</option>
                            <option>Per Collection</option>
                            <option>Overall Collection</option>
                        </select>
                    </div>

                    <label class="form-label mb-0">Select Month:</label>
                    <div class="input-group-custom mb-3">
                        <div class="input-group-icon">
                            <i class="bi bi-calendar-fill text-white" style="font-size: 17px"></i>
                        </div>
                        <input type="month" value="{{ date('Y-m') }}" class="select-field" id="month_collection">
                    </div>

                    <button type="button" class="btn-report-collection">View Report</button>
                </div>
            </div>
            <div class="bg-white rounded p-2 col-4 mb-4" style="width: 32%">
                <div class="card-header-green rounded">
                    <span class="close-icon"><i class="fas fa-times-circle"></i></span>
                    <div class="d-flex justify-content-center">
                        <div style="width: 140px; height: 140px; border-radius: 50%; border: 3px solid white"
                            class="p-2">
                            <img src="{{ asset('assets/images/users/kagawad.png') }}"
                                class="w-100 bg-white h-100 object-fit-contain rounded-circle" alt="Logo">
                        </div>
                    </div>
                    <h2 style="font-size: 23px">KAGAWAD REPORT</h2>
                </div>

                <div class="card-content">
                    <div class="d-flex flex-column justify-content-between" style="min-height: 325px">
                        <div>
                            <label class="form-label mb-0">Report Type:</label>
                            <div class="input-group-custom mb-2">
                                <div class="input-group-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="white" stroke-width="2">
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
                                <input type="month" value="{{ date('Y-m') }}" class="select-field"
                                    id="month_kagawad">
                            </div>
                        </div>
                        <button type="button" class="btn-report-kagawad">View Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('admin.js.report_adminjs')
@endsection
