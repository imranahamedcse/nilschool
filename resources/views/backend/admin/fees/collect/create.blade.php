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
                        <li class="breadcrumb-item" aria-current="page"><a
                                href="{{ route('fees-collect.index') }}">{{ $data['title'] }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ ___('common.add_new') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        {{-- bradecrumb Area E n d --}}

        <div class="card card">
            <div class="card-body">
                <form action="{{ route('fees-collect.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault01" class="form-label ">{{ ___('common.name') }} <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control @error('name') is-invalid @enderror" name="name"
                                        id="validationDefault01" type="text"
                                        placeholder="{{ ___('common.enter_name') }}" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault02" class="form-label ">{{ ___('common.code') }} <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control @error('code') is-invalid @enderror" name="code"
                                        id="validationDefault02" type="text"
                                        placeholder="{{ ___('common.enter_code') }}" value="{{ old('code') }}">
                                    @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault03" class="form-label ">{{ ___('common.description') }}</label>
                                    <textarea class="form-control mt-0 @error('description') is-invalid @enderror" name="description"
                                    id="validationDefault03"
                                    placeholder="{{ ___('common.enter_description') }}">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">

                                    <label for="validationDefault04" class="form-label">{{ ___('common.status') }} <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault04"
                                   >
                                        <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('common.active') }}</option>
                                        <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('common.inactive') }}
                                        </option>
                                    </select>

                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="col-md-12 mt-24">
                                    <div class="text-end">
                                        <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                            </span>{{ ___('common.submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
