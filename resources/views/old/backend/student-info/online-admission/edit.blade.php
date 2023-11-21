@extends('backend.master')

@section('title')
    {{ @$data['title'] }}
@endsection
@section('content')
    <div class="page-content">

        {{-- bradecrumb Area S t a r t --}}
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="bradecrumb-title mb-1">{{ $data['title'] }}</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ ___('common.home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $data['title'] }}</li>
                        </ol>
                </div>
            </div>
        </div>
        {{-- bradecrumb Area E n d --}}

        <div class="card ot-card">
            <div class="card-body">
                <form action="{{ route('online-admissions.store') }}" enctype="multipart/form-data" method="post"
                    id="visitForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            
                            <input type="hidden" name="online_admission_id" value="{{@$data['student']->id}}">
                            <h2>Student Information</h2>
                            {{-- Start student information --}}
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.admission_no') }} <span
                                            class="fillable">*</span></label>
                                    <input class="form-control ot-input @error('admission_no') is-invalid @enderror"
                                        name="admission_no" list="datalistOptions" id="exampleDataList" type="number"
                                        placeholder="{{ ___('student_info.enter_admission_no') }}"
                                        value="{{ old('admission_no',@$data['student']->admission_no) }}">
                                    @error('admission_no')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.roll_no') }} <span
                                            class="fillable">*</span></label>
                                    <input class="form-control ot-input @error('roll_no') is-invalid @enderror"
                                        name="roll_no" list="datalistOptions" id="exampleDataList" type="number"
                                        placeholder="{{ ___('student_info.enter_roll_no') }}" value="{{ old('roll_no',@$data['student']->roll_no) }}">
                                    @error('roll_no')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.first_name') }} <span
                                            class="fillable">*</span></label>
                                    <input class="form-control ot-input @error('first_first_name') is-invalid @enderror"
                                        name="first_name" list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.enter_first_name') }}" value="{{ old('first_name',@$data['student']->first_name) }}">
                                    @error('first_name')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.last_name') }} <span
                                            class="fillable">*</span></label>
                                    <input class="form-control ot-input @error('last_name') is-invalid @enderror"
                                        name="last_name" list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.enter_last_name') }}" value="{{ old('last_name',@$data['student']->last_name) }}">
                                    @error('last_name')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.mobile') }} <span
                                            class="fillable"></span></label>
                                    <input class="form-control ot-input @error('mobile') is-invalid @enderror"
                                        name="mobile" list="datalistOptions" id="exampleDataList" type="text"
                                        placeholder="{{ ___('student_info.enter_mobile') }}" value="{{ old('mobile',@$data['student']->phone) }}">
                                    @error('mobile')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('common.email') }} <span
                                            class="fillable"></span></label>
                                    <input class="form-control ot-input @error('email') is-invalid @enderror"
                                        name="email" list="datalistOptions" id="exampleDataList" type="email"
                                        placeholder="{{ ___('student_info.enter_email') }}" value="{{ old('email',@$data['student']->email) }}">
                                    @error('email')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-3">

                                    <label for="validationServer04" class="form-label">{{ ___('student_info.class') }} <span
                                            class="fillable">*</span></label>
                                    <select id="getSections"
                                        class="nice-select niceSelect bordered_style wide @error('class') is-invalid @enderror"
                                        name="class" id="validationServer04"
                                        aria-describedby="validationServer04Feedback">
                                        <option value="">{{ ___('student_info.select_class') }}</option>
                                        @foreach ($data['classes'] as $item)
                                            <option {{ @$data['student']->class->id == $item->class->id ? 'selected':''}} value="{{ $item->class->id }}">{{ $item->class->name }}
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
                                    <label for="validationServer04" class="form-label">{{ ___('student_info.section') }} <span
                                            class="fillable">*</span></label>
                                    <select id="getSections"
                                        class="nice-select sections niceSelect bordered_style wide @error('section') is-invalid @enderror"
                                        name="section" id="validationServer04"
                                        aria-describedby="validationServer04Feedback">
                                        <option value="">{{ ___('student_info.select_section') }}</option>
                                        @foreach ($data['sections'] as $item)
                                            <option {{ @$data['student']->section->id == $item->section->id ? 'selected':''}} value="{{ $item->section->id }}">{{ $item->section->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('section')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-3">

                                    <label for="validationServer04" class="form-label">{{ ___('student_info.shift') }} <span
                                            class="fillable"></span></label>
                                    <select
                                        class="nice-select niceSelect bordered_style wide @error('shift') is-invalid @enderror"
                                        name="shift" id="validationServer04"
                                        aria-describedby="validationServer04Feedback">
                                        <option value="">{{ ___('student_info.select_shift') }}</option>
                                        @foreach ($data['shifts'] as $item)
                                            <option {{ @$data['student']->shift->id == $item->id ? 'selected':''}} value="{{ $item->id }}">{{ $item->name }}
                                        @endforeach
                                    </select>

                                    @error('shift')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('common.date_of_birth') }}
                                        <span class="fillable">*</span></label>
                                    <input type="date"
                                        class="form-control ot-input @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth" list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('common.date_of_birth') }}"
                                        value="{{ old('date_of_birth',@$data['student']->dob) }}">
                                    @error('date_of_birth')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-3">

                                    <label for="validationServer04" class="form-label">{{ ___('student_info.religion') }} <span
                                            class="fillable"></span></label>
                                    <select
                                        class="nice-select niceSelect bordered_style wide @error('religion') is-invalid @enderror"
                                        name="religion" id="validationServer04"
                                        aria-describedby="validationServer04Feedback">
                                        <option value="">{{ ___('student_info.select_religion') }}</option>
                                        @foreach ($data['religions'] as $item)
                                            <option {{ @$data['student']->religion_id == $item->id ? 'selected':''}} value="{{ $item->id }}">{{ $item->name }}
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
                                            class="fillable"></span></label>
                                    <select
                                        class="nice-select niceSelect bordered_style wide @error('gender') is-invalid @enderror"
                                        name="gender" id="validationServer04"
                                        aria-describedby="validationServer04Feedback">
                                        <option value="">{{ ___('student_info.select_gender') }}</option>
                                        @foreach ($data['genders'] as $item)
                                            <option {{ @$data['student']->gender_id == $item->id ? 'selected':''}} value="{{ $item->id }}">{{ $item->name }}
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
                                            class="fillable"></span></label>
                                    <select
                                        class="nice-select niceSelect bordered_style wide @error('category') is-invalid @enderror"
                                        name="category" id="validationServer04"
                                        aria-describedby="validationServer04Feedback">
                                        <option value="">{{ ___('student_info.select_category') }}</option>
                                        @foreach ($data['categories'] as $item)
                                            <option {{ @$data['student']->student_category_id == $item->id ? 'selected':''}} value="{{ $item->id }}">{{ $item->name }}
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
                                            class="fillable"></span></label>
                                    <select
                                        class="nice-select niceSelect bordered_style wide @error('blood') is-invalid @enderror"
                                        name="blood" id="validationServer04"
                                        aria-describedby="validationServer04Feedback">
                                        <option value="">{{ ___('student_info.select_blood') }}</option>
                                        @foreach ($data['bloods'] as $item)
                                            <option {{ @$data['student']->blood_group_id == $item->id ? 'selected':''}} value="{{ $item->id }}">{{ $item->name }}
                                        @endforeach
                                    </select>

                                    @error('blood')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList"
                                        class="form-label ">{{ ___('student_info.admission_date') }} <span
                                            class="fillable">*</span></label>
                                    <input type="date"
                                        class="form-control ot-input @error('admission_date') is-invalid @enderror"
                                        name="admission_date" list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.admission_date') }}"
                                        value="{{ old('admission_date',@$data['student']->admission_date) }}">
                                    @error('admission_date')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleDataList"
                                        class="form-label ">{{ ___('common.image') }} {{ ___('common.(100 x 100 px)') }}<span
                                            class="fillable"></span></label>


                                    <div class="ot_fileUploader left-side mb-3">
                                        <input class="form-control" type="text"
                                            placeholder="{{ ___('common.image') }}" readonly="" id="placeholder">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="btn btn-lg ot-btn-primary"
                                                for="fileBrouse">{{ ___('common.browse') }}</label>
                                            <input type="file" class="d-none form-control" name="image"
                                                id="fileBrouse" accept="image/*">
                                        </button>
                                    </div>

                                </div>
                                {{-- <div class="col-md-3 parent">

                                    <label for="validationServer04" class="form-label">{{ ___('student_info.select_parent') }}
                                        <span class="fillable">*</span></label>
                                    <select
                                        class="parent nice-select niceSelect bordered_style wide @error('parent') is-invalid @enderror"
                                        name="parent" id="validationServer04"
                                        aria-describedby="validationServer04Feedback">
                                        <option value="">{{ ___('student_info.select_parent') }}</option>
                                        <option selected value="{{ @$data['student']->parent_guardian_id }}">{{  @$data['student']->parent->guardian_name }}
                                    </select>

                                    @error('parent')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div> --}}

                                <div class="col-md-3">

                                    <label for="validationServer04" class="form-label">{{ ___('common.status') }} <span
                                            class="fillable">*</span></label>
                                    <select
                                        class="nice-select niceSelect bordered_style wide @error('status') is-invalid @enderror"
                                        name="status" id="validationServer04"
                                        aria-describedby="validationServer04Feedback">
                                        <option {{ @$data['student']->status == App\Enums\Status::ACTIVE ? 'selected':'' }} value="{{ App\Enums\Status::ACTIVE }}">{{ ___('common.active') }}
                                        </option>
                                        <option {{ @$data['student']->status == App\Enums\Status::INACTIVE ? 'selected':'' }} value="{{ App\Enums\Status::INACTIVE }}">{{ ___('common.inactive') }}
                                        </option>
                                    </select>

                                    @error('status')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center gap-4 flex-wrap">
                                        <h5 class="mt-5 flex-fill">
                                            {{-- {{ ___('school.School name,and name, office address of Manager, Chairman,Secretary') }} --}}
                                            {{ ___('student_info.Upload Documents') }}
                                        </h5>
                                        <button type="button" class="btn btn-lg ot-btn-primary radius_30px small_add_btn addNewDocument"
                                            onclick="addNewDocument()">
                                            <span><i class="fa-solid fa-plus"></i> </span>
                                            {{ ___('common.add') }}</button>
                                            <input type="hidden" name="counter" id="counter" value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table school_borderLess_table table_border_hide2" id="student-document">
                                            <thead>
                                                <tr>
                                                    <td scope="col">{{ ___('common.name') }} <span
                                                            class="text-danger"></span>
                                                        @if ($errors->any())
                                                            @if ($errors->has('school_user_name.*'))
                                                                <span
                                                                    class="custom-message">{{ 'the fields are required' }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td scope="col">
                                                        {{ ___('common.document') }}
                                                        <span class="text-danger"></span>
                                                        @if ($errors->any())
                                                            @if ($errors->has('school_user_telephone.*'))
                                                                <span
                                                                    class="custom-message">{{ 'the fields are required' }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td scope="col">

                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                {{-- @foreach (@$data['student']->upload_documents as $key=>$item)
                                                <tr id="document-file">
                                                    <td>
                                                        <input type="text" name="document_names[{{$key}}]" value="{{ $item['title'] }}"
                                                            class="form-control ot-input min_width_200 " placeholder="{{___('student_info.enter_name')}}" required>
                                                            <input type="hidden" name="document_rows[]" value="{{$key}}">
                                
                                                    </td>
                                                    <td class="w-100 mw-50">
                                                        <div class="school_primary_fileUplaoder mb-3">
                                                            <label for="awesomefile{{$key}}" class="filelabel">{{ ___('school.browse') }}</label>
                                                            <input type="file" name="document_files[{{$key}}]" id="awesomefile{{$key}}" value="{{ $item['file'] }}">
                                                            <input type="text" class="redonly_input" readonly placeholder="{{ ___("school.Document upload") }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="drax_close_icon" onclick="removeRow(this)">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach --}}

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            {{-- End student information --}}



                            {{-- Start parent information --}}
                            
                            <h5>{{ ___('student_info.Parent Information') }}</h5>
                            {{-- father --}}
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.father_name') }} <span
                                            class="fillable"></span></label>
                                    <input class="form-control ot-input @error('father_name') is-invalid @enderror" name="father_name"
                                        list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.enter_father_name') }}" type="text" value="{{ old('father_name') }}">
                                    @error('father_name')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.father_mobile') }} <span
                                            class="fillable"></span></label>
                                    <input class="form-control ot-input @error('father_mobile') is-invalid @enderror" name="father_mobile"
                                        list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.enter_father_mobile') }}" type="text" value="{{ old('father_mobile') }}">
                                    @error('father_mobile')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.father_profession') }} <span
                                            class="fillable"></span></label>
                                    <input class="form-control ot-input @error('father_profession') is-invalid @enderror" name="father_profession"
                                        list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.enter_father_profession') }}" type="text" value="{{ old('father_profession') }}">
                                    @error('father_profession')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">

                                    <label class="form-label" for="inputImage">{{ ___('student_info.father_image') }} {{ ___('common.(95 x 95 px)') }}</label>
                                    <div class="ot_fileUploader left-side mb-3">
                                        <input class="form-control" type="text" placeholder="{{ ___('student_info.father_image') }}" readonly="" id="placeholder2">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="btn btn-lg ot-btn-primary" for="fileBrouse2">{{ ___('common.browse') }}</label>
                                            <input type="file" class="d-none form-control" name="father_image" id="fileBrouse2" accept="image/*">
                                        </button>
                                    </div>

                                </div>
                            </div>
                            {{-- end father --}}
                            {{-- mother --}}
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.mother_name') }} <span
                                            class="fillable"></span></label>
                                    <input class="form-control ot-input @error('mother_name') is-invalid @enderror" name="mother_name"
                                        list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.enter_mother_name') }}" type="text" value="{{ old('mother_name') }}">
                                    @error('mother_name')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.mother_mobile') }} <span
                                            class="fillable"></span></label>
                                    <input class="form-control ot-input @error('mother_mobile') is-invalid @enderror" name="mother_mobile"
                                        list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.enter_mother_mobile') }}" type="text" value="{{ old('mother_mobile') }}">
                                    @error('mother_mobile')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.mother_profession') }} <span
                                            class="fillable"></span></label>
                                    <input class="form-control ot-input @error('mother_profession') is-invalid @enderror" name="mother_profession"
                                        list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.enter_father_profession') }}" type="text" value="{{ old('mother_profession') }}">
                                    @error('mother_profession')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">

                                    <label class="form-label" for="inputImage">{{ ___('student_info.mother_image') }} {{ ___('common.(95 x 95 px)') }}</label>
                                    <div class="ot_fileUploader left-side mb-3">
                                        <input class="form-control" type="text" placeholder="{{ ___('student_info.mother_image') }}" readonly="" id="placeholder3">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="btn btn-lg ot-btn-primary" for="fileBrouse3">{{ ___('student_info.browse') }}</label>
                                            <input type="file" class="d-none form-control" name="mother_image" id="fileBrouse3" accept="image/*">
                                        </button>
                                    </div>

                                </div>
                            </div>
                            {{-- end mother --}}
                            {{-- guardian --}}
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.guardian_name') }} <span
                                            class="fillable">*</span></label>
                                    <input class="form-control ot-input @error('guardian_name') is-invalid @enderror" name="guardian_name"
                                        list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.enter_guardian_name') }}" type="text" value="{{ old('guardian_name',$data['student']->guardian_name) }}">
                                    @error('guardian_name')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.guardian_mobile') }} <span
                                            class="fillable">*</span></label>
                                    <input class="form-control ot-input @error('guardian_mobile') is-invalid @enderror" name="guardian_mobile"
                                        list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.enter_guardian_mobile') }}" type="text" value="{{ old('guardian_mobile',$data['student']->guardian_phone) }}">
                                    @error('guardian_mobile')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.guardian_profession') }} <span
                                            class="fillable"></span></label>
                                    <input class="form-control ot-input @error('guardian_profession') is-invalid @enderror" name="guardian_profession"
                                        list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.enter_guardian_profession') }}" type="text" value="{{ old('guardian_profession') }}">
                                    @error('guardian_profession')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">

                                    <label class="form-label" for="inputImage">{{ ___('student_info.guardian_image') }} {{ ___('common.(95 x 95 px)') }}</label>
                                    <div class="ot_fileUploader left-side mb-3">
                                        <input class="form-control" type="text" placeholder="{{ ___('student_info.guardian_image') }}" readonly="" id="placeholder4">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="btn btn-lg ot-btn-primary" for="fileBrouse4">{{ ___('student_info.browse') }}</label>
                                            <input type="file" class="d-none form-control" name="guardian_image" id="fileBrouse4" accept="image/*">
                                        </button>
                                    </div>

                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.guardian_email') }}</label>
                                    <input class="form-control ot-input @error('guardian_email') is-invalid @enderror" name="guardian_email"
                                        list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.enter_guardian_email') }}" type="email" value="{{ old('guardian_email') }}">
                                    @error('guardian_email')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.guardian_address') }} <span
                                            class="fillable"></span></label>
                                    <input class="form-control ot-input @error('guardian_address') is-invalid @enderror" name="guardian_address"
                                        list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.enter_guardian_address') }}" type="text" value="{{ old('guardian_address') }}">
                                    @error('guardian_address')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="exampleDataList" class="form-label ">{{ ___('student_info.guardian_relation') }} <span
                                            class="fillable"></span></label>
                                    <input class="form-control ot-input @error('guardian_relation') is-invalid @enderror" name="guardian_relation"
                                        list="datalistOptions" id="exampleDataList"
                                        placeholder="{{ ___('student_info.enter_guardian_relation') }}" type="text" value="{{ old('guardian_relation') }}">
                                    @error('guardian_relation')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">

                                    <label for="validationServer04" class="form-label">{{ ___('student_info.status') }} <span class="fillable">*</span></label>
                                    <select class="nice-select niceSelect bordered_style wide @error('status') is-invalid @enderror"
                                    name="status" id="validationServer04"
                                    aria-describedby="validationServer04Feedback">
                                        <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('student_info.active') }}</option>
                                        <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('student_info.inactive') }}
                                        </option>
                                    </select>

                                    @error('status')
                                        <div id="validationServer04Feedback" class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                            {{-- end guardian --}}



                            {{-- End parent information --}}







                            <div class="row">
                                <div class="col-md-12 mt-24">
                                    <div class="text-end">
                                        <button class="btn btn-lg ot-btn-primary"><span><i class="fa-solid fa-save"></i>
                                            </span>{{ ___('common.submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
