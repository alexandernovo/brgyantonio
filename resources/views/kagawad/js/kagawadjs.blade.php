<script>
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

    function populateblotterBlotterForm(formId, data) {

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
