@extends('backend.student.partials.master')

@section('title')
    {{ $data['headers']['title'] }}
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
                    <th class="purchase">{{ ___('common.name') }}</th>
                    <th class="purchase">{{ ___('academic.code') }}</th>
                    <th class="purchase">{{ ___('academic.type') }}</th>
                    <th class="purchase">{{ ___('academic.teacher') }}</th>
                </tr>
            </thead>
            <tbody class="tbody">
                @if ($subjectTeacher)
                    @foreach ($subjectTeacher->subjectTeacher as $key => $row)
                        <tr id="row_{{ $row->id }}">
                            <td class="serial">{{ ++$key }}</td>
                            <td>{{ $row->subject->name }}</td>
                            <td>{{ $row->subject->code }}</td>
                            <td>
                                @if ($row->subject->type == App\Enums\SubjectType::THEORY)
                                    {{ ___('academic.theory') }}
                                @elseif ($row->subject->type == App\Enums\SubjectType::PRACTICAL)
                                    {{ ___('academic.practical') }}
                                @endif
                            </td>
                            <td><a href="">{{ $row->teacher->first_name }} {{ $row->teacher->last_name }}</a>
                                <small>{{ $row->teacher->email }}</small></td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="100%" class="text-center gray-color">
                            <img src="{{ asset('images/no_data.svg') }}" alt="" class="mb-primary" width="100">
                            <p class="mb-0 text-center">{{ ___('common.No data available') }}</p>
                            <p class="mb-0 text-center text-secondary font-size-90">
                                {{ ___('common.Please add new entity regarding this table') }}
                            </p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection

@push('script')
    @include('backend.admin.components.table.js')
@endpush
