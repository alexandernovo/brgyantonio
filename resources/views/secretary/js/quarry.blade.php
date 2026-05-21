<script>
    // Global variables for certification filtering
    let dateFromQuarryOtp = '';
    let dateToQuarryOtp = '';
    let selectedLetterQuarryOtp = '';
    let certificationTableQuarryOtp = null;
    let selectedCertificationRow = null;
    let selectedQuarryId = null;
    let certificationQuarryOtpData = [];

    quarryOTPOptions = {
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('get_quary') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFromQuarryOtp;
                d.dateTo = dateToQuarryOtp;
                d.letter = selectedLetterQuarryOtp;
            },
            dataSrc: function(json) {
                certificationQuarryOtpData = json.data;
                return json.data;
            }
        },

        columns: [{
                title: 'NO.',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row, meta) =>
                    meta.row + meta.settings._iDisplayStart + 1
            },

            {
                title: 'BL NO.',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'delivery_receipt_or_bl_no'
            },

            {
                title: 'MARKS',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'load_marks'
            },

            {
                title: 'NUMBERS',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'load_numbers'
            },

            {
                title: 'NO. OF PACKAGES',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'no_of_packages'
            },

            {
                title: 'CUBIC METER',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'cubic_meter'
            },

            {
                title: 'KIND OF PARCEL',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'material_type'
            },

            {
                title: 'WEIGHT IN KILOGRAM',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'weight_kg'
            },

            {
                title: 'VALUE',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'market_value'
            },

            {
                title: 'SHIPPER',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'quarry_operator_or_shipper'
            },

            {
                title: 'CONSIGNEE',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'consignee'
            },

            {
                title: 'ACTION',
                className: 'text-nowrap p-2 text-center align-middle sticky-action',
                render: function(data, type, row) {
                    return `
                <div class="d-flex gap-1 justify-content-center">

                    <button class="btn btn-warning btn-sm editButton px-2"
                        style="background-color: #B35100 !important"
                        data-quarry_id="${row.quarry_id}">

                        <i style="font-size: 15px"
                            class="bi bi-pencil-fill"></i>

                    </button>

                    <button class="btn btn-danger btn-sm deleteButton px-2"
                        style="background-color: #A10101 !important"
                        data-quarry_id="${row.quarry_id}">

                        <i style="font-size: 15px"
                            class="bi bi-trash3-fill"></i>

                    </button>

                </div>
            `;
                }
            },
        ],

        initComplete: function(settings, json) {

            let filterHtml = `
        <div class="d-flex align-items-center gap-2 flex-wrap">

            <div class="input-group date-filter-box" style="width:auto;">

                <span class="input-group-text">From</span>

                <input type="date"
                    class="form-control"
                    id="certDateFromQuarryOtp">

                <span class="input-group-text">To</span>

                <input type="date"
                    class="form-control"
                    id="certDateToQuarryOtp">

                <button id="btnCertFilter"
                    class="btn btn-filter">

                    Filter

                </button>

            </div>

            <div class="alphabet-filter d-flex gap-1 flex-wrap">

                ${'ABCDEFGHIJKL'.split('').map(char =>
                    `<button class="alpha-btn ${char === 'B' ? 'active' : ''}"
                        data-letter="${char}">

                        ${char}

                    </button>`
                ).join('')}

            </div>

        </div>
    `;

            $("#certificationTableQuarryOtp_wrapper .dt-length")
                .addClass('d-flex align-items-center gap-2')
                .first()
                .append(filterHtml);
        }
    };

    function renderCertificationTableQuarryOtp() {
        if (certificationTableQuarryOtp) {
            certificationTableQuarryOtp.destroy();
        }

        certificationTableQuarryOtp = new DataTable('#certificationTableQuarryOtp', quarryOTPOptions)
    }

    $(document).ready(function() {
        renderCertificationTableQuarryOtp();
    })

    $(document).on("click", "#addQuarryOtp", function() {
        $("#quarryForm")[0].reset();

        $("#quarryForm")
            .find('input[type="hidden"]')
            .not('[name="_token"]')
            .not('[name="certification_type"]')
            .val('');

        $("#quarryModal").modal("show");
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

        const rowData = certificationTableQuarryOtp.row(this).data();

        // unselect
        if ($(this).hasClass('selected-row')) {

            $(this).removeClass('selected-row');

            selectedCertificationRow = null;
            selectedQuarryId = null;

            return;
        }

        $('table.dataTable tbody tr').removeClass('selected-row');

        $(this).addClass('selected-row');

        selectedCertificationRow = rowData;
        selectedQuarryId = rowData.brgy_id;
    });


    $(document).on('submit', '#quarryForm', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('storeQuarry') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: "Success",
                    text: "Barangay OTP Quarry Saved Successfully!",
                    icon: "success",
                    showCancelButton: false,
                })

                $('#quarryModal').modal('hide');
                $('#quarryForm')[0].reset();
                reloadOTPQuary();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                console.log(errors);
                alert("Something went wrong. Please check the console.");
            }
        });
    });

    function reloadOTPQuary() {
        if (certificationTableQuarryOtp) {
            certificationTableQuarryOtp.ajax.reload(null, false);
        } else {
            renderCertificationTableQuarryOtp();
        }
    }

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();
        let brgy_id = $(this).attr("data-brgy_id");
        let find_data = certificationQuarryOtpData.find(x => x.brgy_id == brgy_id);
        if (find_data) {
            $("#quarryForm")[0].reset();

            $("#quarryForm")
                .find('input[type="hidden"]')
                .not('[name="_token"]')
                .not('[name="certification_type"]')
                .val('');

            populateCertificationForm('quarryForm', find_data);

            $("#quarryModal").modal("show");
        }
    })

    quarryOTPOptions.drawCallback = function() {

        if (!selectedQuarryId) return;

        const api = this.api();

        api.rows().every(function() {

            let data = this.data();

            if (data.brgy_id == selectedQuarryId) {

                $(this.node()).addClass('selected-row');

                selectedCertificationRow = data;

            } else {

                $(this.node()).removeClass('selected-row');

            }

        });

    };

    $(document).on("click", ".deleteButton", function(e) {
        e.stopPropagation();

        let quarry_id = $(this).attr("data-quarry_id");

        Swal.fire({
            icon: "warning",
            title: "Delete Barangay OTP Quarry?",
            text: "This action cannot be undone.",
            showCancelButton: true,
            confirmButtonColor: "#A10101",
            cancelButtonColor: "#1A212B",
            confirmButtonText: "Yes, delete it"
        }).then((result) => {

            if (!result.isConfirmed) return;

            $.ajax({
                url: "{{ route('deleteQuarry') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    quarry_id: quarry_id
                },
                success: function(response) {

                    Swal.fire({
                        icon: "success",
                        title: "Deleted",
                        text: response.message
                    });

                    // clear selection if deleted row is selected
                    if (selectedQuarryId == quarry_id) {
                        selectedQuarryId = null;
                        selectedCertificationRow = null;
                    }

                    reloadOTPQuary();
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

    function printQuaryForm() {

        let printContent = $("#quarryModal .modal-body").clone();

        let printWindow = window.open('', '', 'width=1000,height=900');

        printWindow.document.write(`
        <html>
            <head>
                <title>RBI FORM A</title>

                <link rel="stylesheet"
                    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

                <style>
                    /* FORCE LANDSCAPE ORIENTATION ON PRINT */
                    @page {
                        size: 13in 11in; /* Standard Long/F4 Legal size in landscape */
                        margin: 0 0.4in;    /* Safe print margins */
                    }
                    body{
                        font-family: Arial, sans-serif;
                        padding: 20px;
                    }

                    button,
                    .btn-close{
                        display:none !important;
                    }
                        
                   .form-check-input{
                        accent-color: #000 !important;
                    }
                    .form-check-input{
                        pointer-events: none !important;
                    }
                    .form-check-input{
                        appearance: none;
                        -webkit-appearance: none;
                    }
                    /* FIX FLEX / BOOTSTRAP GRID */
                    .row{
                        display:flex !important;
                        flex-wrap:wrap !important;
                    }

                    .col-md-1{ width:8.333333% !important; }
                    .col-md-2{ width:16.666667% !important; }
                    .col-md-3{ width:25% !important; }
                    .col-md-4{ width:33.333333% !important; }
                    .col-md-6{ width:50% !important; }
                    .col-md-9{ width:75% !important; }

                    .d-flex{ display:flex !important; }
                    .justify-content-center{ justify-content:center !important; }
                    .align-items-center{ align-items:center !important; }

                </style>
            </head>

            <body></body>
        </html>
    `);

        printWindow.document.body.appendChild(printContent[0]);

        printWindow.document.close();

        setTimeout(() => {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        }, 500);
    }
</script>
