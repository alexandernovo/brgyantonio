<script>
    $(document).on("click", ".btn-submit-collection", function() {
        let collection_type = $('#collection_type').val();
        let route = "";
        if (!collection_type) {
            Swal.fire({
                title: "Warning",
                text: "Please Select Nature of Collection!",
                icon: "warning",
                showCancelButton: false,
            })

            return;
        }

        if (collection_type == 'Barangay Clearance') {
            route = "{{ route('barangay_clearance') }}";
        }

        if (collection_type == 'Certificate of Barangay Clearance') {
            route = "{{ route('certificate_clearance') }}";
        }

        if (collection_type == 'Certificate of Trees') {
            route = "{{ route('certificate_trees') }}";
        }

        if (collection_type == 'Certificate of First Time Job Seeker') {
            route = "{{ route('certificate_jobseeker') }}";
        }

        if (collection_type == 'Certificate of Good Moral Character') {
            route = "{{ route('certificate_goodmoral') }}";
        }

        if (collection_type == 'Certificate of Indigency') {
            route = "{{ route('certificate_indigency') }}";
        }

        if (collection_type == 'Certificate of Livestock') {
            route = "{{ route('certificate_livestock') }}";
        }

        if (collection_type == 'Certificate of Motorcycle') {
            route = "{{ route('certificate_motorcycle') }}";
        }

        if (collection_type == 'Certificate of Piggery') {
            route = "{{ route('certificate_piggery') }}";
        }

        if (collection_type == 'Certificate of Quarry') {
            route = "{{ route('certificate_quary') }}";
        }

        if (collection_type == 'Certificate of Lot') {
            route = "{{ route('certificate_lot') }}";
        }

        window.location = route;
    })

    function populateCollectionForm(formId, data) {

        const form = $(`#${formId}`);

        $.each(data, function(key, value) {

            let field = form.find(`[name="${key}"]`);

            if (!field.length) return true;

            const fieldType = field.attr('type');
            const tag = field.prop("tagName")?.toLowerCase();

            // ❌ skip file inputs
            if (fieldType === 'file') {
                return true;
            }

            // ✅ RADIO
            if (fieldType === 'radio') {
                field.filter(`[value="${value}"]`).prop('checked', true);
            }

            // ✅ CHECKBOX
            else if (fieldType === 'checkbox') {
                field.prop('checked', value == 1);
            }

            // ✅ SELECT (FIX ADDED HERE)
            else if (tag === 'select') {

                field.find('option').each(function() {

                    if ($(this).val() == value) {
                        $(this).attr('selected', 'selected');
                    } else {
                        $(this).removeAttr('selected');
                    }

                });

                field.val(value); // ensure UI value
                field.trigger('change');
            }

            // ✅ DATE / DATETIME
            else if ((fieldType === 'date' || fieldType === 'datetime-local') && value) {

                const dateObj = new Date(value);

                if (!isNaN(dateObj.getTime())) {

                    const pad = (num) => String(num).padStart(2, '0');

                    const year = dateObj.getFullYear();
                    const month = pad(dateObj.getMonth() + 1);
                    const day = pad(dateObj.getDate());

                    if (fieldType === 'date') {
                        field.val(`${year}-${month}-${day}`).trigger('change');
                    } else {
                        const hours = pad(dateObj.getHours());
                        const minutes = pad(dateObj.getMinutes());

                        field.val(`${year}-${month}-${day}T${hours}:${minutes}`).trigger('change');
                    }
                } else {
                    field.val(value).trigger('change');
                }
            }

            // ✅ DEFAULT INPUTS
            else {
                field.val(value).trigger('change');
            }
        });
    }
</script>
