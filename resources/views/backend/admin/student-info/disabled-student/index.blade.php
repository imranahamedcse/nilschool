@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['title'] }}
@endsection

@push('style')
    @include('backend.admin.components.table.css')
@endpush

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="p-4 rounded-3 bg-white">

        @include('backend.admin.components.table.header')

        <div class="card-body">


            <table id="datatable" class="table">
                <thead class="thead">
                    <tr>
                        <th class="serial">{{ ___('common.sr_no') }}</th>
                        <th class="purchase">{{ ___('common.admission_no') }}</th>
                        <th class="purchase">{{ ___('common.Student Name') }}</th>
                        <th class="purchase">{{ ___('common.class') }} ({{ ___('common.section') }})</th>
                        <th class="purchase">{{ ___('common.guardian_name') }}</th>
                        <th class="purchase">{{ ___('common.Date Of Birth') }}</th>
                        <th class="purchase">{{ ___('common.gender') }}</th>
                        <th class="purchase">{{ ___('common.Mobile Number') }}</th>
                        <th class="purchase">{{ ___('common.status') }}</th>
                        @if (hasPermission('disabled_students_update') || hasPermission('disabled_students_delete'))
                            <th class="action">{{ ___('common.action') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="tbody">
                    @forelse ($students as $key => $item)
                        <tr id="row_{{ @$item->student->id }}">
                            <td class="serial">{{ ++$key }}</td>
                            <td class="serial">{{ @$item->student->admission_no }}</td>
                            <td>
                                {{ @$item->student->first_name }} {{ @$item->student->last_name }}
                                {{-- <div class="">
                                            <a href="{{ route('student.show', @$item->student->id) }}">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <img src="{{ @globalAsset(@$item->student->user->upload->path) }}"
                                                            alt="{{ @$item->student->name }}">
                                                    </div>
                                                    <div class="user-info">
                                                        {{ @$item->student->first_name }}
                                                        {{ @$item->student->last_name }}
                                                    </div>
                                                </div>
                                            </a>
                                        </div> --}}
                            </td>
                            <td>{{ @$item->student->session_class_student->class->name }}
                                ({{ @$item->student->session_class_student->section->name }})
                            </td>
                            <td>{{ @$item->student->parent->guardian_name }}</td>
                            <td>{{ dateFormat(@$item->student->dob) }}</td>
                            <td>{{ @$item->student->gender->name }}</td>
                            <td>{{ @$item->student->mobile }}</td>
                            <td>
                                @if (@$item->student->status == App\Enums\Status::ACTIVE)
                                    <span class="btn btn-sm btn-success">{{ ___('common.active') }}</span>
                                @else
                                    <span class="btn btn-sm btn-danger">{{ ___('common.inactive') }}</span>
                                @endif
                            </td>
                            @if (hasPermission('disabled_students_update'))
                                <td class="action">
                                    <div class="dropdown dropdown-action">
                                        <button type="button" class="btn-dropdown" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end ">
                                            @if (hasPermission('disabled_students_update'))
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('student.edit', @$item->student->id) }}"><span
                                                            class="icon mr-8"><i
                                                                class="fa-solid fa-pen-to-square"></i></span>
                                                        {{ ___('common.edit') }}</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center gray-color">
                                <img src="{{ asset('images/no_data.svg') }}" alt="" class="mb-primary"
                                    width="100">
                                <p class="mb-0 text-center">{{ ___('common.No data available') }}</p>
                                <p class="mb-0 text-center text-secondary font-size-90">
                                    {{ ___('common.Please add new entity regarding this table') }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>

@endsection

@push('script')
    @include('backend.admin.components.table.js')
    <script src="{{ asset('backend/js/get-section.js') }}"></script>
@endpush
