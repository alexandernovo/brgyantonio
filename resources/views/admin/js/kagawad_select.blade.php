<script>
    $(document).on("click", ".btn-submit-kagawad", function() {

        console.log("clicked");

        let kagawad_type = $('#kagawad_type').val();
        let route = "";
        if (!kagawad_type) {
            Swal.fire({
                title: "Warning",
                text: "Please Select Document Record Type!",
                icon: "warning",
                showCancelButton: false,
            })

            return;
        }

        if (kagawad_type == 'Blotter Complaints') {
            route = "{{ route('blotter') }}";
        }

        if (kagawad_type == 'Borrowed Equipment') {
            route = "{{ route('borrowedequipment') }}";
        }

        window.location = route;
    })
</script>
