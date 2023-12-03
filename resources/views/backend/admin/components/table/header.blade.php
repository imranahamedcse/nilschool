<div class="row justify-content-between border-bottom pb-4 mb-4">
    <div class="col-2 align-self-center">
        <h4 class="m-0">{{ @$data['headers']['title'] }}</h4>
    </div>

    <div class="col-8 d-flex justify-content-center align-items-center">
        @if (@$data['headers']['filter'] != '')
            <form action="{{ route(@$data['headers']['filter'][0]) }}" method="post" id="marksheet" class="exam_assign"
                enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    @if (in_array('view', @$data['headers']['filter']))
                        <div class="px-1">
                            <select class="form-control" name="view">
                                <option {{ old('view', @$data['request']->view) == '0' ? 'selected' : '' }}
                                    value="0">
                                    {{ ___('report.Short view') }}</option>
                                <option {{ old('view', @$data['request']->view) == '1' ? 'selected' : '' }}
                                    value="1">
                                    {{ ___('report.Details view') }}</option>
                            </select>
                        </div>
                    @endif

                    @if (in_array('class', @$data['headers']['filter']))
                        <div class="px-1">
                            <select id="getSections" class="form-control @error('class') is-invalid @enderror"
                                name="class">
                                <option value="">{{ ___('student_info.select_class') }} </option>
                                @foreach ($data['classes'] as $item)
                                    <option {{ old('class', @$data['request']->class) == $item->id ? 'selected' : '' }}
                                        value="{{ $item->class->id }}">{{ $item->class->name }}</option>
                                @endforeach
                            </select>
                            @error('class')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif

                    @if (in_array('section', @$data['headers']['filter']))
                        <div class="px-1">
                            <select class="sections form-control @error('section') is-invalid @enderror" name="section">
                                <option value="">{{ ___('student_info.select_section') }} </option>
                                @foreach ($data['sections'] as $item)
                                    <option
                                        {{ old('section', @$data['request']->section) == $item->section->id ? 'selected' : '' }}
                                        value="{{ $item->section->id }}">{{ $item->section->name }}</option>
                                @endforeach
                            </select>
                            @error('section')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif

                    @if (in_array('shift', @$data['headers']['filter']))
                        <div class="px-1">
                            <select class="shift form-control" name="shift" id="validationServer04"
                                aria-describedby="validationServer04Feedback">
                                <option value="">{{ ___('student_info.select_shift') }}</option>
                                @foreach ($data['shifts'] as $item)
                                    <option {{ old('shift', @$data['request']->shift) == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if (in_array('transaction', @$data['headers']['filter']))
                        <div class="px-1">
                            <select class="form-control account_head_type @error('type') is-invalid @enderror"
                                name="type">
                                <option value="{{ App\Enums\AccountHeadType::INCOME }}"
                                    {{ @$data['request']->type == App\Enums\AccountHeadType::INCOME ? 'selected' : '' }}>
                                    {{ ___('account.income') }}</option>
                                <option value="{{ App\Enums\AccountHeadType::EXPENSE }}"
                                    {{ @$data['request']->type == App\Enums\AccountHeadType::EXPENSE ? 'selected' : '' }}>
                                    {{ ___('account.expense') }}</option>
                            </select>
                            @error('type')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif

                    @if (in_array('account_head', @$data['headers']['filter']))
                        <div class="px-1">
                            <select class="form-control account_types @error('head') is-invalid @enderror"
                                name="head">
                                <option value="">{{ ___('student_info.select head') }}</option>
                                @foreach ($data['account_head'] as $item)
                                    <option {{ old('head', @$data['request']->head) == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('head')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif

                    @if (in_array('month', @$data['headers']['filter']))
                        <div class="px-1">
                            <input value="{{ old('month', @$data['request']->month) }}" name="month"
                                class="form-control @error('month') is-invalid @enderror" type="month"
                                placeholder="Search month" min="2023-01" max="2023-12">
                            @error('month')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif

                    @if (in_array('date', @$data['headers']['filter']))
                        <div class="px-1">
                            <input value="{{ old('date', @$data['request']->date) }}" name="date"
                                class="form-control @error('date') is-invalid @enderror" type="date">

                            @error('date')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif

                    @if (in_array('date_range', @$data['headers']['filter']))
                        <div class="px-1">
                            <div class="single_large_selectBox">
                                <input type="text" class="form-control" value="{{ @$data['request']->dates }}"
                                    name="dates">
                            </div>
                        </div>
                    @endif

                    @if (in_array('exam_type', @$data['headers']['filter']))
                        <div class="px-1">
                            <select class="form-control exam_types @error('exam_type') is-invalid @enderror"
                                name="exam_type">
                                <option value="">{{ ___('examination.select_exam_type') }} </option>
                                @foreach ($data['exam_types'] as $item)
                                    <option
                                        {{ old('exam_type', @$data['request']->exam_type) == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('exam_type')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif

                    @if (in_array('subject', @$data['headers']['filter']))
                        <div class="px-1">
                            <select class="subjects form-control @error('subject') is-invalid @enderror" name="subject">
                                <option value="">{{ ___('academic.Select subject') }} </option>
                            </select>
                            @error('subject')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif

                    @if (in_array('student', @$data['headers']['filter']))
                        <div class="px-1">
                            <select class="students form-control @error('student') is-invalid @enderror" name="student">
                                <option value="">{{ ___('student_info.Select student') }} *</option>
                                @foreach ($data['students'] as $item)
                                    <option
                                        {{ old('student', @$data['student']->id) == $item->student_id ? 'selected' : '' }}
                                        value="{{ $item->student_id }}">{{ $item->student->first_name }}
                                        {{ $item->student->last_name }}</option>
                                @endforeach
                            </select>
                            @error('student')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif

                    @if (in_array('fees', @$data['headers']['filter']))
                        <div class="px-1">
                            <select class="fees-masters form-control @error('fees_master') is-invalid @enderror"
                                name="fees_master">
                                <option value="">{{ ___('fees.select_fees_type') }} *</option>
                                @foreach ($data['fees_masters'] as $item)
                                    <option value="{{ $item->id }}"
                                        {{ @$data['request']->fees_master == $item->id ? 'selected' : '' }}>
                                        {{ $item->type->name }}</option>
                                @endforeach
                            </select>
                            @error('fees_master')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endif
                    <div class="px-1">
                        <button class="btn btn-primary" type="submit">
                            {{ ___('common.Search') }}
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div>
    <div class="col-2 text-end">
        @if (@$data['headers']['create-permission'] != '' && hasPermission(@$data['headers']['create-permission']))
            <a class="btn btn-sm btn-secondary" href="{{ route(@$data['headers']['create-route']) }}">
                <i class="fa-solid fa-plus"></i> {{ ___('common.add') }}
            </a>
        @endif
    </div>
</div>
