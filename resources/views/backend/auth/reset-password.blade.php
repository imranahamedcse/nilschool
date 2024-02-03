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
                <h4 class="text-center mb-4">{{ ___('auth.login_details') }}</h4>

                <form action="{{ route('reset.password') }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $data['token'] }}">

                    <div class="col-12">
                        <div class="input-group mb-4">
                            <span class="input-group-text" for="email">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input placeholder="{{ ___('auth.enter_your_email') }}" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                aria-describedby="emailValidationMsg" value="{{ $data['email'] }}" required>
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
                            <input placeholder="{{ ___('auth.password') }}" type="password"
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

                    <div class="col-12">
                        <div class="input-group mb-4">
                            <span class="input-group-text" for="confirm_password">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input placeholder="{{ ___('auth.confirm_password') }}" type="password"
                                class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password"
                                id="confirm_password" aria-describedby="confirm_passwordValidationMsg" required>
                            @error('confirm_password')
                                <div id="confirm_passwordValidationMsg" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn border rounded-5">
                            {{ ___('auth.send') }}
                        </button>
                    </div>
                </form>

                <div class="d-flex justify-content-center">
                    {{ ___('auth.already_have_an_account') }}&nbsp
                    <a class="link-underline link-underline-opacity-0"
                        href="{{ route('login') }}">{{ ___('auth.login') }}</a>
                </div>
            </div>
        </div>
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
