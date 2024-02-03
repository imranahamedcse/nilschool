@extends('backend.student.partials.master')

@section('title')
    {{ ___('common.Dashboard') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="row mt-4">
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card bg-primary-light">
                                    <div class="card-body">
                                        <i class="fa-solid fa-shop h3 mb-0 text-primary"></i>
                                    </div>
                                </div>
                                <div class="px-3">
                                    <span class="text-body-secondary">{{ ___('common.Total class') }}</span>
                                    <p class="fw-bold fs-5 mb-0">{{ $data['totalClass'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card bg-secondary-light">
                                    <div class="card-body">
                                        <i class="fa-solid fa-book h3 mb-0 text-secondary"></i>
                                    </div>
                                </div>
                                <div class="px-3">
                                    <span class="text-body-secondary">{{ ___('common.Total subject') }}</span>
                                    <p class="fw-bold fs-5 mb-0">{{ $data['totalSubject'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card bg-info-light">
                                    <div class="card-body">
                                        <i class="fa-solid fa-user h3 mb-0 text-info"></i>
                                    </div>
                                </div>
                                <div class="px-3">
                                    <span class="text-body-secondary">{{ ___('common.Total teacher') }}</span>
                                    <p class="fw-bold fs-5 mb-0">{{ $data['totalTeacher'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="card bg-success-light">
                                    <div class="card-body">
                                        <i class="fa-solid fa-face-smile h3 mb-0 text-success"></i>
                                    </div>
                                </div>
                                <div class="px-3">
                                    <span class="text-body-secondary">{{ ___('common.Total event') }}</span>
                                    <p class="fw-bold fs-5 mb-0">{{ $data['totalEvent'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>Upcoming Events</strong>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach ($data['events'] as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <small>
                                                <strong>{{ $item->title }}</strong><br>
                                                <span class="text-body-secondary">{{ timeFormat(@$item->start_time) }} -
                                                    {{ timeFormat(@$item->end_time) }}</span>
                                            </small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">{{ dateFormat(@$item->date) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div id="chart"></div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>Student Details</strong>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <small>Student Name:</small>
                                    <small><strong>{{ @$data['student']->first_name }}
                                            {{ @$data['student']->last_name }}</strong></small>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <small>Admission No:</small>
                                    <small><strong>{{ @$data['student']->admission_no }}</strong></small>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <small>Class (Section):</small>
                                    <small><strong>{{ @$data['student']->sessionStudentDetails->class->name }}
                                            ({{ @$data['student']->sessionStudentDetails->section->name }})</strong></small>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <small>Mobile Number:</small>
                                    <small><strong>{{ @$data['student']->mobile }}</strong></small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var title, titles, points;
        $.ajax({
            type: "GET",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/student-panel/marksheet/result',
            success: function(data) {
                title = data.title;
                titles = data.titles;
                points = data.points;
                getResult();
            },
            error: function(data) {
                console.log(data);
            }
        });

        function getResult() {

            var options = {
                series: [{
                    name: "GPA",
                    data: points
                }],
                chart: {
                    height: 340,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                title: {
                    text: title,
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'],
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: titles
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
    </script>
@endpush
