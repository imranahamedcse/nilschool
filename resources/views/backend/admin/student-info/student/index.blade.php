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
                    <th class="purchase">{{ ___('student_info.admission_no') }}</th>
                    <th class="purchase">{{ ___('student_info.roll_no') }}</th>
                    <th class="purchase">{{ ___('student_info.Student Name') }}</th>
                    <th class="purchase">{{ ___('academic.class') }} ({{ ___('academic.section') }})</th>
                    <th class="purchase">{{ ___('student_info.guardian_name') }}</th>
                    <th class="purchase">{{ ___('student_info.Date Of Birth') }}</th>
                    <th class="purchase">{{ ___('common.gender') }}</th>
                    <th class="purchase">{{ ___('student_info.Mobile Number') }}</th>
                    <th class="purchase">{{ ___('common.status') }}</th>
                    @if (hasPermission('student_update') || hasPermission('student_delete'))
                        <th class="action">{{ ___('common.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                {{-- @dd($data['students']) --}}
                @forelse ($data['students'] as $key => $row)
                    <tr id="row_{{ @$row->student->id }}">
                        <td>{{ ++$key }}</td>
                        <td>{{ @$row->student->admission_no }}</td>
                        <td>{{ @$row->roll }}</td>
                        <td>
                            {{ @$row->student->first_name }} {{ @$row->student->last_name }}

                            {{-- <div class="">
                                <a href="{{ route('student.show', @$row->student->id) }}">
                                    <div class="user-card">
                                        <div class="user-avatar">
                                            <img src="{{ @globalAsset(@$row->student->user->upload->path, '40X40.webp') }}"
                                                alt="{{ @$row->student->name }}">
                                        </div>
                                        <div class="user-info">
                                            {{ @$row->student->first_name }} {{ @$row->student->last_name }}
                                        </div>
                                    </div>
                                </a>
                            </div> --}}
                        </td>
                        <td>{{ @$row->class->name }} ({{ @$row->section->name }})</td>
                        <td>{{ @$row->student->parent->guardian_name }}</td>
                        <td>{{ dateFormat(@$row->student->dob) }}</td>
                        <td>{{ @$row->student->gender->name }}</td>
                        <td>{{ @$row->student->mobile }}</td>
                        <td>
                            @if (@$row->student->status == App\Enums\Status::ACTIVE)
                                <span class="badge-basic-success-text">{{ ___('common.active') }}</span>
                            @else
                                <span class="badge-basic-danger-text">{{ ___('common.inactive') }}</span>
                            @endif
                        </td>
                        <td>
                            @if (hasPermission('language_update'))
                                <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ ___('common.edit') }}" href="{{ route('languages.edit', $row->id) }}"><i
                                        class="fa-solid fa-pencil"></i></a>
                            @endif
                            @if (hasPermission('language_delete') && $row->code != 'en')
                                <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ ___('common.delete') }}" href="javascript:void(0);"
                                    onclick="delete_row('student/delete', {{ $row->id }})"><i
                                        class="fa-solid fa-trash-can"></i></a>
                            @endif
                        </td>
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
