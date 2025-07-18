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

            <form action="{{ route('marks-register.store') }}" enctype="multipart/form-data" method="post" id="markRegister">
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
                                <select class="form-control section @error('section') is-invalid @enderror" name="section"
                                    id="validationDefault02">
                                    <option value="">{{ ___('create.select_section') }}</option>
                                    </option>
                                </select>

                                @error('section')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-lg-3">
                                <label for="validationDefault03" class="form-label">{{ ___('create.exam_type') }}
                                    <span class="text-danger">*</span></label>
                                <select id="validationDefault03"
                                    class="exam_types form-control @error('exam_type') is-invalid @enderror"
                                    name="exam_type">
                                    <option value="">{{ ___('create.select_exam_type') }}</option>
                                </select>
                                @error('exam_type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault04" class="form-label">{{ ___('create.subject') }} <span
                                        class="text-danger">*</span></label>
                                <select class="subject form-control @error('subject') is-invalid @enderror" name="subject"
                                    id="validationDefault04">
                                    <option value="">{{ ___('create.select_subject') }}</option>
                                </select>

                                @error('subject')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="col-md-12 mt-24">
                                <div class="table-responsive">
                                    <table class="table table-bordered role-table" id="students_table">
                                        <thead class="thead">
                                            <tr>
                                                <th>{{ ___('create.Student Name') }}</th>
                                                <th>{{ ___('create.Total mark') }}</th>
                                                <th>{{ ___('create.Mark distribution') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbody"></tbody>
                                    </table>
                                </div>
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


@
@push('script')
    <script src="{{ asset('backend/js/get-section.js') }}"></script>
    <script src="{{ asset('backend/js/get-subject.js') }}"></script>
    <script src="{{ asset('backend/js/get-exam-type.js') }}"></script>
@endpush
