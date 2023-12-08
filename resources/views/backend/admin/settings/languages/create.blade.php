@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection
@section('content')
    <nav class="mt-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ ___('common.home') }}</a></li>
            <li class="breadcrumb-item" aria-current="page"><a
                    href="{{ route('languages.index') }}">{{ ___('language.languages') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ ___('common.add_new') }}</li>
        </ol>
    </nav>

    <div class="p-4 bg-white rounded-3">

        <div class="row justify-content-between mb-4">
            <div class="col-6 align-self-center">
                <h4 class="m-0">{{ ___('language.languages') }}</h4>
            </div>
        </div>
        <form action="{{ route('languages.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="exampleDataList" class="form-label ">{{ ___('common.name') }} <span
                                    class="text-danger">*</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" name="name"
                                list="datalistOptions" id="exampleDataList" placeholder="{{ ___('common.enter_name') }}">
                            @error('name')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="exampleDataList" class="form-label ">{{ ___('language.code') }} <span
                                    class="text-danger">*</span></label>
                            <input class="form-control @error('code') is-invalid @enderror" name="code"
                                list="datalistOptions" id="exampleDataList" placeholder="{{ ___('language.enter_code') }}">
                            @error('code')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="validationServer04" class="form-label">{{ ___('language.flag_icon') }}
                                <span class="text-danger">*</span></label>
                            <select class="form-control @error('flagIcon') is-invalid @enderror"
                                name="flagIcon" id="validationServer04" aria-describedby="validationServer04Feedback">
                                <option value="">{{ ___('common.select') }}</option>
                                @foreach ($data['flagIcons'] as $row)
                                    <option value="{{ $row->icon_class }}" data-icon="{{ $row->icon_class }}">
                                        {{ $row->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('flagIcon')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="col-md-6 direction-button">

                            <label for="validationServer04" class="form-label">{{ ___('language.direction') }}</label>

                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input mt-0 mr-4 read common-key"
                                        name="direction" value="{{ App\Enums\Direction::RTL }}" id="rtl_direction">
                                    <label class="custom-control-label"
                                        for="rtl_direction">{{ ___('language.rtl') }}</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input mt-0 mr-4 read common-key"
                                        name="direction" value="{{ App\Enums\Direction::LTR }}" id="ltr_direction">
                                    <label class="custom-control-label"
                                        for="ltr_direction">{{ ___('language.ltr') }}</label>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="text-end">
                        <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                            </span>{{ ___('common.submit') }}</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="bg-white text-center p-4">
            {{ setting('footer_text') }}
        </div>
    </div>

@endsection
