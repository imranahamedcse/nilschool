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

            <form action="{{ route('users.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">

                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="validationDefault02" class="form-label">{{ ___('create.roles') }} <span
                                class="text-danger">*</span></label>
                        <select
                            class="form-control @error('role') is-invalid @enderror change-role"
                            name="role" id="validationDefault02">
                            <option value="">{{ ___('create.select_role') }}</option>
                            @foreach ($data['roles'] as $role)
                                <option {{ old('role') == $role->id ? 'selected' : '' }} value="{{ $role->id }}">
                                    {{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="validationDefault05" class="form-label ">{{ ___('create.name') }} <span
                                class="text-danger">*</span></label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" id="validationDefault05"
                            placeholder="{{ ___('create.enter_name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="validationDefault09" class="form-label">{{ ___('create.email') }} <span
                                class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control  @error('email') is-invalid @enderror" id="validationDefault09"
                            aria-describedby="emailHelp" placeholder="{{ ___('create.enter_your_email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="validationDefault13" class="form-label ">{{ ___('create.phone') }} <span
                                class="text-danger">*</span></label>
                        <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ old('phone') }}" id="validationDefault13"
                            placeholder="{{ ___('create.enter_phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="validationDefault16" class="form-label">{{ ___('create.status') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror"
                            name="status" id="validationDefault16">
                            <option {{ old('status') == App\Enums\Status::ACTIVE ? 'selected' : '' }}
                                value="{{ App\Enums\Status::ACTIVE }}">{{ ___('create.active') }}</option>
                            <option {{ old('status') == App\Enums\Status::INACTIVE ? 'selected' : '' }}
                                value="{{ App\Enums\Status::INACTIVE }}">{{ ___('create.inactive') }}</option>
                        </select>

                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="validationDefault17" class="form-label" for="inputImage">{{ ___('create.image') }}
                            {{ ___('create.(95 x 95 px)') }}</label>
                        <input id="validationDefault17" type="file" class="form-control" name="image">
                    </div>

                </div>

                <div class="col-md-12 mt-24">
                    <div class="text-end">
                        <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                            </span>{{ ___('create.submit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
