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
        <div class="row justify-content-between border-bottom pb-4 mb-4">
            <div class="col align-self-center">
                <h4 class="m-0">{{ @$data['title'] }}</h4>
            </div>
            <div class="col">
                <form action="{{ route('online-admissions.search') }}" method="post" id="marksheed"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col">
                            <select id="getSections" class="form-control @error('class') is-invalid @enderror"
                                name="class">
                                <option value="">{{ ___('student_info.select_class') }}</option>
                                @foreach ($data['classes'] as $item)
                                    <option
                                        {{ old('class', @$data['request']->class) == $item->class->id ? 'selected' : '' }}
                                        value="{{ $item->class->id }}">{{ $item->class->name }}</option>
                                @endforeach
                            </select>
                            @error('class')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col">
                            <select class="sections form-control @error('section') is-invalid @enderror" name="section">
                                <option value="">{{ ___('student_info.select_section') }}</option>
                                @foreach ($data['sections'] as $item)
                                    <option
                                        {{ old('section', @$data['request']->section) == $item->section->id ? 'selected' : '' }}
                                        value="{{ $item->section->id }}">{{ $item->section->name }}</option>
                                @endforeach
                            </select>
                            @error('section')
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" type="submit">
                                {{ ___('common.Search') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col text-end">
            </div>
        </div>







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

                    $.each(JSON.parse(data), function(i, item) {
                        section_options += "<option value=" + item.section.id + ">" + item
                            .section.name + "</option>";
                    });

                    $("select.sections option").not(':first').remove();
                    $("select.sections").append(section_options);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endpush
