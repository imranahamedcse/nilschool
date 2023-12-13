@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card bg-white">
        <div class="card-body">
            <div class="border-bottom pb-3 mb-4">
                <h4 class="m-0">{{ @$data['title'] }}</h4>
            </div>
            <form action="{{ route('book.update', @$data['book']->id) }}" enctype="multipart/form-data" method="post"
                id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="validationDefault01" class="form-label">{{ ___('settings.Book category') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('category') is-invalid @enderror"
                                    name="category" id="validationDefault01">
                                    <option value="">{{ ___('library.Select category') }}</option>
                                    @foreach ($data['categories'] as $item)
                                        <option {{ @$data['book']->category_id == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}"
                                            {{ old('category') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault02" class="form-label ">{{ ___('common.name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', @$data['book']->name) }}"
                                    id="validationDefault02" placeholder="{{ ___('common.enter_name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('library.code') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('code') is-invalid @enderror" name="code"
                                    value="{{ old('code', @$data['book']->code) }}"
                                    id="validationDefault03" placeholder="{{ ___('library.enter_code') }}">
                                @error('code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('library.publisher_name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('publisher_name') is-invalid @enderror"
                                    name="publisher_name"
                                    value="{{ old('publisher_name', @$data['book']->publisher_name) }}"
                                    id="validationDefault04"
                                    placeholder="{{ ___('library.enter_publisher_name') }}">
                                @error('publisher_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault05" class="form-label ">{{ ___('library.author_name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('author_name') is-invalid @enderror"
                                    name="author_name" value="{{ old('author_name', @$data['book']->author_name) }}"
                                    id="validationDefault05"
                                    placeholder="{{ ___('library.enter_author_name') }}">
                                @error('author_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault06" class="form-label ">{{ ___('library.rack_no') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('rack_no') is-invalid @enderror" name="rack_no"
                                    value="{{ old('rack_no', @$data['book']->rack_no) }}"
                                    id="validationDefault06" type="number" placeholder="{{ ___('library.enter_rack_no') }}">
                                @error('rack_no')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault07" class="form-label ">{{ ___('library.price') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('price') is-invalid @enderror" name="price"
                                    type="number" value="{{ old('price', @$data['book']->price) }}"
                                    id="validationDefault07" placeholder="{{ ___('library.enter_price') }}">
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault08" class="form-label ">{{ ___('library.quantity') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('quantity') is-invalid @enderror"
                                    name="quantity" type="number"
                                    value="{{ old('quantity', @$data['book']->quantity) }}"
                                    id="validationDefault08" placeholder="{{ ___('library.enter_quantity') }}">
                                @error('quantity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault09" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault09">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['book']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['book']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationDefault10" class="form-label">{{ ___('library.description') }}</label>
                                <textarea class="form-control" name="description" id="validationDefault10">{{ old('description', @$data['book']->description) }}</textarea>
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
