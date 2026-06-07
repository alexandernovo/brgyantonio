<script>
    // Global variables for certification filtering
    let dateFromBlotter = '';
    let dateToBlotter = '';
    let selectedLetterBlotter = '';
    let tableBlotter = null;
    let selectedBlotterRow = null;
    let selectedBlotterId = null;
    let certificationBlotterData = [];
    let record_status_blotter = "Resolved"

    blotterOptions = {
        processing: true,
        serverSide: false, // Client-side processing as requested
        ajax: {
            url: "{{ route('get_blotter') }}", // Updated route to a meaningful endpoint name
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFromBlotter;
                d.dateTo = dateToBlotter;
                d.letter = selectedLetterBlotter;
                d.type = "blotter";
                d.status = record_status_blotter;
            },
            dataSrc: function(json) {
                certificationBlotterData = json.data;
                return json.data;
            }
        },
        columns: [{
                title: 'NO.',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row, meta) => meta.row + meta.settings._iDisplayStart + 1
            },
            {
                title: 'CASE CODE',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'code' // Uses the primary key from your migration
            },
            {
                title: 'COMPLAINANT',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => {
                    let middle = row.middle_name ? ` ${row.middle_name} ` : ' ';
                    return `${row.first_name}${middle}${row.last_name}`.trim();
                }
            },
            {
                title: 'RESPONDENT',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => {
                    let middle = row.respondent_middle_name ? ` ${row.respondent_middle_name} ` : ' ';
                    return `${row.respondent_first_name}${middle}${row.respondent_last_name}`.trim();
                }
            },
            {
                title: 'NATURE OF CASE',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'nature_case'
            },
            {
                title: 'CASE STATUS',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => {

                    let bgColor = '#830202';

                    if (row.status === 'Resolved') {
                        bgColor = '#0B4E06';
                    }

                    return `
                        <span
                            class="badge px-3 py-2"
                            style="
                                background-color:${bgColor};
                                color:white;
                                border-radius:6px;
                                font-size:12px;
                            ">
                            ${row.status}
                        </span>
                    `;
                }
            },
            {
                title: 'DATE OF COMPLAINTS',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => row.date_of_complaints ? formatDateTime(row.date_of_complaints) :
                    ''
            },
            {
                title: 'DATE OF RESOLVED',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => row.date_of_resolve ? formatDateTime(row.date_of_resolve) : ''
            },
            {
                title: 'ACTION',
                className: 'text-nowrap p-2 text-center align-middle sticky-action',
                render: function(data, type, row) {
                    return `
                <div class="d-flex gap-1 justify-content-center">
                    <button class="btn btn-warning btn-sm editButton px-2" style="background-color: #B35100 !important; border: none;" data-record_id="${row.record_id}"><i style="font-size: 15px" class="bi bi-pencil-fill"></i></button>
                    <button class="btn btn-danger btn-sm deleteButtonBlotter px-2" style="background-color: #A10101 !important; border: none;" data-record_id="${row.record_id}"><i style="font-size: 15px" class="bi bi-trash3-fill"></i></button>
                </div>`;
                }
            }
        ],

        initComplete: function(settings, json) {
            let filterHtml = `
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <div class="input-group date-filter-box" style="width:auto;">
                        <span class="input-group-text">From</span>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" id="blotterDateFrom">
                        <span class="input-group-text">To</span>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" id="blotterDateTo">
                        <button id="btnBlotterFilter" class="btn btn-filter">Filter</button>
                    </div>
                    <div class="alphabet-filter d-flex gap-1 flex-wrap">
                        ${'ABCDEFGHIJKL'.split('').map(char => 
                            `<button class="alpha-btn" data-letter="${char}">${char}</button>`
                        ).join('')}
                    </div>
                </div>`;

            $("#tableBlotter_wrapper .dt-length")
                .addClass('d-flex align-items-center gap-2')
                .first()
                .append(filterHtml);
        }
    };

    function rendertableBlotter() {
        if (tableBlotter) {
            tableBlotter.destroy();
        }

        tableBlotter = new DataTable('#tableBlotter', blotterOptions)
    }

    $(document).ready(function() {
        rendertableBlotter();
    })

    $(document).on("click", "#addComplaint", function() {
        $("#blotterComplaintForm")[0].reset();

        $("#blotterComplaintForm")
            .find('input[type="hidden"]')
            .not('[name="_token"]')
            .not('[name="record_type"]')
            .val('');

        $("#blotterModal").modal("show");
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

        const rowData = tableBlotter.row(this).data();

        // unselect
        if ($(this).hasClass('selected-row')) {

            $(this).removeClass('selected-row');

            selectedBlotterRow = null;
            selectedBlotterId = null;

            return;
        }

        $('table.dataTable tbody tr').removeClass('selected-row');

        $(this).addClass('selected-row');

        selectedBlotterRow = rowData;
        selectedBlotterId = rowData.certification_id;
    });

    $(document).on('click', '#editCertificationMoral', function() {

        if (!selectedBlotterRow) {

            Swal.fire({
                icon: 'warning',
                title: 'No Selected Row',
                text: 'Please select a record first.',
                confirmButtonColor: '#1A412F'
            });

            return;
        }
    });


    $(document).on('submit', '#blotterComplaintForm', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('storeKagawadRecord') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: "Success",
                    text: "Blotter Saved Successfully!",
                    icon: "success",
                    showCancelButton: false,
                })

                $('#blotterModal').modal('hide');
                $('#blotterComplaintForm')[0].reset();
                $('#image_filename_display').val('No file chosen');
                reloadBlotter();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                console.log(errors);
                alert("Something went wrong. Please check the console.");
            }
        });
    });

    function reloadBlotter() {
        if (tableBlotter) {
            tableBlotter.ajax.reload(null, false);
        } else {
            rendertableBlotter();
        }
    }

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();
        let certification_id = $(this).attr("data-certification_id");
        let find_data = certificationBlotterData.find(x => x.certification_id == certification_id);
        if (find_data) {
            $("#blotterComplaintForm")[0].reset();

            $("#blotterComplaintForm")
                .find('input[type="hidden"]')
                .not('[name="_token"]')
                .not('[name="record_type"]')
                .val('');

            populateblotterBlotterForm('blotterComplaintForm', find_data);

            $("#blotterModal").modal("show");
        }
    })

    blotterOptions.drawCallback = function() {

        if (!selectedBlotterId) return;

        const api = this.api();

        api.rows().every(function() {

            let data = this.data();

            if (data.certification_id == selectedBlotterId) {

                $(this.node()).addClass('selected-row');

                selectedBlotterRow = data;

            } else {

                $(this.node()).removeClass('selected-row');

            }

        });

    };

    $(document).on("click", ".deleteButtonBlotter", function(e) {
        e.stopPropagation();

        let record_id = $(this).attr("data-record_id");

        Swal.fire({
            icon: "warning",
            title: "Delete Blotter?",
            text: "This action cannot be undone.",
            showCancelButton: true,
            confirmButtonColor: "#A10101",
            cancelButtonColor: "#1A212B",
            confirmButtonText: "Yes, delete it"
        }).then((result) => {

            if (!result.isConfirmed) return;

            $.ajax({
                url: "{{ route('deleteRecord') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    record_id: record_id
                },
                success: function(response) {

                    Swal.fire({
                        icon: "success",
                        title: "Deleted Successfully",
                        text: "Blotter Deleted Successfully!"
                    });

                    // clear selection if deleted row is selected
                    if (selectedBlotterId == record_id) {
                        selectedBlotterId = null;
                        selectedBlotterRow = null;
                    }

                    reloadBlotter();
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

    $(document).on("click", '.resolvedUnresolvedBlotter', function() {
        $(".resolvedUnresolvedBlotter").removeClass("active-btn").addClass("btn-edit-table");
        $(this).addClass("active-btn").removeClass("btn-edit-table");

        record_status_blotter = $(this).attr('data-status');
        blotterOptions.ajax.data.status = record_status_blotter;
        reloadBlotter();
    })


    $(document).on("click", ".btn-reload-table", function() {
        dateFromBlotter = '';
        dateTolotter = '';
        selectedLetterBlotter = '';

        blotterOptions.ajax.data.dateFrom = dateFromBlotter;
        blotterOptions.ajax.data.dateTo = dateTolotter;
        blotterOptions.ajax.data.selectedLetterBlotter = selectedLetterBlotter;
        $(".alpha-btn").removeClass("active");
        tableBlotter.column(3).search('').draw();
        reloadBlotter();
    })

    $(document).on("click", "#btnBlotterFilter", function() {
        dateFromBlotter = $("#blotterDateFrom").val();
        dateTolotter = $("#blotterDateTo").val();
        blotterOptions.ajax.data.dateFrom = dateFromBlotter;
        blotterOptions.ajax.data.dateTo = dateTolotter;
        reloadBlotter();
    })

    $(document).on("click", ".alpha-btn", function() {

        let letter = $(this).attr("data-letter").toUpperCase();

        if ($(this).hasClass("active")) {
            $(".alpha-btn").removeClass("active");

            tableBlotter
                .search('')
                .columns().search('')
                .draw();

            return;
        }

        $(".alpha-btn").removeClass("active");
        $(this).addClass("active");

        tableBlotter
            .column(2)
            .search('^' + letter, true, false)
            .draw();
    });
</script>
