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

            <form action="{{ route('issue-book.store') }}" enctype="multipart/form-data" method="post" id="issue_book">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-6 book mb-3">
                                <label for="validationServer04" class="form-label">{{ ___('library.select_book') }}
                                    <span class="fillable">*</span></label>
                                <select
                                    class="form-control @error('book') is-invalid @enderror"
                                    name="book" id="validationServer04" aria-describedby="validationServer04Feedback">
                                    <option value="">{{ ___('library.select_book') }}</option>
                                </select>
                                @error('book')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 member mb-3">
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

                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('library.issue_date') }} <span
                                        class="fillable">*</span></label>
                                <input class="form-control @error('issue_date') is-invalid @enderror"
                                    name="issue_date" type="date" value="{{ old('issue_date') }}" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('library.enter_issue_date') }}">
                                @error('issue_date')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('library.return_date') }} <span
                                        class="fillable">*</span></label>
                                <input class="form-control @error('return_date') is-invalid @enderror"
                                    name="return_date" type="date" value="{{ old('return_date') }}"
                                    list="datalistOptions" id="exampleDataList"
                                    placeholder="{{ ___('library.enter_return_date') }}">
                                @error('return_date')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.phone') }} <span
                                        class="fillable">*</span></label>
                                <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone') }}" list="datalistOptions" id="exampleDataList"
                                    placeholder="{{ ___('library.enter_phone_no') }}">
                                @error('phone')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="exampleDataList" class="form-label">{{ ___('library.description') }}</label>
                                <textarea class="form-control" name="description" id="exampleDataList">{{ old('description') }}</textarea>
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
