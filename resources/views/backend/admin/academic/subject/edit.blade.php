@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['breadcrumbs']['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

        <div class="card">
            <div class="card-body">
                <form action="{{ route('subject.update', @$data['subject']->id) }}" enctype="multipart/form-data" method="post"
                    id="visitForm">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault01" class="form-label ">{{ ___('create.name') }} <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name',@$data['subject']->name) }}" id="validationDefault01"
                                        placeholder="{{ ___('create.enter_name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault02" class="form-label ">{{ ___('create.code') }} <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control @error('code') is-invalid @enderror" name="code"
                                        id="validationDefault02" type="number"
                                        placeholder="{{ ___('create.enter_code') }}" value="{{ old('code',@$data['subject']->code) }}">
                                    @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">

                                    <label for="validationDefault03" class="form-label">{{ ___('create.type') }} <span class="text-danger">*</span></label>
                                    <select class="form-control @error('type') is-invalid @enderror"
                                    name="type" id="validationDefault03"
                                   >
                                        <option value="{{ old('type',App\Enums\SubjectType::THEORY) }}" {{ old('type',@$data['subject']->type == App\Enums\SubjectType::THEORY ? 'selected' : '') }}>{{ ___('create.theory') }}</option>
                                        <option value="{{ old('type',App\Enums\SubjectType::PRACTICAL) }}" {{ old('type',@$data['subject']->type == App\Enums\SubjectType::PRACTICAL ? 'selected' : '') }}>{{ ___('create.practical') }}
                                        </option>
                                    </select>

                                    @error('type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationDefault04" class="form-label">{{ ___('create.status') }} <span class="text-danger">*</span></label>

                                    <select class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault04"
                                   >

                                        <option value="{{ old('status',App\Enums\Status::ACTIVE) }}"
                                            {{ old('status',@$data['subject']->status == App\Enums\Status::ACTIVE ? 'selected' : '') }}>
                                            {{ ___('create.active') }}</option>
                                        <option value="{{ old('status',App\Enums\Status::INACTIVE) }}"
                                            {{ old('status',@$data['subject']->status == App\Enums\Status::INACTIVE ? 'selected' : '') }}>
                                            {{ ___('create.inactive') }}
                                        </option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="col-md-12">
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
@endsection
