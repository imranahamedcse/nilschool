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

            <form action="{{ route('dormitory.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.Name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    list="datalistOptions" id="exampleDataList" placeholder="{{ ___('common.Enter name') }}"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Type') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('type') is-invalid @enderror"
                                    name="type" id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="Boys">{{ ___('common.Boys') }}</option>
                                    <option value="Girls">{{ ___('common.Girls') }}
                                    </option>
                                </select>
                                @error('type')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.Address') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('address') is-invalid @enderror" name="address"
                                    list="datalistOptions" id="exampleDataList" placeholder="{{ ___('common.Enter address') }}"
                                    value="{{ old('address') }}">
                                @error('address')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationServer04" aria-describedby="validationServer04Feedback">
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
