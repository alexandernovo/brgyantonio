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
        @php
            $typeProfile = '';
            $imageProfile = '';
            $user_type = Auth::user()->type ?? '';
            $userProfile = Auth::user()->name ?? '';
            if ($user_type == 'treasurer') {
                $typeProfile = 'Barangay Treasurer';
                $imageProfile = asset('assets/images/users/treasurer.png');
            } elseif ($user_type == 'secretary') {
                $typeProfile = 'Barangay Secretary';
                $imageProfile = asset('assets/images/users/secretary.png');
            } elseif ($user_type == 'kagawad') {
                $typeProfile = 'REX P. BERNESTO';
                $imageProfile = asset('assets/images/users/kagawad.png');
            } elseif ($user_type == 'admin') {
                $typeProfile = 'Barangay Captain';
                $imageProfile = asset('assets/images/users/captain.png');
            }
        @endphp
        <div class="row mx-auto px-2" style="width: 60vw">
            <div class="col-5 pt-3 px-3" style="background-color: #1A412F; min-height: 60vh; border-radius: 10px">
                <div class="d-flex justify-content-center align-items-center">
                    <div style="width: 180px; height: 180px; border-radius: 50%;"
                        class="overflow-hidden border p-1 bg-white">
                        <img src="{{ $imageProfile }}" alt="" class="w-100 h-100 object-fit-contain">
                    </div>
                </div>
                <p class="mb-0 text-center fw-semibold mt-2 text-white" style="font-size: 25px">{{ $userProfile }}</p>
                <p class="mb-0 text-center p-2 rounded fw-semibold mt-2 text-white"
                    style="font-size: 22px; background-color: #335847">{{ $typeProfile }}</p>

                <form id="userForm">
                    <input type="hidden" value="{{ Auth::user()->id }}" name="id" id="id" value="0">
                    <div class="mb-3 mt-4">

                        <div class="position-relative" style="">

                            <i class="bi bi-person-circle position-absolute text-dark"
                                style="left: 15px; top: 50%; transform: translateY(-50%); z-index: 2; font-size: 25px"></i>

                            <input type="text" value="{{ Auth::user()->username }}" class="form-control bg-white"
                                name="username" placeholder="Enter username" style="text-indent: 36px; height: 50px">

                        </div>

                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-4">

                        <div class="position-relative inputToggle">
                            <i class="bi bi-lock-fill position-absolute text-dark"
                                style="left: 15px; top: 50%; transform: translateY(-50%); z-index: 2; font-size: 25px"></i>

                            <input type="password" class="form-control bg-white" name="password" id="password"
                                style="text-indent: 36px; height: 50px" placeholder="Enter password">

                            <i class="bi bi-eye-fill togglePassword2 position-absolute cursor-pointer"
                                style="right: 15px; top: 50%; transform: translateY(-50%); z-index: 2; font-size: 25px"></i>
                        </div>
                        <p class="mb-0 text-danger d-none errorLogin" style="font-size: 14px">
                            Incorrect password or username
                        </p>
                        <p class="mb-0" style="font-size: 14px; color: rgb(202, 202, 17)">
                            (Leave blank to retain old password)
                        </p>
                    </div>

                    {{-- LOGIN BUTTON --}}
                    <button type="submit" class="btn login-btn w-100 p-2"
                        style="background-color: #335847 !important; border: 2px solid white;">
                        Save
                    </button>

                </form>
            </div>
            <div class="col-6 bg-white rounded p-5" style=" border-radius: 10px">
                <img src="{{ asset('assets/images/logo.png') }}" alt="" class="w-100 h-100">
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('admin.js.report_adminjs')
    @include('admin.js.profile')
@endsection
