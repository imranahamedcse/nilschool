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
                    <th class="serial">{{ ___('common.sr_no.') }}</th>
                    <th class="purchase">{{ ___('staff.staff_id') }}</th>
                    <th class="purchase">{{ ___('common.name') }}</th>
                    <th class="purchase">{{ ___('common.roles') }}</th>
                    <th class="purchase">{{ ___('staff.departments') }}</th>
                    <th class="purchase">{{ ___('common.designation') }}</th>
                    <th class="purchase">{{ ___('common.email') }}</th>
                    <th class="purchase">{{ ___('common.phone') }}</th>
                    <th class="purchase">{{ ___('common.status') }}</th>
                    @if (hasPermission('user_update') || hasPermission('user_delete'))
                        <th class="action">{{ ___('common.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['users'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td class="serial">{{ $row->staff_id }}</td>
                        <td>
                            {{ $row->first_name }} {{ $row->last_name }}
                            {{-- <div class="">
                                <a href="{{ route('users.show', $row->id) }}">
                                    <div class="user-card">
                                        <div class="user-avatar">
                                            <img src="{{ @globalAsset($row->upload['path'], '40X40.webp') }}"
                                                alt="{{ $row->name }}">
                                        </div>
                                        <div class="user-info">
                                            {{ $row->first_name }} {{ $row->last_name }}
                                        </div>
                                    </div>
                                </a>
                            </div> --}}
                        </td>
                        <td>{{ $row->role->name }}</td>
                        <td>{{ $row->department->name }}</td>
                        <td>{{ $row->designation->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>
                            @if ($row->status == App\Enums\Status::ACTIVE)
                                <span class="badge-basic-success-text">{{ ___('common.active') }}</span>
                            @else
                                <span class="badge-basic-danger-text">{{ ___('common.inactive') }}</span>
                            @endif
                        </td>
                        @if (hasPermission('user_update') || hasPermission('user_delete'))
                            <td>
                                @if (hasPermission('user_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.edit') }}" href="{{ route('users.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('user_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('users/delete', {{ $row->id }})"><i
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
