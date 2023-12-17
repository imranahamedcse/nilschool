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
                        <label for="validationDefault01" class="form-label">{{ ___('common.fees_group') }} <span
                                class="text-danger">*</span></label>
                        <select id="validationDefault01" class="fees_group form-control @error('fees_group') is-invalid @enderror" name="fees_group"
                           >
                            <option value="">{{ ___('common.select_fees_group') }}</option>
                            @foreach ($data['fees_groups'] as $item)
                                <option {{ old('fees_group') == $item->group->id ? 'selected' : '' }}
                                    value="{{ $item->group->id }}">{{ $item->group->name }}</option>
                            @endforeach
                        </select>
                        @error('fees_group')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="validationDefault02" class="form-label">{{ ___('common.class') }} <span
                                class="text-danger">*</span></label>
                        <select id="validationDefault02" class="class form-control @error('class') is-invalid @enderror" name="class"
                           >
                            <option value="">{{ ___('common.select_class') }}</option>
                            @foreach ($data['classes'] as $item)
                                <option {{ old('class') == $item->class->id ? 'selected' : '' }}
                                    value="{{ $item->class->id }}">{{ $item->class->name }}
                            @endforeach
                            </option>
                        </select>
                        @error('class')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="validationDefault03" class="form-label">{{ ___('common.section') }} <span
                                class="text-danger">*</span></label>
                        <select id="validationDefault03" class="section form-control @error('section') is-invalid @enderror" name="section"
                           >
                            <option value="">{{ ___('common.select_section') }}</option>
                            @foreach ($data['sections'] as $item)
                                @if (old('section') == $item->id)
                                    <option {{ old('section') == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}
                                @endif
                            @endforeach
                        </select>
                        @error('section')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <div>
                            <label for="validationDefault04" class="form-label">{{ ___('common.gender') }}</label>
                            <select id="validationDefault04" class="gender form-control @error('gender') is-invalid @enderror" name="gender">
                                <option value="">{{ ___('common.select_gender') }}</option>
                                @foreach ($data['genders'] as $item)
                                    <option {{ old('gender') == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}
                                @endforeach
                            </select>
                        </div>
                        @error('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <div>
                            <label for="validationDefault05"
                                class="form-label">{{ ___('common.student_category') }}</label>
                            <select id="validationDefault05" class="student_category form-control @error('student_category') is-invalid @enderror"
                                name="student_category">
                                <option value="">{{ ___('common.select_student_category') }}</option>
                                @foreach ($data['categories'] as $item)
                                    <option {{ old('student_category') == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}
                                @endforeach
                            </select>
                        </div>
                        @error('student_category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h5 class="text-info">{{ ___('common.Fees Types') }}</h5>
                        <div class="table-responsive">
                            <input type="hidden" id="page" value="create">
                            <table class="table table-bordered role-table" id="types_table">
                                <thead class="thead">
                                    <tr>
                                        <th class="purchase mr-4">{{ ___('common.All') }} <input class="form-check-input"
                                                type="checkbox" id="all_fees_masters"></th>
                                        <th class="purchase">{{ ___('common.name') }}</th>
                                        <th class="purchase">{{ ___('common.amount') }}
                                            ({{ Setting('currency_symbol') }})</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <h5 class="text-info">{{ ___('common.Students List') }} </h5>
                        <div class="table-responsive">
                            <table class="table table-bordered role-table" id="students_table">
                                <thead class="thead">
                                    <tr>
                                        <th class="purchase mr-4">{{ ___('common.All') }} <input class="form-check-input"
                                                type="checkbox" id="all_students"></th>
                                        <th class="purchase">{{ ___('common.admission_no') }}</th>
                                        <th class="purchase">{{ ___('common.Student Name') }}</th>
                                        <th class="purchase">{{ ___('common.class') }}
                                            ({{ ___('common.section') }})</th>
                                        <th class="purchase">{{ ___('common.guardian_name') }}</th>
                                        <th class="purchase">{{ ___('common.Mobile Number') }}</th>
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
