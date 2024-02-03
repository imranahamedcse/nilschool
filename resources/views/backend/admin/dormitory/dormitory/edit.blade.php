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

            <form action="{{ route('dormitory.update', @$data['dormitory']->id) }}" enctype="multipart/form-data"
                method="post" id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('create.Name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', @$data['dormitory']->name) }}"
                                    id="validationDefault01" placeholder="{{ ___('create.Enter name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02" class="form-label">{{ ___('create.type') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('type') is-invalid @enderror"
                                    name="type" id="validationDefault02">
                                    <option {{ @$data['dormitory']->type == 'Boys' ? 'selected' : '' }} value="Boys">{{ ___('create.Boys') }}</option>
                                    <option {{ @$data['dormitory']->type == 'Girls' ? 'selected' : '' }} value="Girls">{{ ___('create.Girls') }}</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('create.Address') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address', @$data['dormitory']->address) }}"
                                    id="validationDefault03" placeholder="{{ ___('create.Enter address') }}">
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label">{{ ___('create.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault04">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['dormitory']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['dormitory']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.inactive') }}
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
