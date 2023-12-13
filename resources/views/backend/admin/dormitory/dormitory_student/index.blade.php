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
                    <th class="purchase">{{ ___('common.Student') }}</th>
                    <th class="purchase">{{ ___('account.Room No') }}</th>
                    <th class="purchase">{{ ___('account.Seat No') }}</th>
                    <th class="purchase">{{ ___('common.status') }}</th>
                    @if (hasPermission('dormitory_student_update') || hasPermission('dormitory_student_delete'))
                        <th class="action">{{ ___('common.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['dormitory_student'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ $row->student->first_name .' '. $row->student->last_name }}</td>
                        <td>{{ $row->room->room_no }}</td>
                        <td>{{ $row->seat_no }}</td>
                        <td>
                            @include('backend.admin.components.table.status')
                        </td>
                        @if ((hasPermission('dormitory_student_update') || hasPermission('dormitory_student_delete')))
                            <td>
                                @if (hasPermission('dormitory_student_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.edit') }}"
                                        href="{{ route('dormitory-student.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('dormitory_student_delete'))
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('dormitory/student/delete', {{ $row->id }})"><i
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
