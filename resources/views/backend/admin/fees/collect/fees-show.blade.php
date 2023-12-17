<div class="modal-content" id="modalWidth">
    <div class="modal-header modal-header-image">
        <h4 class="modal-title" id="modalLabel2">
            {{ ___('common.fees_collect') }}
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="{{ route('fees-collect.store') }}" enctype="multipart/form-data" method="post" id="visitForm">
        @csrf
        <input type="hidden" name="student_id" value="{{ $data['student_id'] }}" />
        <div class="modal-body p-5">

            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault01" class="form-label ">{{ ___('common.due_date') }} <span
                                    class="text-danger">*</span></label>
                            <input class="form-control @error('date') is-invalid @enderror" name="date"
                                id="validationDefault01" type="date"
                                placeholder="{{ ___('common.enter_date') }}" value="{{ old('date') }}" required>
                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ ___('common.Payment Method') }} <span
                                    class="text-danger">*</span></label>
                            <div
                                class="input-check-radio academic-section @error('payment_method') is-invalid @enderror">
                                @foreach (\Config::get('site.payment_methods') as $key => $item)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            {{ $key == 1 ? 'checked' : '' }} value="{{ $key }}"
                                            id="flexCheckDefault{{ $key }}" />
                                        <label class="form-check-label ps-2 pe-5"
                                            for="flexCheckDefault{{ $key }}">{{ ___($item) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive table_height_450 niceScroll">
                <table class="table table-bordered role-table" id="students_table">
                    <thead class="thead">
                        <tr>
                            <th class="purchase">{{ ___('common.group') }}</th>
                            <th class="purchase">{{ ___('common.type') }}</th>
                            <th class="purchase">{{ ___('common.due_date') }}</th>
                            <th class="purchase">{{ ___('common.amount') }} ({{ Setting('currency_symbol') }})</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @php
                            $total = 0;
                        @endphp
                        @foreach (@$data['fees_assign_children'] as $item)
                            @if ($item->fees_collect_count == 0)
                                @php

                                    $total += @$item->feesMaster->amount;

                                    if (date('Y-m-d') > $item->feesMaster->date) {
                                        $total += @$item->feesMaster->fine_amount;
                                    }

                                @endphp
                                <input type="hidden" name="fees_assign_childrens[]" value="{{ $item->id }}">
                                <input type="hidden" name="amounts[]" value="{{ $item->feesMaster->amount }}">
                                @if (date('Y-m-d') > $item->feesMaster->date)
                                    <input type="hidden" name="fine_amounts[]"
                                        value="{{ $item->feesMaster->fine_amount }}">
                                @else
                                    <input type="hidden" name="fine_amounts[]" value="0">
                                @endif
                                <tr>
                                    <td>{{ @$item->feesMaster->group->name }}</td>
                                    <td>{{ @$item->feesMaster->type->name }}</td>
                                    <td>{{ dateFormat(@$item->feesMaster->date) }}</td>
                                    <td>{{ @$item->feesMaster->amount }}
                                        @if (date('Y-m-d') > $item->feesMaster->date)
                                            <span class="text-danger">+ {{ @$item->feesMaster->fine_amount }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                            <td><strong>{{ ___('common.total') }}</strong></td>
                            <td>{{ @$total }} </td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-end">
                @if ($total != 0)
                    <button type="submit" class="btn btn-primary">{{ ___('common.confirm') }}</button>
                @endif
            </div>
        </div>
    </form>
</div>
