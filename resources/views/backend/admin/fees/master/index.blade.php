@extends('backend.admin.partial.master')

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
                    <th class="serial">{{ ___('index.sr_no') }}</th>
                    <th class="purchase">{{ ___('index.group') }}</th>
                    <th class="purchase">{{ ___('index.type') }}</th>
                    <th class="purchase">{{ ___('index.due_date') }}</th>
                    <th class="purchase">{{ ___('index.amount') }} ({{ Setting('currency_symbol') }})</th>
                    <th class="purchase">{{ ___('index.fine_type') }}</th>
                    <th class="purchase">{{ ___('index.percentage') }}</th>
                    <th class="purchase">{{ ___('index.fine_amount') }} ({{ Setting('currency_symbol') }})</th>
                    <th class="purchase">{{ ___('index.status') }}</th>
                    @if (hasPermission('fees_master_update') || hasPermission('fees_master_delete'))
                        <th class="action">{{ ___('index.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['fees_masters'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ $row->group->name }}</td>
                        <td>{{ $row->type->name }}</td>
                        <td>{{ dateFormat($row->due_date) }}</td>
                        <td>{{ $row->amount }}</td>
                        <td>
                            @if ($row->fine_type == 0)
                                <span class="badge-basic-info-text">{{ ___('index.none') }}</span>
                            @elseif($row->fine_type == 1)
                                <span class="badge-basic-info-text">{{ ___('index.percentage') }}</span>
                            @elseif($row->fine_type == 2)
                                <span class="badge-basic-info-text">{{ ___('index.fixed') }}</span>
                            @endif
                        </td>
                        <td>{{ $row->percentage }}</td>
                        <td>{{ $row->fine_amount }}</td>
                        <td>
                            @include('backend.admin.components.table.status')
                        </td>
                        @if (hasPermission('fees_master_update') || hasPermission('fees_master_delete'))
                            <td>
                                @if (hasPermission('fees_master_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('index.edit') }}"
                                        href="{{ route('fees-master.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('fees_master_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('index.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('fees/master/delete', {{ $row->id }})"><i
                                            class="fa-solid fa-trash-can"></i></a>
                                @endif
                            </td>
                        @endif
                    </tr>
                @empty
                    @include('backend.admin.components.table.empty')
                @endforelse
            </tbody>
        </table>


    </div>
@endsection

@push('script')
    @include('backend.admin.components.table.js')
    @include('backend.admin.components.table.delete-ajax')
@endpush
