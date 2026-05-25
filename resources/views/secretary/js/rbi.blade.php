<script>
    // Global variables for certification filtering
    let dateFromRbi = '';
    let dateToRbi = '';
    let selectedLetterRbi = '';
    let certificationTableRbi = null;
    let selectedCertificationRow = null;
    let selectedCertificationId = null;
    let certificationRbiData = [];
    let isAllInhabitantsActive = false;
    let typeInhabitant = "single";
    let houseHoldMember = [];

    certificationRBIOptions = {
        processing: true,
        serverSide: false,

        ajax: {
            url: "{{ route('getRBI1') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFromRbi;
                d.dateTo = dateToRbi;
                d.type = typeInhabitant;
                d.letter = selectedLetterRbi;
                // Pass the state to back-end query filters if required
                d.view_mode = isAllInhabitantsActive ? "all_inhabitants" : "default";
            },
            dataSrc: function(json) {
                certificationRbiData = json.data;
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
                // Title switches dynamically on init depending on context
                title: isAllInhabitantsActive ? 'MAIN INHABITANT' : 'NAME',
                className: 'text-nowrap p-2 align-middle',
                render: (data, type, row) => {
                    let middle = row.middle_name ? ` ${row.middle_name}` : '';
                    let suffix = row.suffix ? ` ${row.suffix}` : '';
                    return `${row.last_name}, ${row.first_name}${middle}${suffix}`;
                }
            },
            {
                title: 'BIRTHDATE',
                className: 'text-nowrap p-2 text-center align-middle',
                visible: !isAllInhabitantsActive, // Hidden when All Inhabitants is Active
                render: (data, type, row) =>
                    row.birth_date ? formatDateTime(row.birth_date) : ''
            },
            {
                title: 'BIRTHPLACE',
                className: 'text-nowrap p-2 align-middle',
                visible: !isAllInhabitantsActive, // Hidden when All Inhabitants is Active
                data: 'birth_place',
                defaultContent: '-'
            },
            {
                title: 'SEX',
                className: 'text-nowrap p-2 text-center align-middle',
                visible: !isAllInhabitantsActive, // Hidden when All Inhabitants is Active
                data: 'sex',
                defaultContent: '-'
            },
            {
                title: 'CIVIL STATUS',
                className: 'text-nowrap p-2 text-center align-middle',
                visible: !isAllInhabitantsActive, // Hidden when All Inhabitants is Active
                data: 'civil_status',
                defaultContent: '-'
            },
            {
                title: 'RELIGION',
                className: 'text-nowrap p-2 text-center align-middle',
                visible: !isAllInhabitantsActive, // Hidden when All Inhabitants is Active
                data: 'religion',
                defaultContent: '-'
            },
            {
                title: 'BARANGAY',
                className: 'text-nowrap p-2 align-middle',
                visible: isAllInhabitantsActive, // ONLY Visible when All Inhabitants is Active
                data: 'barangay',
                defaultContent: '-'
            },
            {
                title: 'MUNCIPALITY',
                className: 'text-nowrap p-2 align-middle',
                visible: isAllInhabitantsActive, // ONLY Visible when All Inhabitants is Active
                data: 'city_municipality',
                defaultContent: '-'
            },
            {
                title: 'PROVINCE',
                className: 'text-nowrap p-2 align-middle',
                visible: isAllInhabitantsActive, // ONLY Visible when All Inhabitants is Active
                data: 'province',
                defaultContent: '-'
            },
            {
                title: 'REGION',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'region',
                defaultContent: '-'
            },
            {
                title: 'RESIDENCE ADDRESS',
                className: 'p-2 align-middle',
                visible: !isAllInhabitantsActive, // Hidden when All Inhabitants is Active
                data: 'residence_address',
                defaultContent: '-'
            },
            {
                title: 'HOUSEHOLD ADDRESS',
                className: 'p-2 align-middle',
                visible: isAllInhabitantsActive, // ONLY Visible when All Inhabitants is Active
                data: 'household_address',
                defaultContent: '-'
            },
            {
                title: 'NO. OF HOUSEHOLD MEMBERS',
                className: 'text-nowrap p-2 text-center align-middle',
                visible: isAllInhabitantsActive, // ONLY Visible when All Inhabitants is Active
                data: 'no_household_members',
                defaultContent: '-'
            },
            {
                title: 'PROFESSION/OCCUPATION',
                className: 'text-nowrap p-2 align-middle',
                visible: !isAllInhabitantsActive, // Hidden when All Inhabitants is Active
                data: 'profession_occupation',
                defaultContent: '-'
            },
            {
                title: 'CONTACT NUMBER',
                className: 'text-nowrap p-2 text-center align-middle',
                visible: !isAllInhabitantsActive, // Hidden when All Inhabitants is Active
                data: 'contact_number',
                defaultContent: '-'
            },
            {
                title: 'ACTION',
                className: 'text-nowrap p-2 text-center align-middle sticky-action',
                render: function(data, type, row) {
                    return `
                <div class="d-flex gap-1 justify-content-center">
                    <button class="btn btn-warning btn-sm editButton px-2"
                        style="background-color: #B35100 !important"
                        data-resident_id="${row.resident_id}">
                        <i style="font-size: 15px" class="bi bi-pencil-fill"></i>
                    </button>
                    <button class="btn btn-danger btn-sm deleteButton px-2"
                        style="background-color: #A10101 !important"
                        data-resident_id="${row.resident_id}">
                        <i style="font-size: 15px" class="bi bi-trash3-fill"></i>
                    </button>
                </div>`;
                }
            },
        ],

        initComplete: function(settings, json) {
            let filterHtml = `
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <div class="input-group date-filter-box" style="width:auto;">
                <span class="input-group-text">From</span>
                <input type="date" class="form-control" id="certDateFromRbi">
                <span class="input-group-text">To</span>
                <input type="date" class="form-control" id="certDateToRbi">
                <button id="btnCertFilter" class="btn btn-filter">Filter</button>
            </div>
            <div class="alphabet-filter d-flex gap-1 flex-wrap">
                ${'ABCDEFGHIJKL'.split('').map(char =>
                    `<button class="alpha-btn ${char === 'A' ? 'active' : ''}" data-letter="${char}">
                        ${char}
                    </button>`
                ).join('')}
            </div>
        </div>`;

            $("#certificationTableRbi_wrapper .dt-length")
                .addClass('d-flex align-items-center gap-2')
                .first()
                .append(filterHtml);
        }
    };

    function renderCertificationTableRbi() {
        if (certificationTableRbi) {
            certificationTableRbi.destroy();
        }

        certificationTableRbi = new DataTable('#certificationTableRbi', certificationRBIOptions)
    }

    $(document).ready(function() {
        renderCertificationTableRbi();
    })

    $(document).on("click", "#addRbi", function() {
        $("#residentForm")[0].reset();

        $("#residentForm")
            .find('input[type="hidden"]')
            .not('[name="_token"]')
            .not('[name="resident_type"]')
            .val('');
        console.log("typeInhabitant: ", typeInhabitant)
        if (typeInhabitant == "single") {
            $("#rbi1Modal").modal("show");
        } else {
            $("#rbi2Modal").modal("show");
        }
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

        const rowData = certificationTableRbi.row(this).data();

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
        selectedCertificationId = rowData.resident_id;
    });

    $(document).on('click', '#editRbi', function() {

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


    $(document).on('submit', '#residentForm', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('storeRBI') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: "Success",
                    text: "Inhabitant Saved Successfully!",
                    icon: "success",
                    showCancelButton: false,
                })

                $('#rbi1Modal').modal('hide');
                $('#residentForm')[0].reset();
                reloadRBI();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                console.log(errors);
                alert("Something went wrong. Please check the console.");
            }
        });
    });

    $(document).on('submit', '#rbi2Form', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('houseHoldMember', JSON.stringify(houseHoldMember ?? []));

        $.ajax({
            url: "{{ route('storeRBI') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    title: "Success",
                    text: "Inhabitant Saved Successfully!",
                    icon: "success",
                    showCancelButton: false,
                })

                $('#rbi2Modal').modal('hide');
                $('#rbi2Form')[0].reset();
                reloadRBI();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                console.log(errors);
                alert("Something went wrong. Please check the console.");
            }
        });
    });

    function reloadRBI() {
        if (certificationTableRbi) {
            certificationTableRbi.ajax.reload(null, false);
        } else {
            renderCertificationTableRbi();
        }
    }

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();
        let resident_id = $(this).attr("data-resident_id");
        let find_data = certificationRbiData.find(x => x.resident_id == resident_id);
        if (find_data) {
            $("#residentForm")[0].reset();

            $("#residentForm")
                .find('input[type="hidden"]')
                .not('[name="_token"]')
                .not('[name="resident_type"]')
                .val('');
            if (typeInhabitant == "single") {
                populateCertificationForm('residentForm', find_data);

                $("#rbi1Modal").modal("show");
            } else {
                populateCertificationForm('rbi2Form', find_data);
                let tbody = "";
                houseHoldMember = find_data.household_member;
                houseHoldMember.forEach((item, index) => {
                    tbody += buildHouseholdRow(item, index + 1);
                });

                $("#rbi2Modal").modal("show");
                $("#householdTable tbody").html(tbody);
            }

        }
    })

    certificationRBIOptions.drawCallback = function() {

        if (!selectedCertificationId) return;

        const api = this.api();

        api.rows().every(function() {

            let data = this.data();

            if (data.resident_id == selectedCertificationId) {

                $(this.node()).addClass('selected-row');

                selectedCertificationRow = data;

            } else {

                $(this.node()).removeClass('selected-row');

            }

        });

    };

    $(document).on("click", ".deleteButton", function(e) {
        e.stopPropagation();

        let resident_id = $(this).attr("data-resident_id");

        Swal.fire({
            icon: "warning",
            title: "Delete Barangay RBI?",
            text: "This action cannot be undone.",
            showCancelButton: true,
            confirmButtonColor: "#A10101",
            cancelButtonColor: "#1A212B",
            confirmButtonText: "Yes, delete it"
        }).then((result) => {

            if (!result.isConfirmed) return;

            $.ajax({
                url: "{{ route('deleteRBI') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    resident_id: resident_id
                },
                success: function(response) {

                    Swal.fire({
                        icon: "success",
                        title: "Deleted Successfully",
                        text: response.message
                    });

                    // clear selection if deleted row is selected
                    if (selectedCertificationId == resident_id) {
                        selectedCertificationId = null;
                        selectedCertificationRow = null;
                    }

                    reloadRBI();
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

    function printRBIForm() {

        let printContent = $("#rbi1Modal .modal-body").clone();
        let printWindow = window.open('', '', 'width=1000,height=900');

        printWindow.document.write(`
        <html>
            <head>
                <title>RBI FORM A</title>

                <link rel="stylesheet"
                    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

                <style>
                    input, select
                    {
                    color: black !important;
                        text-align:center !important; 
                        border: 0 !important;
                    }
                        select
                        {
                        width: 80px !important
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
            // printWindow.close();
        }, 500);
    }


    function printRBI2Form() {

        let printContent = $("#rbi2Modal .modal-body").clone();

        let printWindow = window.open('', '', 'width=1000,height=900');

        printWindow.document.write(`
        <html>
            <head>
                <title>RBI FORM A</title>

                <link rel="stylesheet"
                    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

                <style>
                    @page {
                        size: 13in 11in; /* Standard Long/F4 Legal size in landscape */
                        margin: 0 0.4in;    /* Safe print margins */
                    }
                    input
                    {
                        border: 0 !important;
                    }
                    body{
                        font-family: Arial, sans-serif;
                        padding: 20px;
                    }
                    #addRowBtn
                    {
                      display: none !important;
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
    $(document).on('click', "#allIndiInhabitants", function() {
        if ($(this).hasClass("btn-add-table")) {
            $(this).removeClass('btn-add-table').addClass("btn-edit-table");
            isAllInhabitantsActive = false;
            typeInhabitant = "single";
            $(certificationTableRbi.column(1).header()).text('NAME');
            certificationTableRbi.columns([2, 3, 4, 5, 6, 11, 14, 15]).visible(true);
            certificationTableRbi.columns([7, 8, 9, 12, 13]).visible(false);
        } else {
            $(this).addClass('btn-add-table').removeClass("btn-edit-table");
            isAllInhabitantsActive = true;
            typeInhabitant = "all";
            $(certificationTableRbi.column(1).header()).text('MAIN INHABITANT');
            certificationTableRbi.columns([2, 3, 4, 5, 6, 11, 14, 15]).visible(false);
            certificationTableRbi.columns([7, 8, 9, 12, 13]).visible(true);
        }
        certificationRBIOptions.ajax.data.type = typeInhabitant;
        certificationTableRbi.ajax.reload(null, false);
    });

    function RenderHouseholdMember() {
        let tbody = "";

        houseHoldMember.forEach((item, index) => {
            tbody += buildHouseholdRow(item, index + 1);
        });

        $("#householdTable tbody").html(tbody);
    }

    function buildHouseholdRow(item = {}, number = 0) {
        return `
        <tr data-index="${number - 1}" data-id="${item.household_id ?? ''}">

            <td>${number}</td>

            <td><input type="text" class="form-control update-field"
                data-field="last_name"
                value="${item.last_name ?? ''}"></td>

            <td><input type="text" class="form-control update-field"
                data-field="first_name"
                value="${item.first_name ?? ''}"></td>

            <td><input type="text" class="form-control update-field"
                data-field="middle_name"
                value="${item.middle_name ?? ''}"></td>

            <td><input type="text" class="form-control update-field"
                data-field="extension"
                value="${item.extension ?? ''}"></td>

            <td><input type="text" class="form-control update-field"
                data-field="place_of_birth"
                value="${item.place_of_birth ?? ''}"></td>

            <td><input type="date" class="form-control update-field"
                data-field="date_of_birth"
                value="${item.date_of_birth ?? ''}"></td>

            <td><input type="number" class="form-control update-field"
                data-field="age"
                value="${item.age ?? ''}"></td>

            <td><input type="text" class="form-control update-field"
                data-field="sex"
                value="${item.sex ?? ''}"></td>

            <td><input type="text" class="form-control update-field"
                data-field="civil_status"
                value="${item.civil_status ?? ''}"></td>

            <td><input type="text" class="form-control update-field"
                data-field="citizenship"
                value="${item.citizenship ?? ''}"></td>

            <td><input type="text" class="form-control update-field"
                data-field="occupation"
                value="${item.occupation ?? ''}"></td>

            <td>
                <button type="button" class="btn btn-danger btn-sm deleteRow" style="background-color: #8b0000; border-radius: 6px;">
                    Delete
                </button>
            </td>

        </tr>
    `;
    }

    $(document).on("change keyup", ".update-field", function() {

        let row = $(this).closest("tr");
        let index = row.data("index"); // IMPORTANT
        let field = $(this).data("field");
        let value = $(this).val();

        if (houseHoldMember[index]) {
            houseHoldMember[index][field] = value;
        }

        console.log(houseHoldMember);
    });

    $(document).on("click", ".deleteRow", function() {

        let row = $(this).closest("tr");
        let index = row.data("index");

        houseHoldMember.splice(index, 1);

        RenderHouseholdMember();
    });

    $(document).on("click", "#addRowBtn", function() {

        houseHoldMember.push({
            household_id: 0,
            last_name: "",
            first_name: "",
            middle_name: "",
            extension: "",
            place_of_birth: "",
            date_of_birth: "",
            age: "",
            sex: "",
            civil_status: "",
            citizenship: "",
            occupation: ""
        });

        RenderHouseholdMember();
    });
</script>
