@extends('backend.parent.partials.master')

@section('title')
    {{ $data['title'] }}
@endsection

@push('style')
    @include('backend.admin.components.table.css')
@endpush

@section('content')

    @include('backend.admin.components.breadcrumb')

    <div class="card bg-white">
        <div class="card-body">

            @include('backend.admin.components.table.header')

            @if (@$data['results'] != null)

                @if (@$data['request']->view == '0')
                    <div class="text-end mb-3">
                        <strong>
                            <span class="text-success">{{ ___('index.Present') }} = {{ ___('index.P') }}</span>
                            <span class="text-warning">{{ ___('index.Late') }} = {{ ___('index.L') }}</span>
                            <span class="text-danger">{{ ___('index.Absent') }} = {{ ___('index.A') }}</span>
                            <span class="text-primary">{{ ___('index.Half day') }} = {{ ___('index.F') }}</span>
                            <span>{{ ___('index.Holiday') }} = {{ ___('index.H') }}</span>
                        </strong>
                    </div>
                @endif

                <div class="table-responsive pb-3">
                    @if (@$data['request']->view == '0')
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    @for ($i = 1; $i < date('t'); $i++)
                                        <th>{{ $i }}</th>
                                    @endfor
                                    <th class="purchase text-success">{{ ___('index.P') }}</th>
                                    <th class="purchase text-warning">{{ ___('index.L') }}</th>
                                    <th class="purchase text-danger">{{ ___('index.A') }}</th>
                                    <th class="purchase text-primary">{{ ___('index.F') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @php
                                        $p = 0;
                                        $l = 0;
                                        $a = 0;
                                        $f = 0;
                                    @endphp
                                    @for ($i = 1; $i < date('t'); $i++)
                                        <td>
                                            @foreach ($data['results'] as $item)
                                                @if ((int) substr($item->date, -2) == $i)
                                                    @if (@$item->attendance == App\Enums\AttendanceType::PRESENT)
                                                        <span class="text-success">{{ ___('index.P') }}</span>
                                                        @php
                                                            ++$p;
                                                        @endphp
                                                    @elseif(@$item->attendance == App\Enums\AttendanceType::LATE)
                                                        <span class="text-warning">{{ ___('index.L') }}</span>
                                                        @php
                                                            ++$l;
                                                        @endphp
                                                    @elseif(@$item->attendance == App\Enums\AttendanceType::ABSENT)
                                                        <span class="text-danger">{{ ___('index.A') }}</span>
                                                        @php
                                                            ++$a;
                                                        @endphp
                                                    @elseif(@$item->attendance == App\Enums\AttendanceType::HALFDAY)
                                                        <span class="text-primary">{{ ___('index.F') }}</span>
                                                        @php
                                                            ++$f;
                                                        @endphp
                                                    @else
                                                        <span>{{ ___('index.H') }}</span>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                    @endfor
                                    <td><span class="text-success">{{ $p }}</span></td>
                                    <td><span class="text-warning">{{ $l }}</span></td>
                                    <td><span class="text-danger">{{ $a }}</span></td>
                                    <td><span class="text-primary">{{ $f }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <table class="table table-bordered role-table" id="students_table">
                            <thead class="thead">
                                <tr>
                                    <th class="purchase">{{ ___('index.date') }}</th>
                                    <th class="purchase">{{ ___('index.Attendance') }}</th>
                                    <th class="purchase">{{ ___('index.Note') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['results'] as $item)
                                    <tr>
                                        <td>
                                            @if (@$item->attendance == App\Enums\AttendanceType::PRESENT)
                                                <span class="badge-basic-success-text">{{ ___('index.Present') }}</span>
                                            @elseif(@$item->attendance == App\Enums\AttendanceType::LATE)
                                                <span class="badge-basic-warning-text">{{ ___('index.Late') }}</span>
                                            @elseif(@$item->attendance == App\Enums\AttendanceType::ABSENT)
                                                <span class="badge-basic-danger-text">{{ ___('index.Absent') }}</span>
                                            @elseif(@$item->attendance == App\Enums\AttendanceType::HALFDAY)
                                                <span class="badge-basic-primary-text">{{ ___('index.Half day') }}</span>
                                            @else
                                                <span class="badge-basic-info-text">{{ ___('index.Holiday') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ dateFormat(@$item->date) }}</td>
                                        <td>
                                            {{ old('note', @$item->note) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center gray-color">
                                            <img src="{{ asset('images/no_data.svg') }}" alt="" class="mb-primary"
                                                width="100">
                                            <p class="mb-0 text-center">{{ ___('index.No data available') }}</p>
                                            <p class="mb-0 text-center text-secondary font-size-90">
                                                {{ ___('index.Please add new entity regarding this table') }}</p>
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
