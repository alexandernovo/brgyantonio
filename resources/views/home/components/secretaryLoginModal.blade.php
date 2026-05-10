<div class="modal fade" data-bs-backdrop="static" id="secretaryLoginModal" tabindex="-1" aria-labelledby="secretaryLoginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="login-wrapper w-100">

                    <div class="login-card shadow-lg">

                        {{-- HEADER --}}
                        <div class="login-header text-center position-relative">
                            <div class="position-absolute d-flex justify-content-end" style="top: 10px; right: 10px;">
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close">
                                </button>
                            </div>
                            <div class="profile-circle mx-auto">
                                <img src="{{ asset('assets/images/users/secretary.png') }}" alt="Captain"
                                    class="w-100 h-100 object-fit-contain">
                            </div>

                            <h2 class="fw-semibold text-white mb-2" style="font-size: 25px">
                                SECRETARY
                            </h2>

                            <p class="text-white mb-0" style="font-size: 15px">
                                Enter your username and password to log in
                                <br>
                                your account
                            </p>

                        </div>

                        {{-- BODY --}}
                        <div class="login-body">
                            <form class="logins-form" data-type="secretary">
                                <div class="mb-4">
                                    <label class="form-label mb-0" style="font-size: 18px; color: #404040 !important">
                                        Username:
                                    </label>
                                    <div class="input-group custom-input-group">

                                        <span class="input-group-text">
                                            <i class="bi bi-person-circle"></i>
                                        </span>

                                        <input type="text" class="form-control" name="username"
                                            placeholder="Enter username">

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
                                    <p class="mb-0 text-danger d-none errorLogin" style="font-size: 14px">Incorrect
                                        password or username</p>
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
        </div>
    </div>
</div>

