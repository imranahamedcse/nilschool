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

            <form action="{{ route('member.update', @$data['member']->id) }}" enctype="multipart/form-data" method="post"
                id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-4 member">
                                <label for="validationDefault01" class="form-label">{{ ___('library.select_member') }}
                                    <span class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('member') is-invalid @enderror"
                                    name="member" id="validationDefault01">
                                    <option value="">{{ ___('library.select_member') }}</option>
                                    <option selected value="{{ @$data['member']->user_id }}">{{ $data['user'] }}</option>
                                </select>
                                @error('member')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="validationDefault02" class="form-label">{{ ___('settings.Member category') }}
                                    <span class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('category') is-invalid @enderror"
                                    name="category" id="validationDefault02">
                                    <option value="">{{ ___('library.Select category') }}</option>
                                    @foreach ($data['categories'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category', @$data['member']->category_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationDefault03" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault03">
                                    <option value="{{ App\Enums\Status::ACTIVE }}"
                                        {{ @$data['member']->status == App\Enums\Status::ACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}"
                                        {{ @$data['member']->status == App\Enums\Status::INACTIVE ? 'selected' : '' }}>
                                        {{ ___('common.inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
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
