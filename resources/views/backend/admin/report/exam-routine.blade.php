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
            @if (@$data['result']->count() > 0)
                <table id="datatable" class="table">
                    <thead>
                        <tr>
                            <th class="marked_bg">{{ ___('report.Day/Time') }}</th>
                            @foreach ($data['time'] as $item)
                                <th>{{ $item->timeSchedule->start_time }} - {{ $item->timeSchedule->end_time }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['result'] as $item)
                            <tr>
                                <th>{{ dateFormat($item->date) }}</th>
                                @foreach ($data['time'] as $item2)
                                    <td>
                                        @foreach ($item->examRoutineChildren as $item3)
                                            @if ($item3->time_schedule_id == $item2->time_schedule_id)
                                                <div class="classBox_wiz">
                                                    <h5>{{ @$item3->subject->name }}</h5>
                                                    <p>{{ ___('report.Room No') }}: {{ @$item3->classRoom->room_no }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
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
