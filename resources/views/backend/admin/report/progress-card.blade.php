@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['headers']['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="p-4 rounded-3 bg-white">
        @include('backend.admin.components.table.header')

        @if (@$data['marks_registers'])
            <div class="d-flex justify-content-center align-items-center mb-3">

                <div id="print" class="border" style="width: 8.27in; height: 11in; padding: 1in;">
                    <table style="width: 100%;">
                        <tr class="top">
                            <td colspan="3">
                                <div style="text-align: center;">
                                    <span
                                        style="font-size: 22px; font-weight: 600; color: #23B7E5;">{{ setting('application_name') }}</span><br>
                                    <span style="font-size: 14px;">{{ setting('address') }}</span> <br>
                                    <span
                                        style="font-size: 22px; font-weight: 600; color: #23B7E5;">{{ @$data['headers']['title'] }}</span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">
                                <table style="width: 100%; margin-top: 25px;">
                                    <tr>
                                        <td>
                                            <span style="font-size: 18px; font-weight: 600;">Student Info</span><br>
                                            <div style="font-size: 14px;">
                                                {{ @$data['student']->first_name }} {{ @$data['student']->last_name }} <br>
                                                {{ @$data['student']->session_class_student->class->name }}
                                                ({{ @$data['student']->session_class_student->section->name }}) <br>
                                                {{ ___('common.Roll No') }} :
                                                {{ @$data['student']->session_class_student->roll }}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">
                                <table style="width: 100%; margin-top: 25px; font-size: 14px; border-collapse: collapse;">
                                    <tr>
                                        <th style="border: 1px solid #dee2e6; padding: 4px; text-align: left;">
                                            {{ ___('report.Subject Code') }}</th>
                                        <th style="border: 1px solid #dee2e6; padding: 4px; text-align: left;">
                                            {{ ___('report.Subject Name') }}</th>
                                        @foreach (@$data['exams'] as $item)
                                            <th style="border: 1px solid #dee2e6; padding: 4px; text-align: right;">
                                                {{ $item->exam_type->name }}
                                                <small>{{ ___('report.Mark') }}</small>
                                            </th>
                                        @endforeach
                                    </tr>

                                    @foreach (@$data['subjects'] as $item)
                                        <tr>
                                            <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                {{ $item->subject->code }}
                                            </td>
                                            <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                {{ $item->subject->name }}
                                            </td>
                                            @foreach (@$data['exams'] as $key => $exam)
                                                <td style="border: 1px solid #dee2e6; padding: 3px; text-align: right;">
                                                    @foreach ($data['marks_registers'][$key] as $result)
                                                        @if ($result->subject_id == $item->subject->id)
                                                            @php
                                                                $n = 0;
                                                            @endphp
                                                            @foreach ($result->marksRegisterChilds as $mark)
                                                                @php
                                                                    $n += $mark->mark;
                                                                @endphp
                                                            @endforeach
                                                            {{ $n }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach

                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">
                                <table style="width: 100%; margin-top: 25px; font-size: 14px; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <th style="border: 1px solid #dee2e6; padding: 4px; text-align: left;">
                                                {{ ___('report.Exam Name') }}</th>
                                            <th style="border: 1px solid #dee2e6; padding: 4px; text-align: left;">
                                                {{ ___('report.Result') }}</th>
                                            <th style="border: 1px solid #dee2e6; padding: 4px; text-align: left;">
                                                {{ ___('report.GPA') }}</th>
                                            <th style="border: 1px solid #dee2e6; padding: 4px; text-align: left;">
                                                {{ ___('report.Total Marks') }}</th>
                                            <th style="border: 1px solid #dee2e6; padding: 4px; text-align: left;">
                                                {{ ___('report.Avg Marks') }}</th>
                                            <th style="border: 1px solid #dee2e6; padding: 4px; text-align: left;">
                                                {{ ___('report.Avg Grade') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['exams'] as $key => $item)
                                            <tr>
                                                <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                    {{ $item->exam_type->name }}</td>
                                                <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                    {{ $data['result'][$key] }}</td>
                                                <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                    {{ $data['result'][$key] == 'Failed' ? '0.00' : $data['gpa'][$key] }}
                                                </td>
                                                <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                    {{ $data['total_marks'][$key] }}</td>
                                                <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                    {{ substr($data['avg_marks'][$key], 0, 5) }}</td>
                                                <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                    {{ $data['result'][$key] == 'Failed' ? 'F' : markGrade((int) $data['avg_marks'][$key]) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5"></td>
                                            <td style="border-bottom: 1px solid #dee2e6; padding: 3px; text-align: center;">
                                                <div style="margin-top: 50px;">Signature</div>
                                            </td>
                                        </tr>
                                    </tbody>
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
