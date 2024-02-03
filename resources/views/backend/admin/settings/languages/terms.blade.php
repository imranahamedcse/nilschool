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
            <li class="breadcrumb-item active" aria-current="page">{{ ___('create.edit_terms') }}</li>
        </ol>
    </nav>

    <div class="app-bar row justify-content-between m-0 p-2 rounded-4 rounded-bottom-0">
        <div class="col-6 align-self-center">
            <h4 class="m-0">{{ ___('create.languages') }}</h4>
        </div>
    </div>

    <div class="border-start border-end border-5 border-black p-3 bg-white">
        <form action="{{ route('languages.update.terms', @$data['language']->code) }}" enctype="multipart/form-data"
            method="post" id="terms-form">
            @csrf
            @method('PUT')
            <input type="hidden" name="code" id="code" value="{{ @$data['language']->code }}">
            <div class="row mb-3">
                <div class="col-md-12 mb-3">
                    <label for="validationDefault01" class="form-label">{{ ___('create.module') }}</label>
                    <select class="form-select @error('lang_module') is-invalid @enderror change-module"
                        name="lang_module" id="validationDefault01">

                        @foreach (config('site.language_modules') as $key => $item)
                            <option value="{{ $key }}">{{ ___($item) }}</option>
                        @endforeach


                    </select>
                    @error('lang_module')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label ">{{ ___('create.term') }}</label>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label ">{{ ___('create.translated_language') }}</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 term-translated-language">
                    @foreach ($data['terms'] as $key => $row)
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input class="form-control" name="name" value="{{ $key }}" disabled>

                            </div>
                            <div class="col-md-6 translated_language">
                                <input class="form-control"
                                    placeholder="{{ ___('create.translated_language') }}" name="{{ $key }}"
                                    value="{{ $row }}">
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-12 mt-3">
                    <div class="text-end">
                        <button class="btn btn-rounded-sm btn-primary rounded-5"><span><i class="fa-solid fa-save"></i>
                            </span>{{ ___('create.submit') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="app-bar text-center p-3 rounded-4 rounded-top-0 mb-4">
        {{ setting('footer_text') }}
    </div>
@endsection
