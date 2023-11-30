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

            <form action="{{ route('member.store') }}" enctype="multipart/form-data" method="post" id="member">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-4 member">
                                <label for="validationServer04" class="form-label">{{ ___('library.select_member') }}
                                    <span class="fillable">*</span></label>
                                <select
                                    class="form-control @error('member') is-invalid @enderror"
                                    name="member" id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('library.select_member') }}</option>
                                </select>
                                @error('member')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="validationServer04" class="form-label">{{ ___('settings.Member category') }}
                                    <span class="fillable">*</span></label>
                                <select
                                    class="form-control @error('category') is-invalid @enderror"
                                    name="category" id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('library.Select category') }}</option>
                                    @foreach ($data['categories'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('common.status') }} <span
                                        class="fillable">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationServer04" aria-describedby="validationServer04Feedback">
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

                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('common.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
