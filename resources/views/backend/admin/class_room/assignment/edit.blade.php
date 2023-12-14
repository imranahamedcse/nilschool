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

            <form action="{{ route('assignment.update', @$data['assignment']->id) }}" enctype="multipart/form-data"
                method="post" id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault01" class="form-label">{{ ___('student_info.class') }} <span
                                        class="text-danger">*</span></label>
                                <select class="class form-control @error('class') is-invalid @enderror" name="class"
                                    id="validationDefault01">
                                    <option value="">{{ ___('student_info.select_class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option
                                            {{ old('class', $data['assignment']->classes_id) == $item->class->id ? 'selected' : '' }}
                                            value="{{ $item->class->id }}">{{ $item->class->name }}
                                    @endforeach
                                    </option>
                                </select>

                                @error('class')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault02" class="form-label">{{ ___('student_info.section') }} <span
                                        class="text-danger">*</span></label>
                                <select class="section form-control @error('section') is-invalid @enderror" name="section"
                                    id="validationDefault02">
                                    <option value="">{{ ___('student_info.select_section') }}</option>
                                    @foreach ($data['sections'] as $item)
                                        @if ($data['assignment']->section_id == $item->id)
                                            <option
                                                {{ old('section', $data['assignment']->section_id) == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->name }}
                                        @endif
                                    @endforeach
                                </select>

                                @error('section')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault03" class="form-label">{{ ___('academic.subject') }} <span
                                        class="text-danger">*</span></label>
                                <select id="validationDefault03"
                                    class="form-control subject @error('subject') is-invalid @enderror" name="subject">
                                    <option value="">{{ ___('examination.select_subject') }}</option>
                                    @foreach ($data['subjects'] as $item)
                                        @if ($data['assignment']->subject_id == $item->id)
                                            <option
                                                {{ old('subject', $data['assignment']->subject_id) == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->name }}
                                        @endif
                                    @endforeach
                                </select>
                                @error('subject')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="col-md-3 mb-3">
                                <label for="validationDefault04" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>

                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault04">

                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['assignment']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['assignment']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault05" class="form-label ">{{ ___('fees.Mark') }} </label>
                                <input class="form-control @error('mark') is-invalid @enderror" name="mark"
                                    value="{{ old('mark', @$data['assignment']->mark) }}" id="validationDefault05"
                                    type="number" placeholder="{{ ___('fees.Enter mark') }}">
                                @error('mark')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault06" class="form-label ">{{ ___('fees.Assigned date') }}
                                </label>
                                <input class="form-control @error('assigned_date') is-invalid @enderror"
                                    name="assigned_date"
                                    value="{{ old('assigned_date', @$data['assignment']->assigned_date) }}"
                                    id="validationDefault06" type="date"
                                    placeholder="{{ ___('fees.Enter assigned date') }}">
                                @error('assigned_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault07" class="form-label ">{{ ___('fees.Submission date') }}
                                </label>
                                <input class="form-control @error('submission_date') is-invalid @enderror"
                                    name="submission_date"
                                    value="{{ old('submission_date', @$data['assignment']->submission_date) }}"
                                    id="validationDefault07" type="date"
                                    placeholder="{{ ___('fees.Enter submission date') }}">
                                @error('submission_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault08" class="form-label ">{{ ___('fees.Document') }} </label>
                                <input class="form-control @error('document') is-invalid @enderror" name="document"
                                    id="validationDefault08" type="file" placeholder="{{ ___('fees.enter_document') }}">
                                @error('document')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="validationDefault09" class="form-label ">{{ ___('fees.Description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="validationDefault09"
                                    type="text" placeholder="{{ ___('fees.Enter description') }}">{{ old('description', @$data['assignment']->description) }}</textarea>
                                @error('description')
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


@push('script')
    <script src="{{ asset('backend/js/get-section.js') }}"></script>
    <script src="{{ asset('backend/js/get-subject.js') }}"></script>
@endpush
