<script>
    let dateFromDashboard = '';
    let dateToDashboard = '';
    let selectedLetterDashboard = '';
    let certificationTableDashboard = null;
    let selectedCertificationRow = null;
    let selectedCertificationId = null;
    let certificationDashboardData = [];
    let statsChart;

    const modalIds = {
        brgy: "brgyModal",
        brgyId: "brgyIdModal",
        clearance: "clearanceModal",
        goodmoral: "goodmoralModal",
        indigency: "indigencyModal",
        jobseeker: "jobseekerModal",
        livestock: "livestockModal",
        lot: "lotModal",
        motorcycle: "motorcycleModal",
        piggery: "piggeryModal",
        quarry: "quarryModal",
        trees: "treesModal"
    };


    function getCertificateName(key) {
        const certificateTypes = {
            'brgy': 'Certificate of Barangay',
            'clearance': 'Certificate of Barangay Clearance',
            'trees': 'Certificate of Trees',
            'jobseeker': 'Certificate of First Time Job Seeker',
            'goodmoral': 'Certificate of Good Moral Character',
            'indigency': 'Certificate of Indigency',
            'livestock': 'Certificate of Livestock',
            'motorcycle': 'Certificate of Motorcycle',
            'piggery': 'Certificate of Piggery',
            'quarry': 'Certificate of Quarry',
            'lot': 'Certificate of Lot'
        };

        return certificateTypes[key] || '';
    }

    certificationDashboardOptions = {
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('get_dashboard_table') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFromDashboard;
                d.dateTo = dateToDashboard;
                d.letter = selectedLetterDashboard;
            },
            dataSrc: function(json) {
                certificationDashboardData = json.data;
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
                title: 'REQUESTER',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => {
                    let middle = row.middle_name ? ` ${row.middle_name} ` : ' ';
                    return `${row.first_name}${middle}${row.last_name}`;
                }
            },

            {
                title: 'OR NUMBER',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'or_number'
            },

            {
                title: 'TYPE CERTIFICATION',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'certification_type',
                render: function(data, type, row) {
                    return getCertificateName(data);
                }
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

                        <button class="btn btn-warning btn-sm editButton px-2"
                            style="background-color: #B35100 !important"
                            data-certification_id="${row.certification_id}">

                            <i style="font-size: 15px"
                                class="bi bi-pencil-fill"></i>

                        </button>

                        <button class="btn btn-danger btn-sm deleteButton px-2" data-certification_id="${row.certification_id}"
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

            $("#certificationTableDashboard_wrapper .dt-length")
                .addClass('d-flex align-items-center gap-2')
                .first()
                .append(filterHtml);
        }
    };

    function renderCertificationTableDashboard() {
        if (certificationTableDashboard) {
            certificationTableDashboard.destroy();
        }

        certificationTableDashboard = new DataTable('#certificationTableDashboard', certificationDashboardOptions)
    }

    function reloaddashboardTable() {
        if (certificationTableDashboard) {
            certificationTableDashboard.ajax.reload(null, false);
        } else {
            renderCertificationTableDashboard();
        }
    }

    $(document).ready(function() {
        renderCertificationTableDashboard();
    })

    const options = {
        chart: {
            type: 'bar',
            height: 380,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                columnWidth: '55%',
                distributed: true,
                dataLabels: {
                    position: 'top'
                }
            }
        },
        colors: ['#184d35'],
        dataLabels: {
            enabled: true,
            formatter: function(val) {
                return val > 0 ? val : '';
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
        },
        legend: {
            show: false
        },
        series: [{
            name: 'Total Requests',
            data: []
        }],
        xaxis: {
            categories: [], // Receives the full names directly from the API response
            labels: {
                rotate: -45,
                rotateAlways: true,
                style: {
                    fontSize: '11px',
                    colors: '#6c757d'
                }
            }
        },
        yaxis: {
            title: {
                text: 'Count Metrics Generated',
                style: {
                    color: '#6c757d'
                }
            },
            labels: {
                style: {
                    colors: '#6c757d'
                }
            }
        },
        tooltip: {
            theme: 'light'
        }
    };

    statsChart = new ApexCharts(document.querySelector("#statisticsApexChart"), options);
    statsChart.render();

    function updateChartData() {
        const month = $('#filterMonth').val();
        const year = $('#filterYear').val();
        const type = $('#certification_type_dashboard').val();

        $.ajax({
            url: "{{ route('getChartStatistics') }}",
            method: "GET",
            data: {
                month: month,
                year: year,
                type: type,
            },
            success: function(response) {
                statsChart.updateOptions({
                    xaxis: {
                        categories: response.labels
                    }
                });

                statsChart.updateSeries([{
                    name: 'Total Requests',
                    data: response.series
                }]);
            },
            error: function(xhr) {
                console.error("Dashboard engine error:", xhr.responseText);
            }
        });
    }

    $('#filterMonth, #filterYear, #certification_type_dashboard').on('change', function() {
        updateChartData();
    });

    updateChartData();

    $(document).on("click", ".btn-reload-table", function() {
        dateFrom = '';
        dateTo = '';
        selectedLetterDashboard = '';

        certificationDashboardOptions.ajax.data.dateFrom = dateFrom;
        certificationDashboardOptions.ajax.data.dateTo = dateTo;
        certificationDashboardOptions.ajax.data.selectedLetterDashboard = selectedLetterDashboard;
        $(".alpha-btn").removeClass("active");
        certificationTableDashboard.column(1).search('').draw();
        reloaddashboardTable();
    })

    $(document).on("click", "#btnCertFilter", function() {
        dateFromDashboard = $("#certDateFromDashboard").val();
        dateToDashboard = $("#certDateToDashboard").val();

        certificationDashboardOptions.ajax.data.dateFrom = dateFromDashboard;
        certificationDashboardOptions.ajax.data.dateTo = dateToDashboard;
        reloaddashboardTable();
    })

    $(document).on("click", ".alpha-btn", function() {

        let letter = $(this).data("letter");

        // if already active → unselect (reset)
        if ($(this).hasClass("active")) {
            $(".alpha-btn").removeClass("active");

            certificationTableDashboard
                .search('')
                .columns().search('')
                .draw();

            return;
        }

        // normal select
        $(".alpha-btn").removeClass("active");
        $(this).addClass("active");

        certificationTableDashboard
            .column(1)
            .search('^' + letter, true, false)
            .draw();
    });

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
                        title: "Deleted Successfully",
                        text: response.message
                    });

                    // clear selection if deleted row is selected
                    if (selectedCertificationId == certification_id) {
                        selectedCertificationId = null;
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
        let certification_id = $(this).attr("data-certification_id");
        let find_data = certificationDashboardData.find(x => x.certification_id == certification_id);
        if (find_data) {
            $("#certificationForm")[0].reset();

            $("#certificationForm")
                .find('input[type="hidden"]')
                .not('[name="_token"]')
                .not('[name="certification_type"]')
                .val('');

            if (modalIds[find_data.certification_type]) {
                populateCertificationForm(`${modalIds[find_data.certification_type]} #certificationForm`,
                    find_data);
                $(`#${modalIds[find_data.certification_type]}`).modal("show");

                $(document).on('submit', `#${modalIds[find_data.certification_type]} #certificationForm`,
                    function(e) {
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

                                $(`#${modalIds[find_data.certification_type]}`).modal("hide");
                                $(`#${modalIds[find_data.certification_type]} #certificationForm`)[
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
