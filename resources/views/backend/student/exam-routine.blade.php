@extends('backend.student.partials.master')

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
                                    <thead>
                                        <tr>
                                            <th style="border: 1px solid #dee2e6; padding: 4px;">Day/Time</th>
                                            @foreach ($data['time'] as $item)
                                                <th style="border: 1px solid #dee2e6; padding: 4px;">
                                                    {{ $item->timeSchedule->start_time }} -
                                                    {{ $item->timeSchedule->end_time }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['result'] as $item)
                                            <tr>
                                                <th style="border: 1px solid #dee2e6; padding: 3px;">
                                                    {{ dateFormat($item->date) }}</th>
                                                @foreach ($data['time'] as $item2)
                                                    <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                        @foreach ($item->examRoutineChildren as $item3)
                                                            @if ($item3->time_schedule_id == $item2->time_schedule_id)
                                                                <strong>{{ @$item3->subject->name }}</strong> <br> Room No:
                                                                {{ @$item3->classRoom->room_no }}
                                                            @else
                                                                -
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
    @include('backend.admin.components.table.js')

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
