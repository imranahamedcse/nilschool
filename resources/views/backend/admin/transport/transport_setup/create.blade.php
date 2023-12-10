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
                                <label for="validationServer04" class="form-label">{{ ___('common.Route') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('route_id') is-invalid @enderror" name="route_id"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">

                                    <option selected>{{ ___('common.Select Route') }}</option>
                                    @foreach ($data['route'] as $item)
                                        <option {{ old('route') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">
                                            {{ $item->name }}</option>
                                    @endforeach

                                </select>
                                @error('route_id')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('common.Active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('common.Inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <p>{{ ___('common.Select vehicle') }} <span class="text-danger">*</span></p>
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
                                <p>{{ ___('common.Select Pickup point') }} <span class="text-danger">*</span></p>
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
                                <label for="exampleDataList" class="form-label ">{{ ___('account.Description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('account.enter_description') }}">{{ old('description') }}</textarea>
                                @error('description')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
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
