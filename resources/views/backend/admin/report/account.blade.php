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

        @if (@$data['result'])
            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ ___('index.date') }}</th>
                        <th>{{ ___('index.name') }}</th>
                        <th>{{ ___('index.Head') }}</th>
                        <th>{{ ___('index.Amount') }} ({{ Setting('currency_symbol') }})</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['result'] as $key=>$item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ dateFormat($item->date) }}</td>
                            <td>
                                @if (@$item->fees_collect_id != null)
                                    {{ @$item->feesType->name }}
                                @else
                                    {{ @$item->name }}
                                @endif
                            </td>
                            <td>{{ $item->head->name }}</td>
                            <td>{{ $item->amount }}</td>
                        </tr>
                    @empty
                        @include('backend.admin.components.table.empty')
                    @endforelse
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">{{ ___('index.total') }}:</td>
                        <td>{{ $data['sum'] }}</td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>
@endsection

@push('script')
    @include('backend.admin.components.table.js')
@endpush
