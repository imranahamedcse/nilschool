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
                    <th class="purchase">{{ ___('index.Student') }}</th>
                    <th class="purchase">{{ ___('index.Route') }}</th>
                    <th class="purchase">{{ ___('index.Vehicle') }}</th>
                    <th class="purchase">{{ ___('index.PickupPoint') }}</th>
                    <th class="purchase">{{ ___('index.status') }}</th>
                    @if (hasPermission('transport_student_update') || hasPermission('transport_student_delete'))
                        <th class="action">{{ ___('index.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['transport_student'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ $row->student->first_name .' '. $row->student->last_name }}</td>
                        <td>{{ $row->route->name }}</td>
                        <td>{{ $row->vehicle->name }}</td>
                        <td>{{ $row->pickupPoint->name }}</td>
                        <td>
                            @include('backend.admin.components.table.status')
                        </td>
                        @if ((hasPermission('transport_student_update') || hasPermission('transport_student_delete')))
                            <td>
                                @if (hasPermission('transport_student_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('index.edit') }}"
                                        href="{{ route('transport-student.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('transport_student_delete'))
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('index.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('transport/student/delete', {{ $row->id }})"><i
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
