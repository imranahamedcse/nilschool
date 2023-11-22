@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@push('style')
    @include('backend.admin.partial.table_header')
@endpush

@section('content')
    <nav class="mt-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-info" href="{{ route('dashboard') }}">{{ ___('common.home') }}</a></li>
            <li class="breadcrumb-item active">{{ $data['title'] }}</li>
        </ol>
    </nav>


    <div class="p-4 rounded-3 bg-white">
        <div class="row justify-content-between mb-4">
            <div class="col-6 align-self-center">
                <h4 class="m-0">{{ ___('language.languages') }}</h4>
            </div>
            <div class="col-6 text-end">
                @if (hasPermission('language_create'))
                    <a class="btn btn-sm btn-info" href="{{ route('languages.create') }}">
                        <i class="fa-solid fa-plus"></i> {{ ___('common.add') }}
                    </a>
                @endif
            </div>
        </div>

        <table id="datatable" class="table cell-border" style="width:100%">
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
                @forelse ($data['languages'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td> {{ $row->name }} {{ $row->summernote }}</td>
                        <td>{{ $row->code }}</td>
                        <td><i class="{{ $row->icon_class }} "></i></td>
                        @if (hasPermission('language_update') || hasPermission('language_delete') || hasPermission('language_update_terms'))
                            <td class="action">
                                <div class="dropdown dropdown-action">
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
                    <tr>
                        <td colspan="100%" class="text-center gray-color">
                            <img src="{{ asset('images/no_data.svg') }}" alt="" class="mb-primary" width="100">
                            <p class="mb-0 text-center">{{ ___('common.No data available') }}</p>
                            <p class="mb-0 text-center text-secondary font-size-90">
                                {{ ___('common.Please add new entity regarding this table') }}</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="text-center p-4 bg-white">
            {{ setting('footer_text') }}
        </div>
    </div>



@endsection

@push('script')
    @include('backend.admin.partial.table_footer')
    @include('backend.admin.partial.delete-ajax')
@endpush
