@extends('backend.student.partials.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')
    <div class="card bg-white">
        <div class="card-body">
            <div class="row p-0 m-0">

                <!-- profile menu start -->
                <div class="col-3">
                    <ul class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action"
                            href="{{ route('student-panel.profile') }}">{{ ___('profile.my_profile') }}</a>
                        <a class="list-group-item list-group-item-action active"
                            href="{{ route('student-panel.password-update') }}">{{ ___('profile.Password update') }}</a>
                    </ul>
                </div>
                <!-- profile menu end -->

                <!-- profile body start -->
                <div class="col-9">
                    <div class="row justify-content-between border-bottom pb-2 mb-3">
                        <div class="col">
                            <h4>{{ @$data['title'] }}</h4>
                        </div>
                    </div>
                    <form action="{{ route('student-panel.password-update-store') }}" enctype="multipart/form-data" method="post"
                        id="visitForm">
                        @csrf
                        @method('PUT')

                        <div class="col-12 mb-3">
                            <label for="inputname" class="form-label">{{ ___('profile.current_password') }}
                                <span class="text-danger">*</span></label>
                            <input type="password" name="current_password"
                                placeholder="{{ ___('profile.current_password') }}"
                                class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="inputname" class="form-label">{{ ___('profile.confirm_password') }}
                                <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation"
                                placeholder="{{ ___('profile.confirm_password') }}"
                                class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="inputname" class="form-label">{{ ___('profile.new_password') }}
                                <span class="text-danger">*</span></label>
                            <input type="password" name="password" placeholder="{{ ___('profile.new_password') }}"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <div class="text-end">
                                <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                    </span>{{ ___('profile.update') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- profile body end -->
        </div>
    </div>
    </div>
@endsection
