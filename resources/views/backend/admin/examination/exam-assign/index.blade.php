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
                                    <p>{{ $item->title }}</p>
                                    <p>{{ $item->mark }}</p>
                                </div>
                            @endforeach
                        </td>
                        @if (hasPermission('exam_assign_update') || hasPermission('exam_assign_delete'))
                            <td>
                                @if (hasPermission('exam_assign_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.edit') }}"
                                        href="{{ route('exam-assign.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('exam_assign_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('exam-assign/delete', {{ $row->id }})"><i
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
    <script>
        // Start get exam_types
        function getExamtype() {
            var classId = $("#getSections").val();
            var sectionId = $(".sections").val();
            var url = $('#url').val();
            var formData = {
                class: classId,
                section: sectionId,
            }
            $.ajax({
                type: "GET",
                dataType: 'html',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + '/exam-assign/get-exam-type',
                success: function(data) {

                    var exam_type_options = '';
                    var exam_type_li = '';

                    $.each(JSON.parse(data), function(i, item) {
                        exam_type_options += "<option value=" + item.exam_type.id + ">" + item.exam_type
                            .name + "</option>";
                        exam_type_li += "<li data-value=" + item.exam_type.id + " class='option'>" +
                            item.exam_type.name + "</li>";
                    });

                    $("select.exam_types option").not(':first').remove();
                    $("select.exam_types").append(exam_type_options);


                    $("div .exam_types .current").html($("div .exam_types .list li:first").html());
                    $("div .exam_types .list li").not(':first').remove();
                    $("div .exam_types .list").append(exam_type_li);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
        $("#getSections").on('change', function(e) {
            getExamtype();
        });
        $(".sections").on('change', function(e) {
            getExamtype();
        });
        // End get exam_types
    </script>

    <script>
        // Start examination filter get subjects
        $("#getSections").on('change', function(e) {
            getExaminationFilterSubject();
        });
        $(".sections").on('change', function(e) {
            getExaminationFilterSubject();
        });

        function getExaminationFilterSubject() {
            var classId = $("#getSections").val();
            var sectionId = $(".sections").val();

            if (classId && sectionId) {
                var url = $('#url').val();
                var formData = {
                    classes_id: classId,
                    section_id: sectionId,
                }
                $.ajax({
                    type: "GET",
                    dataType: 'html',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url + '/assign-subject/get-subjects',
                    success: function(data) {
                        var subject_options = '';
                        var subject_li = '';

                        $.each(JSON.parse(data), function(i, item) {
                            subject_options += "<option value=" + item.subject.id + ">" + item.subject
                                .name + "</option>";
                            subject_li += "<li data-value=" + item.subject.id + " class='option'>" +
                                item.subject.name + "</li>";
                        });

                        $("select.subjects option").not(':first').remove();
                        $("select.subjects").append(subject_options);


                        $("div .subjects .current").html($("div .subjects .list li:first").html());
                        $("div .subjects .list li").not(':first').remove();
                        $("div .subjects .list").append(subject_li);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        }
        // End examination filter get subjects
    </script>
@endpush
