@extends('backend.parent.partials.master')

@section('title')
    {{ @$data['headers']['title'] }}
@endsection

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
                                            {{ ___('index.Day/Time') }}</th>
                                        @foreach ($data['time'] as $item)
                                            <th style="border: 1px solid #dee2e6; padding: 4px;">
                                                {{ $item->timeSchedule->start_time }} - {{ $item->timeSchedule->end_time }}
                                            </th>
                                        @endforeach
                                    </tr>

                                    @php
                                        $n = 0;
                                    @endphp
                                    @foreach (\Config::get('site.days') as $key => $item)
                                        <tr>
                                            <th style="border: 1px solid #dee2e6; padding: 3px;">{{ ___($item) }}</th>
                                            @if (isset($data['result'][$n]))
                                                @if ($data['result'][$n]->day == $key)
                                                    @foreach ($data['time'] as $key => $item0)
                                                        <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                            @foreach ($data['result'][$n]->classRoutineChildren as $item)
                                                                @if ($item->time_schedule_id == $item0->time_schedule_id)
                                                                    {{ $item->subject->name }} <br>
                                                                    {{-- @foreach ($data['result'][$n]->TeacherName->subjectTeacher as $item2)
                                                                        @if ($item2->subject_id == $item->subject->id)
                                                                            {{ $item2->teacher->first_name }}
                                                                            {{ $item2->teacher->last_name }}
                                                                        @endif
                                                                    @endforeach --}}
                                                                    <small>
                                                                        {{ ___('index.Room No') }}:
                                                                        {{ $item->classRoom->room_no }}
                                                                    </small>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    @endforeach
                                                    @php
                                                        ++$n;
                                                    @endphp
                                                @else
                                                    @foreach ($data['time'] as $item)
                                                        <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                            -
                                                        </td>
                                                    @endforeach
                                                @endif
                                            @else
                                                @foreach ($data['time'] as $item)
                                                    <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                        -
                                                    </td>
                                                @endforeach
                                            @endif
                                        </tr>
                                    @endforeach

                                </table>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-secondary" onclick="printDiv('print')">
                    {{ ___('index.Print') }}
                    <span><i class="fa-solid fa-print"></i></span>
                </button>
            </div>
        @endif
    </div>
@endsection

@push('script')

    <script src="{{ asset('backend/js/get-section.js') }}"></script>

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
