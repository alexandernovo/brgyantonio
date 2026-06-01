<script>
    $(document).on("click", ".btn-submit", function() {
        let cert_type = $('#cert_type').val();
        let doc_type = $('#doc_type').val();
        let route = "";

        if (!doc_type) {
            Swal.fire({
                title: "Warning",
                text: "Please Select Document Report Type!",
                icon: "warning",
                showCancelButton: false,
            })

            return;
        }

        if (!cert_type && doc_type == "Certification") {
            Swal.fire({
                title: "Warning",
                text: "Please Select Type of Certification!",
                icon: "warning",
                showCancelButton: false,
            })

            return;
        }

        if (doc_type == "Barangay ID") {
            route = "{{ route('brgy_id') }}";
        }

        if (doc_type == "Barangay RBI") {
            route = "{{ route('rbi') }}";
        }

        if (doc_type == "Barangay OTP Quarry") {
            route = "{{ route('quarry') }}";
        }

        if (doc_type == "Certification") {
            if (cert_type == 'Certificate of Barangay') {
                route = "{{ route('certificate_brgy') }}";
            }

            if (cert_type == 'Certificate of Barangay Clearance') {
                route = "{{ route('certificate_clearance') }}";
            }

            if (cert_type == 'Certificate of Trees') {
                route = "{{ route('certificate_trees') }}";
            }

            if (cert_type == 'Certificate of First Time Job Seeker') {
                route = "{{ route('certificate_jobseeker') }}";
            }

            if (cert_type == 'Certificate of Good Moral Character') {
                route = "{{ route('certificate_goodmoral') }}";
            }

            if (cert_type == 'Certificate of Indigency') {
                route = "{{ route('certificate_indigency') }}";
            }

            if (cert_type == 'Certificate of Livestock') {
                route = "{{ route('certificate_livestock') }}";
            }

            if (cert_type == 'Certificate of Motorcycle') {
                route = "{{ route('certificate_motorcycle') }}";
            }

            if (cert_type == 'Certificate of Piggery') {
                route = "{{ route('certificate_piggery') }}";
            }

            if (cert_type == 'Certificate of Quarry') {
                route = "{{ route('certificate_quary') }}";
            }

            if (cert_type == 'Certificate of Lot') {
                route = "{{ route('certificate_lot') }}";
            }
        }

        window.location = route;
    });

    $(document).on("change", "#doc_type", function() {
        let value = $(this).val();
        console.log(value);
        if (value != "Certification") {
            let $select = $("#cert_type");
            $select.val("").trigger("change").addClass("disabled-input");
            $select.find("option[value='']");
        } else {
            $("#cert_type").removeClass("disabled-input");
        }
    })
</script>
