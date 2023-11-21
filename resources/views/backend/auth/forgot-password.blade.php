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
                <h4 class="text-center mb-4">{{ ___('common.forgot_password') }}</h4>

                <form action="{{ route('forgot.password') }}" method="post">
                    @csrf

                    <div class="col-12">
                        <div class="input-group mb-4">
                            <span class="input-group-text" for="email">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input placeholder="{{ ___('common.phone_or_email') }}" type="text"
                                class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                aria-describedby="emailValidationMsg" required>
                            @error('email')
                                <div id="emailValidationMsg" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn border rounded-5">
                            {{ ___('common.send') }}
                        </button>
                    </div>
                </form>

                <div class="d-flex justify-content-center">
                    <a class="link-underline link-underline-opacity-0"
                        href="{{ route('login') }}">{{ ___('common.back_to_login') }}</a>
                </div>
            </div>
        </div>

    </div>
@endsection
