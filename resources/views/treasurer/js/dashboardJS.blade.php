<script>
    let dateFromDashboard = '';
    let dateToDashboard = '';
    let selectedLetter = '';
    let tableDashboard = null;
    let selectedCertificationRow = null;
    let selectedCertificationId = null;
    let collectionDashboarddData = [];
    let statsChart;
    let collectionChart;


    const collectionModalIds = {
        certification: "collectionCertificationModal",
        clearance: "clearanceCollectionModal",
        barangay_id: "collectionBarangayIDModal",
        businessclearance: "collectionBusinessClearanceModal",
        summon: "collectionSummonModal"
    };

    function getCollectionName(key) {
        const certificateTypes = {
            'clearance': 'Barangay Clearance',
            'certification': 'Barangay Certification',
            'summon': 'Summon',
            'barangay_id': 'Barangay ID',
            'businessclearance': 'Barangay Business Clearance',
        };

        return certificateTypes[key] || '';
    }

    dashboardOptions = {
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('get_dashboard_treasurer_table') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFromDashboard;
                d.dateTo = dateToDashboard;
                d.letter = selectedLetter;
            },
            dataSrc: function(json) {
                collectionDashboarddData = json.data;
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
                title: 'DATE',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => row.payment_date ? formatDateTime(row.payment_date) : ''
            },
            {
                title: 'OR NUMBER',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => row.or_number
            },
            {
                title: 'NATURE OF COLLECTION',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'collection_type',
                render: function(data, type, row) {
                    return getCollectionName(data);
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
                                width: 70px
                            ">
                            ${row.payment_status}
                        </span>
                    `;
                }
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
                title: 'AMOUNT',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'payment_amount'
            },
            {
                title: 'ACTION',
                className: 'text-nowrap p-2 text-center align-middle sticky-action',
                render: function(data, type, row) {
                    return `
                    <div class="d-flex gap-1 justify-content-center">

                        <button class="btn btn-warning btn-sm editButton px-2"
                            style="background-color: #B35100 !important"
                            data-collection_id="${row.collection_id}">

                            <i style="font-size: 15px"
                                class="bi bi-pencil-fill"></i>

                        </button>

                        <button class="btn btn-danger btn-sm deleteButton px-2"
                            style="background-color: #A10101 !important"
                            data-collection_id="${row.collection_id}">

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
                        value="{{ date('Y-m-d') }}"
                        id="certDateFromDashboard">

                    <span class="input-group-text">To</span>

                    <input type="date"
                        value="{{ date('Y-m-d') }}"
                        class="form-control"
                        id="certDateToDashboard">

                    <button id="btnCertFilter"
                        class="btn btn-filter">

                        Filter

                    </button>

                </div>

                <div class="alphabet-filter d-flex gap-1 flex-wrap">

                    ${'ABCDEFGHIJKL'.split('').map(char =>
                        `<button class="alpha-btn"
                            data-letter="${char}">

                            ${char}

                        </button>`
                    ).join('')}

                </div>

            </div>
        `;

            $("#tableDashboard_wrapper .dt-length")
                .addClass('d-flex align-items-center gap-2')
                .first()
                .append(filterHtml);
        }
    };

    function rendertableDashboard() {
        if (tableDashboard) {
            tableDashboard.destroy();
        }

        tableDashboard = new DataTable('#tableDashboard', dashboardOptions)
    }

    $(document).ready(function() {
        rendertableDashboard();
    })


    function loadCollectionChart() {
        $.ajax({
            url: "{{ route('getChartStatisticsCollection') }}",
            type: "GET",
            data: {
                type: $('#certification_type_dashboard').val(),
                year: $('#filterYear').val()
            },
            success: function(response) {
                collectionChart.updateSeries([{
                    name: 'Collections',
                    data: response
                }]);
            }
        });
    }

    $(function() {

        collectionChart = new ApexCharts(
            document.querySelector("#statisticsApexChart"), {
                chart: {
                    type: 'bar',
                    height: 450,
                    toolbar: {
                        show: false
                    }
                },

                series: [{
                    name: 'Collections',
                    data: []
                }],

                colors: ['#184d35'],

                plotOptions: {
                    bar: {
                        columnWidth: '65%',
                        borderRadius: 4
                    }
                },

                dataLabels: {
                    enabled: true
                },

                xaxis: {
                    categories: [
                        'January',
                        'February',
                        'March',
                        'April',
                        'May',
                        'June',
                        'July',
                        'August',
                        'September',
                        'October',
                        'November',
                        'December'
                    ]
                },

                yaxis: {
                    min: 0,
                    title: {
                        text: 'Collections'
                    }
                },

                legend: {
                    show: false
                }
            }
        );

        collectionChart.render();

        loadCollectionChart();

        $('#certification_type_dashboard, #filterYear').on('change', function() {
            loadCollectionChart();
        });

    });


    $(document).on("click", ".btn-reload-table", function() {
        dateFrom = '';
        dateTo = '';
        selectedLetterDashboard = '';

        dashboardOptions.ajax.data.dateFrom = dateFrom;
        dashboardOptions.ajax.data.dateTo = dateTo;
        dashboardOptions.ajax.data.selectedLetterDashboard = selectedLetterDashboard;
        $(".alpha-btn").removeClass("active");
        tableDashboard.column(3).search('').draw();
        reloaddashboardTable();
    })

    function reloaddashboardTable() {
        if (tableDashboard) {
            tableDashboard.ajax.reload(null, false);
        } else {
            rendertableDashboard();
        }
    }

    $(document).on("click", "#btnCertFilter", function() {
        dateFromDashboard = $("#certDateFromDashboard").val();
        dateToDashboard = $("#certDateToDashboard").val();
        dashboardOptions.ajax.data.dateFrom = dateFromDashboard;
        dashboardOptions.ajax.data.dateTo = dateToDashboard;
        reloaddashboardTable();
    })

    $(document).on("click", ".alpha-btn", function() {

        let letter = $(this).data("letter");

        // if already active → unselect (reset)
        if ($(this).hasClass("active")) {
            $(".alpha-btn").removeClass("active");

            tableDashboard
                .search('')
                .columns().search('')
                .draw();

            return;
        }

        // normal select
        $(".alpha-btn").removeClass("active");
        $(this).addClass("active");

        tableDashboard
            .column(5)
            .search('^' + letter, true, false)
            .draw();
    });

    $(document).on("click", ".deleteButton", function(e) {
        e.stopPropagation();

        let collection_id = $(this).attr("data-collection_id");

        Swal.fire({
            icon: "warning",
            title: "Delete This Record?",
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
                        text: "Barangay ID Deleted Successfully!"
                    });

                    // clear selection if deleted row is selected
                    if (selectedLetter == collection_id) {
                        selectedLetter = null;
                        selectedCertificationRow = null;
                    }

                    reloaddashboardTable();
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

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();
        let collection_id = $(this).attr("data-collection_id");
        let find_data = collectionDashboarddData.find(x => x.collection_id == collection_id);
        if (find_data) {
            $("#collectionForm")[0].reset();

            $("#collectionForm")
                .find('input[type="hidden"]')
                .not('[name="_token"]')
                .not('[name="collection_type"]')
                .val('');
            console.log(find_data.collection_type);
            if (collectionModalIds[find_data.collection_type]) {
                populateCollectionForm(`${collectionModalIds[find_data.collection_type]} #collectionForm`,
                    find_data);
                $(`#${collectionModalIds[find_data.collection_type]}`).modal("show");

                $(document).on('submit', `#${collectionModalIds[find_data.collection_type]} #collectionForm`,
                    function(e) {
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
                                    text: "Collection Saved Successfully!",
                                    icon: "success",
                                    showCancelButton: false,
                                })

                                $(`#${collectionModalIds[find_data.collection_type]}`).modal(
                                    "hide");
                                $(`#${collectionModalIds[find_data.collection_type]} #collectionForm`)[
                                    0].reset();
                                $('#image_filename_display').val('No file chosen');
                                reloaddashboardTable();
                            },
                            error: function(xhr) {
                                let errors = xhr.responseJSON.errors;
                                console.log(errors);
                                alert("Something went wrong. Please check the console.");
                            }
                        });
                    });
            }

        }
    })
</script>
