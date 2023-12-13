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

            <form action="{{ route('income.update', @$data['income']->id) }}" enctype="multipart/form-data" method="post"
                id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('common.name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', @$data['income']->name) }}"
                                    id="validationDefault01" placeholder="{{ ___('common.enter_name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="validationDefault02" class="form-label">{{ ___('account.income_head') }} <span
                                        class="text-danger">*</span></label>

                                <select class="form-control @error('income_head') is-invalid @enderror" name="income_head"
                                    id="validationDefault02">
                                    @foreach ($data['heads'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('income_head', @$data['income']->income_head) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('income_head')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('account.date') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('date') is-invalid @enderror" name="date"
                                    type="date" value="{{ old('date', @$data['income']->date) }}"
                                    id="validationDefault03" placeholder="{{ ___('account.enter_date') }}">
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('account.invoice_number') }}
                                </label>
                                <input class="form-control @error('invoice_number') is-invalid @enderror"
                                    name="invoice_number"
                                    value="{{ old('invoice_number', @$data['income']->invoice_number) }}"
                                    id="validationDefault04"
                                    placeholder="{{ ___('account.enter_invoice_number') }}">
                                @error('invoice_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault05" class="form-label ">{{ ___('account.amount') }}
                                    ({{ Setting('currency_symbol') }}) <span class="text-danger">*</span></label>
                                <input class="form-control @error('amount') is-invalid @enderror" name="amount"
                                    type="number" value="{{ old('amount', @$data['income']->amount) }}"
                                    id="validationDefault05"
                                    placeholder="{{ ___('account.enter_amount') }}">
                                @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="validationDefault06" class="form-label ">{{ ___('common.document') }} <span
                                        class="text-danger"></span></label>
                                <input id="validationDefault06" type="file" class="form-control" name="document">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationDefault07" class="form-label ">{{ ___('account.description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                    id="validationDefault07" placeholder="{{ ___('account.enter_description') }}">{{ old('description', @$data['income']->description) }}</textarea>
                                @error('description')
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
