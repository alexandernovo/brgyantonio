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

        if (collection_type == 'Barangay Certification') {
            route = "{{ route('barangay_certification') }}";
        }

        if (collection_type == 'Summon') {
            route = "{{ route('summon') }}";
        }

        if (collection_type == 'Barangay ID') {
            route = "{{ route('barangay_id') }}";
        }

        if (collection_type == 'Barangay Business Clearance') {
            route = "{{ route('business_clearance') }}";
        }

        window.location = route;
    })

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
            window.location = `{{ route('collection_report') }}?type=${collection_type_data}&month=${month_collection}`;
        } else {
            window.location = `{{ route('overallreport') }}?month=${month_collection}`;
        }
    });

    $(document).on("change", "#category_collection_type", function() {
        let value = $(this).val();
        if (value != "Per Collection") {
            let $select = $("#collection_type");
            $select.val("").trigger("change").addClass("disabled-input");
            $select.find("option[value='']");
        } else {
            $("#collection_type").removeClass("disabled-input");
        }
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
