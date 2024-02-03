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

            <form action="{{ route('event.update', @$data['event']->id) }}" enctype="multipart/form-data" method="post"
                id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('create.title') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('title') is-invalid @enderror" name="title"
                                    value="{{ old('title', @$data['event']->title) }}"
                                    id="validationDefault01" placeholder="{{ ___('create.enter_title') }}">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="validationDefault02" class="form-label ">{{ ___('create.image') }}
                                    {{ ___('create.(815 x 500 px)') }}</label>
                                <input type="file" class="form-control" name="image" accept="image/*" id="validationDefault02">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('create.Date') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('date') is-invalid @enderror" name="date"
                                    value="{{ old('date', @$data['event']->date) }}"
                                    id="validationDefault03" type="date" placeholder="{{ ___('create.enter_date') }}">
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('create.address') }} </label>
                                <input class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address', @$data['event']->address) }}"
                                    id="validationDefault04" placeholder="{{ ___('create.enter_address') }}">
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault05" class="form-label ">{{ ___('create.Start time') }} </label>
                                <input class="form-control @error('start_time') is-invalid @enderror"
                                    name="start_time" value="{{ old('start_time', @$data['event']->start_time) }}"
                                    id="validationDefault05" type="time"
                                    placeholder="{{ ___('create.enter_start_time') }}">
                                @error('start_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault06" class="form-label ">{{ ___('create.End time') }} </label>
                                <input class="form-control @error('end_time') is-invalid @enderror" name="end_time"
                                    value="{{ old('end_time', @$data['event']->end_time) }}"
                                    id="validationDefault06" type="time" placeholder="{{ ___('create.enter_end_time') }}">
                                @error('end_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault07" class="form-label">{{ ___('create.status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault07">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['event']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['event']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
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
                                <label for="validationDefault08" class="form-label">{{ ___('create.Description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                    id="validationDefault08" placeholder="{{ ___('create.Enter description') }}">{{ old('description', @$data['event']->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

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
