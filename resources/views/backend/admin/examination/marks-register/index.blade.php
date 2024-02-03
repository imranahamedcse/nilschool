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
                    <th class="purchase">{{ ___('index.exam_type') }}</th>
                    <th class="purchase">{{ ___('index.class') }} ({{ ___('index.section') }})</th>
                    <th class="purchase">{{ ___('index.subject') }}</th>
                    <th class="purchase">{{ ___('index.student') }} & {{ ___('index.mark') }}</th>
                    @if (hasPermission('marks_register_update') || hasPermission('marks_register_delete'))
                        <th class="action">{{ ___('index.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['marks_registers'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ $row->exam_type->name }}</td>
                        <td>{{ $row->class->name }} ({{ $row->section->name }})</td>
                        <td>{{ $row->subject->name }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalCustomizeWidth" onclick="viewStudentMark({{ $row->id }})">
                                <span><i class="fa-solid fa-eye"></i> </span>
                            </a>
                        </td>
                        @if (hasPermission('marks_register_update') || hasPermission('marks_register_delete'))
                            <td>
                                @if (hasPermission('marks_register_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('index.edit') }}"
                                        href="{{ route('marks-register.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('marks_register_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('index.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('exam/marks-register/delete', {{ $row->id }})"><i
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
