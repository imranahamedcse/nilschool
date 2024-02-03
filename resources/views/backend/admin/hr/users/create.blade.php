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

            <form action="{{ route('users.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">

                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault01" class="form-label ">{{ ___('create.staff_id') }} <span
                                class="text-danger">*</span></label>
                        <input class="form-control @error('staff_id') is-invalid @enderror" name="staff_id"
                            value="{{ old('staff_id') }}" id="validationDefault01" type="number"
                            placeholder="{{ ___('create.enter_staff_id') }}">
                        @error('staff_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault02" class="form-label">{{ ___('create.roles') }} <span
                                class="text-danger">*</span></label>
                        <select
                            class="form-control @error('role') is-invalid @enderror change-role"
                            name="role" id="validationDefault02">
                            <option value="">{{ ___('create.select_role') }}</option>
                            @foreach ($data['roles'] as $role)
                                <option {{ old('role') == $role->id ? 'selected' : '' }} value="{{ $role->id }}">
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault03" class="form-label">{{ ___('create.designations') }} <span
                                class="text-danger">*</span></label>
                        <select
                            class="form-control @error('designation') is-invalid @enderror change-designation"
                            name="designation" id="validationDefault03">
                            <option value="">{{ ___('create.select_designation') }}</option>
                            @foreach ($data['designations'] as $designation)
                                <option {{ old('designation') == $designation->id ? 'selected' : '' }}
                                    value="{{ $designation->id }}">{{ $designation->name }}</option>
                            @endforeach
                        </select>
                        @error('designation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault04" class="form-label">{{ ___('create.departments') }} <span
                                class="text-danger">*</span></label>
                        <select
                            class="form-control @error('department') is-invalid @enderror change-department"
                            name="department" id="validationDefault04">
                            <option value="">{{ ___('create.select_department') }}</option>
                            @foreach ($data['departments'] as $department)
                                <option {{ old('department') == $department->id ? 'selected' : '' }}
                                    value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault05" class="form-label ">{{ ___('create.first_name') }} <span
                                class="text-danger">*</span></label>
                        <input class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                            value="{{ old('first_name') }}" id="validationDefault05"
                            placeholder="{{ ___('create.enter_first_name') }}">
                        @error('first_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault06" class="form-label ">{{ ___('create.last_name') }} </label>
                        <input class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                            value="{{ old('last_name') }}" id="validationDefault06"
                            placeholder="{{ ___('create.enter_last_name') }}">
                        @error('last_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault07" class="form-label ">{{ ___('create.father_name') }} </label>
                        <input class="form-control @error('father_name') is-invalid @enderror" name="father_name"
                            value="{{ old('father_name') }}" id="validationDefault07"
                            placeholder="{{ ___('create.enter_father_name') }}">
                        @error('father_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault08" class="form-label ">{{ ___('create.mother_name') }} </label>
                        <input class="form-control @error('mother_name') is-invalid @enderror" name="mother_name"
                            value="{{ old('mother_name') }}" id="validationDefault08"
                            placeholder="{{ ___('create.enter_mother_name') }}">
                        @error('mother_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault09" class="form-label">{{ ___('create.email') }} <span
                                class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control  @error('email') is-invalid @enderror" id="validationDefault09"
                            aria-describedby="emailHelp" placeholder="{{ ___('create.enter_your_email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault10" class="form-label">{{ ___('create.genders') }} <span
                                class="text-danger">*</span></label>
                        <select
                            class="form-control @error('gender') is-invalid @enderror change-gender"
                            name="gender" id="validationDefault10">
                            <option value="">{{ ___('create.select_gender') }}</option>
                            @foreach ($data['genders'] as $gender)
                                <option {{ old('gender') == $gender->id ? 'selected' : '' }} value="{{ $gender->id }}">
                                    {{ $gender->name }}</option>
                            @endforeach
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault11" class="form-label ">{{ ___('create.date_of_birth') }} <span
                                class="text-danger">*</span></label>
                        <input class="form-control @error('dob') is-invalid @enderror" name="dob"
                            value="{{ old('dob') }}" id="validationDefault11" type="date"
                            placeholder="{{ ___('create.enter_date_of_birth') }}">
                        @error('dob')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault12" class="form-label ">{{ ___('create.joining_date') }} </label>
                        <input class="form-control @error('joining_date') is-invalid @enderror"
                            name="joining_date" value="{{ old('joining_date') }}"
                            id="validationDefault12" type="date" placeholder="{{ ___('create.enter_joining_date') }}">
                        @error('joining_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault13" class="form-label ">{{ ___('create.phone') }} <span
                                class="text-danger">*</span></label>
                        <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ old('phone') }}" id="validationDefault13"
                            placeholder="{{ ___('create.enter_phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault14" class="form-label ">{{ ___('create.emergency_contact') }} </label>
                        <input class="form-control @error('emergency_contact') is-invalid @enderror"
                            name="emergency_contact" value="{{ old('emergency_contact') }}"
                            id="validationDefault14" placeholder="{{ ___('create.enter_emergency_contact') }}">
                        @error('emergency_contact')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault15" class="form-label">{{ ___('create.marital_status') }} </label>
                        <select
                            class="form-control @error('marital_status') is-invalid @enderror"
                            name="marital_status" id="validationDefault15">
                            <option {{ old('marital_status') == App\Enums\MaritalStatus::UNMARRIED ? 'selected' : '' }}
                                value="{{ App\Enums\MaritalStatus::UNMARRIED }}">{{ ___('create.unmarried') }}</option>
                            <option {{ old('marital_status') == App\Enums\MaritalStatus::MARRIED ? 'selected' : '' }}
                                value="{{ App\Enums\MaritalStatus::MARRIED }}">{{ ___('create.married') }}</option>
                        </select>

                        @error('marital_status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault16" class="form-label">{{ ___('create.status') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror"
                            name="status" id="validationDefault16">
                            <option {{ old('status') == App\Enums\Status::ACTIVE ? 'selected' : '' }}
                                value="{{ App\Enums\Status::ACTIVE }}">{{ ___('create.active') }}</option>
                            <option {{ old('status') == App\Enums\Status::INACTIVE ? 'selected' : '' }}
                                value="{{ App\Enums\Status::INACTIVE }}">{{ ___('create.inactive') }}</option>
                        </select>

                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault17" class="form-label" for="inputImage">{{ ___('create.image') }}
                            {{ ___('create.(95 x 95 px)') }}</label>
                        <input id="validationDefault17" type="file" class="form-control" name="image">
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault18" class="form-label ">{{ ___('create.current_address') }} </label>
                        <input class="form-control @error('current_address') is-invalid @enderror"
                            name="current_address" value="{{ old('current_address') }}"
                            id="validationDefault18" placeholder="{{ ___('create.enter_current_address') }}">
                        @error('current_address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault19" class="form-label ">{{ ___('create.permanent_address') }} </label>
                        <input class="form-control @error('permanent_address') is-invalid @enderror"
                            name="permanent_address" value="{{ old('permanent_address') }}"
                            id="validationDefault19" placeholder="{{ ___('create.enter_permanent_address') }}">
                        @error('permanent_address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label for="validationDefault20" class="form-label ">{{ ___('create.basic_salary') }} <span
                                class="text-danger">*</span></label>
                        <input class="form-control @error('basic_salary') is-invalid @enderror"
                            name="basic_salary" value="{{ old('basic_salary') }}"
                            id="validationDefault20" type="number" placeholder="{{ ___('create.enter_basic_salary') }}">
                        @error('basic_salary')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center gap-4 flex-wrap">
                            <h5 class="m-0 flex-fill text-info">
                                {{ ___('create.Upload Documents') }}
                            </h5>
                            <button type="button" class="btn btn-sm btn-info"
                                onclick="addNewDocument()">
                                <span><i class="fa-solid fa-plus"></i> </span>
                                {{ ___('create.add') }}</button>
                            <input type="hidden" name="counter" id="counter" value="0">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table school_borderLess_table" id="student-document">
                                <thead>
                                    <tr>
                                        <td scope="col">{{ ___('create.name') }} <span class="text-danger"></span>
                                            @if ($errors->any())
                                                @if ($errors->has('document_names.*'))
                                                    <span class="text-danger">{{ 'the fields are required' }}
                                                @endif
                                            @endif
                                        </td>
                                        <td scope="col">
                                            {{ ___('create.document') }}
                                            <span class="text-danger"></span>
                                            @if ($errors->any())
                                                @if ($errors->has('document_files.*'))
                                                    <span class="text-danger">{{ 'The fields are required' }}
                                                @endif
                                            @endif
                                        </td>
                                        <td scope="col">

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-24">
                    <div class="text-end">
                        <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                            </span>{{ ___('create.submit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
