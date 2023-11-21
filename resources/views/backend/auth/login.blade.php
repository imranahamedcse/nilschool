@extends('master')

@section('maintitle')
    {{ $data['title'] }}
@endsection

@section('mainsection')
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="w-28">
            <div class="p-4 border rounded-5 mb-4">
                <div class="d-flex justify-content-center">
                    <h1>Logo</h1>
                </div>
                <h4 class="text-center mb-4">{{ ___('common.login_details') }}</h4>


                <form action="{{ route('login.auth') }}" method="post">
                    @csrf

                    <div class="col-12">
                        <div class="input-group mb-4">
                            <span class="input-group-text" for="email">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input placeholder="{{ ___('common.phone_or_email') }}" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                aria-describedby="emailValidationMsg" required>
                            @error('email')
                                <div id="emailValidationMsg" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-group password-input mb-4">
                            <span class="input-group-text" for="password">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input placeholder="{{ ___('common.password') }}" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" id="password"
                                aria-describedby="passwordValidationMsg" required>
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

                    <div class="d-flex justify-content-end mb-4">
                        <a class="link-underline link-underline-opacity-0"
                            href="{{ route('forgot-password') }}">{{ ___('common.forgot_password') }}</a>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn border rounded-5">
                            {{ ___('common.login') }}
                        </button>
                    </div>
                </form>

                
                <div class="d-flex justify-content-center">
                    {{ ___('common.dont_have_account') }}&nbsp
                    <a class="link-underline link-underline-opacity-0"
                        href="{{ route('register') }}">{{ ___('common.register') }}</a>
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
                                <button type="submit" class="btn border rounded-5"
                                    value="Login">{{ ___('common.superadmin') }}
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
                                <button type="submit" class="btn border rounded-5"
                                    value="Login">{{ ___('common.admin') }}
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
                                <button type="submit" class="btn border rounded-5"
                                    value="Login">{{ ___('common.student') }}
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
                                <button type="submit" class="btn border rounded-5"
                                    value="Login">{{ ___('common.guardian') }}
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
                                <button type="submit" class="btn border rounded-5"
                                    value="Login">{{ ___('common.teacher') }}
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
                                <button type="submit" class="btn border rounded-5"
                                    value="Login">{{ ___('common.test') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            
        </div>


    </div>

    <div class="d-flex justify-content-center p-4">
        term conditions <br>
        copyright text
    </div>
@endsection

@push('mainstyle')
    {{--  --}}
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
