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

            <form action="{{ route('class-setup.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label">{{ ___('create.class') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('classes') is-invalid @enderror" name="classes"
                                    id="validationDefault01">
                                    <option value="">{{ ___('create.select class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>

                                @error('classes')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ ___('create.section') }} <span
                                        class="text-danger">*</span></label>
                                <div class="@error('sections') is-invalid @enderror">
                                    @foreach ($data['section'] as $item)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="sections[]"
                                                value="{{ $item->id }}" id="flexCheckDefault" />
                                            <label class="form-check-label ps-2 pe-5"
                                                for="flexCheckDefault">{{ $item->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('sections')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label">{{ ___('create.status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault03">
                                    <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('create.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('create.inactive') }}
                                    </option>
                                </select>

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mt-24">
                            <div class="text-end">
                                <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                    </span>{{ ___('create.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
