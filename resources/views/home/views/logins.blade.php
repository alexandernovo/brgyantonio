@extends('layout.mainlayout')

@section('content')
    @include('home.css.homecss')
    @include('home.components.secretaryLoginModal')
    @include('home.components.kagawadLoginModal')
    @include('home.components.treasurerLoginModal')
    <div class="banner d-flex flex-column justify-content-center align-items-center px-5"
        style="height: calc(100vh - 132px);">

        {{-- TITLE --}}
        <div class="text-center mb-5">

            <h1 class="text-white fw-semibold main-title mb-3" style="font-size: 48px">
                Barangay Record Management System
            </h1>

            <h2 class="text-white sub-title mb-0" style="font-size: 35px">
                User-Login
            </h2>

        </div>

        {{-- LOGIN CARDS --}}
        <div class="row w-100 justify-content-center g-5 px-lg-5 mt-4">

            {{-- SECRETARY --}}
            <div class="col-xl-3 col-lg-4 col-md-6">

                <div class="user-card mx-auto">

                    <div class="user-image-wrapper">
                        <img src="{{ asset('assets/images/users/secretary.png') }}" alt="Secretary" class="user-image">
                    </div>

                    <div class="user-role-box" data-bs-toggle="modal" data-bs-target="#secretaryLoginModal">
                        SECRETARY
                    </div>

                </div>

            </div>

            {{-- TREASURER --}}
            <div class="col-xl-3 col-lg-4 col-md-6">

                <div class="user-card mx-auto">

                    <div class="user-image-wrapper">
                        <img src="{{ asset('assets/images/users/treasurer.png') }}" alt="Treasurer" class="user-image">
                    </div>

                    <div class="user-role-box" data-bs-toggle="modal" data-bs-target="#treasurerLoginModal">
                        TREASURER
                    </div>

                </div>

            </div>

            {{-- KAGAWAD --}}
            <div class="col-xl-3 col-lg-4 col-md-6">

                <div class="user-card mx-auto">

                    <div class="user-image-wrapper">
                        <img src="{{ asset('assets/images/users/kagawad.png') }}" alt="Kagawad" class="user-image">
                    </div>

                    <div class="user-role-box" data-bs-toggle="modal" data-bs-target="#kagawadLoginModal">
                        KAGAWAD
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

@section('js')
    @include('home.js.login')
@endsection
