@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card bg-white">
        <div class="card-body">
            <div class="border-bottom pb-3 mb-4">
                <h4 class="m-0">{{ @$data['title'] }}</h4>
            </div>

            <form action="{{ route('online-exam.store') }}" enctype="multipart/form-data" method="post" id="onlineExam">
                @csrf
                <div class="row mb-3">

                    <div class="col-md-4 mb-3">
                        <label for="validationDefault01" class="form-label ">{{ ___('create.name') }} <span
                                class="text-danger">*</span></label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                            id="validationDefault01" type="text" placeholder="{{ ___('create.enter_name') }}"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault02" class="form-label ">{{ ___('create.Start') }} <span
                                class="text-danger">*</span></label>
                        <input class="form-control @error('start') is-invalid @enderror" name="start"
                            type="datetime-local" id="validationDefault02" type="text"
                            placeholder="{{ ___('create.Enter start') }}" value="{{ old('start') }}">
                        @error('start')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="validationDefault03" class="form-label ">{{ ___('create.End') }} <span
                                class="text-danger">*</span></label>
                        <input class="form-control @error('end') is-invalid @enderror" name="end" type="datetime-local"
                            id="validationDefault03" type="text" placeholder="{{ ___('create.Enter end') }}"
                            value="{{ old('end') }}">
                        @error('end')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="validationDefault04" class="form-label ">{{ ___('create.Published') }}
                            <span class="text-danger">*</span></label>
                        <input class="form-control @error('published') is-invalid @enderror" name="published"
                            type="datetime-local" id="validationDefault04" type="text"
                            placeholder="{{ ___('create.Enter published') }}" value="{{ old('published') }}">
                        @error('published')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>






                    <div class="col-md-4 mb-3">
                        <label for="validationDefault05" class="form-label">{{ ___('create.Question group') }}
                            <span class="text-danger">*</span></label>
                        <select id="question_group validationDefault05"
                            class="form-control @error('question_group') is-invalid @enderror" name="question_group">
                            <option value="">{{ ___('create.Select question group') }}</option>
                            @foreach ($data['question_groups'] as $item)
                                <option {{ old('question_group') == $item->id ? 'selected' : '' }}
                                    value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('question_group')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault06" class="form-label">{{ ___('create.class') }} <span
                                class="text-danger">*</span></label>
                        <select id="validationDefault06" class="class form-control @error('class') is-invalid @enderror"
                            name="class">
                            <option value="">{{ ___('create.select_class') }}</option>
                            @foreach ($data['classes'] as $item)
                                <option {{ old('class') == $item->class->id ? 'selected' : '' }}
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
                    <div class="col-md-2 mb-3">
                        <label for="validationDefault07" class="form-label">{{ ___('create.section') }} <span
                                class="text-danger">*</span></label>
                        <select id="validationDefault07" class="section form-control @error('section') is-invalid @enderror"
                            name="section">
                            <option value="">{{ ___('create.select_section') }}</option>
                            @foreach ($data['sections'] as $item)
                                @if (old('section') == $item->id)
                                    <option {{ old('section') == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}
                                @endif
                            @endforeach
                        </select>
                        @error('section')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="validationDefault08" class="form-label">{{ ___('create.Subject') }}</label>
                        <select id="validationDefault08" class="subject form-control @error('subject') is-invalid @enderror"
                            name="subject">
                            <option value="">{{ ___('create.Select subject') }}</option>
                            @foreach ($data['sections'] as $item)
                                @if (old('subject') == $item->id)
                                    <option {{ old('subject') == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}
                                @endif
                            @endforeach
                        </select>
                        @error('subject')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>






                    <div class="col-md-4 mb-3">
                        <label for="validationDefault09" class="form-label ">{{ ___('create.Total Mark') }}
                            <span class="text-danger">*</span></label>
                        <input class="form-control @error('mark') is-invalid @enderror" name="mark"
                            id="validationDefault09" type="number"
                            placeholder="{{ ___('create.Enter total mark') }}" value="{{ old('mark') }}">
                        @error('mark')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault10" class="form-label">{{ ___('create.Type') }}</label>
                        <select id="type validationDefault10" class="form-control @error('type') is-invalid @enderror"
                            name="type">
                            <option value="">{{ ___('create.Select Type') }}</option>
                            @foreach ($data['types'] as $item)
                                <option {{ old('type') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <div>
                            <label for="validationDefault11"
                                class="form-label">{{ ___('create.student_category') }}</label>
                            <select id="student_category validationDefault11"
                                class="nice-select student_category @error('student_category') is-invalid @enderror"
                                name="student_category">
                                <option value="">{{ ___('create.select_student_category') }}</option>
                                @foreach ($data['categories'] as $item)
                                    <option {{ old('student_category') == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}
                                @endforeach
                            </select>
                        </div>
                        @error('student_category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <div>
                            <label for="validationDefault12" class="form-label">{{ ___('create.gender') }}</label>
                            <select id="gender validationDefault12"
                                class="nice-select gender @error('gender') is-invalid @enderror"
                                name="gender">
                                <option value="">{{ ___('create.select_gender') }}</option>
                                @foreach ($data['genders'] as $item)
                                    <option {{ old('gender') == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}
                                @endforeach
                            </select>
                        </div>
                        @error('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- First row end --}}






                    {{-- Second row --}}
                    <div class="col-md-4 mb-3">
                        <h5>{{ ___('create.Question list') }}</h5>
                        <div class="table-responsive">
                            <input type="hidden" id="page" value="create">
                            <table class="table table-bordered role-table" id="types_table">
                                <thead class="thead">
                                    <tr>
                                        <th class="purchase mr-4">{{ ___('create.All') }} <input
                                                class="form-check-input all" type="checkbox"></th>
                                        <th class="purchase">{{ ___('create.Question') }}</th>
                                        <th class="purchase">{{ ___('create.Type') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody"></tbody>
                            </table>
                        </div>
                        @if ($errors->has('questions_ids'))
                            <span class="text-danger">{{ ___('create.At least select one.') }}</span>
                        @endif
                    </div>
                    <div class="col-md-8 mb-3">
                        <h5>{{ ___('create.Students List') }} </h5>
                        <div class="table-responsive">
                            <table class="table table-bordered role-table" id="students_table">
                                <thead class="thead">
                                    <tr>
                                        <th class="purchase mr-4">{{ ___('create.All') }} <input class="form-check-input"
                                                type="checkbox" id="all_students"></th>
                                        <th class="purchase">{{ ___('create.admission_no') }}</th>
                                        <th class="purchase">{{ ___('create.Student Name') }}</th>
                                        <th class="purchase">{{ ___('create.class') }} ({{ ___('create.section') }})
                                        </th>
                                        <th class="purchase">{{ ___('create.guardian_name') }}</th>
                                        <th class="purchase">{{ ___('create.Mobile Number') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody"></tbody>
                            </table>
                        </div>
                        @if ($errors->has('student_ids'))
                            <span class="text-danger">{{ ___('create.At least select one.') }}</span>
                        @endif
                    </div>
                    {{-- Second row end --}}
                    <div class="col-md-12 mt-24">
                        <div class="text-end">
                            <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                </span>{{ ___('create.submit') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('script')
    <script src="{{ asset('backend/js/get-section.js') }}"></script>
    <script type="text/javascript">
        // online exam create time start
        $(document).ready(function() {
            var today = new Date().toISOString().slice(0, 16);

            $('input[name="start"]').attr('min', today);
            // $('input[name="end"]').attr('min', today);
            $('input[name="published"]').attr('min', today);

            $('input[name="end"]').on('click', function() {
                var startValue = $('input[name="start"]').val();
                if (startValue) {
                    // $('input[name="end"]').attr('min', startValue);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Please enter start time first'
                    });
                }
            });

            $('input[name="published"]').on('click', function() {
                var endValue = $('input[name="end"]').val();
                if (endValue) {
                    $('input[name="published"]').attr('max', endValue);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Please enter end time first'
                    });
                }
            });
        });
        // online exam create time end
    </script>
@endpush
