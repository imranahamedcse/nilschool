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

            <form action="{{ route('fees-master.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label">{{ ___('common.fees_group') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('fees_group_id') is-invalid @enderror"
                                    name="fees_group_id" id="validationDefault01"
                                   >
                                    <option value="">{{ ___('common.select_fees_group') }}</option>
                                    @foreach ($data['fees_groups'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('fees_group_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('fees_group_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02" class="form-label">{{ ___('common.fees_type') }} <span
                                        class="text-danger">*</span></label>
                                <select id="getSubjects validationDefault02"
                                    class="form-control @error('fees_type_id') is-invalid @enderror"
                                    name="fees_type_id">
                                    <option value="">{{ ___('common.select_section') }}</option>
                                    @foreach ($data['fees_types'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('fees_type_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('fees_type_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('common.due_date') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('due_date') is-invalid @enderror" name="due_date"
                                    id="validationDefault03" type="date"
                                    placeholder="{{ ___('common.enter_due_date') }}" value="{{ old('due_date') }}">
                                @error('due_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('common.amount') }}
                                    ({{ Setting('currency_symbol') }}) <span class="text-danger">*</span></label>
                                <input class="form-control amount @error('amount') is-invalid @enderror"
                                    name="amount" id="validationDefault04" type="number"
                                    placeholder="{{ ___('common.enter_amount') }}" value="{{ old('amount') }}">
                                @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault05" class="form-label">{{ ___('common.fine_type') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="fine_type form-control @error('fine_type') is-invalid @enderror"
                                    name="fine_type" id="validationDefault05">
                                    <option {{ old('fine_type') == App\Enums\FineType::NONE ? 'selected' : '' }}
                                        value="{{ App\Enums\FineType::NONE }}">{{ ___('common.none') }}</option>
                                    <option {{ old('fine_type') == App\Enums\FineType::PERCENTAGE ? 'selected' : '' }}
                                        value="{{ App\Enums\FineType::PERCENTAGE }}">{{ ___('common.percentage') }}</option>
                                    <option {{ old('fine_type') == App\Enums\FineType::FIX_AMOUNT ? 'selected' : '' }}
                                        value="{{ App\Enums\FineType::FIX_AMOUNT }}">{{ ___('common.fix_amount') }}</option>
                                </select>
                                @error('fine_type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault06" class="form-label">{{ ___('common.status') }} <span
                                        class="text-danger">*</span></label>
                                <select
                                    class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="validationDefault06">
                                    <option value="{{ App\Enums\Status::ACTIVE }}">{{ ___('common.active') }}</option>
                                    <option value="{{ App\Enums\Status::INACTIVE }}">{{ ___('common.inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3 percentage">
                                <label for="validationDefault07" class="form-label ">{{ ___('common.percentage') }} <span
                                        class="text-danger">*</span></label>
                                <input
                                    class="form-control percentage_input @error('percentage') is-invalid @enderror"
                                    name="percentage" id="validationDefault07" type="number"
                                    placeholder="{{ ___('common.enter_percentage') }}" value="{{ old('percentage') ?? 0 }}">
                                @error('percentage')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3 fine_amount">
                                <label for="validationDefault08" class="form-label ">{{ ___('common.fine_amount') }}
                                    ({{ Setting('currency_symbol') }}) <span class="text-danger">*</span></label>
                                <input
                                    class="form-control fine_amount_input @error('fine_amount') is-invalid @enderror"
                                    name="fine_amount" id="validationDefault08" type="number"
                                    placeholder="{{ ___('common.enter_fine_amount') }}"
                                    value="{{ old('fine_amount') ?? 0 }}">
                                @error('fine_amount')
                                    <div class="invalid-feedback">
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
