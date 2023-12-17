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

            <form action="{{ route('exam-assign.update', @$data['exam_assign']->id) }}" enctype="multipart/form-data"
                method="post" id="visitForm">
                <input type="hidden" name="form_type" id="form_type" value="update" />
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="validationDefault01" class="form-label">{{ ___('common.exam_type') }}
                                    <span class="text-danger">*</span></label>
                                <select id="validationDefault01"
                                    class="form-control  @error('exam_types') is-invalid @enderror"
                                    name="exam_types">
                                    <option value="">{{ ___('common.select_exam_type') }}</option>
                                    @foreach ($data['exam_types'] as $item)
                                        <option
                                            {{ old('exam_types', @$data['exam_assign']->exam_type_id) == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                </select>
                                @error('exam_types')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">

                                <label for="validationDefault02" class="form-label">{{ ___('common.class') }} <span
                                        class="text-danger">*</span></label>
                                <select onchange="changeExamAssignClass(this)"
                                    class="nice-select class @error('class') is-invalid @enderror"
                                    name="class" id="validationDefault02">
                                    <option value="">{{ ___('common.select_class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option
                                            {{ old('class', @$data['exam_assign']->classes_id) == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}
                                    @endforeach
                                    </option>
                                </select>

                                @error('class')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ ___('common.section') }} <span
                                        class="text-danger">*</span></label>
                                <div class="input-check-radio academic-section exam-assign-section">
                                    @foreach ($data['sections'] as $item)
                                        <div class='form-check'>
                                            <input class='form-check-input sections' onclick='return checkSection(this)'
                                                type='checkbox'
                                                {{ $item->section_id == @$data['exam_assign']->section_id ? 'checked' : '' }}
                                                name='sections' value="{{ $item->section_id }}" id='flexCheckDefault' />
                                            <label class='form-check-label ps-2 pe-5'
                                                for='flexCheckDefault'>{{ $item->section->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="col-md-6 mb-3">

                                <label for="validationDefault03" class="form-label">{{ ___('common.subjects') }} <span
                                        class="text-danger">*</span></label>
                                <select id="subjectMark validationDefault03"
                                    class="form-control subjects @error('subjects') is-invalid @enderror"
                                    name="subjects" id="validationServer04">
                                    <option value="">{{ ___('common.select_subject') }}</option>
                                    @foreach ($data['subjects'] as $key => $item)
                                        <option
                                            {{ old('subjects', @$data['exam_assign']->subject_id) == $item->subject_id ? 'selected' : '' }}
                                            value="{{ $item->subject_id }}">{{ $item->subject->name }}</option>
                                    @endforeach
                                </select>

                                @error('subjects')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table school_borderLess_table " id="subject_marks_distribute">
                                        <thead>
                                            <tr>
                                                <td scope="col">{{ ___('common.subject') }}<span
                                                        class="text-danger"></span> </td>
                                                <td scope="col"> {{ ___('common.mark_distribution') }} <span
                                                        class="text-danger"></span> </td>
                                            </tr>
                                        </thead>
                                        <tbody id="main">
                                            <tr>
                                                <td>
                                                    <p class="mark_distribution_p">
                                                        {{ @$data['exam_assign']->subject->name }}</p>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-between mt-0">
                                                        <div></div>
                                                        <button type="button"
                                                            class="btn btn-primary radius_30px small_add_btn"
                                                            onclick="marksDistribution({{ @$data['exam_assign']->subject->id }})">
                                                            <span><i class="fa-solid fa-plus"></i> </span>
                                                            {{ ___('common.add') }}</button>
                                                    </div>
                                                    <table class="table table_border_hide"
                                                        id="marks-distribution{{ @$data['exam_assign']->subject->id }}">
                                                        @foreach (@$data['exam_assign']->mark_distribution as $key => $item)
                                                            <tr>
                                                                <td>
                                                                    <div class="school_primary_fileUplaoder">
                                                                        <input type="text"
                                                                            name="marks_distribution[{{ @$data['exam_assign']->subject->id }}][titles][]"
                                                                            class="redonly_input"
                                                                            value="{{ $item->title }}"
                                                                            placeholder="{{ ___('common.title') }}">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="school_primary_fileUplaoder">
                                                                        <input type="number" step="any"
                                                                            name="marks_distribution[{{ @$data['exam_assign']->subject->id }}][marks][]"
                                                                            class="redonly_input"
                                                                            value="{{ $item->mark }}"
                                                                            placeholder="{{ ___('common.marks') }}">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <button class="drax_close_icon mark_distribution_close"
                                                                        onclick="removeRow(this)">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
                                            </tr>
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
