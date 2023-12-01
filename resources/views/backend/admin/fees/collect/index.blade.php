@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['headers']['title'] }}
@endsection

@push('style')
    @include('backend.admin.components.table.css')
@endpush

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card">
        <div class="card-body">
            
            @include('backend.admin.components.table.header')            

            @isset($data['students'])

                <table id="datatable" class="table">
                    <thead class="thead">
                        <tr>
                            <th class="purchase">{{ ___('student_info.Student Name') }}</th>
                            <th class="purchase">{{ ___('student_info.admission_no') }}</th>
                            <th class="purchase">{{ ___('academic.class') }} ({{ ___('academic.section') }})</th>
                            <th class="purchase">{{ ___('student_info.guardian_name') }}</th>
                            <th class="purchase">{{ ___('student_info.Mobile Number') }}</th>
                            @if (hasPermission('fees_collect_create'))
                                <th class="purchase">{{ ___('common.action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data['students'] as $item)
                            <tr id="document-file">
                                <td>{{ @$item->student->first_name }} {{ @$item->student->last_name }}</td>
                                <td>{{ @$item->student->admission_no }}</td>
                                <td>{{ @$item->class->name }} ({{ @$item->section->name }})</td>
                                <td>{{ @$item->student->parent->guardian_name }}</td>
                                <td>{{ @$item->student->mobile }}</td>
                                @if (hasPermission('fees_collect_create'))
                                    <td>
                                        <a href="{{ route('fees-collect.collect', $item) }}" target="_blank"
                                            class="btn btn-sm btn-info">{{ ___('fees.Details') }}
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            @include('backend.admin.components.table.empty')
                        @endforelse
                    </tbody>
                </table>
                @endif
            </div>
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
