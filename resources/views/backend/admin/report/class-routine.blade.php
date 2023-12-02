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
                    @php
                        $n = 0;
                    @endphp
                    @foreach (\Config::get('site.days') as $key => $item)
                        <tr>
                            <th>{{ ___($item) }}</th>
                            @if (isset($data['result'][$n]))
                                @if ($data['result'][$n]->day == $key)
                                    @foreach ($data['time'] as $key => $item0)
                                        <td>
                                            @foreach ($data['result'][$n]->classRoutineChildren as $item)
                                                @if ($item->time_schedule_id == $item0->time_schedule_id)
                                                    <div class="classBox_wiz">
                                                        {{ $item->subject->name }} <br>
                                                        {{-- @foreach ($data['result'][$n]->TeacherName->subjectTeacher as $item2)
                                                            @if ($item2->subject_id == $item->subject->id)
                                                                {{$item2->teacher->first_name}} {{$item2->teacher->last_name}}
                                                            @endif
                                                        @endforeach --}}
                                                        {{ ___('report.Room No') }}: {{ $item->classRoom->room_no }}
                                                    </div>
                                                @endif
                                            @endforeach
                                        </td>
                                    @endforeach
                                    @php
                                        ++$n;
                                    @endphp
                                @else
                                    @foreach ($data['time'] as $item)
                                        <td></td>
                                    @endforeach
                                @endif
                            @else
                                @foreach ($data['time'] as $item)
                                    <td></td>
                                @endforeach
                            @endif
                        </tr>
                    @endforeach


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
@endpush
