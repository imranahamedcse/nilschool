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

            <form action="{{ route('transport-setup.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label">{{ ___('create.Route') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('route_id') is-invalid @enderror" name="route_id"
                                    id="validationDefault01">

                                    <option selected>{{ ___('create.Select Route') }}</option>
                                    @foreach ($data['route'] as $item)
                                        <option {{ old('route') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">
                                            {{ $item->name }}</option>
                                    @endforeach

                                </select>
                                @error('route_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02" class="form-label">{{ ___('create.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault02">
                                    <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('create.Active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('create.Inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <p>{{ ___('create.Select vehicle') }} <span class="text-danger">*</span></p>
                                @foreach ($data['vehicle'] as $key => $item)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                                            id="vehicle{{ $key }}" name="vehicle[]">
                                        <label class="form-check-label" for="vehicle{{ $key }}">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-md-6 mb-3">
                                <p>{{ ___('create.Select Pickup point') }} <span class="text-danger">*</span></p>
                                @foreach ($data['pickup_point'] as $key => $item)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                                            id="pickup_point{{ $key }}" name="pickup_point[]">
                                        <label class="form-check-label" for="pickup_point{{ $key }}">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('create.Description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                    id="validationDefault03" placeholder="{{ ___('create.enter_description') }}">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('create.Submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
