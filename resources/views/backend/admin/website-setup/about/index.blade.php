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
                    <th class="serial">{{ ___('common.sr_no') }}</th>
                    <th class="purchase">{{ ___('common.name') }}</th>
                    <th class="purchase">{{ ___('common.icon') }}</th>
                    <th class="purchase">{{ ___('common.image') }}</th>
                    <th class="purchase">{{ ___('common.Serial') }}</th>
                    <th class="purchase">{{ ___('common.status') }}</th>
                    @if (hasPermission('about_update') || hasPermission('about_delete'))
                        <th class="action">{{ ___('common.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['about'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ @$row->name }}</td>
                        <td>
                            <div class="user-avatar">
                                <img src="{{ @globalAsset(@$row->icon_upload->path, '40X40.webp') }}" alt="Photo">
                            </div>
                        </td>
                        <td>
                            <div class="user-avatar">
                                <img src="{{ @globalAsset(@$row->upload->path, '40X40.webp') }}" alt="Photo">
                            </div>
                        </td>
                        <td>{{ @$row->serial }}</td>
                        <td>
                            @include('backend.admin.components.table.status')
                        </td>
                        @if ((hasPermission('about_update') || hasPermission('about_delete')) && $row->fees_collect_id == null)
                            <td>
                                @if (hasPermission('about_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.edit') }}" href="{{ route('about.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('about_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('website-setup/abouts/delete', {{ $row->id }})"><i
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
