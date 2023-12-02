@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['headers']['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="p-4 rounded-3 bg-white">
        @include('backend.admin.components.table.header')

        @if (@$data['resultData'])
        
                <div class="d-flex justify-content-center align-items-center mb-3">
        
                    <div id="print" class="border" style="width: 8.27in; height: 11in; padding: 1in;">
                        <table style="width: 100%;">
                            <tr class="top">
                                <td colspan="3">
                                    <div style="text-align: center;">
                                        <span
                                            style="font-size: 22px; font-weight: 600; color: #23B7E5;">{{ setting('application_name') }}</span><br>
                                        <span style="font-size: 14px;">{{ setting('address') }}</span> <br><br>
                                        <span
                                            style="font-size: 22px; font-weight: 600; color: #23B7E5;">{{ @$data['headers']['title'] }}</span>
                                    </div>
                                </td>
                            </tr>
        
                            <tr>
                                <td colspan="3">
                                    <table style="width: 100%; margin-top: 75px;">
                                        <tr>
                                            <td>
                                                <span style="font-size: 18px; font-weight: 600;">Student Info</span><br>
                                                <div style="font-size: 14px;">
                                                    {{ @$data['student']->first_name }} {{ @$data['student']->last_name }} <br>
                                                    {{ dateFormat(@$data['student']->dob) }} <br>
                                                    {{ @$data['student']->session_class_student->class->name }}
                                                    ({{ @$data['student']->session_class_student->section->name }})
                                                </div>
                                            </td>
                                            <td>
                                                <div style="text-align: right;">
                                                    <span style="font-size: 18px; font-weight: 600;">Guardian Info</span><br>
                                                    <div style="font-size: 14px;">
                                                        {{ @$data['student']->parent->guardian_name }} <br>
                                                        {{ @$data['student']->parent->guardian_mobile }} <br>
                                                        {{ @$data['student']->parent->guardian_email }}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
        
                            <tr>
                                <td>
                                    <table
                                        style="width: 100%; margin-top: 25px; font-size: 14px; border-collapse: collapse;">
                                        <tr>
                                            <th style="border: 1px solid #dee2e6; padding: 4px; text-align: left;">
                                                {{ ___('report.Subject Code') }}</th>
                                            <th style="border: 1px solid #dee2e6; padding: 4px; text-align: left;">
                                                {{ ___('report.Subject Name') }}</th>
                                            <th style="border: 1px solid #dee2e6; padding: 4px; text-align: right;">
                                                {{ ___('report.Grade') }}</th>
                                        </tr>
                                        @php
                                            $totalMark = 0;
                                        @endphp
                                        @forelse (@$data['resultData']['marks_registers'] as $item)
                                            <tr>
                                                <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                    {{ $item->subject->code }}
                                                </td>
                                                <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                    {{ $item->subject->name }}
                                                </td>
                                                <td style="border: 1px solid #dee2e6; padding: 3px; text-align: right;">
                                                    @php
                                                        $n = 0;
                                                    @endphp
                                                    @foreach ($item->marksRegisterChilds as $item)
                                                        @php
                                                            $n += $item->mark;
                                                        @endphp
                                                    @endforeach
                                                    @php
                                                        $totalMark += $n;
                                                    @endphp
                                                    {{ markGrade($n) }}
                                                </td>
                                            </tr>
                                        @empty
                                            @include('backend.admin.components.table.empty')
                                        @endforelse
        
                                        <tr>
                                            <td></td>
                                            <td style="padding: 3px; text-align: right;">Total mark - </td>
                                            <td
                                                style="border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6; padding: 3px; text-align: right;">
                                                {{ $totalMark }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td style="padding: 3px; text-align: right;">GPA - </td>
                                            <td
                                                style="border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6; padding: 3px; text-align: right;">
                                                @if ($data['resultData']['result'] == 'Passed')
                                                    {{ @$data['resultData']['gpa'] }}
                                                @else
                                                    {{ '0.00' }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <th style="padding: 3px; text-align: right;">Result - </th>
                                            <th style="border: 1px solid #dee2e6; padding: 3px; text-align: right;">
                                                {{ @$data['resultData']['result'] }}
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td
                                                style="border-bottom: 1px solid #dee2e6; padding: 3px; text-align: center;">
                                                <div style="margin-top: 50px;">Signature</div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
        
                            <tr>
                                <td colspan="3" style="text-align: center;">
                                    <div style="margin-top: 50px;">
                                        <small>Thank you.</small>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-secondary" onclick="printDiv('print')">
                        {{ ___('common.Print') }}
                        <span><i class="fa-solid fa-print"></i></span>
                    </button>
                </div>
            
        @endif
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
    <script>
        // Marksheet students start
        $("#getSections").on('change', function(e) {
            getStudents();
        });
        $(".sections").on('change', function(e) {
            getStudents();
        });

        // Start Class Section wise get Students
        function getStudents() {
            var url = $('#url').val();
            var classId = $("#getSections").val();
            var sectionId = $(".sections").val();
            var formData = {
                class: classId,
                section: sectionId,
            }

            if (classId && sectionId) {
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/report-marksheet/get-students',
                    success: function(data) {
                        var student_options = '';
                        var student_li = '';
                        $.each(data, function(i, item) {
                            student_options += "<option value=" + item.student_id + ">" + item.student
                                .first_name + ' ' + item.student.last_name + "</option>";
                            student_li += "<li data-value=" + item.student_id + " class='option'>" +
                                item.student.first_name + ' ' + item.student.last_name + "</li>";
                        });

                        $("select.students option").not(':first').remove();
                        $("select.students").append(student_options);

                        $("div .students .current").html($("div .students .list li:first").html());
                        $("div .students .list li").not(':first').remove();
                        $("div .students .list").append(student_li);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        }
        // Marksheet students end.
    </script>

    <script>
        // Report start
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
        // Report end
    </script>
@endpush
