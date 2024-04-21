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
            <form action="{{ route('product.update', @$data['product']->id) }}" enctype="multipart/form-data" method="post"
                id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="validationDefault01" class="form-label">{{ ___('create.product category') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('category') is-invalid @enderror"
                                    name="category" id="validationDefault01">
                                    <option value="">{{ ___('create.Select category') }}</option>
                                    @foreach ($data['categories'] as $item)
                                        <option {{ @$data['product']->product_categorie_id == $item->id ? 'selected' : '' }}
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
                                <label for="validationDefault02" class="form-label ">{{ ___('create.name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', @$data['product']->name) }}"
                                    id="validationDefault02" placeholder="{{ ___('create.enter_name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('create.SKU') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('sku') is-invalid @enderror" name="sku"
                                    value="{{ old('sku', @$data['product']->sku) }}"
                                    id="validationDefault03" placeholder="{{ ___('create.enter_sku') }}">
                                @error('sku')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault07" class="form-label ">{{ ___('create.price') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('price') is-invalid @enderror" name="price"
                                    type="number" value="{{ old('price', @$data['product']->price) }}"
                                    id="validationDefault07" placeholder="{{ ___('create.enter_price') }}">
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationDefault08" class="form-label ">{{ ___('create.quantity') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('quantity') is-invalid @enderror"
                                    name="quantity" type="number"
                                    value="{{ old('quantity', @$data['product']->quantity) }}"
                                    id="validationDefault08" placeholder="{{ ___('create.enter_quantity') }}">
                                @error('quantity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault09" class="form-label">{{ ___('create.status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault09">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['product']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['product']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('create.inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationDefault10" class="form-label">{{ ___('create.description') }}</label>
                                <textarea class="form-control" name="description" id="validationDefault10">{{ old('description', @$data['product']->description) }}</textarea>
                            </div>


                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('create.update') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
