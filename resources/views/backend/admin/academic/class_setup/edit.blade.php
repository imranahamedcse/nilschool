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

            <form action="{{ route('class-setup.update', @$data['class_setup']->id) }}" enctype="multipart/form-data"
                method="post" id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('academic.class') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('classes') is-invalid @enderror" name="classes"
                                    id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('common.select class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $data['class_setup']->classes_id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>

                                @error('classes')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">{{ ___('academic.section') }} <span
                                        class="text-danger">*</span></label>
                                <div class="@error('sections') is-invalid @enderror">
                                    @foreach ($data['section'] as $item)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="sections[]"
                                                value="{{ $item->id }}" id="flexCheckDefault"
                                                {{ in_array($item->id, $data['class_setup_sections']) ? 'checked' : '' }} />
                                            <label class="form-check-label ps-2 pe-5"
                                                for="flexCheckDefault">{{ $item->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('sections')
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
                                        {{ @$data['class_setup']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['class_setup']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.inactive') }}
                                    </option>
                                </select>

                                @error('status')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mt-24">
                            <div class="text-end">
                                <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                    </span>{{ ___('common.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
@endsection
