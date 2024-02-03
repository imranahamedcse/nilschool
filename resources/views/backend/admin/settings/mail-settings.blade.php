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

            <form action="{{ route('settings.mail-setting') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="row mb-3">
                                {{-- Mail drive start --}}
                                <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3">
                                    <label for="inputname" class="form-label">{{ ___('create.mail_host') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="mail_host"
                                        class="form-control @error('mail_host') is-invalid @enderror"
                                        value="{{ setting('mail_host') }}" placeholder="{{ ___('create.mail_host') }}">
                                    @error('mail_host')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- Mail drive start --}}

                                {{-- Mail drive start --}}
                                <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3">
                                    <label for="inputname" class="form-label">{{ ___('create.mail_address') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="mail_address"
                                        class="form-control @error('mail_address') is-invalid @enderror"
                                        value="{{ Setting('mail_address') }}"
                                        placeholder="{{ ___('create.mail_address') }}">
                                    @error('mail_address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- Mail drive start --}}

                                {{-- Mail drive start --}}
                                <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3">
                                    <label for="inputname" class="form-label">{{ ___('create.from_name') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="from_name"
                                        class="form-control @error('from_name') is-invalid @enderror"
                                        value="{{ Setting('from_name') }}" placeholder="{{ ___('create.from_name') }}">
                                    @error('from_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- Mail drive start --}}

                                {{-- Mail drive start --}}
                                <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3">
                                    <label for="inputname" class="form-label">{{ ___('create.mail_username') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="mail_username"
                                        class="form-control @error('mail_username') is-invalid @enderror"
                                        value="{{ Setting('mail_username') }}"
                                        placeholder="{{ ___('create.mail_username') }}">
                                    @error('mail_username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- Mail drive start --}}

                                <!-- Mail Password start -->
                                <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3">
                                    <label for="exampleInputPassword1"
                                        class="form-label ">{{ ___('create.mail_password') }} <span
                                            class="text-danger"></span></label> <input type="password" name="mail_password"
                                        class="form-control @error('mail_password') is-invalid @enderror"
                                        id="exampleInputmail_password1"
                                        placeholder="{{ ___('create.enter_your_mail_password') }}">
                                    @error('mail_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Mail Password end -->
                                <!-- Mail Password start -->
                                <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3">
                                    <label for="exampleInputPassword1" class="form-label ">{{ ___('create.mail_port') }}
                                        <span class="text-danger">*</span></label> <input type="text" name="mail_port"
                                        value="{{ Setting('mail_port') }}"
                                        class="form-control @error('mail_port') is-invalid @enderror"
                                        id="exampleInputmail_password1"
                                        placeholder="{{ ___('create.enter_your_mail_post') }}">
                                    @error('mail_port')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Mail Password end -->

                                <!-- Encryption start-->
                                <div class="col-12 col-md-6 col-xl-6 col-lg-6 mb-3">
                                    <label for="Encryption" class="form-label">{{ ___('create.encryption') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="encryption" id="encryptionId"
                                        class="@error('encryption') is-invalid @enderror">
                                        <option value="">{{ ___('create.select_encryption') }}</option>
                                        <option value="{{ App\Enums\Encryption::null }}"
                                            {{ setting('encryption') == App\Enums\Encryption::null ? 'selected' : '' }}>
                                            {{ ___('create.null') }}</option>
                                        <option value="{{ App\Enums\Encryption::tls }}"
                                            {{ setting('encryption') == App\Enums\Encryption::tls ? 'selected' : '' }}>
                                            {{ ___('create.tls') }}</option>
                                        <option value="{{ App\Enums\Encryption::ssl }}"
                                            {{ setting('encryption') == App\Enums\Encryption::ssl ? 'selected' : '' }}>
                                            {{ ___('create.ssl') }}</option>
                                    </select>
                                </div>
                                <!-- Encryption end-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="text-end">
                            @if (hasPermission('storage_settings_update'))
                                <button class="btn btn-primary">
                                    <span>
                                        <i class="fa-solid fa-save"></i>
                                    </span>{{ ___('create.update') }}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
