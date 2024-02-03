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
                    <th class="purchase">{{ ___('index.image') }}</th>
                    <th class="purchase">{{ ___('index.status') }}</th>
                    @if (hasPermission('dep_contact_update') || hasPermission('dep_contact_delete'))
                        <th class="action">{{ ___('index.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['dep_contact'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ @$row->name }}</td>
                        <td>{{ @$row->phone }}</td>
                        <td>{{ @$row->email }}</td>
                        <td>
                            <div class="user-avatar">
                                <img src="{{ @globalAsset(@$row->upload->path, '40X40.webp') }}" alt="Photo">
                            </div>
                        </td>
                        <td>
                            @include('backend.admin.components.table.status')
                        </td>
                        @if (hasPermission('dep_contact_update') || hasPermission('dep_contact_delete'))
                            <td>
                                @if (hasPermission('dep_contact_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('index.edit') }}"
                                        href="{{ route('department-contact.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('dep_contact_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('index.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('website-setup/department-contact/delete', {{ $row->id }})"><i
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
