@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['headers']['title'] }}
@endsection

@push('style')
    @include('backend.admin.components.table.css')
@endpush

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="row">
        <div class="col-12">
            <div class="card ot-card mb-24 position-relative z_1">
                <form action="{{ route('fees-collect-search') }}" enctype="multipart/form-data" method="post"
                    id="fees-collect">
                    @csrf
                    <div class="card-header d-flex align-items-center gap-4 flex-wrap">
                        <h3 class="mb-0">{{ ___('common.Filtering') }}</h3>

                        <div
                            class="card_header_right d-flex align-items-center gap-3 flex-fill justify-content-end flex-wrap">
                            <!-- table_searchBox -->

                            <div class="single_selectBox">
                                <select id="getSections" class="class nice-select niceSelect bordered_style wide"
                                    name="class">
                                    <option value="">{{ ___('student_info.select_class') }}</option>
                                    @foreach ($data['classes'] as $item)
                                        <option {{ old('class') == $item->id ? 'selected' : '' }}
                                            value="{{ $item->class->id }}">{{ $item->class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="single_selectBox">
                                <select class="sections section nice-select niceSelect bordered_style wide" name="section">
                                    <option value="">{{ ___('student_info.select_section') }}</option>
                                </select>
                            </div>
                            <div class="single_selectBox">
                                <select
                                    class="students nice-select niceSelect bordered_style wide @error('student') is-invalid @enderror"
                                    name="student">
                                    <option value="">{{ ___('student_info.Select student') }}</option>
                                </select>
                                @error('student')
                                    <div id="validationServer04Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="input-group table_searchBox">
                                <input name="name" type="text" class="form-control"
                                    placeholder="{{ ___('common.name') }} " aria-label="Search "
                                    aria-describedby="searchIcon">
                                <span class="input-group-text" id="searchIcon">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                            </div>
                            <button class="btn btn-lg ot-btn-primary">
                                {{ ___('common.Search') }}
                            </button>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>

    @isset($data['students'])

        <!--  table content start -->
        <div class="table-content table-basic mt-20">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ $data['title'] }}</h4>

                </div>
                <div class="card-body">

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
                                        <td><a href="{{ route('fees-collect.collect', $item) }}" target="_blank"
                                                class="btn btn-sm ot-btn-primary">{{ ___('fees.Collect') }}</a></td>
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
        </div>
        @endif

    @endsection

    @push('script')
        @include('backend.admin.components.table.js')
        @include('backend.admin.components.table.delete-ajax')
    @endpush
