@php
    $reportRoute = [];
    $certificationRoute = ['certification_select'];
@endphp
<aside class="left-sidebar sidebar-custom">

    <div class="h-100 d-flex flex-column px-2">

        {{-- PROFILE --}}
        <div class="text-center pt-3 pb-4">

            <div class="profile-wrapper mx-auto">
                <img src="{{ asset('assets/images/users/secretary.png') }}" class="profile-image" alt="">
            </div>

            <p class="welcome-text mb-0">
                Welcome Secretary!
            </p>

        </div>
        <hr class="sidebar-divider" style="border-top: 2px solid white">
        {{-- SIDEBAR --}}
        <nav class="sidebar-nav flex-grow-1">

            <ul id="sidebarnav" class="px-0">

                {{-- DASHBOARD --}}
                <li class="sidebar-item px-2 mb-3">

                    <a href="{{ route('secretary_dashboard') }}" class="sidebar-link dashboard-link {{ Route::currentRouteName() == "secretary_dashboard" ? "active" : "" }}">

                        <i class="bi bi-grid-fill"></i>

                        <span>
                            Dashboard
                        </span>

                    </a>

                </li>

                <hr class="sidebar-divider" style="border-top: 2px solid white">

                {{-- RECORD --}}
                <li class="sidebar-title">
                    RECORD
                </li>

                {{-- CERTIFICATION --}}
                <li class="sidebar-item">

                    <a href="{{ route('certification_select') }}"
                        class="sidebar-link {{ in_array(Route::currentRouteName(), $certificationRoute) ? 'active' : '' }}">

                        <img src="{{ asset('assets/images/icons/certification.png') }}" class="sidebar-image-icon"
                            alt="">

                        <span>
                            Certification
                        </span>

                    </a>

                </li>

                {{-- BARANGAY ID --}}
                <li class="sidebar-item">

                    <a href="a" class="sidebar-link">

                        <img src="{{ asset('assets/images/icons/barangay-id.png') }}" class="sidebar-image-icon"
                            alt="">

                        <span>
                            Barangay ID
                        </span>

                    </a>

                </li>

                {{-- BARANGAY RBI --}}
                <li class="sidebar-item">

                    <a href="a" class="sidebar-link">

                        <img src="{{ asset('assets/images/icons/rbi.png') }}" class="sidebar-image-icon" alt="">

                        <span>
                            Barangay RBI
                        </span>

                    </a>

                </li>

                {{-- OTP --}}
                <li class="sidebar-item">

                    <a href="a" class="sidebar-link">

                        <img src="{{ asset('assets/images/icons/otp.png') }}" class="sidebar-image-icon" alt="">

                        <span>
                            Barangay OTP Quarry
                        </span>

                    </a>

                </li>

                <hr class="sidebar-divider my-0" style="border-top: 2px solid white">

                {{-- REPORT --}}
                <li class="sidebar-item">
                    <a href="a" class="sidebar-link">
                        <i class="bi bi-file-earmark-text-fill"></i>
                        <span>
                            Report
                        </span>
                    </a>
                </li>

                <hr class="sidebar-divider my-0" style="border-top: 2px solid white">

                {{-- LOGOUT --}}
                <li class="sidebar-item">

                    <a href="a" class="sidebar-link">

                        <i class="bi bi-box-arrow-right"></i>

                        <span>
                            Logout
                        </span>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</aside>
