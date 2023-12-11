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

            <form action="{{ route('dormitory-student.update', @$data['dormitory_student']->id) }}"
                enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Class') }} <span
                                        class="text-danger">*</span></label>
                                <select class="class form-control @error('class') is-invalid @enderror" name="class">
                                    <option value="">{{ ___('student_info.select_class') }} </option>
                                    @foreach ($data['classes'] as $item)
                                        <option {{ old('class', $data['dormitory_student']->class_id) == $item->id ? 'selected' : '' }}
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
                                            {{ old('section', $data['dormitory_student']->section_id) == $item->section->id ? 'selected' : '' }}
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
                                            {{ old('student', $data['dormitory_student']->student_id) == $item->student_id ? 'selected' : '' }}
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
                                <label for="validationServer04" class="form-label">{{ ___('common.Dormitory') }} <span
                                        class="text-danger">*</span></label>
                                <select class="dormitory form-control @error('dormitory') is-invalid @enderror"
                                    name="dormitory">
                                    <option value="">{{ ___('student_info.Select dormitory') }} </option>
                                    @foreach ($data['dormitories'] as $item)
                                        <option
                                            {{ old('dormitory', $data['dormitory_student']->dormitory_id) == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('dormitory')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Room No') }} <span
                                        class="text-danger">*</span></label>
                                <select class="room form-control @error('room') is-invalid @enderror" name="room">
                                    <option value="">{{ ___('student_info.Select room no') }} </option>
                                    @foreach ($data['rooms'] as $item)
                                        <option
                                            {{ old('room', $data['dormitory_student']->room_id) == $item->room->id ? 'selected' : '' }}
                                            value="{{ $item->room->id }}">{{ $item->room->room_no }}</option>
                                    @endforeach
                                </select>
                                @error('room')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Seat No') }} <span
                                        class="text-danger">*</span></label>
                                <select class="seat form-control @error('seat') is-invalid @enderror" name="seat">
                                    <option value="">{{ ___('student_info.Select seat no') }} *</option>

                                    @for ($i = 1; $i <= $data['seats']->type->total_seat; $i++)
                                        <option {{ old('seat', $data['dormitory_student']->seat_no) == $i ? 'selected' : '' }}
                                            value="{{ $i }}">{{ $i }}</option>
                                    @endfor

                                </select>
                                @error('seat')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['dormitory_student']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['dormitory_student']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
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
                                        </span>{{ ___('common.Update') }}</button>
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
    <script src="{{ asset('backend/js/get-dormitory-rooms.js') }}"></script>
    <script src="{{ asset('backend/js/get-room-seats.js') }}"></script>
@endpush
