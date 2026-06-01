@php
    $reportRoute = [];
    $certificationRoute = ['certification_select'];
    $collectionRoute = ['collectionfee_select'];
    $reportKagawadRoute = ['kagawad_select', 'blotter_report', 'borrowed_report'];
    $secretaryRoute = ['secretary_select'];
    $treasurerRoute = ['treasurer_select'];
    $kagawadRoute = ['kagawad_select'];
@endphp
<aside class="left-sidebar sidebar-custom">

    <div class="h-100 d-flex flex-column px-2">

        {{-- PROFILE --}}
        <div class="text-center pt-3 pb-4">
            @php
                $type = '';
                $image = '';
                $user_type = Auth::user()->type;
                $user = '';
                if ($user_type == 'treasurer') {
                    $type = 'Treasurer!';
                    $user = 'Treasurer';
                    $image = asset('assets/images/users/treasurer.png');
                } elseif ($user_type == 'secretary') {
                    $type = 'Secretary!';
                    $user = 'Secretary';
                    $image = asset('assets/images/users/secretary.png');
                } elseif ($user_type == 'kagawad') {
                    $type = 'Kagawad!';
                    $user = 'Kagawad';
                    $image = asset('assets/images/users/kagawad.png');
                } elseif ($user_type == 'admin') {
                    $type = 'Admin!';
                    $user = 'Admin';
                    $image = asset('assets/images/users/captain.png');
                }
            @endphp
            <div class="profile-wrapper mx-auto">
                <img src="{{ $image }}" class="profile-image" alt="">
            </div>

            <p class="welcome-text mb-0">
                Welcome
                {{ $type }}
            </p>

        </div>
        <hr class="sidebar-divider" style="border-top: 2px solid white">
        {{-- SIDEBAR --}}
        <nav class="sidebar-nav flex-grow-1">

            <ul id="sidebarnav" class="px-0">
                @if ($user_type == 'secretary')
                    {{-- DASHBOARD --}}
                    <li class="sidebar-item px-2 mb-3">

                        <a href="{{ route('secretary_dashboard') }}"
                            class="sidebar-link dashboard-link {{ Route::currentRouteName() == 'secretary_dashboard' ? 'active' : '' }}">

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

                            <img src="{{ asset('assets/images/new/CERTIFICATION.png') }}" class="sidebar-image-icon"
                                alt="">

                            <span>
                                Certification
                            </span>

                        </a>

                    </li>

                    {{-- BARANGAY ID --}}
                    <li class="sidebar-item">

                        <a href="{{ route('brgy_id') }}" class="sidebar-link">

                            <img src="{{ asset('assets/images/new/BRGY ID.png') }}"
                                class="sidebar-image-icon {{ Route::currentRouteName() == 'brgy_id' ? 'active' : '' }}"
                                alt="">

                            <span>
                                Barangay ID
                            </span>

                        </a>

                    </li>

                    {{-- BARANGAY RBI --}}
                    <li class="sidebar-item">

                        <a href="{{ route('rbi') }}" class="sidebar-link">

                            <img src="{{ asset('assets/images/new/HOUSEHOLD INHABITANT.png') }}"
                                class="sidebar-image-icon" alt="">

                            <span>
                                Barangay RBI
                            </span>

                        </a>

                    </li>

                    {{-- OTP --}}
                    <li class="sidebar-item">

                        <a href="{{ route('quarry') }}" class="sidebar-link">

                            <img src="{{ asset('assets/images/new/QUARRY.png') }}" class="sidebar-image-icon"
                                alt="">

                            <span>
                                Barangay OTP Quarry
                            </span>

                        </a>

                    </li>

                    <hr class="sidebar-divider my-0" style="border-top: 2px solid white">

                    {{-- REPORT --}}
                    <li class="sidebar-item">
                        <a href="{{ route('report_select') }}"
                            class="sidebar-link {{ Route::currentRouteName() == 'report_select' ? 'active' : '' }}">
                            <i class="bi bi-file-earmark-text-fill"></i>
                            <span>
                                Report
                            </span>
                        </a>
                    </li>
                @endif

                @if ($user_type == 'treasurer')
                    <li class="sidebar-item px-2 mb-3">

                        <a href="{{ route('treasurer_dashboard') }}"
                            class="sidebar-link dashboard-link {{ Route::currentRouteName() == 'treasurer_dashboard' ? 'active' : '' }}">

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
                    <li class="sidebar-item">

                        <a href="{{ route('collectionfee_select') }}"
                            class="sidebar-link {{ in_array($collectionRoute, $certificationRoute) ? 'active' : '' }}">
                            <img src="{{ asset('assets/images/new/PESO.png') }}"
                                class="sidebar-image-icon1 image-black" style="filter: invert(1)" alt="">

                            <span>
                                Collection Fee
                            </span>

                        </a>

                    </li>

                    <hr class="sidebar-divider my-0" style="border-top: 2px solid white">

                    {{-- REPORT --}}
                    <li class="sidebar-item">
                        <a href="{{ route('collectionfeereport_select') }}"
                            class="sidebar-link {{ Route::currentRouteName() == 'collectionfeereport_select' ? 'active' : '' }}">
                            <i class="bi bi-file-earmark-text-fill"></i>
                            <span>
                                Report
                            </span>
                        </a>
                    </li>
                @endif

                @if ($user_type == 'kagawad')
                    <li class="sidebar-item px-2 mb-3">

                        <a href="{{ route('kagawad_dashboard') }}"
                            class="sidebar-link dashboard-link {{ Route::currentRouteName() == 'kagawad_dashboard' ? 'active' : '' }}">

                            <i class="bi bi-grid-fill"></i>

                            <span>
                                Dashboard
                            </span>

                        </a>

                    </li>
                    <hr class="sidebar-divider" style="border-top: 2px solid white">

                    <li class="sidebar-item">

                        <a href="{{ route('blotter') }}" class="sidebar-link">

                            <img src="{{ asset('assets/images/new/BLOTTER COMPLAINTS.png') }}"
                                class="sidebar-image-icon {{ Route::currentRouteName() == 'blotter' ? 'active' : '' }}"
                                alt="">

                            <span>
                                Blotter Complaints
                            </span>

                        </a>

                    </li>

                    <li class="sidebar-item">

                        <a href="{{ route('borrowedequipment') }}" class="sidebar-link">

                            <img src="{{ asset('assets/images/new/BORROWED EQUIPMENT.png') }}"
                                class="sidebar-image-icon {{ Route::currentRouteName() == 'borrowedequipment' ? 'active' : '' }}"
                                alt="">

                            <span>
                                Borrowed Equipment
                            </span>

                        </a>

                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('kagawad_select') }}"
                            class="sidebar-link {{ in_array(Route::currentRouteName(), $reportKagawadRoute) ? 'active' : '' }}">
                            <i class="bi bi-file-earmark-text-fill"></i>
                            <span>
                                Report
                            </span>
                        </a>
                    </li>
                @endif
                @if ($user_type == 'admin')
                    <li class="sidebar-item px-2 mb-3">

                        <a href="{{ route('admin_dashboard') }}"
                            class="sidebar-link dashboard-link {{ Route::currentRouteName() == 'admin_dashboard' ? 'active' : '' }}">

                            <i class="bi bi-grid-fill"></i>

                            <span>
                                Dashboard
                            </span>

                        </a>

                    </li>
                    <li class="sidebar-title">
                        OFFICIALS
                    </li>

                    {{-- CERTIFICATION --}}
                    <li class="sidebar-item ">

                        <a href="{{ route('secretary_select') }}"
                            class="sidebar-link {{ in_array(Route::currentRouteName(), $secretaryRoute) ? 'active' : '' }}">
                            <div class="image-officials">
                                <img src="{{ asset('assets/images/users/secretary.png') }}"
                                    class="w-100 h-100 object-fit-contain image-black" alt="">
                            </div>
                            <span>
                                Secretary
                            </span>

                        </a>

                    </li>

                    <li class="sidebar-item ">

                        <a href="{{ route('treasurer_select') }}"
                            class="sidebar-link {{ in_array(Route::currentRouteName(), $treasurerRoute) ? 'active' : '' }}">
                            <div class="image-officials">
                                <img src="{{ asset('assets/images/users/treasurer.png') }}"
                                    class="w-100 h-100 object-fit-contain image-black" alt="">
                            </div>
                            <span>
                                Treasurer
                            </span>

                        </a>

                    </li>

                    <li class="sidebar-item ">

                        <a href="{{ route('kagawad_select') }}"
                            class="sidebar-link {{ in_array(Route::currentRouteName(), $kagawadRoute) ? 'active' : '' }}">
                            <div class="image-officials">
                                <img src="{{ asset('assets/images/users/kagawad.png') }}"
                                    class="w-100 h-100 object-fit-contain image-black" alt="">
                            </div>
                            <span>
                                Kagawad
                            </span>

                        </a>

                    </li>
                @endif

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
