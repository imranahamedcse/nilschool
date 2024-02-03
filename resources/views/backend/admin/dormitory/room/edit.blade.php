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

            <form action="{{ route('room.update', @$data['room']->id) }}" enctype="multipart/form-data"
                method="post" id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label">{{ ___('create.Type') }} <span
                                        class="text-danger">*</span></label>
                                <select id="validationDefault01" class="section form-control @error('type') is-invalid @enderror" name="type">
                                    <option value="">{{ ___('create.Select type') }} </option>
                                    @foreach ($data['types'] as $item)
                                        <option
                                            {{ old('type', @$data['room']->room_type_id) == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02" class="form-label ">{{ ___('create.Room no') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('room_no') is-invalid @enderror" name="room_no" type="number"
                                    id="validationDefault02" placeholder="{{ ___('create.Enter room no') }}"
                                    value="{{ old('room_no', @$data['room']->room_no) }}">
                                @error('room_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label">{{ ___('create.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault03">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['room']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['room']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('create.Description') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('description') is-invalid @enderror" name="description"
                                    id="validationDefault04" placeholder="{{ ___('create.Enter description') }}"
                                    value="{{ old('description', @$data['room']->description) }}">
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
