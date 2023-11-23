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
                    <th class="purchase">{{ ___('language.code') }}</th>
                    <th class="purchase">{{ ___('language.icon') }}</th>
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
                        @if (hasPermission('language_update') || hasPermission('language_delete') || hasPermission('language_update_terms'))
                            <td class="action">
                                <div class="dropdown dropdown-action px-1">
                                    <button type="button" class="btn btn-sm btn-primary btn-dropdown"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-screwdriver-wrench"></i> {{ ___('common.buttons') }}
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">
                                        @if (hasPermission('language_update'))
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('languages.edit', $row->id) }}"><span
                                                        class="icon mr-8"><i class="fa-solid fa-pen-to-square"></i></span>
                                                    <span>{{ ___('common.edit') }}</span></a>
                                            </li>
                                        @endif
                                        @if ($row->code != 'en')
                                            @if (hasPermission('language_delete'))
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);"
                                                        onclick="delete_row('languages/delete', {{ $row->id }})">
                                                        <span class="icon mr-8"><i class="fa-solid fa-trash-can"></i></span>
                                                        <span>{{ ___('common.delete') }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endif
                                        @if (hasPermission('language_update_terms'))
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('languages.edit.terms', $row->id) }}"><span
                                                        class="icon mr-8"><i class="fa-solid fa-pen-to-square"></i></span>
                                                    <span>{{ ___('language.edit_terms') }}</span></a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
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
