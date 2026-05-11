<script>
    // Global variables for certification filtering
    let dateFromMoral = '';
    let dateToMoral = '';
    let selectedLetterMoral = '';
    let certificationTableMoral = null;
    let selectedCertificationRow = null;
    let selectedCertificationId = null;
    let certificationMoralData = [];

    certificationMoralOptions = {
        processing: true,
        serverSide: false, // Client-side processing as requested
        ajax: {
            url: "{{ route('get_certification') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFromMoral;
                d.dateTo = dateToMoral;
                d.type = "goodmoral";
                d.letter = selectedLetterMoral;
            },
            dataSrc: function(json) {
                certificationMoralData = json.data;
                return json.data;
            }
        },
        columns: [{
                title: 'NO.',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row, meta) => meta.row + meta.settings._iDisplayStart + 1
            },
            {
                title: 'REQUESTER',
                className: 'text-nowrap p-2 text-center align-middle',
                // Combines names from migration fields
                render: (data, type, row) => {
                    let middle = row.middle_name ? ` ${row.middle_name} ` : ' ';
                    return `${row.first_name}${middle}${row.last_name}`;
                }
            },
            {
                title: 'OR NUMBER',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'or_number' // Matches migration
            },
            {
                title: 'CIVIL STATUS',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'civil_status' // Matches migration
            },
            {
                title: 'SEX',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'sex' // Matches migration
            },
            {
                title: 'PUROK',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'purok' // Matches migration
            },
            {
                title: 'DATE ISSUED',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => row.date_issued ? formatDateTime(row.date_issued) : ''
            },
            {
                title: 'ACTION',
                className: 'text-nowrap p-2 text-center align-middle sticky-action',
                render: function(data, type, row) {
                    return `
                <div class="d-flex gap-1 justify-content-center">
                    <a href="{{ route('viewGoodMoralCertification') }}?certification_id=${row.certification_id}" class="btn btn-dark btn-sm printButton px-2" style="background-color: #1A212B !important"><i style="font-size: 15px" class="bi bi-printer-fill"></i></a>
                    <button class="btn btn-warning btn-sm editButton px-2" style="background-color: #B35100 !important" data-certification_id="${row.certification_id}"><i style="font-size: 15px" class="bi bi-pencil-fill"></i></button>
                    <button class="btn btn-danger btn-sm deleteButton px-2" style="background-color: #A10101 !important" data-certification_id="${row.certification_id}"><i style="font-size: 15px" class="bi bi-trash3-fill"></i></button>
                </div>`;
                }
            },
        ],

        initComplete: function(settings, json) {
            let filterHtml = `
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <div class="input-group date-filter-box" style="width:auto;">
                    <span class="input-group-text">From</span>
                    <input type="date" class="form-control" id="certDateFromBrgy">
                    <span class="input-group-text">To</span>
                    <input type="date" class="form-control" id="certDateToBrgy">
                    <button id="btnCertFilter" class="btn btn-filter">Filter</button>
                </div>
                <div class="alphabet-filter d-flex gap-1 flex-wrap">
                    ${'ABCDEFGHIJKL'.split('').map(char => 
                        `<button class="alpha-btn ${char === 'B' ? 'active' : ''}" data-letter="${char}">${char}</button>`
                    ).join('')}
                </div>
            </div>`;

            $("#certificationTableMoral_wrapper .dt-length")
                .addClass('d-flex align-items-center gap-2')
                .first()
                .append(filterHtml);
        }
    };

    function renderCertificationTableMoral() {
        if (certificationTableMoral) {
            certificationTableMoral.destroy();
        }

        certificationTableMoral = new DataTable('#certificationTableMoral', certificationMoralOptions)
    }

    $(document).ready(function() {
        renderCertificationTableMoral();
    })

    $(document).on("click", "#addCertificationMoral", function() {
        $("#certificationForm")[0].reset();

        $("#certificationForm")
            .find('input[type="hidden"]')
            .not('[name="_token"]')
            .not('[name="certification_type"]')
            .val('');

        $("#goodmoralModal").modal("show");
    })

    $(document).ready(function() {
        $('#image_path').on('change', function() {
            // Get the file name from the path
            var fileName = $(this).val().split('\\').pop();

            // Update the display input; default to 'No file chosen' if empty
            if (fileName) {
                $('#image_filename_display').val(fileName);
            } else {
                $('#image_filename_display').val('No file chosen');
            }
        });
    });

    $(document).on('click', 'table.dataTable tbody tr', function() {

        const rowData = certificationTableMoral.row(this).data();

        // unselect
        if ($(this).hasClass('selected-row')) {

            $(this).removeClass('selected-row');

            selectedCertificationRow = null;
            selectedCertificationId = null;

            return;
        }

        $('table.dataTable tbody tr').removeClass('selected-row');

        $(this).addClass('selected-row');

        selectedCertificationRow = rowData;
        selectedCertificationId = rowData.certification_id;
    });

    $(document).on('click', '#editCertificationMoral', function() {

        if (!selectedCertificationRow) {

            Swal.fire({
                icon: 'warning',
                title: 'No Selected Row',
                text: 'Please select a record first.',
                confirmButtonColor: '#1A412F'
            });

            return;
        }
    });


    $(document).on('submit', '#certificationForm', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('storeCertification') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: "Success",
                    text: "Certification Saved Successfully!",
                    icon: "success",
                    showCancelButton: false,
                })

                $('#goodmoralModal').modal('hide');
                $('#certificationForm')[0].reset();
                $('#image_filename_display').val('No file chosen');
                reloadBrgyCertification();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                console.log(errors);
                alert("Something went wrong. Please check the console.");
            }
        });
    });

    function reloadBrgyCertification() {
        if (certificationTableMoral) {
            certificationTableMoral.ajax.reload(null, false);
        } else {
            renderCertificationTableMoral();
        }
    }

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();
        let certification_id = $(this).attr("data-certification_id");
        let find_data = certificationMoralData.find(x => x.certification_id == certification_id);
        if (find_data) {
            $("#certificationForm")[0].reset();

            $("#certificationForm")
                .find('input[type="hidden"]')
                .not('[name="_token"]')
                .not('[name="certification_type"]')
                .val('');

            populateCertificationForm('certificationForm', find_data);

            $("#goodmoralModal").modal("show");
        }
    })

    certificationMoralOptions.drawCallback = function() {

        if (!selectedCertificationId) return;

        const api = this.api();

        api.rows().every(function() {

            let data = this.data();

            if (data.certification_id == selectedCertificationId) {

                $(this.node()).addClass('selected-row');

                selectedCertificationRow = data;

            } else {

                $(this.node()).removeClass('selected-row');

            }

        });

    };

    $(document).on("click", ".deleteButton", function(e) {
        e.stopPropagation();

        let certification_id = $(this).attr("data-certification_id");

        Swal.fire({
            icon: "warning",
            title: "Delete Certification?",
            text: "This action cannot be undone.",
            showCancelButton: true,
            confirmButtonColor: "#A10101",
            cancelButtonColor: "#1A212B",
            confirmButtonText: "Yes, delete it"
        }).then((result) => {

            if (!result.isConfirmed) return;

            $.ajax({
                url: "{{ route('deleteCertification') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    certification_id: certification_id
                },
                success: function(response) {

                    Swal.fire({
                        icon: "success",
                        title: "Deleted",
                        text: response.message
                    });

                    // clear selection if deleted row is selected
                    if (selectedCertificationId == certification_id) {
                        selectedCertificationId = null;
                        selectedCertificationRow = null;
                    }

                    reloadBrgyCertification();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);

                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Failed to delete record"
                    });
                }
            });

        });
    });
</script>
