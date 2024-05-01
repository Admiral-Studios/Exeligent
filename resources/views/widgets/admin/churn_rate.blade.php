    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Churn Rate</h4>
            <div class="dropdown chart-dropdown">
                <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
                <div class="dropdown-menu dropdown-menu-end">
                    @foreach($periods as $period)
                        <a class="dropdown-item change-widget-period" data-period="{{ $period }}" href="javascript:;">Last {{ ucfirst($period) }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div id="goal-overview-radial-bar-chart" class="my-2"></div>
            <div class="row border-top text-center mx-0">
                <div class="col-6 border-end py-1">
                    <p class="card-text text-muted mb-0">Previous {{ ucfirst($config['period']) }}</p>
                    <h3 class="fw-bolder mb-0">{{ $previous_count }}</h3>
                </div>
                <div class="col-6 py-1">
                    <p class="card-text text-muted mb-0">Last {{ ucfirst($config['period']) }}</p>
                    <h3 class="fw-bolder mb-0">{{ $last_count }}</h3>
                </div>
            </div>
        </div>
    </div>

<script>
    setTimeout(function () {
        goalOverviewChart = new ApexCharts(document.getElementById('goal-overview-radial-bar-chart'), {
            chart: {
                height: 245,
                type: 'radialBar',
                sparkline: {
                    enabled: true
                },
                dropShadow: {
                    enabled: true,
                    blur: 3,
                    left: 1,
                    top: 1,
                    opacity: 0.1
                }
            },
            colors: ['#e55151'],
            plotOptions: {
                radialBar: {
                    offsetY: -10,
                    startAngle: -150,
                    endAngle: 150,
                    hollow: {
                        size: '77%'
                    },
                    track: {
                        background: '#ebe9f1',
                        strokeWidth: '50%'
                    },
                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            color: '#5e5873',
                            fontSize: '2.86rem',
                            fontWeight: '600'
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'horizontal',
                    shadeIntensity: 0.5,
                    gradientToColors: [window.colors.solid.warning],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100]
                }
            },
            series: [{{ $chart_data }}],
            stroke: {
                lineCap: 'round'
            },
            grid: {
                padding: {
                    bottom: 30
                }
            }
        });
        goalOverviewChart.render();

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
