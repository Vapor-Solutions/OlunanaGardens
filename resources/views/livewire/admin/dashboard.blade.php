<div>
    <x-slot:header>
        {{ __('Dashboard') }}
    </x-slot>

    <div class="container-fluid">
        <!-- Dashboard Metrics Row -->
        <div class="row g-4 mb-4">
            <!-- Total Earnings Card -->
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <x-back.dashboard-card
                    title="Total Earnings"
                    value="KES {{ number_format($totalEarnings) }}"
                    icon="dollar-sign"
                    color="primary"
                />
            </div>

            <!-- Available Sections Card -->
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <x-back.dashboard-card
                    title="Available Sections"
                    value="{{ number_format($availableSections) }}"
                    icon="shopping-bag"
                    color="secondary"
                />
            </div>

            <!-- Total Bookings Card -->
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <x-back.dashboard-card
                    title="Total Bookings"
                    value="{{ number_format($totalBookings) }}"
                    icon="database"
                    color="primary"
                />
            </div>

            <!-- Unpaid Invoices Card -->
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <x-back.dashboard-card
                    title="Unpaid Invoices"
                    value="KES {{ number_format($unpaidInvoices) }}"
                    icon="alert-circle"
                    color="secondary"
                />
            </div>
        </div>

        <!-- System Controls and Chart Row -->
        <div class="row g-4">
            <!-- Maintenance Mode Card -->
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-light border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">System Status</h5>
                            <span class="badge bg-{{ $maintenanceMode ? 'danger' : 'success' }}">
                                {{ $maintenanceMode ? 'Maintenance ON' : 'Maintenance OFF' }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-3">
                            <small>Toggle maintenance mode to restrict user access while performing system updates.</small>
                        </p>
                        <button
                            wire:click="toggleMaintenanceMode"
                            class="btn btn-{{ $maintenanceMode ? 'danger' : 'success' }} w-100"
                            onclick="return confirm('Are you sure you want to {{ $maintenanceMode ? 'disable' : 'enable' }} maintenance mode?')"
                        >
                            <i data-feather="power"></i>
                            {{ $maintenanceMode ? 'Disable Maintenance' : 'Enable Maintenance' }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bookings Overview Chart -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light border-bottom d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">Bookings Overview</h5>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($dateRangeStart)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($dateRangeEnd)->format('M d, Y') }}
                            </small>
                        </div>
                        <div class="btn-group btn-group-sm" role="group">
                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                wire:click="previousMonth"
                                title="View previous month"
                            >
                                <i data-feather="chevron-left" style="width: 18px; height: 18px;"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                wire:click="nextMonth"
                                title="View next month"
                            >
                                <i data-feather="chevron-right" style="width: 18px; height: 18px;"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chart-bookings-overview" wire:ignore></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Prepare chart data from Livewire component
        const bookingData = @json($bookingCounts);
        const daysArray = @json($days);

        // Transform booking counts into chart-compatible format
        const chartData = daysArray.map((dayString) => {
            const date = new Date(dayString);
            return [date.getTime(), bookingData[dayString] || 0];
        });

        const chartOptions = {
            series: [
                {
                    name: 'Active Bookings',
                    data: chartData,
                }
            ],
            chart: {
                id: 'bookings-overview',
                type: 'area',
                height: 400,
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                        selection: true,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        reset: true,
                    }
                },
                zoom: {
                    autoScaleYaxis: true,
                    enabled: true,
                },
            },
            stroke: {
                curve: 'smooth',
                width: 2,
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [20, 100, 100, 100],
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                type: 'datetime',
                labels: {
                    format: 'dd MMM',
                    datetimeUTC: false,
                }
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return Math.round(value);
                    }
                },
                min: 0,
            },
            tooltip: {
                x: {
                    format: 'dd MMMM yyyy',
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return seriesName;
                        }
                    }
                }
            },
            colors: ['#531502'],
            responsive: [
                {
                    breakpoint: 1366,
                    options: {
                        chart: {
                            height: 350
                        }
                    }
                },
                {
                    breakpoint: 768,
                    options: {
                        chart: {
                            height: 300
                        }
                    }
                },
                {
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 250
                        }
                    }
                }
            ]
        };

        // Initialize and render chart
        const bookingsChart = new ApexCharts(
            document.querySelector("#chart-bookings-overview"),
            chartOptions
        );
        bookingsChart.render();

        // Refresh chart when Livewire component updates
        Livewire.hook('component.updated', () => {
            // Refetch and re-render chart data
            setTimeout(() => {
                const updatedData = @json($bookingCounts);
                const updatedDays = @json($days);
                const newChartData = updatedDays.map((dayString) => {
                    const date = new Date(dayString);
                    return [date.getTime(), updatedData[dayString] || 0];
                });
                bookingsChart.updateSeries([
                    {
                        name: 'Active Bookings',
                        data: newChartData,
                    }
                ]);
            }, 100);
        });
    </script>
@endpush
