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

            <form action="{{ route('fees-master.update', @$data['fees_master']->id) }}" enctype="multipart/form-data"
                method="post" id="visitForm">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault01" class="form-label">{{ ___('create.fees_group') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('fees_group_id') is-invalid @enderror"
                                    name="fees_group_id" id="validationDefault01">
                                    @foreach ($data['fees_groups'] as $item)
                                        <option
                                            {{ old('fees_group_id', @$data['fees_master']->fees_group_id == $item->id ? 'selected' : '') }}
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('fees_group_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault02" class="form-label">{{ ___('create.fees_type') }} <span
                                        class="text-danger">*</span></label>
                                <select id="getSubjects validationDefault02"
                                    class="form-control @error('fees_type_id') is-invalid @enderror" name="fees_type_id">
                                    <option value="">{{ ___('create.select_section') }}</option>
                                    @foreach ($data['fees_types'] as $item)
                                        <option
                                            {{ old('fees_type_id', @$data['fees_master']->fees_type_id) == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('fees_type_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault03" class="form-label ">{{ ___('create.due_date') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('due_date') is-invalid @enderror" name="due_date"
                                    id="validationDefault03" type="date"
                                    placeholder="{{ ___('create.enter_due_date') }}"
                                    value="{{ old('due_date', @$data['fees_master']->due_date) }}">
                                @error('due_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault04" class="form-label ">{{ ___('create.amount') }}
                                    ({{ Setting('currency_symbol') }}) <span class="text-danger">*</span></label>
                                <input class="form-control amount @error('amount') is-invalid @enderror" name="amount"
                                    id="validationDefault04" type="number" placeholder="{{ ___('create.enter_amount') }}"
                                    value="{{ old('amount', @$data['fees_master']->amount) }}">
                                @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault05" class="form-label">{{ ___('create.fine_type') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control fine_type @error('fine_type') is-invalid @enderror"
                                    name="fine_type" id="validationDefault05">
                                    <option
                                        {{ old('fine_type', @$data['fees_master']->fine_type) == App\Enums\FineType::NONE ? 'selected' : '' }}
                                        value="{{ App\Enums\FineType::NONE }}">{{ ___('create.none') }}</option>
                                    <option
                                        {{ old('fine_type', @$data['fees_master']->fine_type) == App\Enums\FineType::PERCENTAGE ? 'selected' : '' }}
                                        value="{{ App\Enums\FineType::PERCENTAGE }}">{{ ___('create.percentage') }}
                                    </option>
                                    <option
                                        {{ old('fine_type', @$data['fees_master']->fine_type) == App\Enums\FineType::FIX_AMOUNT ? 'selected' : '' }}
                                        value="{{ App\Enums\FineType::FIX_AMOUNT }}">{{ ___('create.fix_amount') }}
                                    </option>
                                </select>
                                @error('fine_type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationDefault06" class="form-label">{{ ___('create.status') }} <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status"
                                    id="validationDefault06">
                                    <option
                                        {{ old('status', @$data['fees_master']->status == App\Enums\Status::ACTIVE ? 'selected' : '') }}
                                        value="{{ App\Enums\Status::ACTIVE }}">{{ ___('create.active') }}</option>
                                    <option
                                        {{ old('status', @$data['fees_master']->status == App\Enums\Status::INACTIVE ? 'selected' : '') }}
                                        value="{{ App\Enums\Status::INACTIVE }}">{{ ___('create.inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3 percentage">
                                <label for="validationDefault07" class="form-label ">{{ ___('create.percentage') }} <span
                                        class="text-danger">*</span></label>
                                <input class="form-control percentage_input @error('percentage') is-invalid @enderror"
                                    name="percentage" id="validationDefault07" type="number"
                                    placeholder="{{ ___('create.enter_percentage') }}"
                                    value="{{ old('percentage', @$data['fees_master']->percentage) ?? 0 }}">
                                @error('percentage')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3 fine_amount">
                                <label for="validationDefault08" class="form-label ">{{ ___('create.fine_amount') }}
                                    ({{ Setting('currency_symbol') }}) <span class="text-danger">*</span></label>
                                <input class="form-control fine_amount_input @error('fine_amount') is-invalid @enderror"
                                    name="fine_amount" id="validationDefault08" type="number"
                                    placeholder="{{ ___('create.enter_fine_amount') }}"
                                    value="{{ old('fine_amount', @$data['fees_master']->fine_amount) ?? 0 }}">
                                @error('fine_amount')
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

@push('script')
    <script>
        // Start Fees Master
        var fine_type = $('.fine_type').val();
        if (fine_type == 0) {
            $('.percentage').hide();
            $('.fine_amount').hide();
        } else if (fine_type == 1) {
            $('.percentage').show();
            $('.fine_amount').show();
        } else if (fine_type == 2) {
            $('.percentage').hide();
            $('.fine_amount').show();
        }

        $('.fine_type').on('change', function(e) {
            var fine_type = $('.fine_type').val();
            if (fine_type == 0) {
                $('.percentage').hide();
                $('.fine_amount').hide();
                $('.percentage_input').val('0');
                $('.fine_amount_input').val('0');
                $('.fine_amount_input').prop('readonly', false);
            } else if (fine_type == 1) {
                $('.percentage').show();
                $('.fine_amount').show();
                $('.percentage_input').val('0');
                $('.fine_amount_input').val('0');
                $('.fine_amount_input').prop('readonly', true);
            } else if (fine_type == 2) {
                $('.percentage').hide();
                $('.fine_amount').show();
                $('.percentage_input').val('0');
                $('.fine_amount_input').val('0');
                $('.fine_amount_input').prop('readonly', false);
            }
        });

        $(".percentage_input").on("keypress", function(e) {
            var currentValue = String.fromCharCode(e.which);
            var finalValue = $(this).val() + currentValue;
            if (finalValue > 100) {
                e.preventDefault();
            }
        });

        $('.percentage_input').on('keyup', function(e) {
            var amount = $('.amount').val();
            var per = $('.percentage_input').val();
            $('.fine_amount_input').val((amount * (per / 100)).toFixed(0));
        });

        $('.amount').on('keyup', function(e) {
            var amount = $('.amount').val();
            var per = $('.percentage_input').val();
            $('.fine_amount_input').val((amount * (per / 100)).toFixed(0));
        });
        // End Fees Master
    </script>
@endpush
