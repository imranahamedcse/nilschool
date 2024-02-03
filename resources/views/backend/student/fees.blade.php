@extends('backend.student.partials.master')

@section('title')
    {{ @$data['headers']['title'] }}
@endsection

@push('style')
    @include('backend.admin.components.table.css')
@endpush

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="p-4 rounded-3 bg-white">
        @include('backend.admin.components.table.header')


        <table id="datatable" class="table">
            <thead class="thead">
                <tr>
                    <th class="purchase">{{ ___('index.group') }}</th>
                    <th class="purchase">{{ ___('index.type') }}</th>
                    <th class="purchase">{{ ___('index.due_date') }}</th>
                    <th class="purchase">{{ ___('index.amount') }} ({{ Setting('currency_symbol') }})</th>
                    <th class="purchase">{{ ___('index.status') }}</th>
                    <th class="purchase">{{ ___('index.fine_type') }}</th>
                    <th class="purchase">{{ ___('index.percentage') }}</th>
                    <th class="purchase">{{ ___('index.fine_amount') }} ({{ Setting('currency_symbol') }})</th>
                    <th class="purchase">{{ ___('index.Action') }}</th>
                </tr>
            </thead>
            <tbody class="tbody">

                @forelse (@$data['fees_assigned'] as $item)
                    <tr>
                        <td>{{ @$item->feesMaster->group->name }}</td>
                        <td>{{ @$item->feesMaster->type->name }}</td>
                        <td>{{ dateFormat(@$item->feesMaster->due_date) }}</td>
                        <td>{{ @$item->feesMaster->amount }}

                            @if (date('Y-m-d') > $item->feesMaster->due_date && $item->fees_collect_count == 0)
                                <span class="text-danger">+ {{ @$item->feesMaster->fine_amount }}</span>
                            @elseif($item->fees_collect_count == 1 && $item->feesMaster->due_date < $item->feesCollect->date)
                                <span class="text-danger">+ {{ @$item->feesMaster->fine_amount }}</span>
                            @endif

                        </td>
                        <td>
                            @if ($item->fees_collect_count)
                                <span class="badge-basic-success-text">{{ ___('index.Paid') }}</span>
                            @else
                                <span class="badge-basic-danger-text">{{ ___('index.Unpaid') }}</span>
                            @endif
                        </td>
                        <td>
                            @if (@$item->fine_type == 0)
                                <span class="badge-basic-info-text">{{ ___('index.none') }}</span>
                            @elseif(@$item->fine_type == 1)
                                <span class="badge-basic-info-text">{{ ___('index.percentage') }}</span>
                            @elseif(@$item->fine_type == 2)
                                <span class="badge-basic-info-text">{{ ___('index.fixed') }}</span>
                            @endif
                        </td>
                        <td>{{ @$item->feesMaster->percentage }}</td>
                        <td>
                            @if (date('Y-m-d') > @$item->feesMaster->due_date)
                                {{ @$item->feesMaster->fine_amount }}
                            @else
                                0
                            @endif
                        </td>
                        <td>
                            @if (!$item->fees_collect_count)
                                <a href="#" class="btn btn-sm ot-btn-primary px-3" data-bs-toggle="modal"
                                    data-bs-target="#modalCustomizeWidth"
                                    onclick="feePayByStudentModal(`{{ $item->id }}`)">
                                    <span class="">{{ ___('index.Pay') }}</span>
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="text-center gray-color">
                            <img src="{{ asset('images/no_data.svg') }}" alt="" class="mb-primary" width="100">
                            <p class="mb-0 text-center">{{ ___('index.No data available') }}</p>
                            <p class="mb-0 text-center text-secondary font-size-90">
                                {{ ___('index.Please add new entity regarding this table') }}
                            </p>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>
@endsection




@push('script')
    <script src="https://js.stripe.com/v3/"></script>
    @include('backend.admin.components.table.js')
@endpush
