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
                                <label for="validationDefault01" class="form-label ">{{ ___('create.name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="validationDefault01" type="text"
                                    placeholder="{{ ___('create.enter_name') }}"
                                    value="{{ old('name', @$data['marks_grade']->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02" class="form-label ">{{ ___('create.point') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('point') is-invalid @enderror" name="point"
                                    id="validationDefault02" type="number" step="any"
                                    placeholder="{{ ___('create.enter_point') }}"
                                    value="{{ old('point', @$data['marks_grade']->point) }}">
                                @error('point')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('create.percent_from') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('percent_from') is-invalid @enderror"
                                    name="percent_from" id="validationDefault03" type="number"
                                    step="any" placeholder="{{ ___('create.enter_percent_from') }}"
                                    value="{{ old('percent_from', @$data['marks_grade']->percent_from) }}">
                                @error('percent_from')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('create.percent_upto') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('percent_upto') is-invalid @enderror"
                                    name="percent_upto" id="validationDefault04" type="number"
                                    step="any" placeholder="{{ ___('create.enter_percent_upto') }}"
                                    value="{{ old('percent_upto', @$data['marks_grade']->percent_upto) }}">
                                @error('percent_upto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault05" class="form-label ">{{ ___('create.remarks') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('remarks') is-invalid @enderror" name="remarks"
                                    id="validationDefault05" type="text"
                                    placeholder="{{ ___('create.enter_remarks') }}"
                                    value="{{ old('remarks', @$data['marks_grade']->remarks) }}">
                                @error('remarks')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">

                                <label for="validationDefault06" class="form-label">{{ ___('create.status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault06">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['marks_grade']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['marks_grade']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.inactive') }}
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
                                        </span>{{ ___('create.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
