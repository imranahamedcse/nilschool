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

            @isset($data['staffs'])
                @if (@$data['status'] == 1)
                    <div class="alert alert-warning text-center">
                        {{ ___('index.Attendance already collected! You can edit record.') }}
                    </div>
                @endif

                <form action="{{ route('staff-attendance.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!--  start hidden items -->
                    <input type="hidden" name="status" value="{{ @$data['status'] }}">
                    <input type="hidden" name="department" value="{{ @$data['request']->department }}">
                    <input type="hidden" name="date" value="{{ @$data['request']->date }}">
                    <!--  end -->

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="holidayId" name="holiday">
                        <label class="form-check-label" for="holidayId">
                            {{ ___('index.Holiday') }}
                        </label>
                    </div>


                    <table id="datatable" class="table">
                        <thead class="thead">
                            <tr>
                                <th class="purchase">{{ ___('index.staff_id') }}</th>
                                <th class="purchase">{{ ___('index.name') }}</th>
                                <th class="purchase">{{ ___('index.roles') }}</th>
                                <th class="purchase">{{ ___('index.Attendance') }}</th>
                                <th class="purchase">{{ ___('index.Note') }}</th>
                            </tr>
                        </thead>
                        <tbody>


                            @forelse ($data['staffs'] as $item)

                                <tr id="document-file">
                                    <td class="serial">{{ @$item->staff_id ?? @$item->staff->id }}</td>
                                    <td>{{ @$item->first_name ?? @$item->staff->first_name }} {{ @$item->last_name ?? @$item->staff->last_name }}</td>
                                    <td>{{ @$item->role->name ?? @$item->staff->role->name }}</td>
                                    <td>

                                        <!--  start hidden items -->
                                        <input type="hidden" name="items[]" value="{{ @$item->id }}">
                                        <input type="hidden" name="staffs[]" value="{{ @$item->id }}">
                                        <!--  end -->

                                        <div
                                            class="remember-me d-flex align-items-center input-check-radio mb-20 gap-4 attendance">
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input {{ @$item->attendance == App\Enums\AttendanceType::PRESENT ? 'checkedItem' : '' }}"
                                                    type="radio" id="flexRadioDefault1"
                                                    name="attendance[{{ @$item->id }}]"
                                                    value="{{ App\Enums\AttendanceType::PRESENT }}"
                                                    {{ @$item->attendance == App\Enums\AttendanceType::PRESENT ? 'checked' : '' }} />
                                                <label class="form-check-label"
                                                    for="flexRadioDefault1">{{ ___('index.Present') }}</label>
                                            </div>
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input {{ @$item->attendance == App\Enums\AttendanceType::LATE ? 'checkedItem' : '' }}"
                                                    type="radio" id="flexRadioDefault2"
                                                    name="attendance[{{ @$item->id }}]"
                                                    value="{{ App\Enums\AttendanceType::LATE }}"
                                                    {{ @$item->attendance == App\Enums\AttendanceType::LATE ? 'checked' : '' }} />
                                                <label class="form-check-label"
                                                    for="flexRadioDefault2">{{ ___('index.Late') }}</label>
                                            </div>
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input {{ @$item->attendance == App\Enums\AttendanceType::ABSENT ? 'checkedItem' : '' }}"
                                                    type="radio" id="flexRadioDefault3"
                                                    name="attendance[{{ @$item->id }}]"
                                                    value="{{ App\Enums\AttendanceType::ABSENT }}"
                                                    {{ @$item->attendance == App\Enums\AttendanceType::ABSENT ? 'checked' : '' }}{{ @$data['status'] == 1 && @$item->attendance == null ? 'checked' : '' }}{{ @$data['status'] == 0 ? 'checked' : '' }} />
                                                <label class="form-check-label"
                                                    for="flexRadioDefault3">{{ ___('index.Absent') }}</label>
                                            </div>
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input {{ @$item->attendance == App\Enums\AttendanceType::HALFDAY ? 'checkedItem' : '' }}"
                                                    type="radio" id="flexRadioDefault4"
                                                    name="attendance[{{ @$item->id }}]"
                                                    value="{{ App\Enums\AttendanceType::HALFDAY }}"
                                                    {{ @$item->attendance == App\Enums\AttendanceType::HALFDAY ? 'checked' : '' }} />
                                                <label class="form-check-label"
                                                    for="flexRadioDefault4">{{ ___('index.Half Day') }}</label>
                                            </div>
                                        </div>

                                    </td>
                                    <td>
                                        <input class="form-control" name="note[]" placeholder="{{ ___('index.Note') }}"
                                            value="{{ old('note', @$item->note) }}">
                                    </td>
                                </tr>
                            @empty
                                @include('backend.admin.components.table.empty')
                            @endforelse
                        </tbody>

                    </table>

                    @if (hasPermission('attendance_create'))
                        <div class="pagination pagination-content d-flex justify-content-end align-content-center pt-3">
                            <button class="btn btn-primary" type="submit">
                                {{ ___('index.submit') }}
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        @else
            <div class="text-center">
                @include('backend.admin.components.table.empty')
            </div>
            @endif
        </div>
    @endsection
