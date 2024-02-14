@extends('frontend.partials.master')
@section('title')
    {{ ___('frontend.Search Result') }}
@endsection

@section('main')
<!-- Breadcrumbs start  -->
<div class="container">
    <nav class="mt-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach (@$data['breadcrumbs'] as $item)
                @if ($item['route'] != '')
                    <li class="breadcrumb-item"><a class="text-info"
                            href="{{ route($item['route']) }}">{{ $item['title'] }}</a></li>
                @else
                    <li class="breadcrumb-item active">{{ $item['title'] }}</li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>
<!-- Breadcrumbs end  -->

<!-- Search result start  -->
<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-6">
            <div class="text-center text-dark lh-1 mb-5">
                <h3><strong>{{ ___('frontend.Check Results') }}</strong></h3>
                <p class="opacity-75">{{ ___('frontend.Here Check Your Recent Result!') }}</p>
            </div>
            <form action="{{ route('frontend.result') }}" method="post" enctype="multipart/form-data" id="result">
                @csrf
                <div class="search_result_form ">

                    @if ($data['result'])
                        <div class="alert alert-success text-center">
                            {{ $data['result'] }}
                        </div>
                    @endif

                    <div class="row">

                        <div class="col-xl-6 mb-4">
                            <label class="primary_label2" for="#">{{ ___('frontend.Academic Year/Session') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="session">
                                <option value="" data-display="Select">{{ ___('frontend.Select') }}</option>
                                @foreach ($data['sessions'] as $item)
                                    <option {{ old('session') == $item->id ? 'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('session'))
                                <small class="text-danger">{{ $errors->first('session') }}</small>
                            @endif
                        </div>

                        <div class="col-xl-6 mb-4">
                            <label class="primary_label2" for="#">{{ ___('frontend.Select class') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="class">
                                <option value="" data-display="Select">{{ ___('frontend.Select') }}</option>
                            </select>
                            @if ($errors->has('class'))
                                <small class="text-danger">{{ $errors->first('class') }}</small>
                            @endif
                        </div>

                        <div class="col-xl-6 mb-4">
                            <label class="primary_label2" for="#">{{ ___('frontend.Select section') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="section">
                                <option value="" data-display="Select">{{ ___('frontend.Select') }}</option>
                            </select>
                            @if ($errors->has('section'))
                                <small class="text-danger">{{ $errors->first('section') }}</small>
                            @endif
                        </div>

                        <div class="col-xl-6 mb-4">
                            <label class="primary_label2" for="#">{{ ___('frontend.Select Exam') }} <span class="text-danger">*</span></label>
                            <select class="form-control" name="exam">
                                <option value="" data-display="Select">{{ ___('frontend.Select') }}</option>
                            </select>
                            @if ($errors->has('exam'))
                                <small class="text-danger">{{ $errors->first('exam') }}</small>
                            @endif
                        </div>

                        <div class="col-xl-12 mb-4">
                            <label for="exampleDataList" class="primary_label2">{{ ___('frontend.Admission no') }} <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" value="{{ old('admission_no') }}" name="admission_no" id="exampleDataList" placeholder="{{ ___('frontend.Enter admission no') }}">
                            @if ($errors->has('admission_no'))
                                <small class="text-danger">{{ $errors->first('admission_no') }}</small>
                            @endif
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary">{{ ___('frontend.Search Result') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<!-- Search result end  -->

@endsection
