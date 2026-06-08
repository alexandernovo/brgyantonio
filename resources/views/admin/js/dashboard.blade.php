<script>
    let statisticsChart;

    function loadStatisticsChart() {
        $.ajax({
            url: "{{ route('statistics.chart') }}",
            type: "GET",
            data: {
                category: $('#category').val(),
                year: $('#year').val(),
                month: $('#month').val(),
            },
            success: function(response) {
                statisticsChart.updateSeries([{
                    name: 'Records',
                    data: response
                }]);
            }
        });
    }

    $(function() {
        statisticsChart = new ApexCharts(
            document.querySelector("#statisticsChart"), {
                chart: {
                    type: 'bar',
                    height: 450,
                    toolbar: {
                        show: false
                    }
                },

                series: [{
                    name: 'Records',
                    data: []
                }],

                colors: ['#2A3646'],

                plotOptions: {
                    bar: {
                        columnWidth: '65%',
                        borderRadius: 0
                    }
                },

                dataLabels: {
                    enabled: false
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

                grid: {
                    borderColor: '#777'
                },

                yaxis: {
                    min: 0
                }
            }
        );

        statisticsChart.render();

        loadStatisticsChart();

        $('#category, #month, #year').on('change', function() {
            loadStatisticsChart();
        });

    });
</script>
