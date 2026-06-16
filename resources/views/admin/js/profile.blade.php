<script>
    $(document).on('submit', '#userForm', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('storeUser') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == "success") {
                    Swal.fire({
                        title: "Success",
                        text: "User Updated Successfully!",
                        icon: "success",
                        showCancelButton: false,
                    }).then(() => {
                        window.location.reload();
                    })

                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message
                    });

                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                console.log(errors);
                alert("Something went wrong. Please check the console.");
            }
        });
    });
</script>
