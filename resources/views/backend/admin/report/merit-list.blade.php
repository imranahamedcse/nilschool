@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['headers']['title'] }}
@endsection

@push('style')
    @include('backend.admin.components.table.css')
@endpush

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="p-4 rounded-3 bg-white">
        @include('backend.admin.components.table.header')
        
        @if ($data['resultData'])
            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th>{{ ___('common.#') }}</th>
                        <th>{{ ___('student_info.Student Name') }}</th>
                        <th>{{ ___('student_info.admission_no') }}</th>
                        <th>{{ ___('academic.class') }} ({{ ___('academic.section') }})</th>
                        <th>{{ ___('report.Position') }}</th>
                        <th>{{ ___('report.Result') }}</th>
                        <th>{{ ___('report.Point') }}</th>
                        <th>{{ ___('report.Grade') }}</th>
                        <th>{{ ___('report.Total Mark') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['resultData'] as $key=>$item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ @$item->student->first_name }} {{ @$item->student->last_name }}</td>
                            <td>{{ @$item->student->admission_no }}</td>
                            <td>{{ @$item->student->session_class_student->class->name }}
                                ({{ @$item->student->session_class_student->section->name }})
                            </td>
                            <td>{{ @$key }}</td>
                            <td>{{ @$item->result }}</td>
                            <td>{{ @$item->grade_point }}</td>
                            <td>{{ @$item->grade_name }}</td>
                            <td>{{ @$item->total_marks }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="td-text-center">
                                @include('backend.includes.no-data')
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif
    </div>
@endsection

@push('script')
    @include('backend.admin.components.table.js')
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
@endpush
