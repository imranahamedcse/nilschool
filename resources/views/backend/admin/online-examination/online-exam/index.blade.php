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
                <form action="{{ route('online-exam.search') }}" method="post" id="marksheet" class="exam_assign"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center align-items-center">
                        <div class="input-group">
                            <div>
                                <select id="getSections"
                                    class="class form-control @error('class') is-invalid @enderror"
                                    name="class">
                                    <option value="">{{ ___('student_info.select_class') }} </option>
                                    @foreach ($data['classes'] as $item)
                                        <option value="{{ $item->class->id }}"
                                            {{ old('class', @$data['request']->class) == $item->class->id ? 'selected' : '' }}>
                                            {{ $item->class->name }}</option>
                                    @endforeach
                                </select>
                                @error('class')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <select id="section"
                                    class="sections section form-control @error('section') is-invalid @enderror"
                                    name="section">
                                    <option value="">{{ ___('student_info.select_section') }} </option>
                                    @foreach ($data['sections'] as $item)
                                        <option value="{{ $item->section->id }}"
                                            {{ old('section', @$data['request']->section) == $item->section->id ? 'selected' : '' }}>
                                            {{ $item->section->name }}</option>
                                    @endforeach
                                </select>
                                @error('section')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <select
                                    class="subjects form-control @error('subject') is-invalid @enderror"
                                    name="subject">
                                    <option value="">{{ ___('online-examination.Select subject') }} </option>
                                    @foreach ($data['subjects'] as $item)
                                        <option value="{{ $item->subject->id }}"
                                            {{ old('subject', @$data['request']->subject) == $item->subject->id ? 'selected' : '' }}>
                                            {{ $item->subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('subject')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <input class="form-control" name="keyword" list="datalistOptions" id="exampleDataList"
                                placeholder="{{ ___('online-examination.Search Exam / Start') }}"
                                value="{{ old('keyword', @$data['request']->keyword) }}">

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

                    <th class="purchase">{{ ___('examination.class') }} ({{ ___('examination.section') }})</th>
                    <th class="purchase">{{ ___('examination.subject') }}</th>

                    <th class="purchase">{{ ___('common.name') }}</th>
                    <th class="purchase">{{ ___('online-examination.Type') }}</th>
                    <th class="purchase">{{ ___('online-examination.Total Mark') }}</th>
                    <th class="purchase">{{ ___('online-examination.Exam Start') }}</th>
                    <th class="purchase">{{ ___('online-examination.Exam End') }}</th>
                    <th class="purchase">{{ ___('online-examination.Duration') }}</th>
                    <th class="purchase">{{ ___('online-examination.Exam Published') }}</th>

                    <th class="purchase">{{ ___('common.status') }}</th>
                    @if (hasPermission('online_exam_update') || hasPermission('online_exam_delete'))
                        <th class="action">{{ ___('common.action') }}</th>
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
                            @if ($row->status == App\Enums\Status::ACTIVE)
                                <span class="badge-basic-success-text">{{ ___('common.active') }}</span>
                            @else
                                <span class="badge-basic-danger-text">{{ ___('common.inactive') }}</span>
                            @endif
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
                                                {{ ___('online-examination.Download Questions') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#modalCustomizeWidth"
                                                onclick="viewQuestions({{ $row->id }})">
                                                <span class="icon mr-8"><i class="fa-solid fa-eye"></i></span>
                                                {{ ___('online-examination.View Questions') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#modalCustomizeWidth"
                                                onclick="viewStudents({{ $row->id }})">
                                                <span class="icon mr-8"><i class="fa-solid fa-eye"></i></span>
                                                {{ ___('online-examination.View Students') }}
                                            </a>
                                        </li>

                                        @if (hasPermission('online_exam_update'))
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('online-exam.edit', $row->id) }}"><span
                                                        class="icon mr-8"><i class="fa-solid fa-pen-to-square"></i></span>
                                                    {{ ___('common.edit') }}</a>
                                            </li>
                                        @endif
                                        @if (hasPermission('online_exam_delete'))
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    onclick="delete_row('online-exam/delete', {{ $row->id }})">
                                                    <span class="icon mr-8"><i class="fa-solid fa-trash-can"></i></span>
                                                    <span>{{ ___('common.delete') }}</span>
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
@endpush
