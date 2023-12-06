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

            <form action="{{ route('marks-grade.update', @$data['marks_grade']->id) }}" enctype="multipart/form-data"
                method="post" id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    list="datalistOptions" id="exampleDataList" type="text"
                                    placeholder="{{ ___('common.enter_name') }}"
                                    value="{{ old('name', @$data['marks_grade']->name) }}">
                                @error('name')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('examination.point') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('point') is-invalid @enderror" name="point"
                                    list="datalistOptions" id="exampleDataList" type="number" step="any"
                                    placeholder="{{ ___('common.enter_point') }}"
                                    value="{{ old('point', @$data['marks_grade']->point) }}">
                                @error('point')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('examination.percent_from') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('percent_from') is-invalid @enderror"
                                    name="percent_from" list="datalistOptions" id="exampleDataList" type="number"
                                    step="any" placeholder="{{ ___('common.enter_percent_from') }}"
                                    value="{{ old('percent_from', @$data['marks_grade']->percent_from) }}">
                                @error('percent_from')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('examination.percent_upto') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('percent_upto') is-invalid @enderror"
                                    name="percent_upto" list="datalistOptions" id="exampleDataList" type="number"
                                    step="any" placeholder="{{ ___('common.enter_percent_upto') }}"
                                    value="{{ old('percent_upto', @$data['marks_grade']->percent_upto) }}">
                                @error('percent_upto')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('examination.remarks') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('remarks') is-invalid @enderror" name="remarks"
                                    list="datalistOptions" id="exampleDataList" type="text"
                                    placeholder="{{ ___('common.enter_remarks') }}"
                                    value="{{ old('remarks', @$data['marks_grade']->remarks) }}">
                                @error('remarks')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">

                                <label for="validationServer04" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['marks_grade']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['marks_grade']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.inactive') }}
                                    </option>
                                </select>

                                @error('status')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
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
