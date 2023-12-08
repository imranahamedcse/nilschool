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
                    <th class="purchase">{{ ___('examination.exam_title') }}</th>
                    <th class="purchase">{{ ___('examination.class') }} ({{ ___('examination.section') }})</th>
                    <th class="purchase">{{ ___('examination.subjects') }}</th>
                    <th class="purchase">{{ ___('examination.total_mark') }}</th>
                    <th class="purchase">{{ ___('examination.mark_distribution') }}</th>
                    @if (hasPermission('exam_assign_update') || hasPermission('exam_assign_delete'))
                        <th class="action">{{ ___('common.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['exam_assigns'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ @$row->exam_type->name }}</td>
                        <td>{{ @$row->class->name }} ({{ @$row->section->name }})</td>
                        <td>{{ @$row->subject->name }}</td>
                        <td>{{ @$row->total_mark }}</td>
                        <td>
                            @foreach (@$row->mark_distribution as $item)
                                <div class="d-flex align-items-center justify-content-between mt-0">
                                    <p>{{ $item->title }}</p>
                                    <p>{{ $item->mark }}</p>
                                </div>
                            @endforeach
                        </td>
                        @if (hasPermission('exam_assign_update') || hasPermission('exam_assign_delete'))
                            <td>
                                @if (hasPermission('exam_assign_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.edit') }}"
                                        href="{{ route('exam-assign.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('exam_assign_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('exam/assign/delete', {{ $row->id }})"><i
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
    
    <script src="{{ asset('backend/js/get-section.js') }}"></script>
    <script src="{{ asset('backend/js/get-subject.js') }}"></script>
    <script src="{{ asset('backend/js/get-exam-type.js') }}"></script>

@endpush
