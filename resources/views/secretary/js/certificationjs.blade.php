<script>
    $(document).on("click", ".btn-submit", function() {
        let cert_type = $('#cert_type').val();
        let route = "";
        if (!cert_type) {
            Swal.fire({
                title: "Warning",
                text: "Please Type of Certification!",
                icon: "warning",
                showCancelButton: false,
            })

            return;
        }

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

        window.location = route;
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
                route = "{{ route('certificate_clearance') }}";
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

    })

    function formatDateTime(dateString) {
        if (!dateString) return "";

        const date = new Date(dateString);

        // Check if the date is valid
        if (isNaN(date.getTime())) return dateString;

        const options = {
            year: 'numeric',
            month: 'short',
            day: '2-digit'
        };
        return date.toLocaleDateString('en-US', options);
    }


    function populateCertificationForm(formId, data) {
        const form = $(`#${formId}`);

        $.each(data, function(key, value) {
            let field = form.find(`[name="${key}"]`);
            if (field.length) {
                const fieldType = field.attr('type');

                if (fieldType === 'file') {
                    return true; // Skip file inputs
                }

                if (fieldType === 'radio') {
                    field.filter(`[value="${value}"]`).prop('checked', true);
                } else if (fieldType === 'checkbox') {
                    field.prop('checked', value == 1);
                } else if ((fieldType === 'date' || fieldType === 'datetime-local') && value) {
                    // Parse the value into a Date object
                    const dateObj = new Date(value);

                    // Check if the date is valid before attempting to format
                    if (!isNaN(dateObj.getTime())) {

                        // Pad numbers with a leading zero if they are single digits
                        const pad = (num) => String(num).padStart(2, '0');

                        const year = dateObj.getFullYear();
                        const month = pad(dateObj.getMonth() + 1);
                        const day = pad(dateObj.getDate());

                        if (fieldType === 'date') {
                            // Format: YYYY-MM-DD
                            field.val(`${year}-${month}-${day}`).trigger('change');
                        } else if (fieldType === 'datetime-local') {
                            // Format: YYYY-MM-DDTHH:mm
                            const hours = pad(dateObj.getHours());
                            const minutes = pad(dateObj.getMinutes());
                            field.val(`${year}-${month}-${day}T${hours}:${minutes}`).trigger('change');
                        }
                    } else {
                        // Fallback to original value if date parsing fails
                        field.val(value).trigger('change');
                    }
                } else {
                    // Handle text, hidden, textarea, select, etc.
                    field.val(value).trigger('change');
                }
            }
        });
    }
</script>
