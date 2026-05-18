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
                if (field.attr('type') === 'file') {
                    return true;
                }

                if (field.attr('type') === 'radio') {
                    field.filter(`[value="${value}"]`).prop('checked', true);
                } else if (field.attr('type') === 'checkbox') {
                    field.prop('checked', value == 1);
                } else {

                    field.val(value).trigger('change');
                }
            }
        });
    }
</script>
