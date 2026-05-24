<script>
    let dateFromDashboard = '';
    let dateToDashboard = '';
    let selectedLetterNrgy = '';
    let certificationTableDashboard = null;
    let selectedCertificationRow = null;
    let selectedCertificationId = null;
    let certificationDashboarddData = [];
    let statsChart;

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
                d.letter = selectedLetterNrgy;
            },
            dataSrc: function(json) {
                certificationDashboarddData = json.data;
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
                data: 'date_issued'
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
                        id="certDateFromDashboard">

                    <span class="input-group-text">To</span>

                    <input type="date"
                        class="form-control"
                        id="certDateToDashboard">

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

        $.ajax({
            url: "{{ route('getChartStatistics') }}",
            method: "GET",
            data: {
                month: month,
                year: year
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

    $('#filterMonth, #filterYear').on('change', function() {
        updateChartData();
    });

    updateChartData();
</script>
