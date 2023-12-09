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
                                <label for="exampleDataList" class="form-label ">{{ ___('common.Name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', @$data['vehicle']->name) }}" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('common.Enter name') }}">
                                @error('name')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.License no') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('license_no') is-invalid @enderror" name="license_no"
                                    value="{{ old('license_no', @$data['vehicle']->license_no) }}" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('common.Enter license no') }}">
                                @error('license_no')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.Driver name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('driver_name') is-invalid @enderror" name="driver_driver_name"
                                    value="{{ old('driver_name', @$data['vehicle']->driver_name) }}" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('common.Enter driver name') }}">
                                @error('driver_name')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.Driver phone') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('driver_phone') is-invalid @enderror" name="driver_phone"
                                    value="{{ old('driver_phone', @$data['vehicle']->driver_phone) }}" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('common.Enter driver phone') }}">
                                @error('driver_phone')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="validationServer04" class="form-label">{{ ___('common.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['vehicle']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['vehicle']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('account.Description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('account.Enter description') }}">{{ old('description', @$data['vehicle']->description) }}</textarea>
                                @error('description')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('common.Update') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
