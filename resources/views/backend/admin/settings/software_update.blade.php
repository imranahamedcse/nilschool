@extends('backend.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    <div class="page-content">

        {{-- bradecrumb Area S t a r t --}}
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="bradecrumb-title mb-1">{{ $data['title'] }}</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ ___('common.home') }}</a></li>
                        <li class="breadcrumb-item">{{ $data['title'] }}</li>
                    </ol>
                </div>
            </div>
        </div>
        {{-- bradecrumb Area E n d --}}

        <div class="card ot-card">
            <div class="card-header">
                <h4>{{ $data['title'] }}</h4>
            </div>
            <div class="card-body">
                <h3 class="mb-5">{{___("settings.Are you sure, want to database update ?")}}</h3>
                <a class="btn ot-btn-primary" href="{{route('settings.install-update')}}"> {{___('settings.Database Update')}}</a>
            </div>
        </div>
    </div>
@endsection
