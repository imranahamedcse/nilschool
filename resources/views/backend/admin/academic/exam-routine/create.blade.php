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
            <form action="{{ route('exam-routine.store') }}" enctype="multipart/form-data" method="post" id="examRoutineForm">
                @csrf
                <input type="hidden" name="form_type" id="form_type" value="create" />
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('academic.class') }} <span
                                        class="fillable">*</span></label>
                                <select id="getSections" class="form-control @error('class') is-invalid @enderror"
                                    name="class" id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('student_info.select_class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option value="{{ $item->class->id }}">{{ $item->class->name }}</option>
                                    @endforeach
                                </select>

                                @error('class')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <div id="show_sections">
                                    <label for="validationServer04" class="form-label">{{ ___('academic.section') }}
                                        <span class="fillable">*</span></label>
                                    <select class="sections form-control @error('section') is-invalid @enderror"
                                        name="section" id="validationServer04"
                                        aria-describedby="validationServer04Feedback">
                                        <option value="">{{ ___('student_info.select_section') }}</option>
                                    </select>
                                    @error('section')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('academic.type') }} <span
                                        class="fillable">*</span></label>
                                <select class="form-control exam_types @error('type') is-invalid @enderror" name="type"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('student_info.select_type') }}</option>
                                </select>

                                @error('type')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.date') }} <span
                                        class="fillable">*</span></label>
                                <input class="form-control date @error('date') is-invalid @enderror" name="date"
                                    list="datalistOptions" id="exampleDataList" type="date"
                                    placeholder="{{ ___('common.enter_date') }}" value="{{ old('date') }}">
                                @error('date')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="d-flex align-items-center gap-4 flex-wrap">
                                    <h5 class="m-0 flex-fill text-info">
                                        {{ ___('academic.Add Subject, Time & Room') }}
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-primary" onclick="addExamRoutine()">
                                        <span><i class="fa-solid fa-plus"></i> </span>
                                        {{ ___('common.add') }}</button>
                                    <input type="hidden" name="counter" id="counter" value="0">
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table school_borderLess_table table_border_hide2" id="exam-routines">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ ___('academic.subject') }} <span
                                                        class="text-danger"></span>
                                                    @if ($errors->any())
                                                        @if ($errors->has('subjects.*'))
                                                            <span class="text-danger">{{ 'The fields are required' }}
                                                        @endif
                                                    @endif
                                                </th>
                                                <th scope="col">
                                                    {{ ___('academic.time_schedules.*') }}
                                                    <span class="text-danger"></span>
                                                    @if ($errors->any())
                                                        @if ($errors->has('time_schedules.*'))
                                                            <span class="text-danger">{{ 'The fields are required' }}
                                                        @endif
                                                    @endif
                                                </th>
                                                <th scope="col">
                                                    {{ ___('academic.class_room') }}
                                                    <span class="text-danger"></span>
                                                    @if ($errors->any())
                                                        @if ($errors->has('class_rooms.*'))
                                                            <span class="text-danger">{{ 'The fields are required' }}
                                                        @endif
                                                    @endif
                                                </th>
                                                <th scope="col">
                                                    {{ ___('common.action') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Add hear --}}
                                        </tbody>
                                    </table>
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
    <script>
        $("#getSections").on('change', function(e) {
            var classId = $("#getSections").val();
            var url = $('#url').val();
            var formData = {
                id: classId,
            }
            $.ajax({
                type: "GET",
                dataType: 'html',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + '/class-setup/get-sections',
                success: function(data) {
                    var section_options = '';
                    var section_li = '';

                    $.each(JSON.parse(data), function(i, item) {
                        section_options += "<option value=" + item.section.id + ">" + item
                            .section.name + "</option>";
                        section_li += "<li data-value=" + item.section.id + " class='option'>" +
                            item.section.name + "</li>";
                    });

                    $("select.sections option").not(':first').remove();
                    $("select.sections").append(section_options);

                    $("div .sections .current").html($("div .sections .list li:first").html());
                    $("div .sections .list li").not(':first').remove();
                    $("div .sections .list").append(section_li);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
    <script>
        // Start get exam_types
        function getExamtype() {
            var classId = $("#getSections").val();
            var sectionId = $(".sections").val();
            var url = $('#url').val();
            var formData = {
                class: classId,
                section: sectionId,
            }
            $.ajax({
                type: "GET",
                dataType: 'html',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + '/exam-assign/get-exam-type',
                success: function(data) {

                    var exam_type_options = '';
                    var exam_type_li = '';

                    $.each(JSON.parse(data), function(i, item) {
                        exam_type_options += "<option value=" + item.exam_type.id + ">" + item.exam_type
                            .name + "</option>";
                        exam_type_li += "<li data-value=" + item.exam_type.id + " class='option'>" +
                            item.exam_type.name + "</li>";
                    });

                    $("select.exam_types option").not(':first').remove();
                    $("select.exam_types").append(exam_type_options);


                    $("div .exam_types .current").html($("div .exam_types .list li:first").html());
                    $("div .exam_types .list li").not(':first').remove();
                    $("div .exam_types .list").append(exam_type_li);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
        $("#getSections").on('change', function(e) {
            getExamtype();
        });
        $(".sections").on('change', function(e) {
            getExamtype();
        });
        // End get exam_types
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
