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
                    <th class="purchase">{{ ___('index.title') }}</th>
                    <th class="purchase">{{ ___('index.image') }}</th>
                    <th class="purchase">{{ ___('index.date') }}</th>
                    <th class="purchase">{{ ___('index.Publish date') }}</th>
                    <th class="purchase">{{ ___('index.status') }}</th>
                    @if (hasPermission('news_update') || hasPermission('news_delete'))
                        <th class="action">{{ ___('index.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['news'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ @$row->title }}</td>
                        <td>
                            <div class="user-avatar">
                                <img src="{{ @globalAsset(@$row->upload->path, '40X40.svg') }}" alt="Photo">
                            </div>
                        </td>
                        <td>{{ dateFormat(@$row->date) }}</td>
                        <td>{{ dateFormat(@$row->publish_date) }}</td>
                        <td>
                            @include('backend.admin.components.table.status')
                        </td>
                        @if (hasPermission('news_update') || hasPermission('news_delete'))
                            <td>
                                @if (hasPermission('news_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('index.edit') }}" href="{{ route('news.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('news_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('index.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('website-setup/news/delete', {{ $row->id }})"><i
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
