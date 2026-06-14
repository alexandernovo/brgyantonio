<script>
    // Global variables for certification filtering
    let dateFromCollectionClearance = '';
    let dateToCollectionClearance = '';
    let selectedLetterCollectionClearance = '';
    let collectionTableClearance = null;
    let selectedCollectionClearanceRow = null;
    let selectedCollectionClearanceId = null;
    let certificationCollectionClearanceData = [];
    let statusCollectionClearance = "Paid";

    collectionClearanceOptions = {
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('get_collection') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFromCollectionClearance;
                d.dateTo = dateToCollectionClearance;
                d.type = "clearance";
                d.status = statusCollectionClearance;
                d.letter = selectedLetterCollectionClearance;
            },
            dataSrc: function(json) {
                certificationCollectionClearanceData = json.data;
                return json.data;
            }
        },
        columns: [{
                title: 'NO.',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row, meta) => meta.row + meta.settings._iDisplayStart + 1
            },
            {
                title: 'DATE',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => row.payment_date ? formatDateTime(row.payment_date) : ''
            },
            {
                title: 'OR NUMBER',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => {
                    return row.or_number;
                }
            },
            {
                title: 'PAYOR',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => {
                    let middle = row.middle_name ? ` ${row.middle_name} ` : ' ';
                    return `${row.first_name}${middle}${row.last_name}`;
                }
            },
            {
                title: 'AMOUNT',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => {
                    return row.payment_amount;
                }
            },
            {
                title: 'PAYMENT STATUS',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => {

                    let bgColor = '#830202';

                    if (row.payment_status === 'Paid') {
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
                            ${row.payment_status}
                        </span>
                    `;
                }
            },
            {
                title: 'ACTION',
                className: 'text-nowrap p-2 text-center align-middle sticky-action',
                render: function(data, type, row) {
                    return `
                        <div class="d-flex gap-1 justify-content-center">
                            <button class="btn btn-warning btn-sm editButtonCollectionClearance px-2" style="background-color: #B35100 !important" data-collection_id="${row.collection_id}"><i style="font-size: 15px" class="bi bi-pencil-fill"></i></button>
                            <button class="btn btn-danger btn-sm deleteButtonCollectionClearance px-2" style="background-color: #A10101 !important" data-collection_id="${row.collection_id}"><i style="font-size: 15px" class="bi bi-trash3-fill"></i></button>
                        </div>`;
                }
            },
        ],

        initComplete: function(settings, json) {
            let filterHtml = `
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <div class="input-group date-filter-box" style="width:auto;">
                    <span class="input-group-text">From</span>
                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="collectionDateFrom">
                    <span class="input-group-text">To</span>
                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="collectionDateTo">
                    <button id="btnCertFilter" class="btn btn-filter">Filter</button>
                </div>
                <div class="alphabet-filter d-flex gap-1 flex-wrap">
                    ${'ABCDEFGHIJKL'.split('').map(char => 
                        `<button class="alpha-btn" data-letter="${char}">${char}</button>`
                    ).join('')}
                </div>
            </div>`;

            $("#collectionTableClearance_wrapper .dt-length")
                .addClass('d-flex align-items-center gap-2')
                .first()
                .append(filterHtml);
        }
    };

    function renderCollectionClearance() {
        if (collectionTableClearance) {
            collectionTableClearance.destroy();
        }

        collectionTableClearance = new DataTable('#collectionTableClearance', collectionClearanceOptions)
    }

    $(document).ready(function() {
        renderCollectionClearance();
    })

    $(document).on("click", "#addCollectionClearance", function() {
        $("#collectionForm")[0].reset();

        $("#collectionForm")
            .find('input[type="hidden"]')
            .not('[name="_token"]')
            .not('[name="collection_type"]')
            .val('');

        $("#clearanceCollectionModal").modal("show");
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

        const rowData = collectionTableClearance.row(this).data();

        // unselect
        if ($(this).hasClass('selected-row')) {

            $(this).removeClass('selected-row');

            selectedCollectionClearanceRow = null;
            selectedCollectionClearanceId = null;

            return;
        }

        $('table.dataTable tbody tr').removeClass('selected-row');

        $(this).addClass('selected-row');

        selectedCollectionClearanceRow = rowData;
        selectedCollectionClearanceId = rowData.collection_id;
    });

    $(document).on('click', '#editCollectionClearance', function() {

        if (!selectedCollectionClearanceRow) {

            Swal.fire({
                icon: 'warning',
                title: 'No Selected Row',
                text: 'Please select a record first.',
                confirmButtonColor: '#1A412F'
            });

            return;
        }
    });


    $(document).on('submit', '#collectionForm', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('storeCollection') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: "Success",
                    text: "Barangay Clearance Fee Saved Successfully!",
                    icon: "success",
                    showCancelButton: false,
                })

                $('#clearanceCollectionModal').modal('hide');
                $('#collectionForm')[0].reset();
                reloadCollectionClearance();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                console.log(errors);
                alert("Something went wrong. Please check the console.");
            }
        });
    });

    function reloadCollectionClearance() {
        if (collectionTableClearance) {
            collectionTableClearance.ajax.reload(null, false);
        } else {
            renderCollectionClearance();
        }
    }

    $(document).on("click", ".editButtonCollectionClearance", function(e) {
        e.stopPropagation();
        let collection_id = $(this).attr("data-collection_id");
        let find_data = certificationCollectionClearanceData.find(x => x.collection_id == collection_id);
        if (find_data) {
            $("#collectionForm")[0].reset();

            $("#collectionForm")
                .find('input[type="hidden"]')
                .not('[name="_token"]')
                .not('[name="collection_type"]')
                .val('');

            populatecollectionForm('collectionForm', find_data);

            $("#clearanceCollectionModal").modal("show");
        }
    })

    collectionClearanceOptions.drawCallback = function() {

        if (!selectedCollectionClearanceId) return;

        const api = this.api();

        api.rows().every(function() {

            let data = this.data();

            if (data.collection_id == selectedCollectionClearanceId) {

                $(this.node()).addClass('selected-row');

                selectedCollectionClearanceRow = data;

            } else {

                $(this.node()).removeClass('selected-row');

            }

        });

    };

    $(document).on("click", ".deleteButtonCollectionClearance", function(e) {
        e.stopPropagation();

        let collection_id = $(this).attr("data-collection_id");

        Swal.fire({
            icon: "warning",
            title: "Delete Barangay Clearance Fee?",
            text: "This action cannot be undone.",
            showCancelButton: true,
            confirmButtonColor: "#A10101",
            cancelButtonColor: "#1A212B",
            confirmButtonText: "Yes, delete it"
        }).then((result) => {

            if (!result.isConfirmed) return;

            $.ajax({
                url: "{{ route('deleteCollection') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    collection_id: collection_id
                },
                success: function(response) {

                    Swal.fire({
                        icon: "success",
                        title: "Deleted Successfully",
                        text: "Barangay Clearance Deleted Successfully!"
                    });

                    // clear selection if deleted row is selected
                    if (selectedCollectionClearanceId == collection_id) {
                        selectedCollectionClearanceId = null;
                        selectedCollectionClearanceRow = null;
                    }

                    reloadCollectionClearance();
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

    $(document).on("click", '.paidUnpaidCollectionClearance', function() {
        $(".paidUnpaidCollectionClearance").removeClass("active-btn").addClass("btn-edit-table");
        $(this).addClass("active-btn").removeClass("btn-edit-table");

        statusCollectionClearance = $(this).attr('data-status');
        collectionClearanceOptions.ajax.data.status = statusCollectionClearance;
        reloadCollectionClearance();
    })

    $(document).on("click", ".btn-reload-table", function() {
        dateFromCollectionClearance = '';
        dateToCollectionClearance = '';
        selectedLetterCollectionClearance = '';

        collectionClearanceOptions.ajax.data.dateFrom = dateFromCollectionClearance;
        collectionClearanceOptions.ajax.data.dateTo = dateToCollectionClearance;
        collectionClearanceOptions.ajax.data.selectedLetterCollectionClearance = selectedLetterCollectionClearance;
        $(".alpha-btn").removeClass("active");
        collectionTableClearance.column(3).search('').draw();
        reloadCollectionClearance();
    })

    $(document).on("click", "#btnCertFilter", function() {
        dateFromCollectionClearance = $("#collectionDateFrom").val();
        dateToCollectionClearance = $("#collectionDateTo").val();
        collectionClearanceOptions.ajax.data.dateFrom = dateFromCollectionClearance;
        collectionClearanceOptions.ajax.data.dateTo = dateToCollectionClearance;
        reloadCollectionClearance();
    })

    $(document).on("click", ".alpha-btn", function() {

        let letter = $(this).data("letter");

        // if already active → unselect (reset)
        if ($(this).hasClass("active")) {
            $(".alpha-btn").removeClass("active");

            collectionTableClearance
                .search('')
                .columns().search('')
                .draw();

            return;
        }

        // normal select
        $(".alpha-btn").removeClass("active");
        $(this).addClass("active");

        collectionTableClearance
            .column(3)
            .search('^' + letter, true, false)
            .draw();
    });
</script>
