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

            <form action="{{ route('post.update', @$data['post']->id) }}" enctype="multipart/form-data" method="post"
                id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            {{-- {{dd($data['post'])}} --}}
                            <div class="col-md-3 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('student_info.class') }} <span
                                        class="text-danger">*</span></label>
                                <select id="getSections" class="form-control @error('class') is-invalid @enderror"
                                    name="class" id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('student_info.select_class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option
                                            {{ old('class', $data['post']->classes_id) == $item->class->id ? 'selected' : '' }}
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
                                        class="text-danger">*</span></label>
                                <select id="getSubjects"
                                    class="nice-select niceSelect sections bordered_style wide @error('section') is-invalid @enderror"
                                    name="section" id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('student_info.select_section') }}</option>
                                    @foreach ($data['sections'] as $item)
                                        @if ($data['post']->section_id == $item->id)
                                            <option
                                                {{ old('section', $data['post']->section_id) == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->name }}
                                        @endif
                                    @endforeach
                                </select>

                                @error('section')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('academic.subject') }} <span
                                        class="text-danger">*</span></label>
                                <select id="subject"
                                    class="form-control subjects wide nice-select bordered_style  @error('subject') is-invalid @enderror"
                                    name="subject">
                                    <option value="">{{ ___('examination.select_subject') }}</option>
                                    @foreach ($data['subjects'] as $item)
                                        @if ($data['post']->subject_id == $item->id)
                                            <option
                                                {{ old('subject', $data['post']->subject_id) == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">{{ $item->name }}
                                        @endif
                                    @endforeach
                                </select>
                                @error('subject')
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
