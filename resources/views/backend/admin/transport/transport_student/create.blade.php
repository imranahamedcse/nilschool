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
                                <label for="validationDefault01" class="form-label">{{ ___('common.Class') }} <span
                                        class="text-danger">*</span></label>
                                <select id="validationDefault01" class="class form-control @error('class') is-invalid @enderror" name="class">
                                    <option value="">{{ ___('common.select_class') }} </option>
                                    @foreach ($data['classes'] as $item)
                                        <option {{ old('class', @$data['request']->class) == $item->id ? 'selected' : '' }}
                                            value="{{ $item->class->id }}">{{ $item->class->name }}</option>
                                    @endforeach
                                </select>
                                @error('class')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault02" class="form-label">{{ ___('common.Section') }} <span
                                        class="text-danger">*</span></label>
                                <select id="validationDefault02" class="section form-control @error('section') is-invalid @enderror" name="section">
                                    <option value="">{{ ___('common.select_section') }} </option>
                                    @foreach ($data['sections'] as $item)
                                        <option
                                            {{ old('section', @$data['request']->section) == $item->section->id ? 'selected' : '' }}
                                            value="{{ $item->section->id }}">{{ $item->section->name }}</option>
                                    @endforeach
                                </select>
                                @error('section')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault03" class="form-label">{{ ___('common.Student') }} <span
                                        class="text-danger">*</span></label>
                                <select id="validationDefault03" class="student form-control @error('student') is-invalid @enderror" name="student">
                                    <option value="">{{ ___('common.Select student') }} *</option>
                                    @foreach ($data['students'] as $item)
                                        <option
                                            {{ old('student', @$data['student']->id) == $item->student_id ? 'selected' : '' }}
                                            value="{{ $item->student_id }}">{{ $item->student->first_name }}
                                            {{ $item->student->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('student')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault04" class="form-label">{{ ___('common.Route') }} <span
                                        class="text-danger">*</span></label>
                                <select class="route form-control @error('route_id') is-invalid @enderror" name="route_id"
                                    id="validationDefault04">
                                    <option selected>{{ ___('common.Select Route') }}</option>
                                    @foreach ($data['route'] as $item)
                                        <option {{ old('route') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('route_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault05" class="form-label">{{ ___('common.Vehicle') }} <span
                                        class="text-danger">*</span></label>
                                <select id="validationDefault05" class="vehicle form-control @error('vehicle') is-invalid @enderror" name="vehicle">
                                    <option value="">{{ ___('common.Select vehicle') }} </option>
                                    @foreach ($data['vehicles'] as $item)
                                        <option
                                            {{ old('vehicle', @$data['request']->vehicle) == $item->vehicle->id ? 'selected' : '' }}
                                            value="{{ $item->vehicle->id }}">{{ $item->vehicle->name }}</option>
                                    @endforeach
                                </select>
                                @error('vehicle')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault06" class="form-label">{{ ___('common.Pickup point') }} <span
                                        class="text-danger">*</span></label>
                                <select id="validationDefault06" class="pickup_point form-control @error('pickup_point') is-invalid @enderror"
                                    name="pickup_point">
                                    <option value="">{{ ___('common.Select pickup point') }} </option>
                                    @foreach ($data['pickup_points'] as $item)
                                        <option
                                            {{ old('pickup_point', @$data['request']->pickup_point) == $item->pickup_point->id ? 'selected' : '' }}
                                            value="{{ $item->pickup_point->id }}">{{ $item->pickup_point->name }}</option>
                                    @endforeach
                                </select>
                                @error('pickup_point')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault07" class="form-label ">{{ ___('common.Note') }}</label>
                                <input class="form-control" name="note" id="validationDefault07"
                                    placeholder="{{ ___('common.Enter note') }}" value="{{ old('note') }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault08" class="form-label">{{ ___('common.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault08">
                                    <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('common.Active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('common.Inactive') }}
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
