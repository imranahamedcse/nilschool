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
                    <th class="purchase">{{ ___('common.Key') }}</th>
                    <th class="purchase">{{ ___('common.name') }}</th>
                    <th class="purchase">{{ ___('common.image') }}</th>
                    @if (hasPermission('page_sections_update'))
                        <th class="action">{{ ___('common.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['sections'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ @$row->key }}</td>
                        <td>{{ @$row->name }}</td>
                        <td>
                            @if (@$row->upload_path)
                                <div class="user-avatar">
                                    <img src="{{ @globalAsset(@$row->upload->path) }}" alt="Photo">
                                </div>
                            @endif
                        </td>
                        @if (hasPermission('page_sections_update'))
                            <td>
                                @if (hasPermission('page_sections_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.edit') }}" href="{{ route('sections.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
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
