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

            <form action="{{ route('homework.store') }}" enctype="multipart/form-data" method="post" id="markRegister">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-3 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('student_info.class') }} <span
                                        class="fillable">*</span></label>
                                <select id="getSections" class="form-control class @error('class') is-invalid @enderror"
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
                            <div class="col-md-3 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('student_info.section') }} <span
                                        class="fillable">*</span></label>
                                <select id="getSubjects"
                                    class="sections form-control section @error('section') is-invalid @enderror"
                                    name="section" id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('student_info.select_section') }}</option>
                                    </option>
                                </select>

                                @error('section')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('academic.subject') }} <span
                                        class="fillable">*</span></label>
                                <select id="subject"
                                    class="subjects form-control @error('subject') is-invalid @enderror"
                                    name="subject" id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('examination.select_subject') }}</option>
                                </select>

                                @error('subject')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.status') }} <span
                                        class="fillable">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('common.inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('fees.Document') }} </label>
                                <input class="form-control @error('document') is-invalid @enderror" name="document"
                                    list="datalistOptions" id="exampleDataList" type="file"
                                    placeholder="{{ ___('fees.enter_document') }}" value="{{ old('document') }}">
                                @error('document')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('fees.description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('fees.enter_description') }}">{{ old('description') }}</textarea>
                                @error('description')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

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
        // Start examination filter get subjects
        $("#getSections").on('change', function(e) {
            getExaminationFilterSubject();
        });
        $(".sections").on('change', function(e) {
            getExaminationFilterSubject();
        });

        function getExaminationFilterSubject() {
            var classId = $("#getSections").val();
            var sectionId = $(".sections").val();

            if (classId && sectionId) {
                var url = $('#url').val();
                var formData = {
                    classes_id: classId,
                    section_id: sectionId,
                }
                $.ajax({
                    type: "GET",
                    dataType: 'html',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url + '/assign-subject/get-subjects',
                    success: function(data) {
                        var subject_options = '';
                        var subject_li = '';

                        $.each(JSON.parse(data), function(i, item) {
                            subject_options += "<option value=" + item.subject.id + ">" + item.subject
                                .name + "</option>";
                            subject_li += "<li data-value=" + item.subject.id + " class='option'>" +
                                item.subject.name + "</li>";
                        });

                        $("select.subjects option").not(':first').remove();
                        $("select.subjects").append(subject_options);


                        $("div .subjects .current").html($("div .subjects .list li:first").html());
                        $("div .subjects .list li").not(':first').remove();
                        $("div .subjects .list").append(subject_li);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        }
        // End examination filter get subjects
    </script>
@endpush
