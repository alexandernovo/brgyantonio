@extends('layout.mainlayout')

@section('content')
    @include('home.css.homecss')

    <div class="d-flex flex-nowrap justify-content-between align-items-center gap-4 banner px-5"
        style="height: calc(100vh - 132px);">

        {{-- LEFT SIDE --}}
        <div class="ms-3 d-flex justify-content-center align-items-center flex-column gap-3">

            <img src="{{ asset('assets/images/logo.png') }}" alt="" class="rounded-circle"
                style="width: 290px; height: 290px">

            <p class="mb-0 text-white fw-semibold text-center" style="font-size: 47px">
                Barangay Record Management System
            </p>

            <p class="mb-0 text-white fw-semibold text-center" style="font-size: 26px">
                Barangay San Antonio, Barbaza, Antique
            </p>

            <a href="{{ route('logins') }}" class="btn getstarted-btn px-5 mt-4">
                Get Started
            </a>

        </div>

        {{-- RIGHT SIDE LOGIN --}}
        <div class="login-wrapper">

            <div class="login-card shadow-lg">

                {{-- HEADER --}}
                <div class="login-header text-center">

                    <div class="profile-circle mx-auto">
                        <img src="{{ asset('assets/images/users/captain.png') }}" alt="Captain"
                            class="w-100 h-100 object-fit-contain">
                    </div>

                    <h2 class="fw-semibold text-white mb-2" style="font-size: 25px">
                        BARANGAY CAPTAIN
                    </h2>

                    <p class="text-white mb-0" style="font-size: 15px">
                        Enter your username and password to log in
                        <br>
                        your account
                    </p>

                </div>

                {{-- BODY --}}
                <div class="login-body">

                    <form>

                        <div class="mb-4">

                            <label class="form-label mb-0" style="font-size: 18px; color: #404040 !important">
                                Username:
                            </label>

                            <div class="input-group custom-input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-person-circle"></i>
                                </span>

                                <input type="text" class="form-control" name="username" placeholder="Enter username">

                            </div>

                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-4">

                            <label class="form-label mb-0" style="font-size: 18px; color: #404040 !important">
                                Password:
                            </label>

                            <div class="input-group custom-input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>

                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Enter password">

                                <button class="input-group-text bg-white border-start-0 togglePassword" type="button">

                                    <i class="bi bi-eye-fill"></i>

                                </button>

                            </div>

                        </div>

                        {{-- LOGIN BUTTON --}}
                        <button type="submit" class="btn login-btn w-100">
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection
