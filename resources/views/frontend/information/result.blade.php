@extends('frontend.information.master')
@section('title')
    {{ ___('frontend.Result') }}
@endsection

@section('mainSection')
    <h3 class="fw-semibold text-dark">Result</h3>
    <div class="border-bottom mb-3"></div>
    <div class="row mb-3">
        <div class="col-12 col-lg-6 offset-lg-3 bg-white p-5">
            <div class="text-center">
                <h5 class="fw-semibold text-dark">{{ ___('frontend.Results') }}</h5>
                <p class="mb-5">{{ ___('frontend.Here Search Your Result!') }}</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('information.result.search') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-12 mb-3 col-md-6">
                        <label class="form-label" for="#">{{ ___('frontend.Academic Year/Session') }}
                            <span class="text-danger">*</span></label>
                        <select class="form-control session" name="session">
                            <option value="" data-display="Select">{{ ___('frontend.Select') }}</option>
                            @foreach ($data['sessions'] as $item)
                                <option {{ old('session') == $item->id ? 'selected' : '' }}
                                    value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('session'))
                            <small class="text-danger">{{ $errors->first('session') }}</small>
                        @endif
                    </div>

                    <div class="col-12 mb-3 col-md-6">
                        <label class="form-label" for="#">{{ ___('frontend.Select class') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-control classes" name="class">
                            <option value="" data-display="Select">{{ ___('frontend.Select') }}</option>
                        </select>
                        @if ($errors->has('class'))
                            <small class="text-danger">{{ $errors->first('class') }}</small>
                        @endif
                    </div>

                    <div class="col-12 mb-3 col-md-6">
                        <label class="form-label" for="#">{{ ___('frontend.Select section') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-control sections" name="section">
                            <option value="" data-display="Select">{{ ___('frontend.Select') }}</option>
                        </select>
                        @if ($errors->has('section'))
                            <small class="text-danger">{{ $errors->first('section') }}</small>
                        @endif
                    </div>

                    <div class="col-12 mb-3 col-md-6">
                        <label class="form-label" for="#">{{ ___('frontend.Select Exam') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-control exam_types" name="exam">
                            <option value="" data-display="Select">{{ ___('frontend.Select') }}</option>
                        </select>
                        @if ($errors->has('exam'))
                            <small class="text-danger">{{ $errors->first('exam') }}</small>
                        @endif
                    </div>

                    <div class="col-12 mb-4">
                        <label for="exampleDataList" class="form-label">{{ ___('frontend.Admission no') }}
                            <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" value="{{ old('admission_no') }}"
                            name="admission_no" id="exampleDataList"
                            placeholder="{{ ___('frontend.Enter admission no') }}">
                        @if ($errors->has('admission_no'))
                            <small class="text-danger">{{ $errors->first('admission_no') }}</small>
                        @endif
                    </div>

                    <div class="d-grid">
                        <button type="submit"
                            class="btn btn-primary">{{ ___('frontend.Search') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
