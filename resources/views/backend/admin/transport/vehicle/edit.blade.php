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

            <form action="{{ route('vehicle.update', @$data['vehicle']->id) }}" enctype="multipart/form-data"
                method="post" id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('create.Name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', @$data['vehicle']->name) }}"
                                    id="validationDefault01" placeholder="{{ ___('create.Enter name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault02" class="form-label ">{{ ___('create.License no') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('license_no') is-invalid @enderror" name="license_no"
                                    value="{{ old('license_no', @$data['vehicle']->license_no) }}"
                                    id="validationDefault02" placeholder="{{ ___('create.Enter license no') }}">
                                @error('license_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('create.Driver name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('driver_name') is-invalid @enderror" name="driver_driver_name"
                                    value="{{ old('driver_name', @$data['vehicle']->driver_name) }}"
                                    id="validationDefault03" placeholder="{{ ___('create.Enter driver name') }}">
                                @error('driver_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('create.Driver phone') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('driver_phone') is-invalid @enderror" name="driver_phone"
                                    value="{{ old('driver_phone', @$data['vehicle']->driver_phone) }}"
                                    id="validationDefault04" placeholder="{{ ___('create.Enter driver phone') }}">
                                @error('driver_phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="validationDefault05" class="form-label">{{ ___('create.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault05">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['vehicle']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['vehicle']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="validationDefault06" class="form-label ">{{ ___('create.Description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                    id="validationDefault06" placeholder="{{ ___('create.Enter description') }}">{{ old('description', @$data['vehicle']->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('create.Update') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
