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

            <form action="{{ route('issue-book.update', @$data['issue_book']->id) }}" enctype="multipart/form-data"
                method="post" id="issue_book">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-6 book mb-3">
                                <label for="validationDefault01" class="form-label">{{ ___('create.select_book') }}
                                    <span class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('book') is-invalid @enderror"
                                    name="book" id="validationDefault01">
                                    <option value="">{{ ___('create.select_book') }}</option>
                                    <option selected value="{{ @$data['issue_book']->book_id }}">{{ $data['book'] }}
                                    </option>
                                </select>
                                @error('book')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 member mb-3">
                                <label for="validationDefault02" class="form-label">{{ ___('create.select_member') }}
                                    <span class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('member') is-invalid @enderror"
                                    name="member" id="validationDefault02">
                                    <option value="">{{ ___('create.select_member') }}</option>
                                    <option selected value="{{ @$data['issue_book']->user_id }}">{{ $data['user'] }}
                                    </option>
                                </select>
                                @error('member')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('create.issue_date') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('issue_date') is-invalid @enderror"
                                    name="issue_date" type="date"
                                    value="{{ old('issue_date', @$data['issue_book']->issue_date) }}"
                                    id="validationDefault03" placeholder="{{ ___('create.enter_issue_date') }}">
                                @error('issue_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('create.return_date') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('return_date') is-invalid @enderror"
                                    name="return_date" type="date"
                                    value="{{ old('return_date', @$data['issue_book']->return_date) }}"
                                    id="validationDefault04"
                                    placeholder="{{ ___('create.enter_return_date') }}">
                                @error('return_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationDefault05" class="form-label ">{{ ___('create.phone') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone', @$data['issue_book']->phone) }}"
                                    id="validationDefault05" placeholder="{{ ___('create.enter_phone_no') }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="validationDefault06" class="form-label">{{ ___('create.description') }}</label>
                                <textarea class="form-control" name="description" id="validationDefault06">{{ old('description', @$data['issue_book']->description) }}</textarea>
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
