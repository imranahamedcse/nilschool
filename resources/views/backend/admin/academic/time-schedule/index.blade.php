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
                    <th class="purchase">{{ ___('academic.type') }}</th>
                    <th class="purchase">{{ ___('academic.start_time') }}</th>
                    <th class="purchase">{{ ___('academic.end_time') }}</th>
                    <th class="purchase">{{ ___('common.status') }}</th>
                    @if (hasPermission('time_schedule_update') || hasPermission('time_schedule_delete'))
                        <th class="action">{{ ___('common.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['time_schedule'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>
                            @if ($row->type == 1)
                                <span class="badge-basic-success-text">{{ ___('academic.class') }}</span>
                            @else
                                <span class="badge-basic-primary-text">{{ ___('academic.exam') }}</span>
                            @endif
                        </td>
                        {{-- <td>{{ formatTimeAMPM($row->start_time) }}</td>
                        <td>{{ formatTimeAMPM($row->end_time) }}</td> --}}
                        <td>{{ $row->start_time }}</td>
                        <td>{{ $row->end_time }}</td>
                        <td>
                            @if ($row->status == App\Enums\Status::ACTIVE)
                                <span class="badge-basic-success-text">{{ ___('common.active') }}</span>
                            @else
                                <span class="badge-basic-danger-text">{{ ___('common.inactive') }}</span>
                            @endif
                        </td>
                        @if (hasPermission('time_schedule_update') || hasPermission('time_schedule_delete'))
                            <td>
                                @if (hasPermission('time_schedule_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.edit') }}"
                                        href="{{ route('time_schedule.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('time_schedule_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('academic/time/schedule/delete', {{ $row->id }})"><i
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
