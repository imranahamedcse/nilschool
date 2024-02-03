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
                    <th class="purchase">{{ ___('index.status') }}</th>
                    @if (hasPermission('classes_update') || hasPermission('classes_delete'))
                        <th class="action">{{ ___('index.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['class'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ $row->name }}</td>
                        <td>
                            @include('backend.admin.components.table.status')
                        </td>
                        <td>
                            @if (hasPermission('classes_update'))
                                <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ ___('index.edit') }}" href="{{ route('classes.edit', $row->id) }}"><i
                                        class="fa-solid fa-pencil"></i></a>
                            @endif
                            @if (hasPermission('classes_delete') && $row->code != 'en')
                                <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ ___('index.delete') }}" href="javascript:void(0);"
                                    onclick="delete_row('academic/classes/delete', {{ $row->id }})"><i
                                        class="fa-solid fa-trash-can"></i></a>
                            @endif
                        </td>
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
