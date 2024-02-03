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
                        <th>{{ ___('index.#') }}</th>
                        <th>{{ ___('index.name') }}</th>
                        <th>{{ ___('index.admission_no') }}</th>
                        <th>{{ ___('index.class') }} ({{ ___('index.section') }})</th>
                        <th>{{ ___('index.Fees type') }}</th>
                        <th>{{ ___('index.date') }}</th>
                        <th>{{ ___('index.Amount') }} ({{ Setting('currency_symbol') }})</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['result'] as $key=>$item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->student->first_name }} {{ $item->student->last_name }}</td>
                            <td>{{ $item->student->admission_no }}</td>
                            <td>{{ $item->student->session_class_student->class->name }}
                                ({{ $item->student->session_class_student->section->name }})</td>
                            <td>{{ $item->feesMaster->type->name }}</td>
                            <td>{{ dateFormat($item->feesCollect->date) }}</td>
                            <td>{{ $item->feesCollect->amount + $item->feesCollect->fine_amount }}</td>
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
