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
            <form action="{{ route('exam-assign.search') }}" method="post" id="marksheet" class="exam_assign" enctype="multipart/form-data">
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
                                    <option value="">{{ ___('student_info.select_class') }} </option>
                                    @foreach ($data['classes'] as $item)
                                        <option value="{{ $item->class->id }}">{{ $item->class->name }}</option>
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
                                    <option value="">{{ ___('student_info.select_section') }} </option>
                                </select>
                                @error('section')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="single_large_selectBox">
                                <select
                                    class="nice-select niceSelect bordered_style wide exam_types @error('exam_type') is-invalid @enderror"
                                    name="exam_type">
                                    <option value="">{{ ___('examination.select_exam_type') }} </option>
                                </select>
                                @error('exam_type')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="single_large_selectBox">
                                <select class="subjects nice-select niceSelect bordered_style wide @error('subject') is-invalid @enderror"
                                    name="subject">
                                    <option value="">{{ ___('academic.Select subject') }} </option>
                                    
                                </select>
                                @error('subject')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                    <th class="purchase">{{ ___('examination.exam_title') }}</th>
                                    <th class="purchase">{{ ___('examination.class') }} ({{ ___('examination.section') }})</th>
                                    <th class="purchase">{{ ___('examination.subjects') }}</th>
                                    <th class="purchase">{{ ___('examination.total_mark') }}</th>
                                    <th class="purchase">{{ ___('examination.mark_distribution') }}</th>
                                    @if (hasPermission('exam_assign_update') || hasPermission('exam_assign_delete'))
                                        <th class="action">{{ ___('common.action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                @forelse ($data['exam_assigns'] as $key => $row)
                                <tr id="row_{{ $row->id }}">
                                    <td class="serial">{{ ++$key }}</td>
                                    <td>{{ @$row->exam_type->name }}</td>
                                    <td>{{ @$row->class->name }} ({{ @$row->section->name }})</td>
                                    <td>{{ @$row->subject->name }}</td>
                                    <td>{{ @$row->total_mark }}</td>
                                    <td>
                                        @foreach (@$row->mark_distribution as $item)
                                            <div class="d-flex align-items-center justify-content-between mt-0">
                                                <p>{{$item->title}}</p>
                                                <p>{{$item->mark}}</p>
                                            </div>
                                        @endforeach    
                                    </td>
                                    @if (hasPermission('exam_assign_update') || hasPermission('exam_assign_delete'))
                                    <td>
                                        @if (hasPermission('exam_assign_update'))
                                            <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ ___('common.edit') }}"
                                                href="{{ route('exam-assign.edit', $row->id) }}"><i class="fa-solid fa-pencil"></i></a>
                                        @endif
                                        @if (hasPermission('exam_assign_delete') && $row->code != 'en')
                                            <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ ___('common.delete') }}" 
                                            href="javascript:void(0);" onclick="delete_row('exam-assign/delete', {{ $row->id }})"><i class="fa-solid fa-trash-can"></i></a>
                                        @endif
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