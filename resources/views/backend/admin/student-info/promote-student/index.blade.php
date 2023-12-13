@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@push('style')
    @include('backend.admin.components.table.css')
@endpush

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card bg-white">
        <div class="card-body">
            <div class="border-bottom pb-3 mb-4">
                <h4 class="m-0">{{ @$data['title'] }}</h4>
            </div>

            <h5 class="text-info">{{ ___('student_info.From') }}</h5>

            <form action="{{ route('promote_students.search') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="validationDefault01" class="form-label">{{ ___('student_info.class') }} <span
                                class="text-danger">*</span></label>
                        <select id="validationDefault01" class="class form-control @error('class') is-invalid @enderror"
                            name="class">
                            <option value="">{{ ___('student_info.select_class') }}</option>
                            @foreach ($data['classes'] as $item)
                                <option {{ old('class', @$request->class) == $item->id ? 'selected' : '' }}
                                    value="{{ $item->class->id }}">{{ $item->class->name }}</option>
                            @endforeach
                        </select>
                        @error('class')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationDefault02" class="form-label">{{ ___('student_info.section') }} <span
                                class="text-danger">*</span></label>
                        <select id="validationDefault02" class="section form-control @error('section') is-invalid @enderror"
                            name="section">
                            <option value="">{{ ___('student_info.select_section') }}</option>
                            @foreach (@$data['sections'] as $item)
                                <option {{ old('section', @$request->section) == $item->section->id ? 'selected' : '' }}
                                    value="{{ $item->section->id }}">{{ $item->section->name }}</option>
                            @endforeach
                        </select>
                        @error('section')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <h5 class="text-info">{{ ___('student_info.To') }}</h5>

                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault03" class="form-label">{{ ___('student_info.Promote session') }} <span
                                class="text-danger">*</span></label>
                        <select id="validationDefault03"
                            class="session form-control @error('promote_session') is-invalid @enderror"
                            name="promote_session">
                            <option value="">{{ ___('student_info.select_session') }}</option>
                            @foreach ($data['sessions'] as $item)
                                <option
                                    {{ old('promote_session', @$request->promote_session) == $item->id ? 'selected' : '' }}
                                    value="{{ $item->id }}">{{ $item->name }}
                                    {{ setting('session') == $item->id ? ___('academic.Current') : '' }}</option>
                            @endforeach
                        </select>
                        @error('promote_session')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault04" class="form-label">{{ ___('student_info.Promote class') }}
                            <span class="text-danger">*</span></label>
                        <select id="validationDefault04"
                            class="promote_class form-control @error('promote_class') is-invalid @enderror"
                            name="promote_class">
                            <option value="">{{ ___('student_info.select_class') }}</option>
                            @foreach (@$data['promoteClasses'] as $item)
                                <option
                                    {{ old('promote_class', @$request->promote_class) == $item->class->id ? 'selected' : '' }}
                                    value="{{ $item->class->id }}">{{ $item->class->name }}</option>
                            @endforeach
                        </select>
                        @error('promote_class')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationDefault05" class="form-label">{{ ___('student_info.Promote section') }} <span
                                class="text-danger">*</span></label>
                        <select id="validationDefault05"
                            class="promote_section form-control @error('promote_section') is-invalid @enderror"
                            name="promote_section">
                            <option value="">{{ ___('student_info.select_section') }}</option>
                            @foreach (@$data['promoteSections'] as $item)
                                <option
                                    {{ old('promote_section', @$request->promote_section) == $item->section->id ? 'selected' : '' }}
                                    value="{{ $item->section->id }}">{{ $item->section->name }}</option>
                            @endforeach
                        </select>
                        @error('promote_section')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="d-flex align-items-center justify-content-between mt-0">
                        @if (@$message)
                            <div class="alert alert-success" role="alert">
                                {{ @$message }}
                            </div>
                        @else
                            <p></p>
                        @endif
                        <button class="btn btn-primary"><span><i class="fa-solid la-search"></i>
                            </span>{{ ___('common.Search') }}</button>
                    </div>
                </div>
            </form>

            @if ($students)
                <div class="border-bottom mb-3"></div>

                <form action="{{ route('promote_students.store') }}" enctype="multipart/form-data" method="post"
                    id="visitForm">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="class" value="{{ $request->class }}">
                    <input type="hidden" name="section" value="{{ $request->section }}">
                    <input type="hidden" name="promote_session" value="{{ $request->promote_session }}">
                    <input type="hidden" name="promote_class" value="{{ $request->promote_class }}">
                    <input type="hidden" name="promote_section" value="{{ $request->promote_section }}">

                    <table id="datatable" class="table">
                        <thead class="thead">
                            <tr>
                                <th>
                                    <div class="check-box">
                                        <div class="form-check">
                                            <input class="form-check-input all" type="checkbox" />
                                        </div>
                                    </div>
                                </th>
                                <th class="purchase">{{ ___('common.Admission no') }}</th>
                                <th class="purchase">{{ ___('common.Student Name') }}</th>
                                <th class="purchase">{{ ___('common.Guardian Name') }}</th>
                                <th class="purchase">{{ ___('common.Mobile Number') }}</th>
                                <th class="purchase">{{ ___('common.Result') }}</th>
                                <th class="purchase">{{ ___('common.Roll') }}</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            @foreach ($students as $key => $item)
                                <tr>
                                    <td>
                                        <div class="check-box">
                                            <div class="form-check">
                                                <input class="form-check-input child" type="checkbox"
                                                    name="students[{{ $key }}][]"
                                                    value="{{ @$item->student->id }}" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ @$item->student->admission_no }}</td>
                                    <td>{{ @$item->student->first_name }} {{ @$item->student->last_name }}
                                    </td>
                                    <td>{{ @$item->student->parent->guardian_name }}</td>
                                    <td>{{ @$item->student->mobile }}</td>
                                    <td>
                                        @if (array_key_exists(@$item->student->id, $results))
                                            <span
                                                class="badge-basic-{{ $results[@$item->student->id] == 'Pass' ? 'primary' : 'warning' }}-text">{{ $results[@$item->student->id] == 'Pass' ? 'Passed' : 'Failed' }}</span>
                                            <input class="form-control" type="hidden"
                                                name="result[{{ $key }}][]"
                                                value="{{ $results[@$item->student->id] == 'Pass' ? 1 : 0 }}">
                                        @else
                                            <span class="badge-basic-danger-text">{{ ___('common.Pending') }}</span>
                                            <input class="form-control" type="hidden"
                                                name="result[{{ $key }}][]" value="0">
                                        @endif
                                    </td>
                                    <td>
                                        <input class="form-control" type="number"
                                            name="roll[{{ $key }}][]" value="{{ old('role') }}">
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (hasPermission('promote_students_create'))
                        <div class="col-md-12 mt-3">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                    </span>{{ ___('common.Promote') }}</button>
                            </div>
                        </div>
                    @endif
                </form>
            @endif
        </div>

    </div>
@endsection

@push('script')
    @include('backend.admin.components.table.js')

    <script src="{{ asset('backend/js/get-section.js') }}"></script>
    <script src="{{ asset('backend/js/get-promote-class-section.js') }}"></script>
@endpush
