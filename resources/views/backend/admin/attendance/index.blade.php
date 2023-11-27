@extends('backend.admin.partial.master')
@section('title')
    {{ @$data['title'] }}
@endsection
@section('content')
    <div class="page-content">

        @include('backend.admin.components.breadcrumb')

        <div class="row">
            <div class="col-12">
                <div class="card ot-card mb-24 position-relative z_1">
                    <form action="{{ route('attendance.search') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="card-header d-flex align-items-center gap-4 flex-wrap">
                            <h4 class="mb-0">{{ ___('common.Filtering') }}</h4>

                            <div
                                class="card_header_right d-flex align-items-center gap-3 flex-fill justify-content-end flex-wrap">
                                <!-- table_searchBox -->

                                <div class="single_large_selectBox">
                                    <select id="getSections" class="form-control @error('class') is-invalid @enderror"
                                        name="class">
                                        <option value="">{{ ___('student_info.select_class') }}</option>
                                        @foreach ($data['classes'] as $item)
                                            <option
                                                {{ old('class', @$data['request']->class) == $item->class->id ? 'selected' : '' }}
                                                value="{{ $item->class->id }}">{{ $item->class->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('class')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="single_large_selectBox">
                                    <select class="sections form-control @error('section') is-invalid @enderror"
                                        name="section">
                                        <option value="">{{ ___('student_info.select_section') }}</option>
                                        @foreach ($data['sections'] as $item)
                                            <option
                                                {{ old('section', @$data['request']->section) == $item->section->id ? 'selected' : '' }}
                                                value="{{ $item->section->id }}">{{ $item->section->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('section')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="single_large_selectBox">
                                    <input value="{{ old('date', @$data['request']->date) }}" name="date"
                                        class="form-control @error('date') is-invalid @enderror" type="date">

                                    @error('date')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button class="btn btn-primary">
                                    {{ ___('common.Search') }}
                                </button>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>

        @isset($data['students'])

            <div class="card">
                <div class="card-body">
                    @if (@$data['status'] == 1)
                        <span
                            class="badge-basic-success-text">{{ ___('attendance.Attendance already collected, You can edit record') }}</span>
                    @endif
                    <form action="{{ route('attendance.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <!--  start hidden items -->
                        <input type="hidden" name="status" value="{{ @$data['status'] }}">
                        <input type="hidden" name="class" value="{{ @$data['request']->class }}">
                        <input type="hidden" name="section" value="{{ @$data['request']->section }}">
                        <input type="hidden" name="date" value="{{ @$data['request']->date }}">
                        <!--  end -->

                        <div class="input-check-radio mb-3">
                            <div class="form-check d-flex align-items-center">
                                <input type="checkbox" id="holiday" class="form-check-input mt-0 mr-4 read common-key"
                                    name="holiday"
                                    {{ @$data['students'][0]->attendance == 0 && @$data['status'] == 1 ? 'checked' : '' }}>
                                <label class="custom-control-label">{{ ___('attendance.Holiday') }}</label>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered role-table" id="students_table">
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
                                                    <div class="form-check d-flex align-items-center mt-6">
                                                        <input
                                                            class="form-check-input {{ @$item->attendance == App\Enums\AttendanceType::PRESENT ? 'checkedItem' : '' }}"
                                                            type="radio" id="flexRadioDefault1"
                                                            name="attendance[{{ @$item->student->id }}]"
                                                            value="{{ App\Enums\AttendanceType::PRESENT }}"
                                                            {{ @$item->attendance == App\Enums\AttendanceType::PRESENT ? 'checked' : '' }} />
                                                        <label for="flexRadioDefault1">{{ ___('attendance.Present') }}</label>
                                                    </div>
                                                    <div class="form-check d-flex align-items-center mt-6 ">
                                                        <input
                                                            class="form-check-input {{ @$item->attendance == App\Enums\AttendanceType::LATE ? 'checkedItem' : '' }}"
                                                            type="radio" id="flexRadioDefault2"
                                                            name="attendance[{{ @$item->student->id }}]"
                                                            value="{{ App\Enums\AttendanceType::LATE }}"
                                                            {{ @$item->attendance == App\Enums\AttendanceType::LATE ? 'checked' : '' }} />
                                                        <label for="flexRadioDefault2">{{ ___('attendance.Late') }}</label>
                                                    </div>
                                                    <div class="form-check d-flex align-items-center mt-6 ">
                                                        <input
                                                            class="form-check-input {{ @$item->attendance == App\Enums\AttendanceType::ABSENT ? 'checkedItem' : '' }}"
                                                            type="radio" id="flexRadioDefault3"
                                                            name="attendance[{{ @$item->student->id }}]"
                                                            value="{{ App\Enums\AttendanceType::ABSENT }}"
                                                            {{ @$item->attendance == App\Enums\AttendanceType::ABSENT ? 'checked' : '' }}{{ @$data['status'] == 1 && @$item->attendance == null ? 'checked' : '' }}{{ @$data['status'] == 0 ? 'checked' : '' }} />
                                                        <label for="flexRadioDefault3">{{ ___('attendance.Absent') }}</label>
                                                    </div>
                                                    <div class="form-check d-flex align-items-center mt-6 ">
                                                        <input
                                                            class="form-check-input {{ @$item->attendance == App\Enums\AttendanceType::HALFDAY ? 'checkedItem' : '' }}"
                                                            type="radio" id="flexRadioDefault4"
                                                            name="attendance[{{ @$item->student->id }}]"
                                                            value="{{ App\Enums\AttendanceType::HALFDAY }}"
                                                            {{ @$item->attendance == App\Enums\AttendanceType::HALFDAY ? 'checked' : '' }} />
                                                        <label
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
                                        <tr>
                                            <td colspan="100%" class="text-center gray-color">
                                                <img src="{{ asset('images/no_data.svg') }}" alt=""
                                                    class="mb-primary" width="100">
                                                <p class="mb-0 text-center">{{ ___('common.No data available') }}</p>
                                                <p class="mb-0 text-center text-secondary font-size-90">
                                                    {{ ___('common.Please add new entity regarding this table') }}</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if (hasPermission('attendance_create'))
                            <div class="ot-pagination pagination-content d-flex justify-content-end align-content-center py-3">
                                <button class="btn btn-primary" type="submit">
                                    {{ ___('common.submit') }}
                                </button>
                            </div>
                        @endif

                    </form>
                </div>



            </div>
            @endif

        </div>
    @endsection

    @push('script')
        @include('backend.admin.components.table.delete-ajax')

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

                        $.each(JSON.parse(data), function(i, item) {
                            section_options += "<option value=" + item.section.id + ">" + item
                                .section.name + "</option>";
                        });

                        $("select.sections option").not(':first').remove();
                        $("select.sections").append(section_options);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
        </script>
    @endpush
