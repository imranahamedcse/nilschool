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

            <form action="{{ route('department-contact.update', @$data['dep_contact']->id) }}" enctype="multipart/form-data"
                method="post" id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('common.name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', @$data['dep_contact']->name) }}"
                                    id="validationDefault01" placeholder="{{ ___('common.enter_name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02" class="form-label ">{{ ___('common.phone') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone', @$data['dep_contact']->phone) }}"
                                    id="validationDefault02" type="text" placeholder="{{ ___('common.Enter phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('common.email') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email', @$data['dep_contact']->email) }}"
                                    id="validationDefault03" type="email" placeholder="{{ ___('common.Enter email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('common.image') }}
                                    {{ ___('common.(60 x 60 px)') }}</label>
                                <input type="file" class="form-control" name="image" accept="image/*" id="validationDefault04">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault05" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault05">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['dep_contact']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['dep_contact']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('common.update') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
