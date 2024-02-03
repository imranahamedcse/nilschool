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

            <form action="{{ route('expense.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label ">{{ ___('create.name') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" id="validationDefault01"
                                    placeholder="{{ ___('create.enter_name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="validationDefault02" class="form-label">{{ ___('create.expense_head') }} <span
                                        class="text-danger">*</span></label>

                                <select class="form-control @error('expense_head') is-invalid @enderror" name="expense_head"
                                    id="validationDefault02">
                                    @foreach ($data['heads'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('expense_head') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('expense_head')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('create.date') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('date') is-invalid @enderror" name="date"
                                    type="date" value="{{ old('date') }}" id="validationDefault03"
                                    placeholder="{{ ___('create.enter_date') }}">
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('create.invoice_number') }}
                                </label>
                                <input class="form-control @error('invoice_number') is-invalid @enderror"
                                    name="invoice_number" value="{{ old('invoice_number') }}"
                                    id="validationDefault04" placeholder="{{ ___('create.enter_invoice_number') }}">
                                @error('invoice_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault05" class="form-label ">{{ ___('create.amount') }}
                                    ({{ Setting('currency_symbol') }}) <span class="text-danger">*</span></label>
                                <input class="form-control @error('amount') is-invalid @enderror" name="amount"
                                    type="number" value="{{ old('amount') }}" id="validationDefault05"
                                    placeholder="{{ ___('create.enter_amount') }}">
                                @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="validationDefault06" class="form-label ">{{ ___('create.document') }} <span
                                        class="text-danger"></span></label>
                                <input id="validationDefault06" type="file" class="form-control" name="document">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationDefault07" class="form-label ">{{ ___('create.description') }}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                    id="validationDefault07" placeholder="{{ ___('create.enter_description') }}">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-24">
                                <div class="text-end">
                                    <button class="btn btn-primary"><span><i class="fa-solid fa-save"></i>
                                        </span>{{ ___('create.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
