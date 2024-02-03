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

            <form action="{{ route('assignment.store') }}" enctype="multipart/form-data" method="post" id="markRegister">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault01" class="form-label">{{ ___('create.class') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control class @error('class') is-invalid @enderror" name="class"
                                    id="validationDefault01">
                                    <option value="">{{ ___('create.select_class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option {{ old('class') == $item->id ? 'selected' : '' }}
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
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault02" class="form-label">{{ ___('create.section') }} <span
                                        class="text-danger">*</span></label>
                                <select id="getSubjects" class="form-control section @error('section') is-invalid @enderror"
                                    name="section" id="validationDefault02">
                                    <option value="">{{ ___('create.select_section') }}</option>
                                    </option>
                                </select>

                                @error('section')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault03" class="form-label">{{ ___('create.subject') }} <span
                                        class="text-danger">*</span></label>
                                <select id="subject" class="subjects form-control @error('subject') is-invalid @enderror"
                                    name="subject" id="validationDefault03">
                                    <option value="">{{ ___('create.select_subject') }}</option>
                                </select>

                                @error('subject')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault04" class="form-label">{{ ___('create.status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault04">
                                    <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('create.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('create.inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault05" class="form-label ">{{ ___('create.Mark') }} </label>
                                <input class="form-control @error('mark') is-invalid @enderror" name="mark"
                                    value="{{ old('mark') }}" id="validationDefault05" type="number"
                                    placeholder="{{ ___('create.Enter mark') }}">
                                @error('mark')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault06" class="form-label ">{{ ___('create.Assigned date') }}
                                </label>
                                <input class="form-control @error('assigned_date') is-invalid @enderror"
                                    name="assigned_date" value="{{ old('assigned_date') }}" id="validationDefault06"
                                    type="date" placeholder="{{ ___('create.enter_assigned_date') }}">
                                @error('assigned_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault07" class="form-label ">{{ ___('create.Submission date') }}
                                </label>
                                <input class="form-control @error('submission_date') is-invalid @enderror"
                                    name="submission_date" value="{{ old('submission_date') }}" id="validationDefault07"
                                    type="date" placeholder="{{ ___('create.enter_submission_date') }}">
                                @error('submission_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault08" class="form-label ">{{ ___('create.Document') }} </label>
                                <input class="form-control @error('document') is-invalid @enderror" name="document"
                                    id="validationDefault08" type="file" placeholder="{{ ___('create.enter_document') }}"
                                    value="{{ old('document') }}">
                                @error('document')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="validationDefault09" class="form-label ">{{ ___('create.description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="validationDefault09"
                                    placeholder="{{ ___('create.enter_description') }}">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('create.submit') }}</button>
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
    <script src="{{ asset('backend/js/get-section.js') }}"></script>

    <script>
        // Start examination filter get subjects
        $(".class").on('change', function(e) {
            getExaminationFilterSubject();
        });
        $(".section").on('change', function(e) {
            getExaminationFilterSubject();
        });

        function getExaminationFilterSubject() {
            var classId = $(".class").val();
            var sectionId = $(".section").val();

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
