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
            <div class="col-3 align-self-center">
                <h4 class="m-0">{{ @$data['headers']['title'] }}</h4>
            </div>
            <div class="col-6">
                <form action="{{ route('marks-register.search') }}" method="post" id="marksheet" class="exam_assign"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <select id="getSections"
                                class="class form-control @error('class') is-invalid @enderror"
                                name="class">
                                <option value="">{{ ___('student_info.select_class') }} </option>
                                @foreach ($data['classes'] as $item)
                                    <option value="{{ $item->class->id }}">{{ $item->class->name }}</option>
                                @endforeach
                            </select>
                            @error('class')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col">
                            <select
                                class="sections section form-control @error('section') is-invalid @enderror"
                                name="section">
                                <option value="">{{ ___('student_info.select_section') }} </option>
                            </select>
                            @error('section')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col">
                            <select
                                class="form-control exam_types @error('exam_type') is-invalid @enderror"
                                name="exam_type">
                                <option value="">{{ ___('examination.select_exam_type') }} </option>
                            </select>
                            @error('exam_type')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col">
                            <select
                                class="subjects form-control @error('subject') is-invalid @enderror"
                                name="subject">
                                <option value="">{{ ___('academic.Select subject') }} </option>

                            </select>
                            @error('subject')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" type="submit">
                                {{ ___('common.Search') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-3 text-end">
                @if (hasPermission(@$data['headers']['permission']))
                    <a class="btn btn-sm btn-secondary" href="{{ route(@$data['headers']['create-route']) }}">
                        <i class="fa-solid fa-plus"></i> {{ ___('common.add') }}
                    </a>
                @endif
            </div>
        </div>


        <table id="datatable" class="table">
            <thead class="thead">
                <tr>
                    <th class="serial">{{ ___('common.sr_no') }}</th>
                    <th class="purchase">{{ ___('examination.exam_type') }}</th>
                    <th class="purchase">{{ ___('academic.class') }} ({{ ___('academic.section') }})</th>
                    <th class="purchase">{{ ___('academic.subject') }}</th>
                    <th class="purchase">{{ ___('examination.student') }} & {{ ___('examination.mark') }}</th>
                    @if (hasPermission('marks_register_update') || hasPermission('marks_register_delete'))
                        <th class="action">{{ ___('common.action') }}</th>
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
                            <a href="#" class="btn btn-sm ot-btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalCustomizeWidth" onclick="viewStudentMark({{ $row->id }})">
                                <span><i class="fa-solid fa-eye"></i> </span>
                            </a>
                        </td>
                        @if (hasPermission('marks_register_update') || hasPermission('marks_register_delete'))
                            <td>
                                @if (hasPermission('marks_register_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.edit') }}"
                                        href="{{ route('marks-register.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('marks_register_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('marks-register/delete', {{ $row->id }})"><i
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
