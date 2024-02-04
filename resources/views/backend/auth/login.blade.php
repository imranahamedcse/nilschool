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
                                    <h5><strong>{{ ___('auth.Sign In') }}</strong></h5>
                                    <span class="small">{{ ___('auth.welcome_to') }} {{ setting('application_name') }}</span>
                                </div>


                                <form class="small" action="{{ route('login.auth') }}" method="post">
                                    @csrf

                                    <div class="col-12 mb-3">
                                        <label for="phoneEmail" class="form-label"><strong>{{ ___('auth.phone_or_email') }}</strong></label>
                                        <input id="phoneEmail" placeholder="{{ ___('auth.phone_or_email') }}" type="text"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            id="email" aria-describedby="emailValidationMsg" required>
                                        @error('email')
                                            <div id="emailValidationMsg" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="d-flex justify-content-between">
                                            <label for="phoneEmail" class="form-label"><strong>{{ ___('auth.password') }}</strong></label>
                                            <a class="link-underline link-underline-opacity-0 text-danger"
                                                href="{{ route('forgot-password') }}"><strong>{{ ___('auth.forgot_password ?') }}</strong></a>
                                        </div>
                                        <div class="input-group password-input mb-4">
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

                                    <div class="d-grid mb-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ ___('auth.sign_in') }}
                                        </button>
                                    </div>
                                </form>


                                <div class="d-flex justify-content-center small">
                                    {{ ___('auth.dont_have_account') }} ? &nbsp
                                    <a class="link-underline link-underline-opacity-0"
                                        href="{{ route('register') }}">{{ ___('auth.sign_up') }}</a>
                                </div>
                            </div>
                        </div>


                        @if (\Config::get('app.debug'))
                            <div class="row">
                                <div class="col-md-4">
                                    <form action="{{ route('login.auth') }}" method="post">
                                        @csrf
                                        <input name="email" type="hidden" value="superadmin@onest.com">
                                        <input name="password" type="hidden" value="123456">
                                        <input name="g-recaptcha-response" type="hidden" value="123456">
                                        <div class="d-grid mb-3">
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                value="Login">{{ ___('auth.superadmin') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4 p-0">
                                    <form action="{{ route('login.auth') }}" method="post">
                                        @csrf
                                        <input name="email" type="hidden" value="admin@onest.com">
                                        <input name="password" type="hidden" value="123456">
                                        <input name="g-recaptcha-response" type="hidden" value="123456">
                                        <div class="d-grid mb-3">
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                value="Login">{{ ___('auth.admin') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <form action="{{ route('login.auth') }}" method="post">
                                        @csrf
                                        <input name="email" type="hidden" value="student111@gmail.com">
                                        <input name="password" type="hidden" value="123456">
                                        <input name="g-recaptcha-response" type="hidden" value="123456">
                                        <div class="d-grid mb-3">
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                value="Login">{{ ___('auth.student') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <form action="{{ route('login.auth') }}" method="post">
                                        @csrf
                                        <input name="email" type="hidden" value="guardian1@gmail.com">
                                        <input name="password" type="hidden" value="123456">
                                        <input name="g-recaptcha-response" type="hidden" value="123456">
                                        <div class="d-grid mb-3">
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                value="Login">{{ ___('auth.guardian') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4 p-0">
                                    <form action="{{ route('login.auth') }}" method="post">
                                        @csrf
                                        <input name="email" type="hidden" value="teacher@onest.com">
                                        <input name="password" type="hidden" value="123456">
                                        <input name="g-recaptcha-response" type="hidden" value="123456">
                                        <div class="d-grid mb-3">
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                value="Login">{{ ___('auth.teacher') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <form action="{{ route('login.auth') }}" method="post">
                                        @csrf
                                        <input name="email" type="hidden" value="teacher@onest.com">
                                        <input name="password" type="hidden" value="123456">
                                        <input name="g-recaptcha-response" type="hidden" value="123456">
                                        <div class="d-grid mb-3">
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                value="Login">{{ ___('auth.test') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif

                        {{-- <div class="d-flex justify-content-center p-4">
                            term conditions <br>
                            copyright text
                        </div> --}}
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
