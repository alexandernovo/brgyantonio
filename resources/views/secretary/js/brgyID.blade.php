<script>
    // Global variables for certification filtering
    let dateFromBrgyId = '';
    let dateToBrgyId = '';
    let selectedLetterNrgy = '';
    let certificationTableBrgyId = null;
    let selectedCertificationRow = null;
    let selectedCertificationId = null;
    let certificationBrgyIdData = [];

    certificationBrgyIdOptions = {
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('get_brgy_id') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFromBrgyId;
                d.dateTo = dateToBrgyId;
                d.type = "brgyId";
                d.letter = selectedLetterNrgy;
            },
            dataSrc: function(json) {
                certificationBrgyIdData = json.data;
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
                title: 'ID NUMBER',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'idnumber'
            },

            {
                title: 'REQUESTER',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => {
                    let middle = row.middle_name ? ` ${row.middle_name} ` : ' ';
                    return `${row.first_name}${middle}${row.last_name}`;
                }
            },

            {
                title: 'CONTACT NUMBER',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'contact_number'
            },

            {
                title: 'GUIDANCE',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'guidance'
            },

            {
                title: 'CONTACT NUMBER',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'guidance_contact'
            },

            {
                title: 'DATE OF EXPIRED',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) =>
                    row.dateexpired ? formatDateTime(row.dateexpired) : ''
            },

            {
                title: 'DATE OF CLAIM',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) =>
                    row.dateclaim ? formatDateTime(row.dateclaim) : ''
            },

            {
                title: 'BIRTHDATE',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) =>
                    row.birthdate ? formatDateTime(row.birthdate) : ''
            },

            {
                title: 'ACTION',
                className: 'text-nowrap p-2 text-center align-middle sticky-action',
                render: function(data, type, row) {
                    return `
                    <div class="d-flex gap-1 justify-content-center">

                        <button class="btn btn-warning btn-sm editButton px-2"
                            style="background-color: #B35100 !important"
                            data-brgy_id="${row.brgy_id}">

                            <i style="font-size: 15px"
                                class="bi bi-pencil-fill"></i>

                        </button>

                        <button class="btn btn-danger btn-sm deleteButton px-2"
                            style="background-color: #A10101 !important"
                            data-brgy_id="${row.brgy_id}">

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
                        id="certDateFromBrgyId">

                    <span class="input-group-text">To</span>

                    <input type="date"
                        class="form-control"
                        id="certDateToBrgyId">

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

            $("#certificationTableBrgyId_wrapper .dt-length")
                .addClass('d-flex align-items-center gap-2')
                .first()
                .append(filterHtml);
        }
    };

    function renderCertificationTableBrgyId() {
        if (certificationTableBrgyId) {
            certificationTableBrgyId.destroy();
        }

        certificationTableBrgyId = new DataTable('#certificationTableBrgyId', certificationBrgyIdOptions)
    }

    $(document).ready(function() {
        renderCertificationTableBrgyId();
    })

    $(document).on("click", "#addBrgyId", function() {
        $("#brgyIdForm")[0].reset();

        $("#brgyIdForm")
            .find('input[type="hidden"]')
            .not('[name="_token"]')
            .not('[name="certification_type"]')
            .val('');

        $("#brgyIdModal").modal("show");
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

        const rowData = certificationTableBrgyId.row(this).data();

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
        selectedCertificationId = rowData.brgy_id;
    });

    $(document).on('click', '#editBrgyId', function() {

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


    $(document).on('submit', '#brgyIdForm', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('storeBrgyID') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: "Success",
                    text: "Barangay ID Saved Successfully!",
                    icon: "success",
                    showCancelButton: false,
                })

                $('#brgyIdModal').modal('hide');
                $('#brgyIdForm')[0].reset();
                reloadBrgyIdCertification();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                console.log(errors);
                alert("Something went wrong. Please check the console.");
            }
        });
    });

    function reloadBrgyIdCertification() {
        if (certificationTableBrgyId) {
            certificationTableBrgyId.ajax.reload(null, false);
        } else {
            renderCertificationTableBrgyId();
        }
    }

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();
        let brgy_id = $(this).attr("data-brgy_id");
        let find_data = certificationBrgyIdData.find(x => x.brgy_id == brgy_id);
        if (find_data) {
            $("#brgyIdForm")[0].reset();

            $("#brgyIdForm")
                .find('input[type="hidden"]')
                .not('[name="_token"]')
                .not('[name="certification_type"]')
                .val('');

            populateCertificationForm('brgyIdForm', find_data);

            $("#brgyIdModal").modal("show");
        }
    })

    certificationBrgyIdOptions.drawCallback = function() {

        if (!selectedCertificationId) return;

        const api = this.api();

        api.rows().every(function() {

            let data = this.data();

            if (data.brgy_id == selectedCertificationId) {

                $(this.node()).addClass('selected-row');

                selectedCertificationRow = data;

            } else {

                $(this.node()).removeClass('selected-row');

            }

        });

    };

    $(document).on("click", ".deleteButton", function(e) {
        e.stopPropagation();

        let brgy_id = $(this).attr("data-brgy_id");

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
                url: "{{ route('deleteBrgyId') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    brgy_id: brgy_id
                },
                success: function(response) {

                    Swal.fire({
                        icon: "success",
                        title: "Deleted",
                        text: response.message
                    });

                    // clear selection if deleted row is selected
                    if (selectedCertificationId == brgy_id) {
                        selectedCertificationId = null;
                        selectedCertificationRow = null;
                    }

                    reloadBrgyIdCertification();
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
