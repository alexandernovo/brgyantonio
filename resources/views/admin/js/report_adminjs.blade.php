<script>
    $(document).on("click", ".btn-report", function() {
        let cert_type = $('#cert_type').val();
        let report_type = $('#report_type').val();
        let month = $('#month').val();
        let route = "";

        if (!report_type) {
            Swal.fire({
                title: "Warning",
                text: "Please Select Report Type!",
                icon: "warning",
                showCancelButton: false,
            })

            return;
        }

        if (!month) {
            Swal.fire({
                title: "Warning",
                text: "Please Select Month!",
                icon: "warning",
                showCancelButton: false,
            })
            return;

        }

        if (!cert_type && report_type == "Barangay Certification") {
            Swal.fire({
                title: "Warning",
                text: "Please Select Type of Certification!",
                icon: "warning",
                showCancelButton: false,
            })

            return;
        }

        if (report_type == "Barangay Certification") {

            if (cert_type == 'Certificate of Barangay') {
                route = "{{ route('report_brgy') }}";
            }

            if (cert_type == 'Certificate of Barangay Clearance') {
                route = "{{ route('report_brgy_clearance') }}";
            }

            if (cert_type == 'Certificate of Trees') {
                route = "{{ route('report_trees') }}";
            }

            if (cert_type == 'Certificate of First Time Job Seeker') {
                route = "{{ route('report_jobseeker') }}";
            }

            if (cert_type == 'Certificate of Good Moral Character') {
                route = "{{ route('report_goodmoral') }}";
            }

            if (cert_type == 'Certificate of Indigency') {
                route = "{{ route('report_indigency') }}";
            }

            if (cert_type == 'Certificate of Livestock') {
                route = "{{ route('report_livestock') }}";
            }

            if (cert_type == 'Certificate of Motorcycle') {
                route = "{{ route('report_motorcycle') }}";
            }

            if (cert_type == 'Certificate of Piggery') {
                route = "{{ route('report_piggery') }}";
            }

            if (cert_type == 'Certificate of Quarry') {
                route = "{{ route('report_quarry') }}";
            }

            if (cert_type == 'Certificate of Lot') {
                route = "{{ route('report_lot') }}";
            }
        }

        window.location = `${route}?month=${month}`;

    });


    $(document).on("click", ".btn-report-collection", function() {
        let collection_type = $('#collection_type').val();
        let collection_type_data = $('#collection_type')
            .find(':selected')
            .data('type');
        let category_collection_type = $('#category_collection_type').val();
        let month_collection = $('#month_collection').val();
        let route = "";

        if (!category_collection_type) {
            Swal.fire({
                title: "Warning",
                text: "Please Select Category Collection!",
                icon: "warning",
                showCancelButton: false,
            })

            return;
        }

        if (!month_collection) {
            Swal.fire({
                title: "Warning",
                text: "Please Select Month!",
                icon: "warning",
                showCancelButton: false,
            })
            return;

        }

        if (!collection_type && category_collection_type == "Per Collection") {
            Swal.fire({
                title: "Warning",
                text: "Please Select Nature of Collection!",
                icon: "warning",
                showCancelButton: false,
            })

            return;
        }

        if (category_collection_type == "Per Collection") {
            window.location = "{{ route('collection_report') }}?type=" + collection_type_data;
        } else {

        }
    });

    $(document).on("click", ".btn-report-kagawad", function() {
        let report_type = $('#report_type').val();
        let report_type_data = $('#report_type').find(':selected').data('type');

        let month_kagawad = $('#month_kagawad').val();
        let route = "";

        if (!report_type) {
            Swal.fire({
                title: "Warning",
                text: "Please Select Report Type!",
                icon: "warning",
                showCancelButton: false,
            });
            return;
        }

        // If no month selected, use current month
        if (!month_kagawad) {
            const today = new Date();
            month_kagawad = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}`;
        }

        if (report_type == "Blotter Complaints") {
            window.location =
                "{{ route('blotter_report') }}?type=" + report_type_data +
                "&month=" + month_kagawad;
        } else {
            window.location =
                "{{ route('borrowed_report') }}?type=" + report_type_data +
                "&month=" + month_kagawad;
        }
    });

    $(document).on("change", "#category_report_type", function() {
        let value = $(this).val();
        if (value != "Per Collection") {
            let $select = $("#collection_type");
            $select.val("").trigger("change").addClass("disabled-input");
            $select.find("option[value='']");
        } else {
            $("#collection_type").removeClass("disabled-input");
        }
    })
    $(document).on("change", "#report_type", function() {
        let value = $(this).val();
        if (value == "Barangay ID") {
            let $select = $("#cert_type");
            $select.val("").trigger("change").addClass("disabled-input");
            $select.find("option[value='']");
        } else {
            $("#cert_type").removeClass("disabled-input");
        }
    })
</script>
