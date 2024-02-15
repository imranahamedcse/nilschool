@extends('frontend.partials.master')
@section('title')
    {{ ___('frontend.Search Result') }}
@endsection

@section('main')
    <!-- Breadcrumbs start  -->
    @include('frontend.partials.breadcrumb')
    <!-- Breadcrumbs end  -->

    <!-- Contact start  -->
    <div class="container-fluid">
        <div class="page_info">
            <img class="image" src="{{ @globalAsset(@$sections['study_at']->upload->path, '1920X700.webp') }}"
                alt="">
            <div class="text">
                <h3 class="fw-semibold">{{ ___('frontend.Results') }}</h3>
                <h6>{{ ___('frontend.What is your result? Check it out here.') }}</h6>
            </div>
        </div>

        <div class="page_items container mb-5">
            <div class="row justify-content-center">

                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('frontend.result') }}" method="post" enctype="multipart/form-data"
                                id="result">
                                @csrf
                                <div class="search_result_form ">

                                    @if ($data['result'])
                                        <div class="alert alert-success text-center">
                                            {{ $data['result'] }}
                                        </div>
                                    @endif

                                    <div class="row">

                                        <div class="col-xl-6 mb-4">
                                            <label class="form-label text-dark fw-semibold"
                                                for="#">{{ ___('frontend.Academic Year/Session') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="session">
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

                                        <div class="col-xl-6 mb-4">
                                            <label class="form-label text-dark fw-semibold" for="#">{{ ___('frontend.Select class') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="class">
                                                <option value="" data-display="Select">{{ ___('frontend.Select') }}</option>
                                            </select>
                                            @if ($errors->has('class'))
                                                <small class="text-danger">{{ $errors->first('class') }}</small>
                                            @endif
                                        </div>

                                        <div class="col-xl-6 mb-4">
                                            <label class="form-label text-dark fw-semibold" for="#">{{ ___('frontend.Select section') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="section">
                                                <option value="" data-display="Select">{{ ___('frontend.Select') }}</option>
                                            </select>
                                            @if ($errors->has('section'))
                                                <small class="text-danger">{{ $errors->first('section') }}</small>
                                            @endif
                                        </div>

                                        <div class="col-xl-6 mb-4">
                                            <label class="form-label text-dark fw-semibold" for="#">{{ ___('frontend.Select Exam') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" name="exam">
                                                <option value="" data-display="Select">{{ ___('frontend.Select') }}</option>
                                            </select>
                                            @if ($errors->has('exam'))
                                                <small class="text-danger">{{ $errors->first('exam') }}</small>
                                            @endif
                                        </div>

                                        <div class="col-xl-12 mb-4">
                                            <label for="exampleDataList" class="form-label text-dark fw-semibold">{{ ___('frontend.Admission no') }}
                                                <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" value="{{ old('admission_no') }}"
                                                name="admission_no" id="exampleDataList"
                                                placeholder="{{ ___('frontend.Enter admission no') }}">
                                            @if ($errors->has('admission_no'))
                                                <small class="text-danger">{{ $errors->first('admission_no') }}</small>
                                            @endif
                                        </div>

                                        <div class="d-grid mb-4">
                                            <button type="submit"
                                                class="btn btn-primary">{{ ___('frontend.Search') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Search result end  -->
@endsection
