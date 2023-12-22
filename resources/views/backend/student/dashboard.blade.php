@extends('backend.student.partials.master')

@section('title')
    {{ ___('common.Dashboard') }}
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="card bg-primary-light">
                            <div class="card-body">
                                <i class="fa-solid fa-shop h3 mb-0 text-primary"></i>
                            </div>
                        </div>
                        <div class="px-3">
                            {{ ___('academic.Total class') }}
                            <h3 class="mb-0">{{ $data['totalClass'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="card bg-secondary-light">
                            <div class="card-body">
                                <i class="fa-solid fa-book h3 mb-0 text-secondary"></i>
                            </div>
                        </div>
                        <div class="px-3">
                            {{ ___('academic.Total subject') }}
                            <h3 class="mb-0">{{ $data['totalSubject'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="card bg-info-light">
                            <div class="card-body">
                                <i class="fa-solid fa-user h3 mb-0 text-info"></i>
                            </div>
                        </div>
                        <div class="px-3">
                            {{ ___('academic.Total teacher') }}
                            <h3 class="mb-0">{{ $data['totalTeacher'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="card bg-success-light">
                            <div class="card-body">
                                <i class="fa-solid fa-face-smile h3 mb-0 text-success"></i>
                            </div>
                        </div>
                        <div class="px-3">
                            {{ ___('academic.Total event') }}
                            <h3 class="mb-0">{{ $data['totalEvent'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- {{ @$data['student']->first_name }} {{ @$data['student']->last_name }} --}}
@endsection
