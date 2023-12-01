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
                                    <label for="exampleDataList" class="form-label ">{{ ___('common.name') }} <span
                                            class="fillable">*</span></label>
                                    <input class="form-control ot-input @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name',@$data['subject']->name) }}" list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('common.enter_name') }}">
                                    @error('name')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('academic.code') }} <span
                                            class="fillable">*</span></label>
                                    <input class="form-control @error('code') is-invalid @enderror" name="code"
                                        list="datalistOptions" id="exampleDataList" type="number"
                                        placeholder="{{ ___('academic.enter_code') }}" value="{{ old('code',@$data['subject']->code) }}">
                                    @error('code')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">

                                    <label for="validationServer04" class="form-label">{{ ___('academic.type') }} <span class="fillable">*</span></label>
                                    <select class="form-control @error('type') is-invalid @enderror"
                                    name="type" id="validationServer04"
                                    aria-describedby="validationServer04Feedback">
                                        <option value="{{ old('type',App\Enums\SubjectType::THEORY) }}" {{ old('type',@$data['subject']->type == App\Enums\SubjectType::THEORY ? 'selected' : '') }}>{{ ___('academic.theory') }}</option>
                                        <option value="{{ old('type',App\Enums\SubjectType::PRACTICAL) }}" {{ old('type',@$data['subject']->type == App\Enums\SubjectType::PRACTICAL ? 'selected' : '') }}>{{ ___('academic.practical') }}
                                        </option>
                                    </select>

                                    @error('type')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="col-md-6 mb-3">
                                    {{-- Status  --}}
                                    <label for="validationServer04" class="form-label">{{ ___('common.status') }} <span class="fillable">*</span></label>

                                    <select class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationServer04"
                                    aria-describedby="validationServer04Feedback">

                                        <option value="{{ old('status',App\Enums\Status::ACTIVE) }}"
                                            {{ old('status',@$data['subject']->status == App\Enums\Status::ACTIVE ? 'selected' : '') }}>
                                            {{ ___('common.active') }}</option>
                                        <option value="{{ old('status',App\Enums\Status::INACTIVE) }}"
                                            {{ old('status',@$data['subject']->status == App\Enums\Status::INACTIVE ? 'selected' : '') }}>
                                            {{ ___('common.inactive') }}
                                        </option>
                                    </select>
                                </div>
                                @error('status')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="col-md-12">
                                    <div class="text-end">
                                        <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                            </span>{{ ___('common.update') }}</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
@endsection
