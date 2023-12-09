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

            <form action="{{ route('pickup-point.update', @$data['pickup_point']->id) }}" enctype="multipart/form-data"
                method="post" id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            
                            <div class="col-md-4 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.Name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', @$data['pickup_point']->name) }}" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('common.Enter name') }}">
                                @error('name')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.Fee') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('fee') is-invalid @enderror" name="fee" type="number"
                                    value="{{ old('fee', @$data['pickup_point']->fee) }}" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('common.Enter fee') }}">
                                @error('fee')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4">
                                <label for="validationServer04" class="form-label">{{ ___('common.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['pickup_point']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['pickup_point']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
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
                                <label for="exampleDataList" class="form-label ">{{ ___('account.Description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('account.Enter description') }}">{{ old('description', @$data['pickup_point']->description) }}</textarea>
                                @error('description')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('common.Update') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
