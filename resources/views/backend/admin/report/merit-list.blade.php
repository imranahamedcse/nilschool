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
        
        @if ($data['resultData'])
            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th>{{ ___('common.#') }}</th>
                        <th>{{ ___('student_info.Student Name') }}</th>
                        <th>{{ ___('student_info.admission_no') }}</th>
                        <th>{{ ___('academic.class') }} ({{ ___('academic.section') }})</th>
                        <th>{{ ___('report.Position') }}</th>
                        <th>{{ ___('report.Result') }}</th>
                        <th>{{ ___('report.Point') }}</th>
                        <th>{{ ___('report.Grade') }}</th>
                        <th>{{ ___('report.Total Mark') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['resultData'] as $key=>$item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ @$item->student->first_name }} {{ @$item->student->last_name }}</td>
                            <td>{{ @$item->student->admission_no }}</td>
                            <td>{{ @$item->student->session_class_student->class->name }}
                                ({{ @$item->student->session_class_student->section->name }})
                            </td>
                            <td>{{ @$key }}</td>
                            <td>{{ @$item->result }}</td>
                            <td>{{ @$item->grade_point }}</td>
                            <td>{{ @$item->grade_name }}</td>
                            <td>{{ @$item->total_marks }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="td-text-center">
                                @include('backend.includes.no-data')
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif
    </div>
@endsection

@push('script')
    @include('backend.admin.components.table.js')
    
    <script src="{{ asset('backend/js/get-section.js') }}"></script>
    <script src="{{ asset('backend/js/get-exam-type.js') }}"></script>
@endpush
