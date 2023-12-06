@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card bg-white">
        <div class="card-body">
            <div class="border-bottom pb-4 mb-4">
                <h4 class="m-0">{{ @$data['title'] }}</h4>
            </div>
            <form action="{{ route('student.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('student_info.admission_no') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('admission_no') is-invalid @enderror" type="number"
                                    name="admission_no" list="datalistOptions" id="exampleDataList"
                                    placeholder="{{ ___('student_info.enter_admission_no') }}"
                                    value="{{ old('admission_no') }}">
                                @error('admission_no')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('student_info.roll_no') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('roll_no') is-invalid @enderror" name="roll_no"
                                    list="datalistOptions" id="exampleDataList" type="number"
                                    placeholder="{{ ___('student_info.enter_roll_no') }}" value="{{ old('roll_no') }}">
                                @error('roll_no')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('student_info.first_name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                    list="datalistOptions" id="exampleDataList"
                                    placeholder="{{ ___('student_info.enter_first_name') }}"
                                    value="{{ old('first_name') }}">
                                @error('first_name')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('student_info.last_name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    list="datalistOptions" id="exampleDataList"
                                    placeholder="{{ ___('student_info.enter_last_name') }}"
                                    value="{{ old('last_name') }}">
                                @error('last_name')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('student_info.mobile') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                    list="datalistOptions" id="exampleDataList" type="number"
                                    placeholder="{{ ___('student_info.enter_mobile') }}" value="{{ old('mobile') }}">
                                @error('mobile')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.email') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('email') is-invalid @enderror" name="email"
                                    list="datalistOptions" id="exampleDataList" type="email"
                                    placeholder="{{ ___('student_info.enter_email') }}" value="{{ old('email') }}">
                                @error('email')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">

                                <label for="validationServer04" class="form-label">{{ ___('student_info.class') }} <span
                                        class="text-danger">*</span></label>
                                <select id="getSections" class="form-control @error('class') is-invalid @enderror"
                                    name="class" id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('student_info.select_class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option {{ old('class') == $item->id ? 'selected' : '' }}
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

                            <div class="col-md-3">
                                <label for="validationServer04" class="form-label">{{ ___('student_info.section') }}
                                    <span class="text-danger">*</span></label>
                                <select class="sections form-control @error('section') is-invalid @enderror"
                                    name="section" id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('student_info.select_section') }}</option>
                                </select>
                                @error('section')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3">

                                <label for="validationServer04" class="form-label">{{ ___('student_info.shift') }} <span
                                        class="text-danger"></span></label>
                                <select class="form-control @error('shift') is-invalid @enderror" name="shift"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('student_info.select_shift') }}</option>
                                    @foreach ($data['shifts'] as $item)
                                        <option {{ old('shift') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>

                                @error('status')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.date_of_birth') }}
                                    <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                    name="date_of_birth" list="datalistOptions" id="exampleDataList"
                                    placeholder="{{ ___('common.date_of_birth') }}" value="{{ old('date_of_birth') }}">
                                @error('date_of_birth')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">

                                <label for="validationServer04" class="form-label">{{ ___('student_info.religion') }}
                                    <span class="text-danger"></span></label>
                                <select class="form-control @error('religion') is-invalid @enderror" name="religion"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('student_info.select_religion') }}</option>
                                    @foreach ($data['religions'] as $item)
                                        <option {{ old('religion') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>

                                @error('religion')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-3">

                                <label for="validationServer04" class="form-label">{{ ___('common.gender') }} <span
                                        class="text-danger"></span></label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('student_info.select_gender') }}</option>
                                    @foreach ($data['genders'] as $item)
                                        <option {{ old('gender') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>

                                @error('gender')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-3">

                                <label for="validationServer04" class="form-label">{{ ___('common.category') }} <span
                                        class="text-danger"></span></label>
                                <select class="form-control @error('category') is-invalid @enderror" name="category"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('student_info.select_category') }}</option>
                                    @foreach ($data['categories'] as $item)
                                        <option {{ old('category') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>

                                @error('category')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-3">

                                <label for="validationServer04" class="form-label">{{ ___('student_info.blood') }} <span
                                        class="text-danger"></span></label>
                                <select class="form-control @error('blood') is-invalid @enderror" name="blood"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('student_info.select_blood') }}</option>
                                    @foreach ($data['bloods'] as $item)
                                        <option {{ old('blood') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>

                                @error('blood')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('student_info.admission_date') }}
                                    <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('admission_date') is-invalid @enderror"
                                    name="admission_date" list="datalistOptions" id="exampleDataList"
                                    placeholder="{{ ___('student_info.admission_date') }}"
                                    value="{{ old('admission_date') }}">
                                @error('admission_date')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.image') }}
                                    {{ ___('common.(100 x 100 px)') }}<span class="text-danger"></span></label>

                                <input class="form-control" type="file" name="image"
                                    placeholder="{{ ___('common.image') }}">


                            </div>
                            <div class="col-md-3 parent">

                                <label for="validationServer04"
                                    class="form-label">{{ ___('student_info.select_parent') }}
                                    <span class="text-danger">*</span></label>
                                <select class="form-control @error('parent') is-invalid @enderror" name="parent"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('student_info.select_parent') }}</option>
                                </select>

                                @error('parent')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-3">

                                <label for="validationServer04" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option {{ old('status') ? 'selected' : '' }} value="{{ App\Enums\Status::ACTIVE }}">
                                        {{ ___('common.active') }}
                                    </option>
                                    <option {{ old('status') ? 'selected' : '' }}
                                        value="{{ App\Enums\Status::INACTIVE }}">
                                        {{ ___('common.inactive') }}
                                    </option>
                                </select>

                                @error('status')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col-md-12">
                                <div class="d-flex align-items-center gap-4 flex-wrap">
                                    <h5 class="m-0 flex-fill text-info">
                                        {{ ___('student_info.Upload Documents') }}
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-primary addNewDocument"
                                        onclick="addNewDocument()">
                                        <span><i class="fa-solid fa-plus"></i> </span>
                                        {{ ___('common.add') }}</button>
                                    <input type="hidden" name="counter" id="counter" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table school_borderLess_table table_border_hide2" id="student-document">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ ___('common.name') }} <span
                                                        class="text-danger"></span>
                                                    @if ($errors->any())
                                                        @if ($errors->has('document_names.*'))
                                                            <span class="text-danger">{{ 'the fields are required' }}
                                                        @endif
                                                    @endif
                                                </th>
                                                <th scope="col">
                                                    {{ ___('common.document') }}
                                                    <span class="text-danger"></span>
                                                    @if ($errors->any())
                                                        @if ($errors->has('document_files.*'))
                                                            <span class="text-danger">{{ 'The fields are required' }}
                                                        @endif
                                                    @endif
                                                </th>
                                                <th scope="col">
                                                    {{ ___('common.action') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('common.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function addNewDocument() {

            var url = $('#url').val();
            var counter = parseInt($('#counter').val()) + 1;

            var formData = {
                counter: counter,
            }

            $.ajax({
                type: "GET",
                dataType: 'html',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + '/student/add-new-document',
                success: function(data) {
                    $("#student-document tbody").append(data);
                    $("#counter").val(counter);
                    console.log(data);
                },
                error: function(data) {}
            });
        }

        function removeRow(element) {
            element.closest('tr').remove();
        }
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
                    var section_li = '';

                    $.each(JSON.parse(data), function(i, item) {
                        section_options += "<option value=" + item.section.id + ">" + item
                            .section.name + "</option>";
                        section_li += "<li data-value=" + item.section.id + " class='option'>" +
                            item.section.name + "</li>";
                    });

                    $("select.sections option").not(':first').remove();
                    $("select.sections").append(section_options);

                    $("div .sections .current").html($("div .sections .list li:first").html());
                    $("div .sections .list li").not(':first').remove();
                    $("div .sections .list").append(section_li);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endpush
