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

            <form action="{{ route('designation.update', @$data['designation']->id) }}" enctype="multipart/form-data"
                method="post" id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('create.name') }}<span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', @$data['designation']->name) }}"
                                    id="validationDefault01" type="text" placeholder="{{ ___('create.enter_name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="validationDefault02" class="form-label">{{ ___('create.status') }} <span
                                        class="text-danger">*</span></label>

                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault02">

                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['designation']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['designation']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.inactive') }}
                                    </option>
                                </select>
                            </div>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('create.update') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
