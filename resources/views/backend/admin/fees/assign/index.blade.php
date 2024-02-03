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
                    <th class="purchase">{{ ___('index.group') }}</th>
                    <th class="purchase">{{ ___('index.class') }} ({{ ___('index.section') }})</th>
                    <th class="purchase">{{ ___('index.Category') }}</th>
                    <th class="purchase">{{ ___('index.gender') }}</th>
                    <th class="purchase">{{ ___('index.Students List') }}</th>
                    @if (hasPermission('fees_assign_update') || hasPermission('fees_assign_delete'))
                        <th class="action">{{ ___('index.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['fees_assigns'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ @$row->feesGroup->name }}</td>
                        <td>{{ @$row->class->name }} ({{ @$row->section->name }})</td>
                        <td>{{ @$row->category->name }}</td>
                        <td>{{ @$row->gender->name }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalCustomizeWidth" onclick="viewStudentList({{ $row->id }})">
                                <span><i class="fa-solid fa-eye"></i> </span>
                            </a>
                        </td>
                        @if (hasPermission('fees_assign_update') || hasPermission('fees_assign_delete'))
                            <td>
                                @if (hasPermission('fees_assign_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('index.edit') }}"
                                        href="{{ route('fees-assign.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('fees_assign_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('index.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('fees/assign/delete', {{ $row->id }})"><i
                                            class="fa-solid fa-trash-can"></i></a>
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


    <div class="modal fade" id="modalCustomizeWidth" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">

        </div>
    </div>


@endsection

@push('script')
    @include('backend.admin.components.table.js')
    @include('backend.admin.components.table.delete-ajax')

    <script>
        function viewStudentList(id) {
            var url = $('#url').val();
            var formData = {
                id: id,
            }
            $.ajax({
                type: "GET",
                dataType: 'html',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + '/fees/assign/show',
                success: function(data) {
                    // $("#view-modal").append(data);
                    $("#modalCustomizeWidth .modal-dialog").html(data);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
    </script>
@endpush
