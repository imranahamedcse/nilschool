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

            <form action="{{ route('expense.update', @$data['expense']->id) }}" enctype="multipart/form-data" method="post"
                id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.name') }} <span
                                        class="fillable">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', @$data['expense']->name) }}" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('common.enter_name') }}">
                                @error('name')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="validationServer04" class="form-label">{{ ___('account.expense_head') }} <span
                                        class="fillable">*</span></label>

                                <select
                                    class="form-control @error('expense_head') is-invalid @enderror"
                                    name="expense_head" id="validationServer04"
                                    aria-describedby="validationServer04Feedback">
                                    @foreach ($data['heads'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('expense_head', @$data['expense']->expense_head) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('expense_head')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('account.date') }} <span
                                        class="fillable">*</span></label>
                                <input class="form-control @error('date') is-invalid @enderror" name="date"
                                    type="date" value="{{ old('date', @$data['expense']->date) }}" list="datalistOptions"
                                    id="exampleDataList" placeholder="{{ ___('account.enter_date') }}">
                                @error('date')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('account.invoice_number') }}
                                </label>
                                <input class="form-control @error('invoice_number') is-invalid @enderror"
                                    name="invoice_number"
                                    value="{{ old('invoice_number', @$data['expense']->invoice_number) }}"
                                    list="datalistOptions" id="exampleDataList"
                                    placeholder="{{ ___('account.enter_invoice_number') }}">
                                @error('invoice_number')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('account.amount') }}
                                    ({{ Setting('currency_symbol') }}) <span class="fillable">*</span></label>
                                <input class="form-control @error('amount') is-invalid @enderror" name="amount"
                                    type="number" value="{{ old('amount', @$data['expense']->amount) }}"
                                    list="datalistOptions" id="exampleDataList"
                                    placeholder="{{ ___('account.enter_amount') }}">
                                @error('amount')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="exampleDataList" class="form-label ">{{ ___('common.document') }} <span
                                        class="fillable"></span></label>
                                    <input type="file" class="form-control" name="document" id="fileBrouse">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="exampleDataList" class="form-label ">{{ ___('account.description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                    list="datalistOptions" id="exampleDataList" placeholder="{{ ___('account.enter_description') }}">{{ old('description', @$data['expense']->description) }}</textarea>
                                @error('description')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
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
