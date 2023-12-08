@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card">
        <div class="card-body">
            <div class="border-bottom pb-3 mb-4">
                <h4 class="m-0">{{ @$data['title'] }}</h4>
            </div>

            <form action="{{ route('fees-assign.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="validationServer04" class="form-label">{{ ___('fees.fees_group') }} <span
                                class="text-danger">*</span></label>
                        <select class="fees_group form-control @error('fees_group') is-invalid @enderror" name="fees_group"
                            aria-describedby="validationServer04Feedback">
                            <option value="">{{ ___('fees.select_fees_group') }}</option>
                            @foreach ($data['fees_groups'] as $item)
                                <option {{ old('fees_group') == $item->group->id ? 'selected' : '' }}
                                    value="{{ $item->group->id }}">{{ $item->group->name }}</option>
                            @endforeach
                        </select>
                        @error('fees_group')
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="validationServer04" class="form-label">{{ ___('student_info.class') }} <span
                                class="text-danger">*</span></label>
                        <select class="class form-control @error('class') is-invalid @enderror" name="class"
                            aria-describedby="validationServer04Feedback">
                            <option value="">{{ ___('student_info.select_class') }}</option>
                            @foreach ($data['classes'] as $item)
                                <option {{ old('class') == $item->class->id ? 'selected' : '' }}
                                    value="{{ $item->class->id }}">{{ $item->class->name }}
                            @endforeach
                            </option>
                        </select>
                        @error('class')
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="validationServer04" class="form-label">{{ ___('student_info.section') }} <span
                                class="text-danger">*</span></label>
                        <select class="section form-control @error('section') is-invalid @enderror" name="section"
                            aria-describedby="validationServer04Feedback">
                            <option value="">{{ ___('student_info.select_section') }}</option>
                            @foreach ($data['sections'] as $item)
                                @if (old('section') == $item->id)
                                    <option {{ old('section') == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}
                                @endif
                            @endforeach
                        </select>
                        @error('section')
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <div>
                            <label for="validationServer04" class="form-label">{{ ___('fees.gender') }}</label>
                            <select class="gender form-control @error('gender') is-invalid @enderror" name="gender">
                                <option value="">{{ ___('student_info.select_gender') }}</option>
                                @foreach ($data['genders'] as $item)
                                    <option {{ old('gender') == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}
                                @endforeach
                            </select>
                        </div>
                        @error('gender')
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <div>
                            <label for="validationServer04"
                                class="form-label">{{ ___('student_info.student_category') }}</label>
                            <select class="student_category form-control @error('student_category') is-invalid @enderror"
                                name="student_category">
                                <option value="">{{ ___('fees.select_student_category') }}</option>
                                @foreach ($data['categories'] as $item)
                                    <option {{ old('student_category') == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}
                                @endforeach
                            </select>
                        </div>
                        @error('student_category')
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h5 class="text-info">{{ ___('student_info.Fees Types') }}</h5>
                        <div class="table-responsive">
                            <input type="hidden" id="page" value="create">
                            <table class="table table-bordered role-table" id="types_table">
                                <thead class="thead">
                                    <tr>
                                        <th class="purchase mr-4">{{ ___('common.All') }} <input class="form-check-input"
                                                type="checkbox" id="all_fees_masters"></th>
                                        <th class="purchase">{{ ___('common.name') }}</th>
                                        <th class="purchase">{{ ___('fees.amount') }}
                                            ({{ Setting('currency_symbol') }})</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <h5 class="text-info">{{ ___('student_info.Students List') }} </h5>
                        <div class="table-responsive">
                            <table class="table table-bordered role-table" id="students_table">
                                <thead class="thead">
                                    <tr>
                                        <th class="purchase mr-4">{{ ___('common.All') }} <input class="form-check-input"
                                                type="checkbox" id="all_students"></th>
                                        <th class="purchase">{{ ___('student_info.admission_no') }}</th>
                                        <th class="purchase">{{ ___('student_info.Student Name') }}</th>
                                        <th class="purchase">{{ ___('academic.class') }}
                                            ({{ ___('academic.section') }})</th>
                                        <th class="purchase">{{ ___('student_info.guardian_name') }}</th>
                                        <th class="purchase">{{ ___('student_info.Mobile Number') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-24">
                    <div class="text-end">
                        <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                            </span>{{ ___('common.submit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('backend/js/get-section.js') }}"></script>
    <script src="{{ asset('backend/js/get-fees-type.js') }}"></script>
    <script src="{{ asset('backend/js/get-fees-assign-students.js') }}"></script>

    <script>
        $("#all_students").on('click', function(e) {
            if ($("#all_students").is(':checked')) {
                $(".student").prop("checked", true);
            } else {
                $(".student").prop("checked", false);
            }
        });
        $(document).on('click', '.student', function() {
            const checkboxes = document.querySelectorAll('.student');
            for (let i = 0; i < checkboxes.length; i++) {
                if (!checkboxes[i].checked) {
                    $("#all_students").prop("checked", false);
                    break;
                } else
                    $("#all_students").prop("checked", true);
            }
        });

        $("#all_fees_masters").on('click', function(e) {
            if ($("#all_fees_masters").is(':checked')) {
                $(".fees_master").prop("checked", true);
            } else {
                $(".fees_master").prop("checked", false);
            }
        });
        $(document).on('click', '.fees_master', function() {
            const checkboxes = document.querySelectorAll('.fees_master');
            for (let i = 0; i < checkboxes.length; i++) {
                if (!checkboxes[i].checked) {
                    $("#all_fees_masters").prop("checked", false);
                    break;
                } else
                    $("#all_fees_masters").prop("checked", true);
            }
        });
    </script>
@endpush
