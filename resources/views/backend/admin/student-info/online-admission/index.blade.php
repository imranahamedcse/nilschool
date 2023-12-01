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

        @if (@$data['students'])
            <div class="card-body">
                <table id="datatable" class="table">

                    <thead class="thead">
                        <tr>
                            <th class="serial">{{ ___('common.sr_no') }}</th>
                            <th class="purchase">{{ ___('student_info.Student Name') }}</th>
                            <th class="purchase">{{ ___('academic.class') }} ({{ ___('academic.section') }})</th>
                            <th class="purchase">{{ ___('student_info.Date Of Birth') }}</th>
                            <th class="purchase">{{ ___('student_info.mobile') }}</th>
                            <th class="purchase">{{ ___('student_info.guardian_name') }}</th>
                            <th class="purchase">{{ ___('student_info.guardian_mobile') }}</th>
                            @if (hasPermission('student_update') || hasPermission('student_delete'))
                                <th class="action">{{ ___('common.action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @forelse ($data['students'] as $key => $row)
                            <tr id="row_{{ $row->id }}">
                                <td class="serial">{{ ++$key }}</td>
                                <td>{{ @$row->first_name }} {{ @$row->last_name }}</td>
                                <td>{{ @$row->class->name }} ({{ @$row->section->name }})</td>
                                <td>{{ dateFormat(@$row->dob) }}</td>
                                <td>{{ @$row->phone }}</td>
                                <td>{{ @$row->guardian_name }}</td>
                                <td>{{ @$row->guardian_phone }}</td>
                                @if (hasPermission('student_update') || hasPermission('student_delete'))
                                    <td>
                                        @if (hasPermission('student_update'))
                                            <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="{{ ___('common.edit') }}"
                                                href="{{ route('online-admissions.edit', $row->id) }}"><i
                                                    class="fa-solid fa-pencil"></i></a>
                                        @endif
                                        @if (hasPermission('student_delete') && $row->code != 'en')
                                            <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="{{ ___('common.delete') }}"
                                                href="javascript:void(0);"
                                                onclick="delete_row('online-admissions/delete', {{ $row->id }})"><i
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
        @else
            @include('backend.admin.components.table.empty')
        @endif

    </div>
@endsection

@push('script')
    @include('backend.admin.components.table.js')
    @include('backend.admin.components.table.delete-ajax')
    <script>
        $("#getSections").on('change', function(e) {
            var classId = $("#getSections").val();
            var url = $('#url').val();
            var formData = {
                id: classId,
            }
            $.ajax({
                type: "GET",
                dataType: 'html',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + '/class-setup/get-sections',
                success: function(data) {
                    var section_options = '';
                    var section_li = '';

                    $.each(JSON.parse(data), function(i, item) {
                        section_options += "<option value=" + item.section.id + ">" + item
                            .section.name + "</option>";
                        section_li += "<li data-value=" + item.section.id + " class='option'>" +
                            item.section.name + "</li>";
                    });

                    $("select.sections option").not(':first').remove();
                    $("select.sections").append(section_options);

                    $("div .sections .current").html($("div .sections .list li:first").html());
                    $("div .sections .list li").not(':first').remove();
                    $("div .sections .list").append(section_li);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endpush
