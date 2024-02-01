@extends('backend.admin.partial.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col-6">
            <div class="row">
                @foreach ($data['total'] as $item)
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="card bg-{{ $item['color'] }}-light">
                                        <div class="card-body">
                                            <i class="fa-solid fa-{{ $item['icon'] }} h3 mb-0 text-{{ $item['color'] }}"></i>
                                        </div>
                                    </div>
                                    <div class="px-3">
                                        <span class="text-body-secondary">{{ $item['title'] }}</span>
                                        <p class="fw-bold fs-5 mb-0">{{ $item['value'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <div id="attendance"></div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Upcoming Events</strong>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($data['events'] as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <small><strong>{{ $item->title }}</strong></small> <br>
                                    <small class="text-body-secondary">{{ timeFormat(@$item->start_time) }} -
                                        {{ timeFormat(@$item->end_time) }}</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{ dateFormat(@$item->date) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <strong>All Users</strong>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($data['users'] as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <small><strong>{{ $item->role->name }}</strong></small>
                                <span class="badge bg-primary rounded-pill">{{ $item['total'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div id="sessionly_transaction"></div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <div id="monthly_transaction"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="monthly_fees_collection"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var classes, present, absent;
        $.ajax({
            type: "GET",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/today-attendance',
            success: function(data) {
                classes = data.classes;
                present = data.present;
                absent = data.absent;
                getAttendance();
            },
            error: function(data) {
                console.log(data);
            }
        });

        function getAttendance() {
            var options = {
                series: [{
                        name: 'Present',
                        data: present
                    },
                    {
                        name: 'Absent',
                        data: absent
                    }
                ],
                chart: {
                    type: 'bar',
                    height: 320
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                grid: {
                    row: {
                        colors: ['#fff', '#f2f2f2']
                    }
                },
                xaxis: {
                    categories: classes,
                },
                fill: {
                    opacity: 1
                },
                title: {
                    text: "Today's Attendance (01 Feb 2024)",
                    align: 'left'
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val
                        }
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#attendance"), options);
            chart.render();
        };
    </script>
    <script>
        var incomes, expenses, revenues;
        var url = $('#url').val();
        $.ajax({
            type: "GET",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url + '/fees-collection-monthly',
            success: function(data) {
                incomes  = data.income;
                expenses = data.expense;
                revenues = data.revenue;
                getSessionlyFeesCollection();
            },
            error: function(data) {
                console.log(data);
            }
        });

        function getSessionlyFeesCollection() {
            var options = {
                series: [{
                    name: 'Income',
                    data: incomes
                },
                {
                    name: 'Expense',
                    data: expenses
                },
                {
                    name: 'Revenue',
                    data: revenues
                }],
                chart: {
                    height: 400,
                    type: 'area'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec"
                    ]
                },
                title: {
                    text: 'Income & Expenses For Session 2023-24',
                    align: 'left'
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            };

            var chart = new ApexCharts(document.querySelector("#sessionly_transaction"), options);
            chart.render();
        }
    </script>

    <script>
        var dates, incomes, expenses;

        $.ajax({
            type: "GET",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/income-expense-current-month',
            success: function(data) {
                dates = data.dates;
                incomes = data.incomes;
                expenses = data.expenses;
                getIncomeExpense();
            },
            error: function(data) {
                console.log(data);
            }
        });

        function getIncomeExpense() {
            var options = {
                series: [{
                        name: 'Income',
                        data: incomes
                    },
                    {
                        name: 'Expenses',
                        data: expenses
                    }
                ],
                chart: {
                    height: 400,
                    type: 'bar',
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2
                },
                grid: {
                    row: {
                        colors: ['#fff', '#f2f2f2']
                    }
                },
                xaxis: {
                    categories: dates
                },
                title: {
                    text: 'Income & Expenses For Feb-24',
                    align: 'left'
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: "horizontal",
                        shadeIntensity: 0.25,
                        gradientToColors: undefined,
                        inverseColors: true,
                        opacityFrom: 0.85,
                        opacityTo: 0.85,
                        stops: [50, 0, 100]
                    },
                }
            };

            var chart = new ApexCharts(document.querySelector("#monthly_transaction"), options);
            chart.render();
        }
    </script>

    <script>
        var dates, collection;
        $.ajax({
            type: "GET",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/fees-collection-current-month',
            success: function(data) {
                dates = data.dates;
                collection = data.collection;
                getFeesCollection();
            },
            error: function(data) {
                console.log(data);
            }
        });

        function getFeesCollection() {
            var options = {
                series: [{
                    name: 'Sales',
                    data: collection
                }],
                chart: {
                    height: 400,
                    type: 'line',
                },
                stroke: {
                    width: 5,
                    curve: 'smooth'
                },
                xaxis: {
                    categories: dates,
                },
                title: {
                    text: 'Fees Collection For Feb-24',
                    align: 'left'
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        gradientToColors: ['#FDD835'],
                        shadeIntensity: 1,
                        type: 'horizontal',
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100]
                    },
                },
                yaxis: {
                    min: -10,
                    max: 40
                }
            };

            var chart = new ApexCharts(document.querySelector("#monthly_fees_collection"), options);
            chart.render();
        }
    </script>
@endpush
