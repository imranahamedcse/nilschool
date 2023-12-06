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

            <form action="{{ route('counter.update', @$data['counter']->id) }}" enctype="multipart/form-data" method="post"
                id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control ot-input @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', @$data['counter']->name) }}" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('common.enter_name') }}">
                                @error('name')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.Total count') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control ot-input @error('total_count') is-invalid @enderror"
                                    name="total_count" value="{{ old('total_count', @$data['counter']->total_count) }}"
                                    list="datalistOptions" id="exampleDataList" type="number"
                                    placeholder="{{ ___('common.Enter total count') }}">
                                @error('total_count')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.image') }}
                                    {{ ___('common.(65 x 75 px)') }}</label>
                                <input type="file" class="form-control" name="image" accept="image/*" id="fileBrouse">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['counter']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['counter']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.Serial') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control ot-input @error('serial') is-invalid @enderror" name="serial"
                                    value="{{ old('serial', @$data['counter']->serial) }}" list="datalistOptions"
                                    id="exampleDataList" type="number" placeholder="{{ ___('common.Enter serial') }}">
                                @error('serial')
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
