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

            <form action="{{ route('assign-subject.store') }}" enctype="multipart/form-data" method="post" id="subjectAssign">
                @csrf
                <input type="hidden" name="form_type" id="form_type" value="create" />
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault01" class="form-label">{{ ___('academic.class') }} <span
                                class="text-danger">*</span></label>
                        <select id="validationDefault01"
                            class="class form-control @error('class') is-invalid @enderror" name="class">
                            <option value="">{{ ___('student_info.select_class') }}</option>
                            @foreach ($data['classes'] as $item)
                                <option value="{{ $item->class->id }}">{{ $item->class->name }}</option>
                            @endforeach
                        </select>

                        @error('class')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <div id="show_sections">
                            <label for="validationDefault02" class="form-label">{{ ___('academic.section') }} <span
                                    class="text-danger">*</span></label>
                            <select class="form-control section @error('section') is-invalid @enderror" name="section"
                                id="validationDefault02">
                                <option value="">{{ ___('student_info.select_section') }}</option>
                            </select>
                            @error('section')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault03" class="form-label">{{ ___('common.status') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status"
                            id="validationDefault03">
                            <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('common.active') }}</option>
                            <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('common.inactive') }}
                            </option>
                        </select>

                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="d-flex align-items-center gap-4 flex-wrap">
                            <h5 class="m-0 flex-fill text-info">
                                {{ ___('common.add') }} {{ ___('academic.Subject & Teacher') }}
                            </h5>
                            <button type="button" class="btn btn-sm btn-info" onclick="addSubjectTeacher()">
                                <span><i class="fa-solid fa-plus"></i> </span>
                                {{ ___('common.add') }}</button>
                            <input type="hidden" name="counter" id="counter" value="1">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <div>
                                <table class="table school_borderLess_table table_border_hide2" id="subject-teacher">
                                    <thead>
                                        <tr>
                                            <td scope="col">{{ ___('academic.subject') }} <span
                                                    class="text-danger"></span>
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

                                    </tbody>
                                </table>
                            </div>

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
