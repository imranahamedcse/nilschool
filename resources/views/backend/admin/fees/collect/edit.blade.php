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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> {{ ___('create.home') }} </a></li>
                        <li class="breadcrumb-item"><a href="{{ route('religions.index') }}">{{ $data['title'] }}</a></li>
                        <li class="breadcrumb-item">{{ ___('create.edit') }}</li>

                    </ol>
                </div>
            </div>
        </div>
        {{-- bradecrumb Area E n d --}}

        <div class="card card">
            <div class="card-body">
                <form action="{{ route('fees-collect.update', @$data['fees_collect']->id) }}" enctype="multipart/form-data" method="post"
                    id="visitForm">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault01" class="form-label ">{{ ___('create.name') }}<span
                                        class="text-danger">*</span></label>
                                    <input class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name',@$data['fees_collect']->name) }}" id="validationDefault01" type="text"
                                        placeholder="{{ ___('create.enter_name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault02" class="form-label ">{{ ___('create.code') }}<span
                                        class="text-danger">*</span></label>
                                    <input class="form-control @error('code') is-invalid @enderror" name="code"
                                        value="{{ old('code',@$data['fees_collect']->code) }}" id="validationDefault02" type="text"
                                        placeholder="{{ ___('create.enter_code') }}">
                                    @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault03" class="form-label ">{{ ___('create.description') }}</label>
                                    <textarea class="form-control mt-0 @error('description') is-invalid @enderror" name="description"
                                    id="validationDefault03" type="text"
                                    placeholder="{{ ___('create.enter_description') }}">{{ old('description',@$data['fees_collect']->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="validationDefault04" class="form-label">{{ ___('create.status') }} <span class="text-danger">*</span></label>

                                    <select class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault04"
                                   >

                                        <option value="{{ App\Enums\Status::ACTIVE }}"
                                            {{ @$data['fees_collect']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                            {{ ___('create.active') }}</option>
                                        <option value="{{ App\Enums\Status::INACTIVE }}"
                                            {{ @$data['fees_collect']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                            {{ ___('create.inactive') }}
                                        </option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="col-md-12 mt-24">
                                    <div class="text-end">
                                        <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                            </span>{{ ___('create.update') }}</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
