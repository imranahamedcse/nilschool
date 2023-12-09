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
                    <th class="purchase">{{ ___('academic.class') }} ({{ ___('academic.section') }})</th>
                    <th class="purchase">{{ ___('academic.subject') }}</th>
                    <th class="purchase">{{ ___('common.document') }}</th>
                    <th class="purchase">{{ ___('common.Assigned By') }}</th>
                    @if (hasPermission('post_update') || hasPermission('post_delete'))
                        <th class="action">{{ ___('common.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['posts'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ $row->class->name }} ({{ $row->section->name }})</td>
                        <td>{{ $row->subject->name }}</td>
                        <td>
                            @if (@$row->upload->path)
                                <a href="{{ @globalAsset(@$row->upload->path) }}"
                                    download>{{ ___('common.download') }}</a>
                            @endif
                        </td>
                        <td>{{ @$row->user->name }}</td>
                        @if (hasPermission('post_update') || hasPermission('post_delete'))
                            <td>
                                @if (hasPermission('fees_type_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.edit') }}" href="{{ route('post.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('fees_type_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('class-room/post/delete', {{ $row->id }})"><i
                                            class="fa-solid fa-trash-can"></i></a>
                                @endif
                                <a class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ ___('common.edit') }}" href="{{ route('post.view', $row->id) }}"><i
                                        class="fa-solid fa-eye"></i></a>
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

    <script src="{{ asset('backend/js/get-section.js') }}"></script>
    <script src="{{ asset('backend/js/get-subject.js') }}"></script>
@endpush
