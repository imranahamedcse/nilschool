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

            <form action="{{ route('transport-student.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Class') }} <span
                                        class="text-danger">*</span></label>
                                <select class="class form-control @error('class') is-invalid @enderror" name="class">
                                    <option value="">{{ ___('student_info.select_class') }} </option>
                                    @foreach ($data['classes'] as $item)
                                        <option {{ old('class', @$data['request']->class) == $item->id ? 'selected' : '' }}
                                            value="{{ $item->class->id }}">{{ $item->class->name }}</option>
                                    @endforeach
                                </select>
                                @error('class')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Section') }} <span
                                        class="text-danger">*</span></label>
                                <select class="section form-control @error('section') is-invalid @enderror" name="section">
                                    <option value="">{{ ___('student_info.select_section') }} </option>
                                    @foreach ($data['sections'] as $item)
                                        <option
                                            {{ old('section', @$data['request']->section) == $item->section->id ? 'selected' : '' }}
                                            value="{{ $item->section->id }}">{{ $item->section->name }}</option>
                                    @endforeach
                                </select>
                                @error('section')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Student') }} <span
                                        class="text-danger">*</span></label>
                                <select class="student form-control @error('student') is-invalid @enderror" name="student">
                                    <option value="">{{ ___('student_info.Select student') }} *</option>
                                    @foreach ($data['students'] as $item)
                                        <option
                                            {{ old('student', @$data['student']->id) == $item->student_id ? 'selected' : '' }}
                                            value="{{ $item->student_id }}">{{ $item->student->first_name }}
                                            {{ $item->student->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('student')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Route') }} <span
                                        class="text-danger">*</span></label>
                                <select class="route form-control @error('route_id') is-invalid @enderror" name="route_id"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option selected>{{ ___('common.Select Route') }}</option>
                                    @foreach ($data['route'] as $item)
                                        <option {{ old('route') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('route_id')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Vehicle') }} <span
                                        class="text-danger">*</span></label>
                                <select class="vehicle form-control @error('vehicle') is-invalid @enderror" name="vehicle">
                                    <option value="">{{ ___('student_info.Select vehicle') }} </option>
                                    @foreach ($data['vehicles'] as $item)
                                        <option
                                            {{ old('vehicle', @$data['request']->vehicle) == $item->vehicle->id ? 'selected' : '' }}
                                            value="{{ $item->vehicle->id }}">{{ $item->vehicle->name }}</option>
                                    @endforeach
                                </select>
                                @error('vehicle')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Pickup point') }} <span
                                        class="text-danger">*</span></label>
                                <select class="pickup_point form-control @error('pickup_point') is-invalid @enderror"
                                    name="pickup_point">
                                    <option value="">{{ ___('student_info.Select pickup point') }} </option>
                                    @foreach ($data['pickup_points'] as $item)
                                        <option
                                            {{ old('pickup_point', @$data['request']->pickup_point) == $item->pickup_point->id ? 'selected' : '' }}
                                            value="{{ $item->pickup_point->id }}">{{ $item->pickup_point->name }}</option>
                                    @endforeach
                                </select>
                                @error('pickup_point')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('account.Note') }}</label>
                                <input class="form-control" name="note" id="exampleDataList"
                                    placeholder="{{ ___('account.Enter note') }}" value="{{ old('note') }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('common.Active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('common.Inactive') }}
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
                                        </span>{{ ___('common.Submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('backend/js/get-section.js') }}"></script>
    <script src="{{ asset('backend/js/get-student.js') }}"></script>
    <script src="{{ asset('backend/js/get-transport.js') }}"></script>
@endpush
