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

            <form action="{{ route('settings.general-settings') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <!--Application Name Start -->
                            <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3 ">
                                <label for="inputname" class="form-label">{{ ___('create.application_name') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="application_name"
                                    class="form-control @error('application_name') is-invalid @enderror"
                                    value="{{ Setting('application_name') }}"
                                    placeholder="{{ ___('create.enter_you_application_name') }}">
                                @error('application_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!--Application Name End -->
                            <!--Footer Text Start -->
                            <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3 ">
                                <label for="inputname" class="form-label">{{ ___('create.footer_text') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="footer_text"
                                    class="form-control @error('footer_text') is-invalid @enderror"
                                    value="{{ Setting('footer_text') }}"
                                    placeholder="{{ ___('create.enter_your_footer_text') }}">
                                @error('footer_text')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3">

                                <div class="d-flex justify-content-center align-items-center">
                                    <img class="img-thumbnail mb-10 full-logo setting-image"
                                        src="{{ @globalAsset(setting('light_logo'), '150X40.svg') }}"
                                        alt="{{ __('light logo') }}">
                                </div>

                                <label class="form-label" for="light_logo">{{ ___('create.light_logo') }}
                                    {{ ___('create.(155 x 40 px)') }}</label>
                                <input type="file" class="form-control" name="light_logo" accept="image/*">
                            </div>
                            <!--White Logo End -->
                            <!--Black Logo Start -->
                            <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3">

                                <div class="d-flex justify-content-center align-items-center">
                                    <img class="img-thumbnail mb-10 full-logo setting-image"
                                        src="{{ @globalAsset(setting('dark_logo'), '150X40.svg') }}"
                                        alt="{{ __('dark logo') }}">
                                </div>

                                <label class="form-label" for="dark_logo">{{ ___('create.dark_logo') }}
                                    {{ ___('create.(155 x 40 px)') }}</label>
                                <input type="file" class="form-control" name="dark_logo" accept="image/*">
                            </div>
                            <!--Black Logo End -->
                            <div class="col-12">
                                <div class="">
                                    <div class="row align-items-end">
                                        <!--Favicon Start -->
                                        <div class="col-md-6 favicon-uploader mb-3">
                                            <div class="d-flex flex-column">

                                                <div class="d-flex align-items-center gap-3 justify-content-center">
                                                    <img class="img-thumbnail mb-10 full-logo setting-image"
                                                        src="{{ @globalAsset(setting('favicon'), '40X40.svg') }}"
                                                        alt="{{ __('favicon') }}">
                                                </div>

                                                <label class="form-label" for="favicon">{{ ___('create.favicon') }}
                                                    {{ ___('create.(40 x 40 px)') }}</label>
                                                <input type="file" class="form-control" name="favicon" accept="image/*">
                                            </div>
                                        </div>
                                        <!--Favicon End -->
                                        <!-- Default Langauge Start-->
                                        <div class="col-md-6 default-langauge mb-3">
                                            <div class="d-flex flex-column">
                                                <label for="default langauge"
                                                    class="form-label">{{ ___('create.default_langauge') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="default_langauge" id="defaultlangaugeId"
                                                    class="form-select flag_icon_list @error('default_langauge') is-invalid @enderror">

                                                    @foreach ($data['languages'] as $row)
                                                        <option value="{{ $row->code }}"
                                                            data-icon="{{ $row->icon_class }}"
                                                            {{ Setting('default_langauge') == $row->code ? 'selected' : '' }}>
                                                            {{ $row->name }}</option>
                                                    @endforeach
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                        <!-- Default Langauge End-->

                                        <!-- Currency Start-->
                                        <div class="col-md-6 default-langauge mb-3">
                                            <div class="d-flex flex-column">
                                                <label for="currency_code" class="form-label">
                                                    {{ ___('create.Currency') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select name="currency_code" id="currency_code"
                                                    class="form-select flag_icon_list @error('currency_code') is-invalid @enderror">
                                                    @foreach ($data['currencies'] as $currency)
                                                        <option value="{{ $currency->code }}"
                                                            {{ Setting('currency_code') == $currency->code ? 'selected' : '' }}>
                                                            {{ $currency->code }} &mdash; {{ $currency->symbol }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Currency End-->

                                        <!-- Session Start-->
                                        <div class="col-md-6 default-langauge mb-3">
                                            <div class="d-flex flex-column">
                                                <label for="session" class="form-label">{{ ___('create.Session') }}
                                                    <span class="text-danger">*</span></label>
                                                <select name="session" id="session"
                                                    class="form-select flag_icon_list @error('session') is-invalid @enderror">
                                                    @foreach ($data['sessions'] as $row)
                                                        <option {{ setting('session') == $row->id ? 'selected' : '' }}
                                                            value="{{ $row->id }}">{{ $row->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Session End-->

                                        <!--Address Start -->
                                        <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3">
                                            <label for="inputname" class="form-label">{{ ___('create.address') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="address"
                                                class="form-control @error('address') is-invalid @enderror"
                                                value="{{ Setting('address') }}"
                                                placeholder="{{ ___('create.enter_you_address') }}">
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <!--Address End -->

                                        <!--Latest news Start -->
                                        <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3">
                                            <label for="inputname"
                                                class="form-label">{{ ___('common.Latest news') }}</label>
                                            <input type="text" name="latest_news"
                                                class="form-control @error('latest_news') is-invalid @enderror"
                                                value="{{ Setting('latest_news') }}"
                                                placeholder="{{ ___('settings.Enter your latest news') }}">
                                            @error('latest_news')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <!--Latest news End -->

                                        <!--Phone Start -->
                                        <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3">
                                            <label for="inputname" class="form-label">{{ ___('create.phone') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                value="{{ Setting('phone') }}"
                                                placeholder="{{ ___('create.enter_you_phone') }}">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <!--Phone End -->

                                        <!--Email Start -->
                                        <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3">
                                            <label for="inputname" class="form-label">{{ ___('create.email') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ Setting('email') }}"
                                                placeholder="{{ ___('create.enter_you_email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <!--Email End -->

                                        <!--School about Start -->
                                        <div class="col-12 mb-3">
                                            <label for="inputname" class="form-label">{{ ___('create.School about') }}
                                                <span class="text-danger">*</span></label>
                                            <textarea name="school_about" class="m-0 form-control @error('school_about') is-invalid @enderror" cols="30"
                                                rows="3">{{ Setting('school_about') }}"</textarea>
                                            @error('school_about')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <!--School about End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <!-- Update Button Start-->
                        <div class="text-end">
                            @if (hasPermission('general_settings_update'))
                                <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                    </span>{{ ___('create.update') }}</button>
                            @endif
                        </div>
                        <!-- Update Button End-->
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
