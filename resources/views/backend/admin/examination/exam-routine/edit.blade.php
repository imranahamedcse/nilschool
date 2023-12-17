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
            <form action="{{ route('exam-routine.update', $data['exam_routine']->id) }}" enctype="multipart/form-data"
                method="post" id="examRoutineForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="form_type" id="form_type" value="update" />
                <input type="hidden" name="id" id="id" value="{{ $data['exam_routine']->id }}" />
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault01" class="form-label">{{ ___('common.class') }} <span
                                        class="text-danger">*</span></label>
                                <select class="class form-control @error('class') is-invalid @enderror" name="class"
                                    id="validationDefault01">
                                    <option value="">{{ ___('common.select_class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option value="{{ $item->class->id }}"
                                            {{ $data['exam_routine']->classes_id == $item->class->id ? 'selected' : '' }}>
                                            {{ $item->class->name }}</option>
                                    @endforeach
                                </select>

                                @error('class')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <div id="show_sections">
                                    <label for="validationDefault02" class="form-label">{{ ___('common.section') }}
                                        <span class="text-danger">*</span></label>
                                    <select class="section form-control @error('section') is-invalid @enderror"
                                        name="section" id="validationDefault02">
                                        <option value="">{{ ___('common.select_section') }}</option>
                                        @foreach ($data['sections'] as $item)
                                            <option value="{{ $item->section_id }}"
                                                {{ $data['exam_routine']->section_id == $item->section_id ? 'selected' : '' }}>
                                                {{ $item->section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('section')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault03" class="form-label">{{ ___('common.type') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control exam_types @error('type') is-invalid @enderror" name="type"
                                    id="validationDefault03">
                                    <option value="">{{ ___('common.select_type') }}</option>
                                    @foreach ($data['types'] as $item)
                                        <option value="{{ $item->exam_type->id }}"
                                            {{ $data['exam_routine']->type_id == $item->exam_type->id ? 'selected' : '' }}>
                                            {{ $item->exam_type->name }}</option>
                                    @endforeach
                                </select>

                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('common.Date') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control date @error('date') is-invalid @enderror" name="date"
                                    id="validationDefault04" type="date" placeholder="{{ ___('common.enter_date') }}"
                                    value="{{ old('date', $data['exam_routine']->date) }}">
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="d-flex align-items-center gap-4 flex-wrap">
                                    <h5 class="m-0 flex-fill text-info">
                                        {{ ___('common.Add Subject, Teacher, Time & Room') }}
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-primary" onclick="addExamRoutine()">
                                        <span><i class="fa-solid fa-plus"></i> </span>
                                        {{ ___('common.add') }}</button>
                                    <input type="hidden" name="counter" id="counter"
                                        value="{{ count($data['exam_routine']->ExamRoutineChildren) - 1 }}">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table school_borderLess_table" id="exam-routines">
                                            <thead>
                                                <tr>
                                                    <td scope="col">{{ ___('common.subject') }} <span
                                                            class="text-danger"></span>
                                                        @if ($errors->any())
                                                            @if ($errors->has('subjects.*'))
                                                                <span class="text-danger">{{ 'The fields are required' }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td scope="col">
                                                        {{ ___('common.time_schedules.*') }}
                                                        <span class="text-danger"></span>
                                                        @if ($errors->any())
                                                            @if ($errors->has('time_schedules.*'))
                                                                <span class="text-danger">{{ 'The fields are required' }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td scope="col">
                                                        {{ ___('common.class_room') }}
                                                        <span class="text-danger"></span>
                                                        @if ($errors->any())
                                                            @if ($errors->has('class_rooms.*'))
                                                                <span class="text-danger">{{ 'The fields are required' }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td scope="col">
                                                        {{ ___('common.action') }}
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Add hear --}}
                                                @foreach ($data['exam_routine']->examRoutineChildren as $counter => $child)
                                                    <tr id="document-file">
                                                        <td>
                                                            <select class="form-control" name="subjects[]"
                                                                id="subject{{ $counter }}" required>
                                                                <option value="">{{ ___('common.Select subject') }}
                                                                </option>
                                                                @foreach ($data['subjects'] as $item)
                                                                    <option value="{{ $item->subject->id }}"
                                                                        {{ $child->subject_id == $item->subject->id ? 'selected' : '' }}>
                                                                        {{ $item->subject->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="time_schedules[]"
                                                                id="teacher{{ $counter }}" required>
                                                                <option value="">
                                                                    {{ ___('common.Select time schedule') }}</option>
                                                                @foreach ($data['time_schedules'] as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $child->time_schedule_id == $item->id ? 'selected' : '' }}>
                                                                        {{ $item->start_time }} - {{ $item->end_time }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="class_rooms[]"
                                                                id="class_room{{ $counter }}" required>
                                                                <option value="">
                                                                    {{ ___('common.Select class room') }}</option>
                                                                @foreach ($data['class_rooms'] as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $child->class_room_id == $item->id ? 'selected' : '' }}>
                                                                        {{ $item->room_no }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger" onclick="removeRow(this)">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-24">
                            <div class="text-end">
                                <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                    </span>{{ ___('common.submit') }}</button>
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
    <script src="{{ asset('backend/js/get-exam-type.js') }}"></script>
    <script src="{{ asset('backend/js/sweetalert2.js') }}"></script>
    <script>
        // Exam routine start
        function addExamRoutine() {
            var classId = $('#getSections').val();
            var sectionId = $('.sections').val();
            var dateId = $('.date').val();

            if (!classId || !sectionId || !dateId) {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'error',
                    title: 'Please select first ( ' + (!classId ? "Class " : '') + (!sectionId ? "Section " : '') +
                        (!dateId ? "Date " : '') + ')'
                })
                return;
            }

            var url = $('#url').val();
            var counter = parseInt($('#counter').val()) + 1;

            var formData = {
                classes_id: classId,
                section_id: sectionId,
                counter: counter,
            }

            $.ajax({
                type: "GET",
                dataType: 'html',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + '/exam-routine/add-exam-routine',
                success: function(data) {
                    $("#exam-routines tbody").append(data);
                    $("#counter").val(counter);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function removeRow(element) {
            element.closest('tr').remove();
        }
    </script>
@endpush
