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

            <form action="{{ route('marks-register.update', @$data['marks_register']->id) }}" method="post" id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault01" class="form-label">{{ ___('create.class') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control class @error('class') is-invalid @enderror" name="class"
                                    id="validationDefault01">
                                    <option value="">{{ ___('create.select_class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option
                                            {{ old('class', $data['marks_register']->classes_id) == $item->class->id ? 'selected' : '' }}
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
                                <label for="validationDefault02" class="form-label">{{ ___('create.section') }} <span
                                        class="text-danger">*</span></label>
                                <select class="section form-control @error('section') is-invalid @enderror" name="section"
                                    id="validationDefault02">
                                    <option value="">{{ ___('create.select_section') }}</option>
                                    @foreach ($data['sections'] as $item)
                                        @if ($data['marks_register']->section_id == $item->id)
                                            <option
                                                {{ old('section', $data['marks_register']->section_id) == $item->id ? 'selected' : '' }}
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

                            <div class="col-lg-3">
                                <label for="validationDefault03" class="form-label">{{ ___('create.exam_type') }}
                                    <span class="text-danger">*</span></label>
                                <select id="validationDefault03"
                                    class="form-control exam_type @error('exam_type') is-invalid @enderror"
                                    name="exam_type">
                                    <option value="">{{ ___('create.select_exam_type') }}</option>
                                    @foreach ($data['exam_types'] as $item)
                                        <option
                                            {{ old('class', $data['marks_register']->exam_type_id) == $item->exam_type->id ? 'selected' : '' }}
                                            value="{{ $item->exam_type->id }}">{{ $item->exam_type->name }}
                                    @endforeach
                                </select>
                                @error('exam_type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault04" class="form-label">{{ ___('create.subject') }} <span
                                        class="text-danger">*</span></label>
                                <select id="validationDefault04"
                                    class="form-control subjects nice-select @error('subject') is-invalid @enderror"
                                    name="subject">
                                    <option value="">{{ ___('create.select_subject') }}</option>
                                    @foreach ($data['subjects'] as $item)
                                        @if ($data['marks_register']->subject_id == $item->id)
                                            <option
                                                {{ old('subject', $data['marks_register']->subject_id) == $item->id ? 'selected' : '' }}
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

                            <div class="col-md-12 mt-24">
                                <div class="table-responsive">
                                    <table class="table table-bordered role-table" id="students_table">
                                        <thead class="thead">
                                            <tr>
                                                <th>{{ ___('create.Student Name') }}</th>
                                                <th>{{ ___('create.Total mark') }}</th>
                                                <th>{{ ___('create.Mark distribution') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbody">
                                            @foreach ($data['students'] as $item)
                                                <tr id="document-file">
                                                    <input type="hidden" name="student_ids[]"
                                                        value="{{ $item->student_id }}">
                                                    <td>
                                                        <p class="mt-3">{{ $item->student->first_name }}
                                                            {{ $item->student->last_name }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="mt-3">{{ @$data['examAssign']->total_mark }}</p>
                                                    </td>
                                                    <td>
                                                        @if (@$data['examAssign'])
                                                            @foreach (@$data['examAssign']->mark_distribution as $row)
                                                                <div class="row mb-1">
                                                                    <div class="col-md-6">
                                                                        <p class="mt-3">{{ @$row->title }}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        @foreach ($data['marks_register']->marksRegisterChilds as $child)
                                                                            @if ($child->student_id == $item->student_id && $child->title == $row->title)
                                                                                <input type="number"
                                                                                    name="marks[{{ $item->student_id }}][{{ @$row->title }}]"
                                                                                    value="{{ $child->mark }}"
                                                                                    class="form-control min_width_200"
                                                                                    placeholder="{{ ___('create.Enter mark out of') }} {{ @$row->mark }}"
                                                                                    required>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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

@push('script')
    <script src="{{ asset('backend/js/get-section.js') }}"></script>
    <script src="{{ asset('backend/js/get-subject.js') }}"></script>
    <script src="{{ asset('backend/js/get-exam-type.js') }}"></script>
@endpush
