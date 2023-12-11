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

            <form action="{{ route('room.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.Type') }} <span
                                        class="text-danger">*</span></label>
                                <select class="section form-control @error('type') is-invalid @enderror" name="type">
                                    <option value="">{{ ___('student_info.Select type') }} </option>
                                    @foreach ($data['types'] as $item)
                                        <option
                                            {{ old('type') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.Room no') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('room_no') is-invalid @enderror" name="room_no" type="number"
                                    list="datalistOptions" id="exampleDataList" placeholder="{{ ___('common.Enter room no') }}"
                                    value="{{ old('room_no') }}">
                                @error('room_no')
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

                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.Description') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('description') is-invalid @enderror" name="description"
                                    list="datalistOptions" id="exampleDataList" placeholder="{{ ___('common.Enter description') }}"
                                    value="{{ old('description') }}">
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
