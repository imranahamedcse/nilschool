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

            <form action="{{ route('pickup-point.update', @$data['pickup_point']->id) }}" enctype="multipart/form-data"
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
                                    value="{{ old('name', @$data['pickup_point']->name) }}"
                                    id="validationDefault01" placeholder="{{ ___('create.Enter name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault02" class="form-label ">{{ ___('create.Fee') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('fee') is-invalid @enderror" name="fee" type="number"
                                    value="{{ old('fee', @$data['pickup_point']->fee) }}"
                                    id="validationDefault02" placeholder="{{ ___('create.Enter fee') }}">
                                @error('fee')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="validationDefault03" class="form-label">{{ ___('create.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault03">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['pickup_point']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['pickup_point']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
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
                                <label for="validationDefault04" class="form-label ">{{ ___('create.Description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                    id="validationDefault04" placeholder="{{ ___('create.Enter description') }}">{{ old('description', @$data['pickup_point']->description) }}</textarea>
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
