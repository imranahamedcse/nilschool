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
                                <label for="exampleDataList" class="form-label ">{{ ___('common.title') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control ot-input @error('title') is-invalid @enderror" name="title"
                                    value="{{ old('title', @$data['event']->title) }}" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('common.enter_title') }}">
                                @error('title')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.image') }}
                                    {{ ___('common.(815 x 500 px)') }}</label>
                                <input type="file" class="form-control" name="image" accept="image/*" id="fileBrouse">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.Date') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control ot-input @error('date') is-invalid @enderror" name="date"
                                    value="{{ old('date', @$data['event']->date) }}" list="datalistOptions"
                                    id="exampleDataList" type="date" placeholder="{{ ___('common.enter_date') }}">
                                @error('date')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.address') }} </label>
                                <input class="form-control ot-input @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address', @$data['event']->address) }}" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('common.enter_address') }}">
                                @error('address')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.Start time') }} </label>
                                <input class="form-control ot-input @error('start_time') is-invalid @enderror"
                                    name="start_time" value="{{ old('start_time', @$data['event']->start_time) }}"
                                    list="datalistOptions" id="exampleDataList" type="time"
                                    placeholder="{{ ___('common.enter_start_time') }}">
                                @error('start_time')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.End time') }} </label>
                                <input class="form-control ot-input @error('end_time') is-invalid @enderror" name="end_time"
                                    value="{{ old('end_time', @$data['event']->end_time) }}" list="datalistOptions"
                                    id="exampleDataList" type="time" placeholder="{{ ___('common.enter_end_time') }}">
                                @error('end_time')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['event']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['event']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
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
                                <label for="exampleDataList" class="form-label">{{ ___('common.Description') }}</label>
                                <textarea id="summernote" class="form-control ot-textarea @error('description') is-invalid @enderror" name="description"
                                    list="datalistOptions" id="exampleDataList" placeholder="{{ ___('common.Enter description') }}">{{ old('description', @$data['event']->description) }}</textarea>
                                @error('description')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('common.update') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
