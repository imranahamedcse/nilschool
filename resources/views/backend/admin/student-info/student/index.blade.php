@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['headers']['title'] }}
@endsection

@push('style')
    @include('backend.admin.components.table.css')
@endpush

@section('content')
    @include('backend.admin.components.breadcrumb')



    <div class="col-12">
        <form action="{{ route('student.search') }}" method="post" id="marksheed" enctype="multipart/form-data">
            @csrf
            <div class="card ot-card mb-24 position-relative z_1">
                <div class="card-header d-flex align-items-center gap-4 flex-wrap">
                    <h3 class="mb-0">{{ ___('common.Filtering') }}</h3>
                    
                    <div
                        class="card_header_right d-flex align-items-center gap-3 flex-fill justify-content-end flex-wrap">
                        <!-- table_searchBox -->
                        <div class="single_large_selectBox">
                            <select id="getSections" class="class nice-select niceSelect bordered_style wide @error('class') is-invalid @enderror"
                                name="class">
                                <option value="">{{ ___('student_info.select_class') }}</option>
                                @foreach ($data['classes'] as $item)
                                    <option {{ old('class', @$data['request']->class) == $item->class->id ? 'selected' : '' }}
                                        value="{{ $item->class->id }}">{{ $item->class->name }}</option>
                                @endforeach
                            </select>
                            @error('class')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="single_large_selectBox">
                            <select class="sections section nice-select niceSelect bordered_style wide @error('section') is-invalid @enderror"
                                name="section">
                                <option value="">{{ ___('student_info.select_section') }}</option>
                                @foreach ($data['sections'] as $item)
                                    <option {{ old('section', @$data['request']->section) == $item->section->id ? 'selected' : '' }}
                                        value="{{ $item->section->id }}">{{ $item->section->name }}</option>
                                @endforeach
                            </select>
                            @error('section')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="single_large_selectBox">
                            <input class="form-control ot-input"
                                name="keyword" list="datalistOptions" id="exampleDataList"
                                placeholder="{{ ___('student_info.Enter keyword') }}"
                                value="{{ old('keyword', @$data['request']->keyword) }}">
                        </div>

                        <button class="btn btn-lg ot-btn-primary" type="submit">
                            {{___('common.Search')}}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>




    <div class="p-4 rounded-3 bg-white">
        @include('backend.admin.components.table.header')


        <table id="datatable" class="table">
            <thead class="thead">
                <tr>
                    <th class="serial">{{ ___('common.sr_no') }}</th>
                    <th class="purchase">{{ ___('student_info.admission_no') }}</th>
                    <th class="purchase">{{ ___('student_info.roll_no') }}</th>
                    <th class="purchase">{{ ___('student_info.Student Name') }}</th>
                    <th class="purchase">{{ ___('academic.class') }} ({{ ___('academic.section') }})</th>
                    <th class="purchase">{{ ___('student_info.guardian_name') }}</th>
                    <th class="purchase">{{ ___('student_info.Date Of Birth') }}</th>
                    <th class="purchase">{{ ___('common.gender') }}</th>
                    <th class="purchase">{{ ___('student_info.Mobile Number') }}</th>
                    <th class="purchase">{{ ___('common.status') }}</th>
                    @if (hasPermission('student_update') || hasPermission('student_delete'))
                        <th class="action">{{ ___('common.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                {{-- @dd($data['students']) --}}
                @forelse ($data['students'] as $key => $row)
                    <tr id="row_{{ @$row->student->id }}">
                        <td>{{ ++$key }}</td>
                        <td>{{ @$row->student->admission_no }}</td>
                        <td>{{ @$row->roll }}</td>
                        <td>
                            {{ @$row->student->first_name }} {{ @$row->student->last_name }}

                            {{-- <div class="">
                                <a href="{{ route('student.show', @$row->student->id) }}">
                                    <div class="user-card">
                                        <div class="user-avatar">
                                            <img src="{{ @globalAsset(@$row->student->user->upload->path, '40X40.webp') }}"
                                                alt="{{ @$row->student->name }}">
                                        </div>
                                        <div class="user-info">
                                            {{ @$row->student->first_name }} {{ @$row->student->last_name }}
                                        </div>
                                    </div>
                                </a>
                            </div> --}}
                        </td>
                        <td>{{ @$row->class->name }} ({{ @$row->section->name }})</td>
                        <td>{{ @$row->student->parent->guardian_name }}</td>
                        <td>{{ dateFormat(@$row->student->dob) }}</td>
                        <td>{{ @$row->student->gender->name }}</td>
                        <td>{{ @$row->student->mobile }}</td>
                        <td>
                            @if (@$row->student->status == App\Enums\Status::ACTIVE)
                                <span class="badge-basic-success-text">{{ ___('common.active') }}</span>
                            @else
                                <span class="badge-basic-danger-text">{{ ___('common.inactive') }}</span>
                            @endif
                        </td>
                        <td>
                            @if (hasPermission('language_update'))
                                <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ ___('common.edit') }}" href="{{ route('languages.edit', $row->id) }}"><i
                                        class="fa-solid fa-pencil"></i></a>
                            @endif
                            @if (hasPermission('language_delete') && $row->code != 'en')
                                <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="{{ ___('common.delete') }}" href="javascript:void(0);"
                                    onclick="delete_row('student/delete', {{ $row->id }})"><i
                                        class="fa-solid fa-trash-can"></i></a>
                            @endif
                        </td>
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
