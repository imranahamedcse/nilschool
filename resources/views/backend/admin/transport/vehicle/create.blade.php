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

            <form action="{{ route('vehicle.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('common.Name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="validationDefault01" placeholder="{{ ___('common.Enter name') }}"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault02" class="form-label ">{{ ___('common.License no') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('license_no') is-invalid @enderror" name="license_no"
                                    id="validationDefault02" placeholder="{{ ___('common.Enter license no') }}"
                                    value="{{ old('license_no') }}">
                                @error('license_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('common.Driver name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('driver_name') is-invalid @enderror" name="driver_name"
                                    id="validationDefault03" placeholder="{{ ___('common.Enter driver name') }}"
                                    value="{{ old('driver_name') }}">
                                @error('driver_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('common.Driver phone') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('driver_phone') is-invalid @enderror" name="driver_phone"
                                    id="validationDefault04" placeholder="{{ ___('common.Enter driver phone') }}"
                                    value="{{ old('driver_phone') }}">
                                @error('driver_phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="validationDefault05" class="form-label">{{ ___('common.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault05">
                                    <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('common.Active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('common.Inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="validationDefault06" class="form-label ">{{ ___('account.Description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                    id="validationDefault06" placeholder="{{ ___('account.enter_description') }}">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('common.Submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
