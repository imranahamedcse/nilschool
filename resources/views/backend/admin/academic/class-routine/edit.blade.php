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

            <form action="{{ route('class-routine.update', $data['class_routine']->id) }}" enctype="multipart/form-data"
                method="post" id="classRoutineForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="form_type" id="form_type" value="update" />
                <input type="hidden" name="id" id="id" value="{{ $data['class_routine']->id }}" />
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault01" class="form-label">{{ ___('create.class') }} <span
                                        class="text-danger">*</span></label>
                                <select class="class form-control @error('class') is-invalid @enderror"
                                    name="class" id="validationDefault01">
                                    <option value="">{{ ___('create.select_class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option value="{{ $item->class->id }}"
                                            {{ $data['class_routine']->classes_id == $item->class->id ? 'selected' : '' }}>
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
                                    <label for="validationDefault02" class="form-label">{{ ___('create.section') }}
                                        <span class="text-danger">*</span></label>
                                    <select class="section form-control @error('section') is-invalid @enderror"
                                        name="section" id="validationDefault02">
                                        <option value="">{{ ___('create.select_section') }}</option>
                                        @foreach ($data['sections'] as $item)
                                            <option value="{{ $item->section_id }}"
                                                {{ $data['class_routine']->section_id == $item->section_id ? 'selected' : '' }}>
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
                                <label for="validationDefault03" class="form-label">{{ ___('create.shift') }} </label>
                                <select class="shift form-control @error('shift') is-invalid @enderror" name="shift"
                                    id="validationDefault03">
                                    <option value="">{{ ___('create.select_shift') }}</option>
                                    @foreach ($data['shifts'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $data['class_routine']->shift_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>

                                @error('shift')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault04" class="form-label">{{ ___('create.day') }} <span
                                        class="text-danger">*</span></label>
                                <select class="day form-control @error('day') is-invalid @enderror" name="day"
                                    id="validationDefault04">
                                    <option value="">{{ ___('create.select_day') }}</option>
                                    @foreach (\Config::get('site.days') as $key => $day)
                                        <option {{ $data['class_routine']->day == $key ? 'selected' : '' }}
                                            value="{{ $key }}">
                                            {{ ___($day) }}</option>
                                    @endforeach
                                </select>

                                @error('day')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>




                            <div class="col-md-12">
                                <div class="d-flex align-items-center gap-4 flex-wrap">
                                    <h5 class="m-0 flex-fill text-info">
                                        {{ ___('create.Add Subject, Teacher, Time & Room') }}
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-info" onclick="addClassRoutine()">
                                        <span><i class="fa-solid fa-plus"></i> </span>
                                        {{ ___('create.add') }}</button>
                                    <input type="hidden" name="counter" id="counter"
                                        value="{{ count($data['class_routine']->classRoutineChildren) - 1 }}">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-12">
                                    <table class="table" id="class-routines">
                                        <thead>
                                            <tr>
                                                <td scope="col">{{ ___('create.subject') }} <span
                                                        class="text-danger"></span>
                                                    @if ($errors->any())
                                                        @if ($errors->has('subjects.*'))
                                                            <span class="text-danger">{{ 'The fields are required' }}
                                                        @endif
                                                    @endif
                                                </td>
                                                <td scope="col">
                                                    {{ ___('create.time_schedules.*') }}
                                                    <span class="text-danger"></span>
                                                    @if ($errors->any())
                                                        @if ($errors->has('time_schedules.*'))
                                                            <span class="text-danger">{{ 'The fields are required' }}
                                                        @endif
                                                    @endif
                                                </td>
                                                <td scope="col">
                                                    {{ ___('create.class_room') }}
                                                    <span class="text-danger"></span>
                                                    @if ($errors->any())
                                                        @if ($errors->has('class_rooms.*'))
                                                            <span class="text-danger">{{ 'The fields are required' }}
                                                        @endif
                                                    @endif
                                                </td>
                                                <td scope="col">
                                                    {{ ___('create.action') }}
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Add hear --}}
                                            @foreach ($data['class_routine']->classRoutineChildren as $counter => $child)
                                                <tr id="document-file">
                                                    <td>
                                                        <select class="form-control" name="subjects[]"
                                                            id="subject{{ $counter }}" required>
                                                            <option value="">{{ ___('create.Select subject') }}
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
                                                                {{ ___('create.Select time schedule') }}</option>
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
                                                                {{ ___('create.Select class room') }}</option>
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
                        <div class="col-md-12 mt-24">
                            <div class="text-end">
                                <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                    </span>{{ ___('create.submit') }}</button>
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
    <script src="{{ asset('backend/js/sweetalert2.js') }}"></script>
    <script>
        // Class routine start
        function addClassRoutine() {
            var classId = $('.class').val();
            var sectionId = $('.section').val();
            var dayId = $('.day').val();

            if (!classId || !sectionId || !dayId) {

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
                        (!dayId ? "Day " : '') + ')'
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
                url: url + '/academic/class-routine/add-class-routine',
                success: function(data) {
                    $("#class-routines tbody").append(data);
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
