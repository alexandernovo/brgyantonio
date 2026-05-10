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
