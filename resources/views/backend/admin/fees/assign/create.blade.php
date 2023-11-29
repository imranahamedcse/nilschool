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
                                class="fillable">*</span></label>
                        <select id="fees_group" class="form-control @error('fees_group') is-invalid @enderror"
                            name="fees_group" aria-describedby="validationServer04Feedback">
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
                                class="fillable">*</span></label>
                        <select id="getSections" class="form-control @error('class') is-invalid @enderror" name="class"
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
                                class="fillable">*</span></label>
                        <select id="section" class="sections form-control @error('section') is-invalid @enderror"
                            name="section" aria-describedby="validationServer04Feedback">
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
                            <select id="gender" class="gender form-control @error('gender') is-invalid @enderror"
                                name="gender">
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
                            <select id="student_category"
                                class="student_category form-control @error('student_category') is-invalid @enderror"
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
    <script>
        // Fees master type
        $("#fees_group").on('change', function(e) {
            groupTypes();
        });

        // groupTypes();

        function groupTypes() {
            var url = $('#url').val();
            var id = $("#fees_group").val();

            var formData = {
                id: id
            }

            $.ajax({
                type: "GET",
                dataType: 'html',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + '/fees-assign/get-all-type',
                success: function(data) {
                    // console.log(data);
                    $("#types_table tbody").empty();
                    $("#types_table tbody").append(data);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
        // Fees master type end
    </script>

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

    <script>
        // Fees master assing
        $("#section").on('change', function(e) {
            assingStudents();
        });

        $("#student_category").on('change', function(e) {
            assingStudents();
        });
        $("#gender").on('change', function(e) {
            assingStudents();
        });

        if ($("#page").val() == "create") {
            assingStudents();
        }

        function assingStudents() {
            var url = $('#url').val();
            var classId = $("#getSections").val();
            var sectionId = $("#section").val();
            var categoryId = $("#student_category").val();
            var genderId = $("#gender").val();

            var formData = {
                class: classId,
                section: sectionId,
                category: categoryId,
                gender: genderId,
                section: sectionId,
            }

            $("#students_table tbody").empty();
            if (classId && sectionId) {
                $.ajax({
                    type: "GET",
                    dataType: 'html',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url + '/fees-assign/get-fees-assign-students',
                    success: function(data) {
                        // console.log(data);
                        $("#students_table tbody").append(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        }
        // Fees master assing end
    </script>

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
