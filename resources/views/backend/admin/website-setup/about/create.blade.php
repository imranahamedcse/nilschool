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

            <form action="{{ route('about.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('common.name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" id="validationDefault01"
                                    placeholder="{{ ___('common.enter_name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02" class="form-label ">{{ ___('common.image') }}
                                    {{ ___('common.(715 x 575 px)') }}<span class="text-danger">*</span></label>
                                <input id="validationDefault02" type="file" class="form-control" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('common.Icon') }}
                                    {{ ___('common.(60 x 60 px)') }}<span class="text-danger">*</span></label>
                                <input id="validationDefault03" type="file" class="form-control" name="icon" accept="image/*">
                                @error('icon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault04">
                                    <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('common.inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault05" class="form-label ">{{ ___('common.Serial') }} <span
                                        class="text-danger"> *</span></label>
                                <input class="form-control @error('serial') is-invalid @enderror" name="serial"
                                    value="{{ old('serial') }}" id="validationDefault05" type="number"
                                    placeholder="{{ ___('common.Enter serial') }}">
                                @error('serial')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="validationDefault06" class="form-label">{{ ___('common.Description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                    id="validationDefault06" placeholder="{{ ___('common.Enter description') }}">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12mb-3">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('common.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
