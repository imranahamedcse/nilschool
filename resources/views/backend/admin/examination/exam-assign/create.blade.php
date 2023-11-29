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
            <form action="{{ route('exam-assign.store') }}" enctype="multipart/form-data" method="post" id="visitForm"
                onsubmit="return examAssignSubmit()">
                @csrf
                <input type="hidden" name="form_type" id="form_type" value="create" />
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="validationServer04" class="form-label">{{ ___('examination.exam_type') }}
                                    <span class="fillable">*</span></label>
                                <select class="form-control exam_types @error('exam_types') is-invalid @enderror"
                                    name="exam_types[]">
                                    <option value="" disabled>{{ ___('examination.select_exam_type') }}</option>
                                    @foreach ($data['exam_types'] as $item)
                                        <option {{ old('class') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>
                                @error('exam_types')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">

                                <label for="validationServer04" class="form-label">{{ ___('student_info.class') }} <span
                                        class="fillable">*</span></label>
                                <select onchange="changeExamAssignClass(this)"
                                    class="classes form-control class @error('class') is-invalid @enderror" name="class"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('student_info.select_class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option {{ old('class') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->class->id }}">{{ $item->class->name }}
                                    @endforeach
                                    </option>
                                </select>

                                @error('class')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ ___('academic.section') }} <span
                                        class="fillable">*</span></label>
                                <div class="input-check-radio academic-section exam-assign-section">
                                </div>
                            </div>



                            <div class="col-md-6 mb-3">

                                <label for="validationServer04" class="form-label">{{ ___('examination.subjects') }} <span
                                        class="fillable">*</span></label>
                                <select id="subjectMark"
                                    class="form-control subjects @error('subjects') is-invalid @enderror" name="subjects[]"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="" disabled>{{ ___('examination.select_subject') }}</option>
                                </select>

                                @error('subjects')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table school_borderLess_table" id="subject_marks_distribute">
                                        <thead>
                                            <tr>
                                                <td scope="col">{{ ___('examination.subject') }}<span
                                                        class="text-danger"></span> </td>
                                                <td scope="col"> {{ ___('examination.mark_distribution') }} <span
                                                        class="text-danger"></span> </td>
                                            </tr>
                                        </thead>
                                        <tbody id="main">

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-lg ot-btn-primary"><span><i
                                                class="fa-solid fa-save"></i>
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
    <script>
        // Start get exam assign section
        function changeExamAssignClass(element) {


            var id = $(element).val();
            var url = $('#url').val();

            if ($("#form_type").val() == "update") {
                $("div .subjects .current").html($("div .subjects .list li:first").html());
                $("#subject_marks_distribute tbody#main").html('');
            } else {
                $("#elect2-subjectMark-container").html('');

                $("select.subjects option").not(':first').remove();


                $("div .subjects .current").html($("div .subjects .list li:first").html());
                $("div .subjects .list li").not(':first').remove();

                $("#subject_marks_distribute tbody#main").html('');

            }

            var formData = {
                id: id,
            }
            $.ajax({
                type: "GET",
                dataType: 'html',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + '/exam-assign/get-sections',
                success: function(data) {

                    var sections = '';
                    $.each(JSON.parse(data), function(i, item) {

                        sections += "<div class='form-check'>";
                        sections +=
                            "<input class='form-check-input sections' onclick='return checkSection(this)' type='checkbox' name='sections[]' value=" +
                            item.section.id + " id='flexCheckDefault' />";
                        sections +=
                            "<label class='form-check-label ps-2 pe-5' for='flexCheckDefault'>" + item
                            .section.name + "</label>";
                        sections += "</div>";

                    });

                    $(".exam-assign-section").html(sections);

                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
        // End get exam assign section
    </script>


    <script>
        function checkSection(element) {

            var classes_id = $(".class").val();
            var url = $('#url').val();

            var current_section = '';
            var sections = [];

            if ($("#form_type").val() == "update") {
                $("input[name^='sections']").map(function(idx, ele) {
                    if ($(ele).val() != $(element).val()) {
                        $(ele).prop('checked', false);
                    }
                });
                if ($(element).is(':checked')) {
                    var current_section = $(element).val();
                }
                $("#subject_marks_distribute tbody#main").html('');
            } else {
                if ($(element).is(':checked')) {
                    var current_section = $(element).val();
                }
                var sections = $("input[name^='sections']").map(function(idx, ele) {
                    if ($(ele).is(':checked')) {
                        return $(ele).val();
                    }
                }).get();
            }

            var formData = {
                classes_id: classes_id,
                section_id: current_section,
                sections: sections,
                form_type: $("#form_type").val(),
            }

            $.ajax({
                type: "GET",
                dataType: 'json',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + '/exam-assign/get-subjects',
                async: false,
                success: function(data) {

                    if ($("#form_type").val() == "update") {

                        var section_options = '';
                        var section_li = '';

                        $.each(data.subjects, function(i, item) {
                            section_options += "<option value=" + item.subject.id + ">" + item.subject
                                .name + "</option>";
                            section_li += "<li data-value=" + item.subject.id + " class='option'>" +
                                item.subject.name + "</li>";
                        });

                        $("select.subjects option").not(':first').remove();
                        $("select.subjects").append(section_options);

                        $("div .subjects .current").html($("div .subjects .list li:first").html());
                        $("div .subjects .list li").not(':first').remove();
                        $("div .subjects .list").append(section_li);

                    } else {

                        if (data.loop_status) {

                            var subject_options = '';

                            $.each(data.subjects, function(i, item) {
                                subject_options += "<option value=" + item.subject.id + ">" + item
                                    .subject.name + "</option>";
                            });

                            $("select.subjects option").not(':first').remove();
                            $("select.subjects").append(subject_options);

                            if (subject_options == '') {
                                $("#subject_marks_distribute tbody#main").html('');
                            }
                        }

                        if (current_section != '' && data.section_status == false) {
                            Toast.fire({
                                icon: 'error',
                                title: data.message
                            });
                            $(element).prop('checked', false);
                        }
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });

        }
    </script>
@endpush
