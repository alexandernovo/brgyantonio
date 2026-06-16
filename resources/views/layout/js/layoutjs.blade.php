<script>
    $(document).on("click", ".logout-btn", function() {
        Swal.fire({
            title: "Logout?",
            text: "Are you sure you want to logout?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: "Yes, Logout",
            cancelButtonText: "No, Stay Login",
            reverseButtons: true,
            backdrop: true,
            allowOutsideClick: false,
            buttonsStyling: false, // Turn off default SweetAlert button styling
            customClass: {
                popup: 'custom-logout-popup',
                icon: 'custom-logout-icon',
                title: 'custom-logout-title',
                htmlContainer: 'custom-logout-text',
                actions: 'custom-logout-actions',
                confirmButton: 'btn btn-logout',
                cancelButton: 'btn btn-cancel-logout'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                let timerInterval;
                Swal.fire({
                    title: "Log out",
                    html: "Logging out in <b></b> seconds",
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getHtmlContainer().querySelector('b');
                        timerInterval = setInterval(() => {
                            const secondsLeft = Math.ceil(Swal.getTimerLeft() /
                                1000);
                            timer.textContent = `${secondsLeft}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        postRequest("{{ route('auth.logout') }}", {}, (response) => {
                            if (response.status == "success") {
                                window.location.href = "{{ route('home') }}";
                            }
                        });
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                console.log("Logout canceled");
            }
        });
    });
    $(document).ready(function() {
        $('.toast').each(function() {
            var toast = new bootstrap.Toast(this);
            toast.show();
        });
    });

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    function postRequest(
        route,
        data = {},
        callback = null,
        errorCallback = null,
        isFormData = false
    ) {
        $.ajax({
            url: route,
            type: "POST",
            data: isFormData ? data : JSON.stringify(data),
            contentType: isFormData ? false : "application/json",
            process: isFormData ? false : true,
            success: function(response) {
                if (callback) {
                    callback(response);
                } else {
                    console.log("success");
                }
            },
            error: function(xhr, status, error) {
                let errorMessageGlobal = "An unexpected error occurred.";
                errorMessageGlobal = errorGetter(xhr, status);
                Swal.fire({
                    title: "Failed",
                    text: errorMessageGlobal,
                    icon: "error",
                    showCancelButton: false,
                });
                if (errorCallback) {
                    errorCallback(error);
                } else {
                    console.error("Error:", status, error);
                }
            },
        });
    }
</script>
