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

            <form action="{{ route('news.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="exampleDataList" class="form-label ">{{ ___('common.title') }} <span
                                class="fillable">*</span></label>
                        <input class="form-control ot-input @error('title') is-invalid @enderror" name="title"
                            value="{{ old('title') }}" list="datalistOptions" id="exampleDataList"
                            placeholder="{{ ___('common.enter_title') }}">
                        @error('title')
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="exampleDataList" class="form-label ">{{ ___('common.image') }}
                            {{ ___('common.(690 x 460 px)') }}<span class="fillable">*</span></label>
                        <input type="file" class="form-control" name="image" accept="image/*" id="fileBrouse">
                        @error('image')
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="exampleDataList" class="form-label ">{{ ___('common.Date') }} <span
                                class="fillable">*</span></label>
                        <input class="form-control ot-input @error('date') is-invalid @enderror" name="date"
                            value="{{ old('date') }}" list="datalistOptions" id="exampleDataList" type="date"
                            placeholder="{{ ___('common.enter_date') }}">
                        @error('date')
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="exampleDataList" class="form-label ">{{ ___('common.Publish date') }} <span
                                class="fillable">*</span></label>
                        <input class="form-control ot-input @error('publish_date') is-invalid @enderror" name="publish_date"
                            value="{{ old('publish_date') }}" list="datalistOptions" id="exampleDataList" type="date"
                            placeholder="{{ ___('common.enter_publish_date') }}">
                        @error('publish_date')
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="validationServer04" class="form-label">{{ ___('common.status') }} <span
                                class="fillable">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status"
                            id="validationServer04" aria-describedby="validationServer04Feedback">
                            <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('common.active') }}</option>
                            <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('common.inactive') }}
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
                            list="datalistOptions" id="exampleDataList" placeholder="{{ ___('common.Enter description') }}">{{ old('description') }}</textarea>
                        @error('description')
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-24">
                        <div class="text-end">
                            <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                </span>{{ ___('common.submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
