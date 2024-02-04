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
                            <img class="mb-3" height="50" src="{{ @globalAsset(setting('light_logo'), '154X38.webp') }}"
                                alt="Logo">
                        </div>
                        <div class="card mb-4">
                            <div class="card-body my-5 mx-4 text-body-secondary">
                                <div class="mb-4 text-center">
                                    <h5><strong>{{ ___('auth.forgot_password') }}</strong></h5>
                                    <span class="small">{{ ___('auth.welcome_back!') }}</span>
                                </div>

                                <form class="small" action="{{ route('forgot.password') }}" method="post">
                                    @csrf

                                    <div class="col-12 mb-3">
                                        <label for="phoneEmail"
                                            class="form-label"><strong>{{ ___('auth.phone_or_email') }}</strong></label>
                                        <input placeholder="{{ ___('auth.phone_or_email') }}" type="text"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            id="email" aria-describedby="emailValidationMsg" required>
                                        @error('email')
                                            <div id="emailValidationMsg" class="invalid-feedback">
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
                                    <a class="link-underline link-underline-opacity-0"
                                        href="{{ route('login') }}">{{ ___('auth.back_to_login') }}</a>
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
