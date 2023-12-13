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
                    <th class="purchase">{{ ___('common.title') }}</th>
                    <th class="purchase">{{ ___('common.image') }}</th>
                    <th class="purchase">{{ ___('common.date') }}</th>
                    <th class="purchase">{{ ___('common.Start time') }}</th>
                    <th class="purchase">{{ ___('common.End time') }}</th>
                    <th class="purchase">{{ ___('common.status') }}</th>
                    @if (hasPermission('event_update') || hasPermission('event_delete'))
                        <th class="action">{{ ___('common.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['event'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ @$row->title }}</td>
                        <td>
                            <div class="user-avatar">
                                <img src="{{ @globalAsset(@$row->upload->path, '40X40.webp') }}" alt="Photo">
                            </div>
                        </td>
                        <td>{{ dateFormat(@$row->date) }}</td>
                        <td>{{ timeFormat(@$row->start_time) }}</td>
                        <td>{{ timeFormat(@$row->end_time) }}</td>
                        <td>
                            @include('backend.admin.components.table.status')
                        </td>
                        @if (hasPermission('event_update') || hasPermission('event_delete'))
                            <td>
                                @if (hasPermission('event_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.edit') }}" href="{{ route('event.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('event_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('website-setup/event/delete', {{ $row->id }})"><i
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
