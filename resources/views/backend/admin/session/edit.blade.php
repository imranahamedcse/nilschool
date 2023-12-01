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

            <form action="{{ route('sessions.update', @$data['session']->id) }}" enctype="multipart/form-data" method="post"
                id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.name') }} <span
                                        class="fillable">*</span></label>
                                <input class="form-control ot-input @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', @$data['session']->name) }}" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('common.enter_name') }}">
                                @error('name')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                {{-- Status  --}}
                                <label for="validationServer04" class="form-label">{{ ___('common.status') }} <span
                                        class="fillable">*</span></label>

                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">

                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['session']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['session']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.inactive') }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.start_date') }} <span
                                        class="fillable">*</span></label>
                                <input type="date"
                                    class="form-control ot-input @error('start_date') is-invalid @enderror"
                                    name="start_date" list="datalistOptions" id="exampleDataList"
                                    placeholder="{{ ___('common.enter_start_date') }}"
                                    value="{{ old('start_date', @$data['session']->start_date) }}">
                                @error('start_date')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.end_date') }} <span
                                        class="fillable">*</span></label>
                                <input type="date" class="form-control ot-input @error('end_date') is-invalid @enderror"
                                    name="end_date" list="datalistOptions" id="exampleDataList"
                                    placeholder="{{ ___('common.enter_end_date') }}"
                                    value="{{ old('end_date', @$data['session']->end_date) }}">
                                @error('end_date')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @error('status')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

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
