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
                    <th class="serial">{{ ___('index.sr_no') }}</th>
                    <th class="purchase">{{ ___('index.name') }}</th>
                    <th class="purchase">{{ ___('index.code') }}</th>
                    <th class="purchase">{{ ___('index.type') }}</th>
                    <th class="purchase">{{ ___('index.teacher') }}</th>
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
                                    {{ ___('index.theory') }}
                                @elseif ($row->subject->type == App\Enums\SubjectType::PRACTICAL)
                                    {{ ___('index.practical') }}
                                @endif
                            </td>
                            <td>
                                <a href="">{{ $row->teacher->first_name }} {{ $row->teacher->last_name }}</a>
                                <small>{{ $row->teacher->email }}</small>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="100%" class="text-center gray-color">
                            <img src="{{ asset('images/no_data.svg') }}" alt="" class="mb-primary" width="100">
                            <p class="mb-0 text-center">{{ ___('index.No data available') }}</p>
                            <p class="mb-0 text-center text-secondary font-size-90">
                                {{ ___('index.Please add new entity regarding this table') }}
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
