@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card">
        <div class="card-body">
            <div class="border-bottom pb-3 mb-4">
                <h4 class="m-0">{{ @$data['title'] }}</h4>
            </div>

            <div class="card-body">
                <h3 class="mb-5">{{ ___('settings.Are you sure, want to database update ?') }}</h3>
                <a class="btn btn-primary" href="{{ route('settings.install-update') }}">
                    {{ ___('settings.Database Update') }}</a>
            </div>
        </div>
    </div>
@endsection
