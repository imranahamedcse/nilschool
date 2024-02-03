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

                    <th class="purchase">{{ ___('index.class') }} ({{ ___('index.section') }})</th>
                    <th class="purchase">{{ ___('index.subject') }}</th>

                    <th class="purchase">{{ ___('index.name') }}</th>
                    <th class="purchase">{{ ___('index.Type') }}</th>
                    <th class="purchase">{{ ___('index.Total Mark') }}</th>
                    <th class="purchase">{{ ___('index.Exam Start') }}</th>
                    <th class="purchase">{{ ___('index.Exam End') }}</th>
                    <th class="purchase">{{ ___('index.Duration') }}</th>
                    <th class="purchase">{{ ___('index.Exam Published') }}</th>

                    <th class="purchase">{{ ___('index.status') }}</th>
                    @if (hasPermission('online_exam_update') || hasPermission('online_exam_delete'))
                        <th class="action">{{ ___('index.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['online_exam'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>

                        <td>{{ @$row->class->name }} ({{ @$row->section->name }})</td>
                        <td>{{ @$row->subject->name }}</td>

                        <td>{{ @$row->name }}</td>
                        <td>{{ @$row->type->name }}</td>
                        <td>{{ @$row->total_mark }}</td>
                        <td>{{ date('d-m-Y H:i a', strtotime(@$row->start)) }}</td>
                        <td>{{ date('d-m-Y H:i a', strtotime(@$row->end)) }}</td>
                        <td>
                            <?php
                            $startDate = new DateTime($row->start);
                            $endDate = new DateTime($row->end);
                            $interval = date_diff($startDate, $endDate);
                            echo $interval->format('%d Day %h Hour %i Minute');
                            ?>
                        </td>
                        <td>{{ date('d-m-Y H:i a', strtotime(@$row->published)) }}</td>

                        <td>
                            @include('backend.admin.components.table.status')
                        </td>
                        @if (hasPermission('online_exam_update') || hasPermission('online_exam_delete'))
                            <td class="action">
                                <div class="dropdown dropdown-action">
                                    <button type="button" class="btn btn-sm btn-secondary btn-dropdown"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end ">

                                        <li>
                                            <a href="{{ route('online-exam.question-download', $row->id) }}"
                                                class="dropdown-item">
                                                <span class="icon mr-8"><i class="fa-solid fa-download"></i></span>
                                                {{ ___('index.Download Questions') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#modalCustomizeWidth"
                                                onclick="viewQuestions({{ $row->id }})">
                                                <span class="icon mr-8"><i class="fa-solid fa-eye"></i></span>
                                                {{ ___('index.View Questions') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#modalCustomizeWidth"
                                                onclick="viewStudents({{ $row->id }})">
                                                <span class="icon mr-8"><i class="fa-solid fa-eye"></i></span>
                                                {{ ___('index.View Students') }}
                                            </a>
                                        </li>

                                        @if (hasPermission('online_exam_update'))
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('online-exam.edit', $row->id) }}"><span
                                                        class="icon mr-8"><i class="fa-solid fa-pen-to-square"></i></span>
                                                    {{ ___('index.edit') }}</a>
                                            </li>
                                        @endif
                                        @if (hasPermission('online_exam_delete'))
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    onclick="delete_row('online-exam/list/delete', {{ $row->id }})">
                                                    <span class="icon mr-8"><i class="fa-solid fa-trash-can"></i></span>
                                                    <span>{{ ___('index.delete') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
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
    <script src="{{ asset('backend/js/get-subject.js') }}"></script>

@endpush
