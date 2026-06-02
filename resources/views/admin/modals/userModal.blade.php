<div class="modal fade" data-bs-backdrop="static" id="userModal" tabindex="-1" aria-labelledby="userModalLabel"
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
                            <div class=" mx-auto" style="width: 96px; height: 96px; border-radius: 50%">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="Captain"
                                    class="w-100 h-100 object-fit-contain">
                            </div>

                            <h2 class="fw-semibold text-white mb-2 mt-2" style="font-size: 25px">
                                USER-ROLE
                            </h2>
                        </div>

                        {{-- BODY --}}
                        <div class="login-body">
                            <form id="userForm">
                                <div class="mb-4">
                                    <input type="hidden" name="id" id="id" value="0">
                                    <label class="form-label mb-0" style="font-size: 18px; color: #404040 !important">
                                        Username:
                                    </label>

                                    <div class="input-group custom-input-group">

                                        <span class="input-group-text">
                                            <i class="bi bi-person-circle"></i>
                                        </span>

                                        <input type="text" class="form-control" id="username" name="username"
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

                                        <button class="input-group-text bg-white border-start-0 togglePassword"
                                            type="button">

                                            <i class="bi bi-eye-fill"></i>

                                        </button>

                                    </div>
                                    <p class="mb-0 text-warning d-none updateWarning" style="font-size: 14px">
                                        (Leave blank to retain old password)
                                    </p>
                                </div>

                                <div class="mb-4">

                                    <label class="form-label mb-0" style="font-size: 18px; color: #404040 !important">
                                        User-Role:
                                    </label>

                                    <div class="input-group custom-input-group">

                                        <span class="input-group-text">
                                            <i class="bi bi-person-vcard"></i>
                                        </span>
                                        <select name="type" id="type" class="form-select rounded">
                                            <option value="admin">Admin</option>
                                            <option value="secretary">Secretary</option>
                                            <option value="treasurer">Treasurer</option>
                                            <option value="kagawad">Kagawad</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- LOGIN BUTTON --}}
                                <button type="submit" class="btn login-btn w-100">
                                    <i class="bi bi-person-plus-fill me-1"></i>
                                    Add User
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
