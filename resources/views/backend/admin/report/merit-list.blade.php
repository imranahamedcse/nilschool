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
                        <th>{{ ___('index.#') }}</th>
                        <th>{{ ___('index.Student Name') }}</th>
                        <th>{{ ___('index.admission_no') }}</th>
                        <th>{{ ___('index.class') }} ({{ ___('index.section') }})</th>
                        <th>{{ ___('index.Position') }}</th>
                        <th>{{ ___('index.Result') }}</th>
                        <th>{{ ___('index.Point') }}</th>
                        <th>{{ ___('index.Grade') }}</th>
                        <th>{{ ___('index.Total Mark') }}</th>
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
