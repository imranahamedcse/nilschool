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

            <form action="{{ route('assign-subject.update', $data['subject_assign']->id) }}" enctype="multipart/form-data"
                method="post" id="visitForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="form_type" id="form_type" value="update" />
                <input type="hidden" name="id" id="id" value="{{ $data['subject_assign']->id }}" />
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="validationServer04" class="form-label">{{ ___('academic.class') }} <span
                                class="text-danger">*</span></label>
                        <select id="getSections" class="form-control @error('class') is-invalid @enderror" name="class"
                            id="validationServer04" aria-describedby="validationServer04Feedback">
                            <option {{ @$data['disabled'] ? 'disabled' : '' }} value="">
                                {{ ___('student_info.select_class') }}</option>
                            @foreach ($data['classes'] as $item)
                                <option
                                    {{ @$data['subject_assign']->classes_id == $item->id ? 'selected' : (@$data['disabled'] ? 'disabled' : '') }}
                                    value="{{ $item->class->id }}">{{ $item->class->name }}</option>
                            @endforeach
                        </select>

                        @error('class')
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <div id="show_sections">
                            <label for="validationServer04" class="form-label">{{ ___('academic.section') }} <span
                                    class="text-danger">*</span></label>
                            <select onchange="return changeSection(this)"
                                class="form-control @error('section') is-invalid @enderror" name="section"
                                id="validationServer04" aria-describedby="validationServer04Feedback">
                                <option {{ @$data['disabled'] ? 'disabled' : '' }} value="">
                                    {{ ___('student_info.select_section') }}</option>
                                @foreach ($data['sections'] as $item)
                                    <option
                                        {{ @$data['subject_assign']->section_id == $item->section_id ? 'selected' : (@$data['disabled'] ? 'disabled' : '') }}
                                        value="{{ $item->section_id }}">{{ $item->section->name }}</option>
                                @endforeach
                            </select>
                            @error('section')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationServer04" class="form-label">{{ ___('common.status') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status"
                            id="validationServer04" aria-describedby="validationServer04Feedback">
                            <option
                                {{ @$data['subject_assign']->status == App\Enums\Status::ACTIVE ? 'selected' : (@$data['disabled'] ? 'disabled' : '') }}
                                value="{{ App\Enums\Status::ACTIVE }}">{{ ___('common.active') }}</option>
                            <option
                                {{ @$data['subject_assign']->status == App\Enums\Status::INACTIVE ? 'selected' : (@$data['disabled'] ? 'disabled' : '') }}
                                value="{{ App\Enums\Status::INACTIVE }}">{{ ___('common.inactive') }}
                            </option>
                        </select>

                        @error('status')
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center gap-4 flex-wrap">
                            <h5 class="m-0 flex-fill text-info">
                                {{ ___('common.add') }} {{ ___('academic.Subject & Teacher') }}
                            </h5>
                            <button type="button" class="btn btn-sm btn-info" onclick="addSubjectTeacher()">
                                <span><i class="fa-solid fa-plus"></i> </span>
                                {{ ___('academic.add') }}</button>
                            <input type="hidden" name="counter" id="counter" value="1">
                        </div>
                    </div>
                </div>

                <table class="table" id="subject-teacher">
                    <thead>
                        <tr>
                            <td scope="col">{{ ___('academic.subject') }} <span class="text-danger"></span>
                                @if ($errors->any())
                                    @if ($errors->has('subjects.*'))
                                        <span class="text-danger">{{ 'The fields are required' }}
                                    @endif
                                @endif
                            </td>
                            <td scope="col">
                                {{ ___('academic.teacher') }}
                                <span class="text-danger"></span>
                                @if ($errors->any())
                                    @if ($errors->has('teachers.*'))
                                        <span class="text-danger">{{ 'The fields are required' }}
                                    @endif
                                @endif
                            </td>
                            <td scope="col">

                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['all_subject_assign'] as $key => $item)
                            <tr>
                                <td>
                                    <select class="form-control @error('subjects') is-invalid @enderror"
                                        name="subjects[]" id="subject{{ $key }}">
                                        <option {{ @$data['assignSubjects'][$key] == 1 ? 'disabled' : '' }}
                                            value="">{{ ___('academic.Select subject') }}
                                        </option>
                                        @foreach ($data['subjects'] as $item)
                                            <option
                                                {{ @$data['subject_assign']->subjectTeacher[$key]->subject->id == $item->id ? 'selected' : (@$data['assignSubjects'][$key] == 1 ? 'disabled' : '') }}
                                                value="{{ $item->id }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control @error('teachers') is-invalid @enderror"
                                        name="teachers[]" id="teacher{{ $key }}">
                                        <option {{ @$data['assignSubjects'][$key] == 1 ? 'disabled' : '' }}
                                            value="">{{ ___('academic.Select teacher') }}
                                        </option>
                                        @foreach ($data['teachers'] as $item)
                                            <option
                                                {{ @$data['subject_assign']->subjectTeacher[$key]->teacher->id == $item->id ? 'selected' : (@$data['assignSubjects'][$key] == 1 ? 'disabled' : '') }}
                                                value="{{ $item->id }}">
                                                {{ $item->first_name }} {{ $item->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    @if ($data['assignSubjects'][$key] == 0)
                                        <button class="btn btn-danger" onclick="removeRow(this)">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

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
    <script>
        function addSubjectTeacher() {
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
                url: url + '/assign-subject/add-subject-teacher',
                success: function(data) {
                    $("#subject-teacher tbody").append(data);
                    $("#counter").val(counter);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function removeRow(element) {
            element.closest('tr').remove();
        }
    </script>
@endpush
