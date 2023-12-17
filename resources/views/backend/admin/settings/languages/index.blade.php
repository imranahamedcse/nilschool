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
            <thead>
                <tr>
                    <th class="serial">{{ ___('common.sr_no') }}</th>
                    <th class="purchase">{{ ___('common.name') }}</th>
                    <th class="purchase">{{ ___('common.code') }}</th>
                    <th class="purchase">{{ ___('common.icon') }}</th>
                    @if (hasPermission('language_update') || hasPermission('language_delete') || hasPermission('language_update_terms'))
                        <th class="action">{{ ___('common.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse (@$data['languages'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td> {{ $row->name }} {{ $row->summernote }}</td>
                        <td>{{ $row->code }}</td>
                        <td><i class="{{ $row->icon_class }} "></i></td>
                        <td>
                            @if (hasPermission('language_update'))
                                <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ ___('common.edit') }}"
                                    href="{{ route('languages.edit', $row->id) }}"><i class="fa-solid fa-pencil"></i></a>
                            @endif
                            @if (hasPermission('language_update_terms'))
                                <a class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ ___('common.edit_terms') }}"
                                    href="{{ route('languages.edit.terms', $row->id) }}"><i class="fa-solid fa-file-pen"></i></a>
                            @endif
                            @if (hasPermission('language_delete') && $row->code != 'en')
                                <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ ___('common.delete') }}" 
                                href="javascript:void(0);" onclick="delete_row('settings/languages/delete', {{ $row->id }})"><i class="fa-solid fa-trash-can"></i></a>
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
