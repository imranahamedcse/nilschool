@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['breadcrumbs']['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('subject.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('common.name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="validationDefault01" placeholder="{{ ___('common.enter_name') }}"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02" class="form-label ">{{ ___('academic.code') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('code') is-invalid @enderror" name="code"
                                    id="validationDefault02" type="number"
                                    placeholder="{{ ___('academic.enter_code') }}" value="{{ old('code') }}">
                                @error('code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">

                                <label for="validationDefault03" class="form-label">{{ ___('academic.type') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('type') is-invalid @enderror" name="type"
                                    id="validationDefault03">
                                    <option value="{{ App\Enums\SubjectType::THEORY }}">{{ ___('academic.theory') }}
                                    </option>
                                    <option value="{{ App\Enums\SubjectType::PRACTICAL }}">{{ ___('academic.practical') }}
                                    </option>
                                </select>

                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-3">

                                <label for="validationDefault04" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault04">
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
                            <div class="col-md-12">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('common.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
