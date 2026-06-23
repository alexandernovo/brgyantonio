<script>
    $(document).on("click", "#saveCertification", function() {

        postRequest("{{ route('secretary.saveCertification') }}", {
            description: $("#description").val(),
            certification_id: "{{ request('certification_id') }}"
        }, (response) => {

            if (response.status == "success") {

                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Certification saved successfully.",
                    confirmButtonText: "OK",
                    allowOutsideClick: false
                }).then((result) => {

                    if (result.isConfirmed) {
                        location.reload();
                    }

                });

            }

        });

    });
</script>
