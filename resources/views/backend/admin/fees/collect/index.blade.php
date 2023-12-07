@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['headers']['title'] }}
@endsection

@push('style')
    @include('backend.admin.components.table.css')
@endpush

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card">
        <div class="card-body">
            
            @include('backend.admin.components.table.header')            

            @isset($data['students'])

                <table id="datatable" class="table">
                    <thead class="thead">
                        <tr>
                            <th class="purchase">{{ ___('student_info.Student Name') }}</th>
                            <th class="purchase">{{ ___('student_info.admission_no') }}</th>
                            <th class="purchase">{{ ___('academic.class') }} ({{ ___('academic.section') }})</th>
                            <th class="purchase">{{ ___('student_info.guardian_name') }}</th>
                            <th class="purchase">{{ ___('student_info.Mobile Number') }}</th>
                            @if (hasPermission('fees_collect_create'))
                                <th class="purchase">{{ ___('common.action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data['students'] as $item)
                            <tr id="document-file">
                                <td>{{ @$item->student->first_name }} {{ @$item->student->last_name }}</td>
                                <td>{{ @$item->student->admission_no }}</td>
                                <td>{{ @$item->class->name }} ({{ @$item->section->name }})</td>
                                <td>{{ @$item->student->parent->guardian_name }}</td>
                                <td>{{ @$item->student->mobile }}</td>
                                @if (hasPermission('fees_collect_create'))
                                    <td>
                                        <a href="{{ route('fees-collect.collect', $item) }}" target="_blank"
                                            class="btn btn-sm btn-info">{{ ___('fees.Details') }}
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            @include('backend.admin.components.table.empty')
                        @endforelse
                    </tbody>
                </table>
                @endif
            </div>
        </div>

    @endsection

    @push('script')
        @include('backend.admin.components.table.js')
        @include('backend.admin.components.table.delete-ajax')

        <script src="{{ asset('backend/js/get-section.js') }}"></script>
    @endpush
