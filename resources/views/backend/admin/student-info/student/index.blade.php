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
                    <th class="purchase">{{ ___('index.admission_no') }}</th>
                    <th class="purchase">{{ ___('index.roll_no') }}</th>
                    <th class="purchase">{{ ___('index.Student Name') }}</th>
                    <th class="purchase">{{ ___('index.class') }} ({{ ___('index.section') }})</th>
                    <th class="purchase">{{ ___('index.guardian_name') }}</th>
                    <th class="purchase">{{ ___('index.Date Of Birth') }}</th>
                    <th class="purchase">{{ ___('index.gender') }}</th>
                    <th class="purchase">{{ ___('index.Mobile Number') }}</th>
                    <th class="purchase">{{ ___('index.status') }}</th>
                    @if (hasPermission('student_update') || hasPermission('student_delete'))
                        <th class="action">{{ ___('index.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
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
                                <span class="badge-basic-success-text">{{ ___('index.active') }}</span>
                            @else
                                <span class="badge-basic-danger-text">{{ ___('index.inactive') }}</span>
                            @endif
                        </td>
                        @if (hasPermission('student_update') || hasPermission('student_delete'))
                        <td>
                            @if (hasPermission('student_update'))
                                <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ ___('index.edit') }}" href="{{ route('student.edit', $row->id) }}"><i
                                        class="fa-solid fa-pencil"></i></a>
                            @endif
                            @if (hasPermission('student_delete') && $row->code != 'en')
                                <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ ___('index.delete') }}" href="javascript:void(0);"
                                    onclick="delete_row('students/list/delete', {{ $row->id }})"><i
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
@endpush
