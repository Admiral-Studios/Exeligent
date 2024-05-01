<div class="card">
    <div class="card-header flex-column align-items-start pb-0">
        <div class="d-flex justify-content-between w-100">
            <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                    <i data-feather="users" class="font-medium-5"></i>
                </div>
            </div>
            <div class="dropdown chart-dropdown">
                <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
                <div class="dropdown-menu dropdown-menu-end">
                    @foreach($periods as $period)
                        <a class="dropdown-item change-widget-period" data-period="{{ $period }}" href="javascript:;">Last {{ ucfirst($period) }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <h2 class="fw-bolder mt-1">Total Customers - {{ $total_users }}</h2>
        <p class="card-text">{{ $new_users }} new sign-up{{ $new_users > 1 ? 's' : '' }} in the
            last {{ $config['period'] }}</p>
    </div>
    <div id="signups-chart"></div>
    <input type="hidden" id="signups-chart-data" value="@json($chart_data)">
</div>

<script>
    setTimeout(function () {
        gainedChart = new ApexCharts(document.getElementById('signups-chart'), {
            chart: {
                height: 100,
                type: 'area',
                toolbar: {
                    show: false
                },
                sparkline: {
                    enabled: true
                },
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0
                    }
                }
            },
            colors: [window.colors.solid.primary],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2.5
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 0.9,
                    opacityFrom: 0.7,
                    opacityTo: 0.5,
                    stops: [0, 80, 100]
                }
            },
            series: [
                {
                    name: 'New Sign-Ups',
                    data: JSON.parse(document.getElementById('signups-chart-data').value)
                }
            ],
            xaxis: {
                labels: {
                    show: false
                },
                axisBorder: {
                    show: false
                }
            },
            yaxis: [
                {
                    y: 0,
                    offsetX: 0,
                    offsetY: 0,
                    padding: {left: 0, right: 0},
                    labels: {
                        formatter: function (val) {
                            return val.toFixed(0);
                        }
                    }
                }
            ],
            tooltip: {
                x: {show: false}
            }
        });
        gainedChart.render();

        initFeather()

        $('#arrilot-widget-container-{{ $widget_id }}').one('click', '.change-widget-period', function (e) {
            let period = $(this).data('period')
            $('#arrilot-widget-container-{{ $widget_id }}').load('/arrilot/load-widget?' + $.param({
                id: {{ $widget_id }},
                name: "{{ $widget_name }}",
                params: JSON.stringify(
                    [
                        {
                            period: period
                        }
                    ]
                ),
                skip_encryption: 1
            }));
        })
    }, 200)
</script>
