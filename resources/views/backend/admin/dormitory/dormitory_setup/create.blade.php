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

            <form action="{{ route('dormitory-setup.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label">{{ ___('common.Dormitory') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('dormitory_id') is-invalid @enderror" name="dormitory_id"
                                    id="validationDefault01">

                                    <option selected>{{ ___('common.Select dormitory') }}</option>
                                    @foreach ($data['dormitories'] as $item)
                                        <option {{ old('dormitory') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">
                                            {{ $item->name }}</option>
                                    @endforeach

                                </select>
                                @error('dormitory_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02" class="form-label">{{ ___('common.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault02">
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
                                <p>{{ ___('common.Select room') }} <span class="text-danger">*</span></p>
                                @foreach ($data['rooms'] as $key => $item)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                                            id="room{{ $key }}" name="room[]">
                                        <label class="form-check-label" for="room{{ $key }}">
                                            {{ $item->room_no }}
                                        </label>
                                    </div>
                                @endforeach
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
