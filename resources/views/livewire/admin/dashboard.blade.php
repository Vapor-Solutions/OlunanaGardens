<div>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    @php
        $earnings = 0;

        foreach (App\Models\Booking::all() as $booking) {
            $earnings += $booking->total_cost_kes;
        }
    @endphp
    {{-- <button>test</button> --}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget" wire:ignore>
                            <div class="align-self-center text-center"><i data-feather="dollar-sign"></i></div>
                            <div class="media-body"><span class="m-0">Total Earnings</span>
                                <h4 class="mb-0 ">KES <span
                                        class="font-bold counter">{{ number_format($earnings) }}</span>
                                </h4><i class="icon-bg" data-feather="dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-secondary b-r-4 card-body">
                        <div class="media static-top-widget" wire:ignore>
                            <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                            <div class="media-body"><span class="m-0">Available Sections</span>
                                @php
                                    $available = count(App\Models\Section::all());
                                    $active = 0;

                                    foreach (App\Models\Section::all() as $section) {
                                        foreach ($section->bookings as $booking) {
                                            if ($booking->is_active) {
                                                $active += 1;
                                            }
                                        }
                                    }

                                    $available -= $active;

                                @endphp
                                <h4 class="mb-0 counter">{{ number_format($available) }}</h4><i class="icon-bg"
                                    data-feather="shopping-bag"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-primary b-r-4 card-body">
                        <div class="media static-top-widget" wire:ignore>
                            <div class="align-self-center text-center"><i data-feather="database"></i></div>
                            <div class="media-body"><span class="m-0">Total Bookings</span>
                                <h4 class="mb-0 counter">{{ number_format(count(App\Models\Booking::all())) }}</h4><i
                                    class="icon-bg" data-feather="database"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden border-0">
                    <div class="bg-secondary b-r-4 card-body">
                        <div class="media static-top-widget" wire:ignore>
                            <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                            <div class="media-body"><span class="m-0">Unpaid Invoices</span>
                                <h4 class="mb-0 ">KES <span class="counter">{{ number_format(0) }}</span></h4><i
                                    class="icon-bg" data-feather="shopping-bag"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Maintenance Mode</h5>
                        <h6 class="text-{{ env('MAINTENANCE_MODE') ? 'success' : 'danger' }}">
                            {{ env('MAINTENANCE_MODE') ? 'ON' : 'OFF' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column mb-md-5 mb-2">
                            <button wire:click='maintenance_switch'
                                onclick="confirm('Are you sure you want switch {{ env('MAINTENANCE_MODE') ? 'from' : 'to' }} maintenance mode?') || event.stopImmediatePropagation()"
                                class="btn btn-{{ env('MAINTENANCE_MODE') ? 'danger' : 'success' }}">
                                Switch {{ env('MAINTENANCE_MODE') ? 'Off' : 'On' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-6 des-xl-100 dashboard-sec">
                <div class="card income-card">
                    <div class="card-header">
                        <div class="header-top d-sm-flex align-items-center">
                            <h5>Bookings Overview Chart</h5>
                            <div class="center-content">
                                {{-- <p class="d-sm-flex align-items-center"><span
                                        class="font-primary m-r-10 f-w-700">$859.25k</span><i
                                        class="toprightarrow-primary fa fa-arrow-up m-r-10"></i>86% More than last year</p> --}}
                            </div>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div id="chart-timeline-dashbord" wire:ignore></div>
                    </div>
                </div>
            </div>
            {{--
            <ol>
                @foreach (App\Models\Permission::all() as $permission)
                    <li>{{ $permission->title }}</li>
                @endforeach
            </ol> --}}
        </div>
    </div>



</div>


@push('scripts')
    <script>
        var options = {
            series: [{
                data: [
                    @foreach ($days as $day)
                        [
                            {{ $day->timestamp . '000' }},
                            @php
                                $count = 0;
                                foreach (App\Models\Section::all() as $section) {
                                    if ($section->IsBooked(Carbon\Carbon::parse($day)->toDateString())) {
                                        $count++;
                                    }
                                }
                            @endphp
                            // {{ $count }}
                        ],
                    @endforeach
                ]
            }],
            chart: {
                id: 'area-datetime',
                type: 'area',
                height: 425,
                zoom: {
                    autoScaleYaxis: true
                },
                toolbar: {
                    show: false
                },
            },
            annotations: {
                yaxis: [{
                    y: 50,
                    borderColor: '#18264b',
                    label: {
                        show: false,
                        text: 'Average',
                        style: {
                            color: "#fff",
                            background: '#18264b'
                        }
                    }
                }],
                xaxis: [{
                    x: {{ Carbon\Carbon::now()->subMonths(2)->timestamp . '000' }},
                    borderColor: '#18264b',
                    yAxisIndex: 50,
                    label: {
                        show: false,
                        text: 'Best',
                        style: {
                            color: "#fff",
                            background: '#18264b'
                        }
                    },
                }]
            },
            dataLabels: {
                enabled: false
            },
            markers: {
                size: 0,
                style: 'hollow',
            },
            xaxis: {
                type: 'datetime',
                min: {{ Carbon\Carbon::now()->subMonths(2)->timestamp . '000' }},
                tickAmount: 6,
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false
                },
            },
            tooltip: {
                x: {
                    format: 'dd MMM yyyy'
                },
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 100]
                }
            },
            responsive: [{
                    breakpoint: 1366,
                    options: {
                        chart: {
                            height: 350
                        }
                    }
                },
                {
                    breakpoint: 1238,
                    options: {
                        chart: {
                            height: 300
                        },
                        grid: {
                            padding: {
                                bottom: 5,
                            },
                        }
                    }
                },
                {
                    breakpoint: 992,
                    options: {
                        chart: {
                            height: 300
                        }
                    }
                },
                {
                    breakpoint: 551,
                    options: {
                        grid: {
                            padding: {
                                bottom: 10,
                            },
                        }
                    }
                },
                {
                    breakpoint: 535,
                    options: {
                        chart: {
                            height: 250
                        }

                    }
                }
            ],

            colors: ['#18264b'],
        };
        var charttimeline = new ApexCharts(document.querySelector("#chart-timeline-dashbord"), options);
        charttimeline.render();
    </script>
@endpush
