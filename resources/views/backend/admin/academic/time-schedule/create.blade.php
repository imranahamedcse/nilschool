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

            <form action="{{ route('time_schedule.store') }}" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">

                                <label for="validationServer04" class="form-label">{{ ___('academic.type') }} <span
                                        class="fillable">*</span></label>
                                <select class="form-control @error('type') is-invalid @enderror" name="type"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="1">{{ ___('academic.class') }}</option>
                                    <option value="2">{{ ___('academic.exam') }}
                                    </option>
                                </select>

                                @error('type')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-3">

                                <label for="validationServer04" class="form-label">{{ ___('common.status') }} <span
                                        class="fillable">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('common.inactive') }}
                                    </option>
                                </select>

                                @error('status')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('academic.start_time') }} <span
                                        class="fillable">*</span></label>
                                <input class="form-control @error('start_time') is-invalid @enderror" name="start_time"
                                    list="datalistOptions" id="exampleDataList" type="time"
                                    placeholder="{{ ___('academic.enter_start_time') }}" value="{{ old('start_time') }}">
                                @error('start_time')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('academic.end_time') }} <span
                                        class="fillable">*</span></label>
                                <input class="form-control @error('end_time') is-invalid @enderror" name="end_time"
                                    list="datalistOptions" id="exampleDataList" type="time"
                                    placeholder="{{ ___('academic.enter_end_time') }}" value="{{ old('end_time') }}">
                                @error('end_time')
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
