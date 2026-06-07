<script>
    // Global variables for certification filtering
    let dateFromBorrowed = '';
    let dateToBorrowed = '';
    let selectedLetterBorrowed = '';
    let tableBorrowed = null;
    let selectedBorrowedRow = null;
    let selectedBorrowedId = null;
    let certificationBorrowedData = [];
    let record_status_borrowed = "Returned"

    borrowedOptions = {
        processing: true,
        serverSide: false, // Client-side processing as requested
        ajax: {
            url: "{{ route('get_blotter') }}", // Updated route to a meaningful endpoint name
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFromBorrowed;
                d.dateTo = dateToBorrowed;
                d.letter = selectedLetterBorrowed;
                d.type = "borrowed";
                d.status = record_status_borrowed;
            },
            dataSrc: function(json) {
                certificationBorrowedData = json.data;
                return json.data;
            }
        },
        columns: [{
                title: 'NO.',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row, meta) => meta.row + meta.settings._iDisplayStart + 1
            },
            {
                title: 'TRANSACTION CODE',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'code' // Uses the primary key from your migration
            },
            {
                title: 'BORROWER',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => {
                    let middle = row.middle_name ? ` ${row.middle_name} ` : ' ';
                    return `${row.first_name}${middle}${row.last_name}`.trim();
                }
            },
            {
                title: 'BORROWED EQUIPMENT',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => {
                    return row.borrowed_equipment;
                }
            },
            {
                title: 'QUANTITY',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'quantity'
            },
            {
                title: 'BORROWED STATUS',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => {

                    let bgColor = '#830202';

                    if (row.status === 'Returned') {
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
                title: 'DATE OF BORROWED',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => row.date_of_borrowed ? formatDateTime(row.date_of_borrowed) : ''
            },
            {
                title: 'DATE OF RETURNED',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => row.date_of_return ? formatDateTime(row.date_of_return) : ''
            },
            {
                title: 'ACTION',
                className: 'text-nowrap p-2 text-center align-middle sticky-action',
                render: function(data, type, row) {
                    return `
                <div class="d-flex gap-1 justify-content-center">
                    <button class="btn btn-warning btn-sm editButton px-2" style="background-color: #B35100 !important; border: none;" data-record_id="${row.record_id}"><i style="font-size: 15px" class="bi bi-pencil-fill"></i></button>
                    <button class="btn btn-danger btn-sm deleteButtonBorrowed px-2" style="background-color: #A10101 !important; border: none;" data-record_id="${row.record_id}"><i style="font-size: 15px" class="bi bi-trash3-fill"></i></button>
                </div>`;
                }
            }
        ],

        initComplete: function(settings, json) {
            let filterHtml = `
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <div class="input-group date-filter-box" style="width:auto;">
                        <span class="input-group-text">From</span>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" id="dateFromBorrowed">
                        <span class="input-group-text">To</span>
                        <input type="date" class="form-control" id="dateToBorrowed" value="{{ date('Y-m-d') }}">
                        <button id="btnBorrowedFilter" class="btn btn-filter">Filter</button>
                    </div>
                    <div class="alphabet-filter d-flex gap-1 flex-wrap">
                        ${'ABCDEFGHIJKL'.split('').map(char => 
                            `<button class="alpha-btn" data-letter="${char}">${char}</button>`
                        ).join('')}
                    </div>
                </div>`;

            $("#tableBorrowed_wrapper .dt-length")
                .addClass('d-flex align-items-center gap-2')
                .first()
                .append(filterHtml);
        }
    };

    function rendertableBorrowed() {
        if (tableBorrowed) {
            tableBorrowed.destroy();
        }

        tableBorrowed = new DataTable('#tableBorrowed', borrowedOptions)
    }

    $(document).ready(function() {
        rendertableBorrowed();
    })

    $(document).on("click", "#addBorrowed", function() {
        $("#borrowedComplaintForm")[0].reset();

        $("#borrowedComplaintForm")
            .find('input[type="hidden"]')
            .not('[name="_token"]')
            .not('[name="record_type"]')
            .val('');

        $("#borrowedModal").modal("show");
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

        const rowData = tableBorrowed.row(this).data();

        // unselect
        if ($(this).hasClass('selected-row')) {

            $(this).removeClass('selected-row');

            selectedBorrowedRow = null;
            selectedBorrowedId = null;

            return;
        }

        $('table.dataTable tbody tr').removeClass('selected-row');

        $(this).addClass('selected-row');

        selectedBorrowedRow = rowData;
        selectedBorrowedId = rowData.certification_id;
    });

    $(document).on('click', '#editCertificationMoral', function() {

        if (!selectedBorrowedRow) {

            Swal.fire({
                icon: 'warning',
                title: 'No Selected Row',
                text: 'Please select a record first.',
                confirmButtonColor: '#1A412F'
            });

            return;
        }
    });


    $(document).on('submit', '#borrowedComplaintForm', function(e) {
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
                    text: "Borrowed Saved Successfully!",
                    icon: "success",
                    showCancelButton: false,
                })

                $('#borrowedModal').modal('hide');
                $('#borrowedComplaintForm')[0].reset();
                $('#image_filename_display').val('No file chosen');
                reloadBorrower();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                console.log(errors);
                alert("Something went wrong. Please check the console.");
            }
        });
    });

    function reloadBorrower() {
        if (tableBorrowed) {
            tableBorrowed.ajax.reload(null, false);
        } else {
            rendertableBorrowed();
        }
    }

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();
        let certification_id = $(this).attr("data-certification_id");
        let find_data = certificationBorrowedData.find(x => x.certification_id == certification_id);
        if (find_data) {
            $("#borrowedComplaintForm")[0].reset();

            $("#borrowedComplaintForm")
                .find('input[type="hidden"]')
                .not('[name="_token"]')
                .not('[name="record_type"]')
                .val('');

            populateblotterBlotterForm('borrowedComplaintForm', find_data);

            $("#borrowedModal").modal("show");
        }
    })

    borrowedOptions.drawCallback = function() {

        if (!selectedBorrowedId) return;

        const api = this.api();

        api.rows().every(function() {

            let data = this.data();

            if (data.certification_id == selectedBorrowedId) {

                $(this.node()).addClass('selected-row');

                selectedBorrowedRow = data;

            } else {

                $(this.node()).removeClass('selected-row');

            }

        });

    };

    $(document).on("click", ".deleteButtonBorrowed", function(e) {
        e.stopPropagation();

        let record_id = $(this).attr("data-record_id");

        Swal.fire({
            icon: "warning",
            title: "Delete Borrowed?",
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
                        text: "Borrowed Deleted Successfully!"
                    });

                    // clear selection if deleted row is selected
                    if (selectedBorrowedId == record_id) {
                        selectedBorrowedId = null;
                        selectedBorrowedRow = null;
                    }

                    reloadBorrower();
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

    $(document).on("click", '.returnedUnreturnBorrowed', function() {
        $(".returnedUnreturnBorrowed").removeClass("active-btn").addClass("btn-edit-table");
        $(this).addClass("active-btn").removeClass("btn-edit-table");

        record_status_borrowed = $(this).attr('data-status');
        borrowedOptions.ajax.data.status = record_status_borrowed;
        reloadBorrower();
    })


    $(document).on("click", ".btn-reload-table", function() {
        dateFromBorrowed = '';
        dateToBorrowed = '';
        selectedLetterBorrowed = '';

        borrowedOptions.ajax.data.dateFrom = dateFromBorrowed;
        borrowedOptions.ajax.data.dateTo = dateToBorrowed;
        borrowedOptions.ajax.data.selectedLetterBorrowed = selectedLetterBorrowed;
        $(".alpha-btn").removeClass("active");
        tableBorrowed.column(3).search('').draw();
        reloadBorrower();
    })

    $(document).on("click", "#btnBorrowedFilter", function() {
        dateFromBorrowed = $("#dateFromBorrowed").val();
        dateToBorrowed = $("#dateToBorrowed").val();
        borrowedOptions.ajax.data.dateFrom = dateFromBorrowed;
        borrowedOptions.ajax.data.dateTo = dateToBorrowed;
        reloadBorrower();
    })

    $(document).on("click", ".alpha-btn", function() {

        let letter = $(this).attr("data-letter").toUpperCase();

        if ($(this).hasClass("active")) {
            $(".alpha-btn").removeClass("active");

            tableBorrowed
                .search('')
                .columns().search('')
                .draw();

            return;
        }

        $(".alpha-btn").removeClass("active");
        $(this).addClass("active");

        tableBorrowed
            .column(2)
            .search('^' + letter, true, false)
            .draw();
    });
</script>
