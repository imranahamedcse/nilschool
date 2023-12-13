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

            <form action="{{ route('marks-grade.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
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
                                <label for="validationDefault02" class="form-label ">{{ ___('examination.point') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('point') is-invalid @enderror" name="point"
                                    id="validationDefault02" type="number" step="any"
                                    placeholder="{{ ___('examination.enter_point') }}" value="{{ old('point') }}">
                                @error('point')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('examination.percent_from') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('percent_from') is-invalid @enderror"
                                    name="percent_from" id="validationDefault03" type="number"
                                    step="any" placeholder="{{ ___('examination.enter_percent_from') }}"
                                    value="{{ old('percent_from') }}">
                                @error('percent_from')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('examination.percent_upto') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('percent_upto') is-invalid @enderror"
                                    name="percent_upto" id="validationDefault04" type="number"
                                    step="any" placeholder="{{ ___('examination.enter_percent_upto') }}"
                                    value="{{ old('percent_upto') }}">
                                @error('percent_upto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault05" class="form-label ">{{ ___('examination.remarks') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('remarks') is-invalid @enderror" name="remarks"
                                    id="validationDefault05" type="text"
                                    placeholder="{{ ___('examination.enter_remarks') }}" value="{{ old('remarks') }}">
                                @error('remarks')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">

                                <label for="validationDefault06" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault06">
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
            </form>
        </div>
    </div>
@endsection
