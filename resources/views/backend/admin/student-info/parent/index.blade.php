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
        <div class="row justify-content-between border-bottom pb-4 mb-4">
            <div class="col align-self-center">
                <h4 class="m-0">{{ @$data['headers']['title'] }}</h4>
            </div>
            <div class="col">
                <form action="{{ route('parent.search') }}" method="post" id="marksheed" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input class="form-control" name="keyword"
                            placeholder="{{ ___('student_info.Enter keyword') }}"
                            value="{{ old('keyword', @$data['request']->keyword) }}">
                        <button class="btn btn-primary ml-3" type="submit">
                            {{ ___('common.Search') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="col text-end">
                @if (hasPermission(@$data['headers']['permission']))
                    <a class="btn btn-sm btn-secondary" href="{{ route(@$data['headers']['create-route']) }}">
                        <i class="fa-solid fa-plus"></i> {{ ___('common.add') }}
                    </a>
                @endif
            </div>
        </div>

        @if (@$data['parents'])
            <div class="card-body">
                <table id="datatable" class="table">
                    <thead class="thead">
                        <tr>
                            <th class="serial">{{ ___('common.sr_no') }}</th>
                            <th class="purchase">{{ ___('common.name') }}</th>
                            <th class="purchase">{{ ___('common.phone') }}</th>
                            <th class="purchase">{{ ___('common.email') }}</th>
                            <th class="purchase">{{ ___('common.address') }}</th>
                            <th class="purchase">{{ ___('common.status') }}</th>
                            @if (hasPermission('parent_update') || hasPermission('parent_delete'))
                                <th class="action">{{ ___('common.action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @forelse ($data['parents'] as $key => $row)
                            <tr id="row_{{ $row->id }}">
                                <td class="serial">{{ ++$key }}</td>
                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->user->phone }}</td>
                                <td>{{ $row->user->email }}</td>
                                <td>{{ $row->guardian_address }}</td>
                                <td>
                                    @include('backend.admin.components.table.status')
                                </td>
                                @if (hasPermission('parent_update') || hasPermission('parent_delete'))
                                    <td>
                                        @if (hasPermission('parent_update'))
                                            <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="{{ ___('common.edit') }}"
                                                href="{{ route('parent.edit', $row->id) }}"><i
                                                    class="fa-solid fa-pencil"></i></a>
                                        @endif
                                        @if (hasPermission('parent_delete') && $row->code != 'en')
                                            <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="{{ ___('common.delete') }}"
                                                href="javascript:void(0);"
                                                onclick="delete_row('students/parent/delete', {{ $row->id }})"><i
                                                    class="fa-solid fa-trash-can"></i></a>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center gray-color">
                                    <img src="{{ asset('images/no_data.svg') }}" alt="" class="mb-primary"
                                        width="100">
                                    <p class="mb-0 text-center">{{ ___('common.No data available') }}</p>
                                    <p class="mb-0 text-center text-secondary font-size-90">
                                        {{ ___('common.Please add new entity regarding this table') }}</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center gray-color p-5">
                <img src="{{ asset('images/no_data.svg') }}" alt="" class="mb-primary" width="100">
                <p class="mb-0 text-center">{{ ___('common.No data available') }}</p>
                <p class="mb-0 text-center text-secondary font-size-90">
                    {{ ___('common.Please add new entity regarding this table') }}</p>
            </div>
        @endif

    </div>
@endsection

@push('script')
    @include('backend.admin.components.table.js')
    @include('backend.admin.components.table.delete-ajax')
@endpush
