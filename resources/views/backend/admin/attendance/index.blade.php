@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@push('style')
    @include('backend.admin.components.table.css')
@endpush

@section('content')
    @include('backend.admin.components.breadcrumb')


    <div class="card">
        <div class="card-body">

            @include('backend.admin.components.table.header')
            
            @isset($data['students'])
                @if (@$data['status'] == 1)
                    <div class="alert alert-warning text-center">
                        {{ ___('attendance.Attendance already collected! You can edit record.') }}
                    </div>
                @endif

                <form action="{{ route('attendance.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!--  start hidden items -->
                    <input type="hidden" name="status" value="{{ @$data['status'] }}">
                    <input type="hidden" name="class" value="{{ @$data['request']->class }}">
                    <input type="hidden" name="section" value="{{ @$data['request']->section }}">
                    <input type="hidden" name="date" value="{{ @$data['request']->date }}">
                    <!--  end -->

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="holidayId" name="holiday">
                        <label class="form-check-label" for="holidayId">
                            {{ ___('attendance.Holiday') }}
                        </label>
                    </div>


                    <table id="datatable" class="table">
                        <thead class="thead">
                            <tr>
                                <th class="purchase">{{ ___('student_info.Student Name') }}</th>
                                <th class="purchase">{{ ___('student_info.roll_no') }}</th>
                                <th class="purchase">{{ ___('student_info.admission_no') }}</th>
                                <th class="purchase">{{ ___('student_info.class') }}
                                    ({{ ___('student_info.section') }})</th>
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
                                    <td>

                                        <!--  start hidden items -->
                                        <input type="hidden" name="items[]" value="{{ @$item->id }}">
                                        <input type="hidden" name="students[]" value="{{ @$item->student->id }}">
                                        <input type="hidden" name="studentsRoll[]" value="{{ @$item->roll }}">
                                        <!--  end -->

                                        <div
                                            class="remember-me d-flex align-items-center input-check-radio mb-20 gap-4 attendance">
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input {{ @$item->attendance == App\Enums\AttendanceType::PRESENT ? 'checkedItem' : '' }}"
                                                    type="radio" id="flexRadioDefault1"
                                                    name="attendance[{{ @$item->student->id }}]"
                                                    value="{{ App\Enums\AttendanceType::PRESENT }}"
                                                    {{ @$item->attendance == App\Enums\AttendanceType::PRESENT ? 'checked' : '' }} />
                                                <label class="form-check-label"
                                                    for="flexRadioDefault1">{{ ___('attendance.Present') }}</label>
                                            </div>
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input {{ @$item->attendance == App\Enums\AttendanceType::LATE ? 'checkedItem' : '' }}"
                                                    type="radio" id="flexRadioDefault2"
                                                    name="attendance[{{ @$item->student->id }}]"
                                                    value="{{ App\Enums\AttendanceType::LATE }}"
                                                    {{ @$item->attendance == App\Enums\AttendanceType::LATE ? 'checked' : '' }} />
                                                <label class="form-check-label"
                                                    for="flexRadioDefault2">{{ ___('attendance.Late') }}</label>
                                            </div>
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input {{ @$item->attendance == App\Enums\AttendanceType::ABSENT ? 'checkedItem' : '' }}"
                                                    type="radio" id="flexRadioDefault3"
                                                    name="attendance[{{ @$item->student->id }}]"
                                                    value="{{ App\Enums\AttendanceType::ABSENT }}"
                                                    {{ @$item->attendance == App\Enums\AttendanceType::ABSENT ? 'checked' : '' }}{{ @$data['status'] == 1 && @$item->attendance == null ? 'checked' : '' }}{{ @$data['status'] == 0 ? 'checked' : '' }} />
                                                <label class="form-check-label"
                                                    for="flexRadioDefault3">{{ ___('attendance.Absent') }}</label>
                                            </div>
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input {{ @$item->attendance == App\Enums\AttendanceType::HALFDAY ? 'checkedItem' : '' }}"
                                                    type="radio" id="flexRadioDefault4"
                                                    name="attendance[{{ @$item->student->id }}]"
                                                    value="{{ App\Enums\AttendanceType::HALFDAY }}"
                                                    {{ @$item->attendance == App\Enums\AttendanceType::HALFDAY ? 'checked' : '' }} />
                                                <label class="form-check-label"
                                                    for="flexRadioDefault4">{{ ___('attendance.Half Day') }}</label>
                                            </div>
                                        </div>

                                    </td>
                                    <td>
                                        <input class="form-control ot-input" name="note[]"
                                            placeholder="{{ ___('attendance.Note') }}"
                                            value="{{ old('note', @$item->note) }}">
                                    </td>
                                </tr>
                            @empty
                                @include('backend.admin.components.table.empty')
                            @endforelse
                        </tbody>

                    </table>

                    @if (hasPermission('attendance_create'))
                        <div class="ot-pagination pagination-content d-flex justify-content-end align-content-center pt-3">
                            <button class="btn btn-primary" type="submit">
                                {{ ___('common.submit') }}
                            </button>
                        </div>
                    @endif
                </form>
            </div>

            @endif
        </div>
    @endsection

    @push('script')
        @include('backend.admin.components.table.js')
        @include('backend.admin.components.table.delete-ajax')

        <script src="{{ asset('backend/js/get-section.js') }}"></script>
    @endpush
