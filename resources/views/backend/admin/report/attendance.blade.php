@extends('backend.admin.partial.master')

@section('title')
    {{ ___('common.Online Class Routine 2023') }}
@endsection

@push('style')
    @include('backend.admin.components.table.css')
@endpush

@section('content')

    @include('backend.admin.components.breadcrumb')

    <div class="card bg-white">
        <div class="card-body">

            @include('backend.admin.components.table.header')

            @if (@$data['students'] != null)

                @if (@$data['request']->view == '0')
                    <div class="text-end mb-3">
                        <strong>
                            <span class="text-success">{{ ___('attendance.Present') }} = {{ ___('common.P') }}</span>
                            <span class="text-warning">{{ ___('attendance.Late') }} = {{ ___('common.L') }}</span>
                            <span class="text-danger">{{ ___('attendance.Absent') }} = {{ ___('common.A') }}</span>
                            <span class="text-primary">{{ ___('attendance.Half day') }} = {{ ___('common.F') }}</span>
                            <span>{{ ___('attendance.Holiday') }} = {{ ___('common.H') }}</span>
                        </strong>
                    </div>
                @endif

                <div class="table-responsive pb-3">
                    @if (@$data['request']->view == '0')
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th class="purchase">{{ ___('common.name') }}</th>
                                    <th class="purchase">{{ ___('student_info.roll_no') }}</th>
                                    <th class="purchase">{{ ___('student_info.admission_no') }}</th>
                                    @foreach ($data['days'] as $day => $date)
                                        <th>{{ ++$day }}</th>
                                    @endforeach
                                    <th class="purchase text-success">{{ ___('common.P') }}</th>
                                    <th class="purchase text-warning">{{ ___('common.L') }}</th>
                                    <th class="purchase text-danger">{{ ___('common.A') }}</th>
                                    <th class="purchase text-primary">{{ ___('common.F') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (@$data['students'] as $item)
                                    <tr>
                                        <td class="w-150">{{ @$item->student->first_name . ' ' . @$item->student->last_name }}</td>
                                        <td>{{ @$item->roll }}</td>
                                        <td>{{ @$item->student->admission_no }}</td>
                                        @php
                                            $p = 0;
                                            $l = 0;
                                            $a = 0;
                                            $f = 0;
                                        @endphp
                                        @foreach ($data['days'] as $day => $date)
                                            @php
                                                $i = ++$day;
                                            @endphp
                                            <td>
                                                @foreach ($data['attendances'] as $item2)
                                                    @if ($item->student_id == $item2->student_id && (int) substr($item2->date, -2) == $i)
                                                        @if (@$item2->attendance == App\Enums\AttendanceType::PRESENT)
                                                            <span class="text-success">{{ ___('common.P') }}</span>
                                                            @php
                                                                ++$p;
                                                            @endphp
                                                        @elseif(@$item2->attendance == App\Enums\AttendanceType::LATE)
                                                            <span class="text-warning">{{ ___('common.L') }}</span>
                                                            @php
                                                                ++$l;
                                                            @endphp
                                                        @elseif(@$item2->attendance == App\Enums\AttendanceType::ABSENT)
                                                            <span class="text-danger">{{ ___('common.A') }}</span>
                                                            @php
                                                                ++$a;
                                                            @endphp
                                                        @elseif(@$item2->attendance == App\Enums\AttendanceType::HALFDAY)
                                                            <span class="text-primary">{{ ___('common.F') }}</span>
                                                            @php
                                                                ++$f;
                                                            @endphp
                                                        @else
                                                            <span>{{ ___('common.H') }}</span>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endforeach
                                        <td><span class="text-success">{{ $p }}</span></td>
                                        <td><span class="text-warning">{{ $l }}</span></td>
                                        <td><span class="text-danger">{{ $a }}</span></td>
                                        <td><span class="text-primary">{{ $f }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th class="purchase">{{ ___('student_info.Student Name') }}</th>
                                    <th class="purchase">{{ ___('student_info.roll_no') }}</th>
                                    <th class="purchase">{{ ___('student_info.admission_no') }}</th>
                                    <th class="purchase">{{ ___('academic.class') }} ({{ ___('academic.section') }})</th>
                                    <th class="purchase">{{ ___('common.date') }}</th>
                                    <th class="purchase">{{ ___('attendance.Attendance') }}</th>
                                    <th class="purchase">{{ ___('attendance.Note') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['students'] as $item)
                                    <tr id="document-file">
                                        <td>{{ @$item->student->first_name }} {{ @$item->student->last_name }}</td>
                                        <td>{{ @$item->roll }}</td>
                                        <td>{{ @$item->student->admission_no }}</td>
                                        <td>{{ @$item->class->name }} ({{ @$item->section->name }})</td>
                                        <td>{{ dateFormat(@$item->date) }}</td>
                                        <td>
                                            @if (@$item->attendance == App\Enums\AttendanceType::PRESENT)
                                                <span
                                                    class="badge-basic-success-text">{{ ___('attendance.Present') }}</span>
                                            @elseif(@$item->attendance == App\Enums\AttendanceType::LATE)
                                                <span class="badge-basic-warning-text">{{ ___('attendance.Late') }}</span>
                                            @elseif(@$item->attendance == App\Enums\AttendanceType::ABSENT)
                                                <span class="badge-basic-danger-text">{{ ___('attendance.Absent') }}</span>
                                            @elseif(@$item->attendance == App\Enums\AttendanceType::HALFDAY)
                                                <span
                                                    class="badge-basic-primary-text">{{ ___('attendance.Half day') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ old('note', @$item->note) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center gray-color">
                                            <img src="{{ asset('images/no_data.svg') }}" alt="" class="mb-primary"
                                                width="100">
                                            <p class="mb-0 text-center">{{ ___('common.No data available') }}</p>
                                            <p class="mb-0 text-center text-secondary font-size-90">
                                                {{ ___('common.Please add new entity regarding this table') }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @endif
                </div>

            @endif
        </div>
    </div>
@endsection


@push('script')
    <script src="{{ asset('backend/datatable/js') }}/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend/datatable/js') }}/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('backend/datatable/js') }}/dataTables.buttons.min.js"></script>
    <script src="{{ asset('backend/datatable/js') }}/buttons.print.min.js"></script>
    <script src="{{ asset('backend/datatable/js') }}/jszip.min.js"></script>
    <script src="{{ asset('backend/datatable/js') }}/pdfmake.min.js"></script>
    <script src="{{ asset('backend/datatable/js') }}/vfs_fonts.js"></script>
    <script src="{{ asset('backend/datatable/js') }}/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            new DataTable('#datatable', {
                dom: 'Bfrtip',
                buttons: [
                    'print',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
            });
        });
    </script>

    <script src="{{ asset('backend/js/get-section.js') }}"></script>
@endpush
