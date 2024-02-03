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

            <form action="{{ route('question-bank.store') }}" enctype="multipart/form-data" method="post" id="question_bank">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">


                            {{-- second row --}}
                            <div class="col-md-3 mb-3">
                                <label for="validationDefault01"
                                    class="form-label">{{ ___('create.question_type') }} <span
                                        class="text-danger">*</span></label>
                                <select class="question_type @error('type') is-invalid @enderror" name="type"
                                    id="validationDefault01">
                                    <option value="">{{ ___('create.select_type') }}</option>
                                    @foreach (\Config::get('site.question_types') as $key => $type)
                                        <option {{ old('type') == $key ? 'selected' : '' }} value="{{ $key }}">
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
                                    class="form-label">{{ ___('create.question_group') }}
                                    <span class="text-danger">*</span></label>
                                <select class="question_group @error('question_group') is-invalid @enderror"
                                    name="question_group" id="validationDefault02">
                                    <option data-display="Select">{{ ___('create.select_question_group') }}
                                    </option>
                                    @if (old('question_group'))
                                        @php
                                            $questionGroupName = \App\Models\OnlineExamination\QuestionGroup::find(old('question_group'))?->name ?? '';
                                        @endphp
                                        <option value="{{ old('question_group') }}" selected>{{ $questionGroupName }}
                                        </option>
                                    @endif
                                </select>
                                @error('question_group')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationDefault03" class="form-label">{{ ___('create.status') }} <span
                                        class="text-danger">*</span></label>
                                <select id="validationDefault03" class="@error('status') is-invalid @enderror"
                                    name="status">
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
                                <label for="validationDefault04" class="form-label ">{{ ___('create.Mark') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('mark') is-invalid @enderror" name="mark"
                                    id="validationDefault04" type="number"
                                    placeholder="{{ ___('create.Enter mark') }}" value="{{ old('mark') }}"
                                    required>
                                @error('mark')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- second row --}}




                            {{-- question --}}
                            <div class="col-12 mb-3">
                                <label for="validationDefault05" class="form-label ">{{ ___('create.question') }}
                                    <span class="text-danger">*</span></label>
                                <input class="form-control @error('question') is-invalid @enderror" name="question"
                                    id="validationDefault05" placeholder="{{ ___('create.enter_question') }}"
                                    value="{{ old('question') }}" required>
                                @error('question')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- question --}}




                            {{-- total options --}}
                            <div class="col-md-12 mb-3 total_option">
                                <label class="form-label">{{ ___('create.Total option') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('total_option') is-invalid @enderror" name="total_option"
                                    id="total_option">
                                    <option value="">{{ ___('create.select_option') }}</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option {{ old('total_option') == $i ? 'selected' : '' }}
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
                                    {{-- options load in js --}}

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
                                    @endif
                                </div>
                                @if ($errors->has('option.*'))
                                    <span
                                        class="text-danger">{{ ___('create.The options field is required.') }}</span>
                                @endif
                            </div>
                            {{-- option --}}





                            {{-- Answer --}}
                            <div class="col-md-12 mb-3 single_choice_ans">
                                <label class="form-label">{{ ___('create.Answer') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('single_choice_ans') is-invalid @enderror"
                                    name="single_choice_ans" id="single_choice_ans">
                                    <option value="">{{ ___('create.select_option') }}</option>
                                    {{-- options load in js --}}
                                    @if (old('option'))
                                        @foreach (old('option') as $oldMultipleChoiceAns)
                                            <option value="{{ $oldMultipleChoiceAns }}"
                                                {{ old('single_choice_ans') == $loop->iteration ? 'selected' : '' }}>
                                                {{ ___('create.option') }} {{ $loop->iteration }}
                                            </option>
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
                                <label class="form-label">{{ ___('create.Answer') }} <span
                                        class="text-danger">*</span></label>
                                <div class="input-check-radio academic-section" id="multiple_choice_ans">
                                    {{-- options load in js --}}
                                    @if (old('option'))
                                        @foreach (old('option') as $oldMultipleChoiceAns)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="multiple_choice_ans[]"
                                                    value="{{ $loop->iteration }}" id="option{{ $loop->iteration }}"
                                                    {{ in_array($loop->iteration, old('multiple_choice_ans') ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label ps-2 pe-5"
                                                    for="option{{ $loop->iteration }}">{{ ___('create.option') }}
                                                    {{ $loop->iteration }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                @if ($errors->has('multiple_choice_ans'))
                                    <span class="text-danger">{{ $errors->first('multiple_choice_ans') }}</span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3 true_false_ans">
                                <label class="form-label">{{ ___('create.Answer') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('true_false_ans') is-invalid @enderror"
                                    name="true_false_ans">
                                    <option value="">{{ ___('create.select_option') }}</option>
                                    <option {{ old('true_false_ans') == 1 ? 'selected' : '' }} value="1">
                                        {{ ___('create.True') }}</option>
                                    <option {{ old('true_false_ans') == 2 ? 'selected' : '' }} value="2">
                                        {{ ___('create.False') }}</option>
                                </select>
                                @error('true_false_ans')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- Answer --}}







                            <div class="col-12 mt-24">
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
    <script>
        $(document).ready(function() {
            $("form#question_bank .total_option").hide();
            $("form#question_bank .options").hide();
            $("form#question_bank .single_choice_ans").hide();
            $("form#question_bank .multiple_choice_ans").hide();
            $("form#question_bank .true_false_ans").hide();


            var type = parseInt($("form#question_bank .question_type").val());
            if (type)
                details(type);

            $("form#question_bank .question_type").on('change', function(e) {
                var type = parseInt($(this).val());
                details(type);
            });

            function details(type) {
                if (type === 1) {
                    $("form#question_bank .total_option").show();
                    $("form#question_bank .options").show();
                    $("form#question_bank .single_choice_ans").show();
                    $("form#question_bank .multiple_choice_ans").hide();
                    $("form#question_bank .true_false_ans").hide();
                } else if (type === 2) {
                    $("form#question_bank .total_option").show();
                    $("form#question_bank .options").show();
                    $("form#question_bank .single_choice_ans").hide();
                    $("form#question_bank .multiple_choice_ans").show();
                    $("form#question_bank .true_false_ans").hide();
                } else if (type === 3) {
                    $("form#question_bank .total_option").hide();
                    $("form#question_bank .options").hide();
                    $("form#question_bank .single_choice_ans").hide();
                    $("form#question_bank .multiple_choice_ans").hide();
                    $("form#question_bank .true_false_ans").show();
                } else {
                    $("form#question_bank .total_option").hide();
                    $("form#question_bank .options").hide();
                    $("form#question_bank .single_choice_ans").hide();
                    $("form#question_bank .multiple_choice_ans").hide();
                    $("form#question_bank .true_false_ans").hide();
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('form#question_bank #total_option').on('change', function() {
                var total_option = Number($(this).val());
                var type = parseInt($("form#question_bank .question_type").val());
                var options = ''; // options
                var section_options = ''; // single_choice_ans
                var section_li = ''; // single_choice_ans
                var multiple_choice_ans = ''; // multiple_choice_ans

                for (var i = 1; i <= total_option; i++) {
                    options += `
                <div class="col-md-3 mb-3">
                    <label class="form-label">Option ${i} <span class="text-danger">*</span></label>
                    <input class="form-control" name="option[${i}]" value="" placeholder="Enter option" required>
                </div>
            `;

                    if (type === 1) {
                        section_options += `<option value='${i}'>Option ${i}</option>`;
                        section_li += `<li data-value='${i}' class='option'>Option ${i}</li>`;
                    }

                    if (type === 2) {
                        multiple_choice_ans += `
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="multiple_choice_ans[]" value="${i}" id="option${i}">
                        <label class="form-check-label ps-2 pe-5" for="option${i}">Option ${i}</label>
                    </div>
                `;
                    }
                }

                // options start
                $('form#question_bank .input_ptions').empty();
                $('form#question_bank .input_ptions').append(options);
                // options end

                // single_choice_ans start
                if (type === 1) {
                    $("form#question_bank .single_choice_ans").show();

                    $("#single_choice_ans option").not(':first').remove();
                    $("#single_choice_ans").append(section_options)
                    $("div #single_choice_ans .list li").not(':first').remove();
                    $("#single_choice_ans .list").append(section_li);

                    $("#single_choice_ans").niceSelect('update');
                }
                // single_choice_ans end

                // multiple_choice_ans start
                if (type === 2) {
                    $("form#question_bank .multiple_choice_ans").show();

                    $('form#question_bank #multiple_choice_ans').empty();
                    $('form#question_bank #multiple_choice_ans').append(multiple_choice_ans);
                }
                // multiple_choice_and end
            });


            $(document).on('change', '.question_type', function() {
                $("#total_option").val('');
                $('#total_option').niceSelect('update');
                $('.input_ptions').empty();
                $('#multiple_choice_ans').empty();
                $('#single_choice_ans').empty();
            });
        });
    </script>

    <script>
        $(document).on('keyup.question_group', function() {
            var $self = $(this);
            var $text = $self.find('.nice-select-search').val();
            var url = $('#url').val();

            var formData = {
                text: $text,
            }

            $.ajax({
                type: "GET",
                dataType: 'html',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + '/question-bank/get-question-group',
                success: function(data) {

                    var section_options = '';
                    var section_li = '';

                    $.each(JSON.parse(data), function(i, item) {
                        section_options += "<option value=" + i + ">" + item + "</option>";
                        section_li += "<li data-value=" + i + " class='option'>" + item +
                            "</li>";
                    });

                    $("select.question_group option").not(':first').remove();
                    $("select.question_group").append(section_options);

                    $("div .question_group .list li").not(':first').remove();
                    $("div .question_group .list").append(section_li);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endpush
