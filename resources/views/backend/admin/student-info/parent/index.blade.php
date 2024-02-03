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


        <div class="card-body">
            <table id="datatable" class="table">
                <thead class="thead">
                    <tr>
                        <th class="serial">{{ ___('index.sr_no') }}</th>
                        <th class="purchase">{{ ___('index.name') }}</th>
                        <th class="purchase">{{ ___('index.phone') }}</th>
                        <th class="purchase">{{ ___('index.email') }}</th>
                        <th class="purchase">{{ ___('index.address') }}</th>
                        <th class="purchase">{{ ___('index.status') }}</th>
                        @if (hasPermission('parent_update') || hasPermission('parent_delete'))
                            <th class="action">{{ ___('index.action') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="tbody">
                    @forelse ($data['parents'] as $key => $row)
                        <tr id="row_{{ $row->id }}">
                            <td class="serial">{{ ++$key }}</td>
                            <td>{{ @$row->student->parent->guardian_name }}</td>
                            <td>{{ @$row->student->parent->guardian_mobile }}</td>
                            <td>{{ @$row->student->parent->guardian_email }}</td>
                            <td>{{ @$row->student->parent->guardian_address }}</td>
                            <td>
                                @if (@$row->student->parent->status == App\Enums\Status::ACTIVE)
                                    <span class="btn btn-sm btn-success">{{ ___('index.active') }}</span>
                                @else
                                    <span class="btn btn-sm btn-danger">{{ ___('index.inactive') }}</span>
                                @endif
                            </td>
                            @if (hasPermission('parent_update') || hasPermission('parent_delete'))
                                <td>
                                    @if (hasPermission('parent_update'))
                                        <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="{{ ___('index.edit') }}"
                                            href="{{ route('parent.edit', @$row->student->parent_guardian_id) }}"><i
                                                class="fa-solid fa-pencil"></i></a>
                                    @endif
                                    @if (hasPermission('parent_delete') && $row->code != 'en')
                                        <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="{{ ___('index.delete') }}"
                                            href="javascript:void(0);"
                                            onclick="delete_row('students/parent/delete', {{ @$row->student->parent_guardian_id }})"><i
                                                class="fa-solid fa-trash-can"></i></a>
                                    @endif

                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="{{ ___('index.Add Student') }}"
                                    href="{{ route('parent.add-student', @$row->student->parent_guardian_id) }}"><i
                                        class="fa-solid fa-plus"></i></a>

                                </td>
                            @endif
                        </tr>
                    @empty
                        @include('backend.admin.components.table.empty')
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection

@push('script')
    @include('backend.admin.components.table.js')
    @include('backend.admin.components.table.delete-ajax')
    <script src="{{ asset('backend/js/get-section.js') }}"></script>
@endpush
