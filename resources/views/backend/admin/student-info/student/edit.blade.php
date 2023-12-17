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
            <form action="{{ route('student.update') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                @method('PUT')

                <input type="hidden" name="user_id" value="{{ @$data['student']->user_id }}">
                <input type="hidden" name="id" value="{{ @$data['student']->id }}">

                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('common.admission_no') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('admission_no') is-invalid @enderror" type="number"
                                    name="admission_no" id="validationDefault01"
                                    placeholder="{{ ___('common.enter_admission_no') }}"
                                    value="{{ old('admission_no', @$data['student']->admission_no) }}">
                                @error('admission_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault02" class="form-label ">{{ ___('common.roll_no') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('roll_no') is-invalid @enderror" name="roll_no"
                                    id="validationDefault02" type="number"
                                    placeholder="{{ ___('common.enter_roll_no') }}"
                                    value="{{ old('roll_no', @$data['session_class_student']->roll) }}">
                                @error('roll_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('common.first_name') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('first_first_name') is-invalid @enderror"
                                    name="first_name" id="validationDefault03"
                                    placeholder="{{ ___('common.enter_first_name') }}"
                                    value="{{ old('first_name', @$data['student']->first_name) }}">
                                @error('first_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('common.last_name') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                    id="validationDefault04" placeholder="{{ ___('common.enter_last_name') }}"
                                    value="{{ old('last_name', @$data['student']->last_name) }}">
                                @error('last_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault05" class="form-label ">{{ ___('common.mobile') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                    id="validationDefault05" type="number"
                                    placeholder="{{ ___('common.enter_mobile') }}"
                                    value="{{ old('mobile', @$data['student']->mobile) }}">
                                @error('mobile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault06" class="form-label ">{{ ___('common.email') }} <span
                                        class="text-danger"></span></label>
                                <input class="form-control @error('email') is-invalid @enderror" name="email"
                                    id="validationDefault06" type="email"
                                    placeholder="{{ ___('common.enter_email') }}"
                                    value="{{ old('email', @$data['student']->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3">

                                <label for="validationDefault07" class="form-label">{{ ___('common.class') }} <span
                                        class="text-danger">*</span></label>
                                <select class="class form-control @error('class') is-invalid @enderror" name="class"
                                    id="validationDefault07">
                                    <option value="">{{ ___('common.select_class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option
                                            {{ @$data['session_class_student']->classes_id == $item->class->id ? 'selected' : '' }}
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

                            <div class="col-md-3">
                                <label for="validationDefault08" class="form-label">{{ ___('common.section') }}
                                    <span class="text-danger">*</span></label>
                                <select class="section form-control @error('section') is-invalid @enderror" name="section"
                                    id="validationDefault08">
                                    <option value="">{{ ___('common.select_section') }}</option>
                                    @foreach ($data['sections'] as $item)
                                        <option
                                            {{ @$data['session_class_student']->section_id == $item->section->id ? 'selected' : '' }}
                                            value="{{ $item->section->id }}">{{ $item->section->name }}</option>
                                    @endforeach
                                </select>
                                @error('section')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3">

                                <label for="validationDefault09" class="form-label">{{ ___('common.shift') }} <span
                                        class="text-danger"></span></label>
                                <select class="form-control @error('shift') is-invalid @enderror" name="shift"
                                    id="validationDefault09">
                                    <option value="">{{ ___('common.select_shift') }}</option>
                                    @foreach ($data['shifts'] as $item)
                                        <option
                                            {{ @$data['student']->session_class_student->shift->id == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>

                                @error('shift')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault10" class="form-label ">{{ ___('common.date_of_birth') }}
                                    <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                    name="date_of_birth" id="validationDefault10"
                                    placeholder="{{ ___('common.date_of_birth') }}"
                                    value="{{ old('date_of_birth', @$data['student']->dob) }}">
                                @error('date_of_birth')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3">

                                <label for="validationDefault11" class="form-label">{{ ___('common.religion') }}
                                    <span class="text-danger"></span></label>
                                <select class="form-control @error('religion') is-invalid @enderror" name="religion"
                                    id="validationDefault11">
                                    <option value="">{{ ___('common.select_religion') }}</option>
                                    @foreach ($data['religions'] as $item)
                                        <option {{ @$data['student']->religion_id == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>

                                @error('religion')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-3">

                                <label for="validationDefault12" class="form-label">{{ ___('common.gender') }} <span
                                        class="text-danger"></span></label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender"
                                    id="validationDefault12">
                                    <option value="">{{ ___('common.select_gender') }}</option>
                                    @foreach ($data['genders'] as $item)
                                        <option {{ @$data['student']->gender_id == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>

                                @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-3">

                                <label for="validationDefault13" class="form-label">{{ ___('common.category') }} <span
                                        class="text-danger"></span></label>
                                <select class="form-control @error('category') is-invalid @enderror" name="category"
                                    id="validationDefault13">
                                    <option value="">{{ ___('common.select_category') }}</option>
                                    @foreach ($data['categories'] as $item)
                                        <option {{ @$data['student']->student_category_id == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>

                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-3">

                                <label for="validationDefault14" class="form-label">{{ ___('common.blood') }} <span
                                        class="text-danger"></span></label>
                                <select class="form-control @error('blood') is-invalid @enderror" name="blood"
                                    id="validationDefault14">
                                    <option value="">{{ ___('common.select_blood') }}</option>
                                    @foreach ($data['bloods'] as $item)
                                        <option {{ @$data['student']->blood_group_id == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>

                                @error('blood')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault15"
                                    class="form-label ">{{ ___('common.admission_date') }}
                                    <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('admission_date') is-invalid @enderror"
                                    name="admission_date" id="validationDefault15"
                                    placeholder="{{ ___('common.admission_date') }}"
                                    value="{{ old('admission_date', @$data['student']->admission_date) }}">
                                @error('admission_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="validationDefault16" class="form-label ">{{ ___('common.image') }}
                                    {{ ___('common.(100 x 100 px)') }}<span class="text-danger"></span></label>


                                <input id="validationDefault16" class="form-control" type="file" name="image">

                            </div>
                            <div class="col-md-3 parent">

                                <label for="validationDefault17"
                                    class="form-label">{{ ___('common.select_parent') }}
                                    <span class="text-danger">*</span></label>
                                <select class="form-control @error('parent') is-invalid @enderror" name="parent"
                                    id="validationDefault17">
                                    <option value="">{{ ___('common.select_parent') }}</option>
                                    <option selected value="{{ @$data['student']->parent_guardian_id }}">
                                        {{ @$data['student']->parent->guardian_name }}
                                </select>

                                @error('parent')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-3">

                                <label for="validationDefault18" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault18">
                                    <option {{ @$data['student']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}
                                        value="{{ App\Enums\Status::ACTIVE }}">{{ ___('common.active') }}
                                    </option>
                                    <option {{ @$data['student']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}
                                        value="{{ App\Enums\Status::INACTIVE }}">{{ ___('common.inactive') }}
                                    </option>
                                </select>

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>

                        <div class="row py-3">
                            <div class="col-md-12">
                                <div class="d-flex align-items-center gap-4 flex-wrap">
                                    <h5 class="m-0 flex-fill text-info">
                                        {{ ___('common.Upload Documents') }}
                                    </h5>
                                    <button type="button" class="btn btn-sm btn-primary" onclick="addNewDocument()">
                                        <span><i class="fa-solid fa-plus"></i> </span>
                                        {{ ___('common.add') }}</button>
                                    <input type="hidden" name="counter" id="counter"
                                        value="{{ count(@$data['student']->upload_documents) }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table school_borderLess_table table_border_hide2" id="student-document">
                                        <thead>
                                            <tr>
                                                <td scope="col">{{ ___('common.name') }} <span
                                                        class="text-danger"></span>
                                                    @if ($errors->any())
                                                        @if ($errors->has('school_user_name.*'))
                                                            <span class="custom-message">{{ 'the fields are required' }}
                                                        @endif
                                                    @endif
                                                </td>
                                                <td scope="col">
                                                    {{ ___('common.document') }}
                                                    <span class="text-danger"></span>
                                                    @if ($errors->any())
                                                        @if ($errors->has('school_user_telephone.*'))
                                                            <span class="custom-message">{{ 'the fields are required' }}
                                                        @endif
                                                    @endif
                                                </td>
                                                <td scope="col">
                                                    {{ ___('common.action') }}
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach (@$data['student']->upload_documents as $key => $item)
                                                <tr id="document-file">
                                                    <td>
                                                        <input type="text" name="document_names[{{ $key }}]"
                                                            value="{{ $item['title'] }}"
                                                            class="form-control min_width_200 "
                                                            placeholder="{{ ___('common.enter_name') }}" required>
                                                        <input type="hidden" name="document_rows[]"
                                                            value="{{ $key }}">

                                                    </td>
                                                    <td class="w-100 mw-50">
                                                        <input type="file" name="document_files[{{ $key }}]"
                                                            id="awesomefile{{ $key }}"
                                                            value="{{ $item['file'] }}">
                                                    </td>
                                                    <td>
                                                        <button class="drax_close_icon" onclick="removeRow(this)">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach

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
                url: url + '/students/list/add-new-document',
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
    <script src="{{ asset('backend/js/get-section.js') }}"></script>
@endpush
