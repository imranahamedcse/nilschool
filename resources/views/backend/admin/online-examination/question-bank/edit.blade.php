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

            <form action="{{ route('question-bank.update', @$data['question_bank']->id) }}" enctype="multipart/form-data"
                method="post" id="question_bank">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">



                            {{-- second row --}}
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault01"
                                    class="form-label">{{ ___('online-examination.question_type') }} <span
                                        class="text-danger">*</span></label>
                                <select class="question_type form-control @error('type') is-invalid @enderror"
                                    name="type" id="validationDefault01">
                                    <option value="">{{ ___('online-examination.select_type') }}</option>
                                    @foreach (\Config::get('site.question_types') as $key => $type)
                                        <option {{ old('type', $data['question_bank']->type) == $key ? 'selected' : '' }}
                                            value="{{ $key }}">
                                            {{ ___($type) }}</option>
                                    @endforeach
                                </select>

                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 question_group mb-3">
                                <label for="validationDefault02"
                                    class="form-label">{{ ___('online-examination.question_group') }}
                                    <span class="text-danger">*</span></label>
                                <select class="question_group form-control @error('question_group') is-invalid @enderror"
                                    name="question_group" id="validationDefault02">
                                    <option value="">{{ ___('online-examination.select_question_group') }}</option>
                                    <option value="{{ $data['question_group']->id }}" selected>
                                        {{ $data['question_group']->name }}</option>
                                </select>
                                @error('question_group')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault03" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault03">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ old('status', $data['question_bank']->status) == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.active') }}
                                    </option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ old('status', $data['question_bank']->status) == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.inactive') }}
                                    </option>
                                </select>

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('online-examination.Mark') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('mark') is-invalid @enderror" name="mark"
                                    id="validationDefault04" type="number"
                                    placeholder="{{ ___('online-examination.Enter mark') }}"
                                    value="{{ old('mark', @$data['question_bank']->mark) }}" required>
                                @error('mark')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- second row --}}




                            {{-- question --}}
                            <div class="col-12 mb-3">
                                <label for="validationDefault05"
                                    class="form-label ">{{ ___('online-examination.question') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('question') is-invalid @enderror" name="question"
                                    id="validationDefault05" placeholder="{{ ___('online-examination.enter_question') }}"
                                    value="{{ old('question', @$data['question_bank']->question) }}" required>
                                @error('question')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- question --}}





                            {{-- total options --}}
                            <div class="col-md-12 mb-3 total_option">
                                <label class="form-label">{{ ___('online-examination.Total option') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('total_option') is-invalid @enderror" name="total_option"
                                    id="total_option">
                                    <option value="">{{ ___('online-examination.select_option') }}</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option
                                            {{ old('total_option', $data['question_bank']->total_option) == $i ? 'selected' : '' }}
                                            value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('total_option')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- total options --}}




                            {{-- options --}}
                            <div class="options">
                                <div class="row input_ptions">
                                    @if (old('option'))
                                        @foreach (old('option') as $oldMultipleChoiceAns)
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Option {{ $loop->iteration }} <span
                                                        class="text-danger">*</span></label>
                                                <input class="form-control" name="option[{{ $loop->iteration }}]"
                                                    value="{{ $oldMultipleChoiceAns }}" placeholder="Enter option"
                                                    required>
                                            </div>
                                        @endforeach
                                    @else
                                        @foreach (@$data['question_bank']->questionOptions as $questionOption)
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">{{ ___('online-examination.option') }}
                                                    {{ $loop->iteration }} <span class="text-danger">*</span></label>
                                                <input class="form-control" name="option[{{ $loop->iteration }}]"
                                                    value="{{ $questionOption->option }}">
                                            </div>
                                        @endforeach
                                    @endif
                                    @if ($errors->has('option.*'))
                                        <span
                                            class="text-danger">{{ ___('online-examination.The options field is required.') }}</span>
                                    @endif
                                </div>
                            </div>
                            {{-- option --}}




                            {{-- Answer --}}
                            <div class="col-md-12 mb-3 single_choice_ans">
                                <label class="form-label">{{ ___('online-examination.Answer') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('single_choice_ans') is-invalid @enderror"
                                    name="single_choice_ans" id="single_choice_ans">
                                    <option value="">{{ ___('online-examination.select_option') }}</option>
                                    @if (old('option'))
                                        @foreach (old('option') as $oldMultipleChoiceAns)
                                            <option value="{{ $oldMultipleChoiceAns }}"
                                                {{ old('single_choice_ans') == $loop->iteration ? 'selected' : '' }}>
                                                {{ ___('online-examination.option') }} {{ $loop->iteration }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach (@$data['question_bank']->questionOptions as $questionOption)
                                            <option
                                                {{ old('single_choice_ans', @$data['question_bank']->answer) == $loop->iteration ? 'selected' : '' }}
                                                value="{{ $loop->iteration }}">{{ ___('online-examination.option') }}
                                                {{ $loop->iteration }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('single_choice_ans')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3 multiple_choice_ans">
                                <label class="form-label">{{ ___('online-examination.Answer') }} <span
                                        class="text-danger">*</span></label>
                                <div class="input-check-radio academic-section" id="multiple_choice_ans">
                                    @if (old('option'))
                                        @foreach (old('option') as $oldMultipleChoiceAns)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    name="multiple_choice_ans[]" value="{{ $loop->iteration }}"
                                                    id="option{{ $loop->iteration }}"
                                                    {{ in_array($loop->iteration, old('multiple_choice_ans') ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label ps-2 pe-5"
                                                    for="option{{ $loop->iteration }}">{{ ___('online-examination.option') }}
                                                    {{ $loop->iteration }}</label>
                                            </div>
                                        @endforeach
                                    @elseif ($data['question_bank']->type == 2)
                                        @foreach (@$data['question_bank']->questionOptions as $questionOption)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    name="multiple_choice_ans[]" value="{{ $loop->iteration }}"
                                                    id="option{{ $loop->iteration }}"
                                                    {{ in_array($loop->iteration, @$data['question_bank']->answer ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label ps-2 pe-5"
                                                    for="option{{ $loop->iteration }}">{{ $loop->iteration }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                @if ($errors->has('multiple_choice_ans'))
                                    <span class="text-danger">{{ $errors->first('multiple_choice_ans') }}</span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3 true_false_ans">
                                <label class="form-label">{{ ___('online-examination.Answer') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('true_false_ans') is-invalid @enderror"
                                    name="true_false_ans">
                                    <option value="">{{ ___('online-examination.select_option') }}</option>
                                    <option
                                        {{ old('true_false_ans', @$data['question_bank']->answer) == '1' ? 'selected' : '' }}
                                        value="1">{{ ___('online-examination.True') }}</option>
                                    <option
                                        {{ old('true_false_ans', @$data['question_bank']->answer) == '2' ? 'selected' : '' }}
                                        value="2">{{ ___('online-examination.False') }}</option>
                                </select>
                                @error('true_false_ans')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- Answer --}}

                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('common.update') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
