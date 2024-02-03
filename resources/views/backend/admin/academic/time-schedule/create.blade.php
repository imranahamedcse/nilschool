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

            <form action="{{ route('time-schedule.store') }}" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">

                                <label for="validationDefault01" class="form-label">{{ ___('create.type') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('type') is-invalid @enderror" name="type"
                                    id="validationDefault01">
                                    <option value="1">{{ ___('create.class') }}</option>
                                    <option value="2">{{ ___('create.exam') }}
                                    </option>
                                </select>

                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-3">

                                <label for="validationDefault02" class="form-label">{{ ___('create.status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault02">
                                    <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('create.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('create.inactive') }}
                                    </option>
                                </select>

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('create.start_time') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('start_time') is-invalid @enderror" name="start_time"
                                    id="validationDefault03" type="time"
                                    placeholder="{{ ___('create.enter_start_time') }}" value="{{ old('start_time') }}">
                                @error('start_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('create.end_time') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('end_time') is-invalid @enderror" name="end_time"
                                    id="validationDefault04" type="time"
                                    placeholder="{{ ___('create.enter_end_time') }}" value="{{ old('end_time') }}">
                                @error('end_time')
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
