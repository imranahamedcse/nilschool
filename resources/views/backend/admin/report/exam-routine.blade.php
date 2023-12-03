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

        @if (@$data['result'])
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
                            <td>
                                <table
                                    style="width: 100%; margin-top: 25px; font-size: 14px; border-collapse: collapse; text-align: center;">
                                    <tr>
                                        <th style="border: 1px solid #dee2e6; padding: 4px;">
                                            {{ ___('report.Day/Time') }}</th>
                                        @foreach ($data['time'] as $item)
                                            <th style="border: 1px solid #dee2e6; padding: 4px;">
                                                {{ $item->timeSchedule->start_time }} -
                                                {{ $item->timeSchedule->end_time }}</th>
                                        @endforeach
                                    </tr>
                                    @foreach ($data['result'] as $item)
                                        <tr>
                                            <th style="border: 1px solid #dee2e6; padding: 3px;">
                                                {{ dateFormat($item->date) }}</th>
                                            @foreach ($data['time'] as $item2)
                                                <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                    @foreach ($item->examRoutineChildren as $item3)
                                                        @if ($item3->time_schedule_id == $item2->time_schedule_id)
                                                            {{ @$item3->subject->name }} <br>
                                                            <small>{{ ___('report.Room No') }}:
                                                                {{ @$item3->classRoom->room_no }}</small>
                                                        @else
                                                            -
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
            {{-- @if (@$data['result']->count() > 0)
            @endif --}}
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
