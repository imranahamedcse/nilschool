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

        @if (@$data['result'])
            <table id="datatable" class="table">
                <thead>
                    <tr>
                        <th>{{ ___('common.#') }}</th>
                        <th>{{ ___('common.name') }}</th>
                        <th>{{ ___('student_info.admission_no') }}</th>
                        <th>{{ ___('academic.class') }} ({{ ___('academic.section') }})</th>
                        <th>{{ ___('report.Fees type') }}</th>
                        <th>{{ ___('report.Amount') }} ({{ Setting('currency_symbol') }})</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['result'] as $key=>$item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->student->first_name }} {{ $item->student->last_name }}</td>
                            <td>{{ $item->student->admission_no }}</td>
                            <td>{{ $item->student->session_class_student->class->name }}
                                ({{ $item->student->session_class_student->section->name }})
                            </td>
                            <td>{{ $item->feesMaster->type->name }}</td>
                            <td>
                                {{ @$item->feesMaster->amount }}

                                @if (date('Y-m-d') > $item->feesMaster->date && $item->fees_collect_count == 0)
                                    <span class="text-danger">+
                                        {{ @$item->feesMaster->fine_amount }}</span>
                                @elseif($item->fees_collect_count == 1 && $item->feesMaster->date < $item->feesCollect->date)
                                    <span class="text-danger">+
                                        {{ @$item->feesMaster->fine_amount }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        @include('backend.admin.components.table.empty')
                    @endforelse
                </tbody>
            </table>
        @endif
    </div>
@endsection

@push('script')
    @include('backend.admin.components.table.js')
    
    <script src="{{ asset('backend/js/get-section.js') }}"></script>
@endpush
