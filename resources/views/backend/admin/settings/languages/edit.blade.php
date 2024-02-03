@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection
@section('content')
    <nav class="mt-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ ___('create.home') }}</a></li>
            <li class="breadcrumb-item" aria-current="page"><a
                    href="{{ route('languages.index') }}">{{ ___('create.languages') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ ___('create.edit') }}</li>
        </ol>
    </nav>

    <div class="bg-white p-4 rounded-3">

        <div class="row justify-content-between mb-4">
            <div class="col-6 align-self-center">
                <h4 class="m-0">{{ $data['title'] }}</h4>
            </div>
        </div>
        <form action="{{ route('languages.update', @$data['language']->id) }}" enctype="multipart/form-data" method="post"
            id="visitForm">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault01" class="form-label ">{{ ___('create.name') }} <span
                                    class="text-danger">*</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" name="name"
                                id="validationDefault01" placeholder="{{ ___('create.enter_name') }} "
                                value="{{ $data['language']->name }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="validationDefault02" class="form-label ">{{ ___('create.code') }} <span
                                    class="text-danger">*</span></label>
                            <input class="form-control @error('code') is-invalid @enderror" name="code"
                                id="validationDefault02" placeholder="{{ ___('create.enter_code') }}"
                                value="{{ $data['language']->code }}">
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="validationDefault03" class="form-label">{{ ___('create.flag_icon') }}
                                <span class="text-danger">*</span></label>
                            <select class="form-control @error('flagIcon') is-invalid @enderror"
                                name="flagIcon" id="validationDefault03">
                                <option value="">{{ ___('create.select') }}</option>
                                @foreach ($data['flagIcons'] as $row)
                                    <option value="{{ $row->icon_class }}" data-icon="{{ $row->icon_class }}"
                                        @php if($data['language']->icon_class == $row->icon_class) echo 'selected' @endphp>
                                        {{ $row->title }} </option>
                                @endforeach
                            </select>
                            @error('flagIcon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 direction-button">

                            <label class="form-label">{{ ___('create.direction') }}</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input mt-0 mr-4 read common-key"
                                        name="direction" value="{{ App\Enums\Direction::RTL }}" id="rtl_direction"
                                        {{ strtoupper($data['language']->direction) == App\Enums\Direction::RTL ? 'checked' : '' }}>
                                    <label class="custom-control-label"
                                        for="rtl_direction">{{ ___('create.rtl') }}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input mt-0 mr-4 read common-key"
                                        name="direction" value="{{ App\Enums\Direction::LTR }}" id="ltr_direction"
                                        {{ strtoupper($data['language']->direction) == App\Enums\Direction::LTR ? 'checked' : '' }}>
                                    <label class="custom-control-label"
                                        for="ltr_direction">{{ ___('create.ltr') }}</label>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="text-end">
                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                        </span>{{ ___('create.update') }}</button>
                </div>
            </div>
        </form>
    </div>

    <div class="bg-white text-center p-4">
        {{ setting('footer_text') }}
    </div>
@endsection
