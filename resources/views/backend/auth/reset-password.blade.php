@extends('master')

@section('maintitle')
    {{ $data['title'] }}
@endsection

@section('mainsection')
    <div class="container">
        <div class="row">
            <div class="vh-100 d-flex justify-content-center align-items-center">
                <div class="col-4">
                    <div>
                        <div class="d-flex justify-content-center">
                            <img class="mb-3" height="50" src="{{ @globalAsset(setting('light_logo'), '150X40.svg') }}"
                                alt="Logo">
                        </div>
                        <div class="card mb-4">
                            <div class="card-body my-5 mx-4 text-body-secondary">
                                <div class="mb-4 text-center">
                                    <h5><strong>{{ ___('auth.Sign In') }}</strong></h5>
                                    <span class="small">{{ ___('auth.welcome_back!') }}</span>
                                </div>

                                <form class="small" action="{{ route('reset.password') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $data['token'] }}">

                                    <div class="col-12 mb-3">
                                        <label for="email"
                                            class="form-label"><strong>{{ ___('auth.email') }}</strong></label>
                                        <input placeholder="{{ ___('auth.enter_your_email') }}" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            id="email" aria-describedby="emailValidationMsg"
                                            value="{{ $data['email'] }}" required readonly>
                                        @error('email')
                                            <div id="emailValidationMsg" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="password"
                                            class="form-label"><strong>{{ ___('auth.password') }}</strong></label>
                                        <div class="input-group">
                                            <input placeholder="{{ ___('auth.password') }}" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                id="password" aria-describedby="passwordValidationMsg" required>
                                            <span class="input-group-text" id="passwordShow">
                                                <i class="fa-solid fa-eye"></i>
                                            </span>
                                            @error('password')
                                                <div id="passwordValidationMsg" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="confirm_password"
                                            class="form-label"><strong>{{ ___('auth.confirm_password') }}</strong></label>
                                        <input placeholder="{{ ___('auth.confirm_password') }}" type="password"
                                            class="form-control @error('confirm_password') is-invalid @enderror"
                                            name="confirm_password" id="confirm_password"
                                            aria-describedby="confirm_passwordValidationMsg" required>
                                        @error('confirm_password')
                                            <div id="confirm_passwordValidationMsg" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="d-grid mb-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ ___('auth.send') }}
                                        </button>
                                    </div>
                                </form>

                                <div class="d-flex justify-content-center small">
                                    {{ ___('auth.already_have_an_account') }} ? &nbsp
                                    <a class="link-underline link-underline-opacity-0"
                                        href="{{ route('login') }}">{{ ___('auth.login') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('mainstyle')
    <style>
        body {
            background: #F0F1F7;
            color: #707071;
        }

        .btn-primary {
            color: white !important;
            background: #845ADF !important;
            border: 0;
        }

        input {
            font-size: 1em !important;
        }
    </style>
@endpush

@push('mainscript')
    <script>
        $('#passwordShow').on('click', function() {
            if ($('#password').attr("type") == 'text') {
                $('#passwordShow').html('<i class="fa-solid fa-eye"></i>');
                $('#password').prop('type', 'password');
            } else {
                $('#passwordShow').html('<i class="fa-solid fa-eye-slash"></i>');
                $('#password').prop('type', 'text');
            }
        });
    </script>
@endpush
