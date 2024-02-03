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
                    <th class="purchase">{{ ___('index.name') }}</th>
                    <th class="purchase">{{ ___('index.phone') }}</th>
                    <th class="purchase">{{ ___('index.email') }}</th>
                    <th class="purchase">{{ ___('index.subject') }}</th>
                    <th class="purchase">{{ ___('index.message') }}</th>
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['contact'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ @$row->name }}</td>
                        <td>{{ @$row->phone }}</td>
                        <td>{{ @$row->email }}</td>
                        <td>{{ @$row->subject }}</td>
                        <td>{{ @$row->message }}</td>
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
