@extends('frontend.partials.master')
@section('title')
    {{ ___('frontend.Search Result') }}
@endsection

@section('main')
    <!-- Breadcrumbs start  -->
    @include('frontend.partials.breadcrumb')
    <!-- Breadcrumbs end  -->

    <!-- Contact start  -->
    <div class="container-fluid">
        <div class="page_info">
            <img class="image" src="{{ @globalAsset(@$sections['study_at']->upload->path, '1920X700.webp') }}" alt="">
            <div class="text">
                <h3 class="fw-semibold">{{ ___('frontend.Results') }}</h3>
                <h6>{{ ___('frontend.What is your result? Check it out here.') }}</h6>
            </div>
        </div>

        <div class="page_items container mb-5">
            {{-- <div class="row justify-content-center">

                <div class="col-xl-8">
                    <div class="search_result_print_view mb_30" id="printableArea">
                        <div class="search_result_print_view_header">
                            <div class="search_result_print_view_header_logo">
                                <img height="75" src="{{ @globalAsset(setting('light_logo'), '150X40.svg') }}"
                                    alt="Logo">
                            </div>
                            <div class="search_result_print_view_header_content">
                                <h3>{{ setting('application_name') }}</h3>
                                <p>{{ setting('address') }}</p>
                            </div>
                        </div>
                        <div class="search_result_print_view_body">
                            <ul class="search_result_print_view_body_list">
                                <li><span class="list_title">{{ ___('frontend.Student Name') }} :</span> <span
                                        class="list_text">{{ @$data['classSection']->student->first_name }}
                                        {{ @$data['classSection']->student->last_name }}</span></li>
                                <li><span class="list_title">{{ ___('frontend.Guardian Name') }} :</span> <span
                                        class="list_text">{{ @$data['classSection']->student->parent->guardian_name }}</span>
                                </li>
                                <li><span class="list_title">{{ ___('frontend.DOB') }} :</span> <span
                                        class="list_text">{{ dateFormat(@$data['classSection']->student->dob) }}</span>
                                </li>
                                <li><span class="list_title">{{ ___('frontend.Guardian Phone') }} :</span> <span
                                        class="list_text">{{ @$data['classSection']->student->parent->guardian_mobile }}</span>
                                </li>
                                <li><span class="list_title">{{ ___('frontend.Class(Section)') }} :</span> <span
                                        class="list_text">{{ @$data['classSection']->class->name }}
                                        ({{ @$data['classSection']->section->name }})</span></li>
                                <li><span class="list_title">{{ ___('frontend.Guardian Email') }} :</span> <span
                                        class="list_text">{{ @$data['classSection']->student->parent->guardian_email }}</span>
                                </li>
                                <li><span class="list_title">{{ ___('frontend.Result') }} :</span> <span
                                        class="list_text">{{ @$data['result'] }}</span></li>
                                <li><span class="list_title">{{ ___('frontend.GPA') }} :</span>
                                    <span class="list_text">
                                        @if ($data['result'] == 'Passed')
                                            {{ @$data['gpa'] }}
                                        @else
                                            {{ '0.00' }}
                                        @endif
                                    </span>
                                </li>
                            </ul>
                            <div class="search_result_print_view_body_info_table">
                                <h4>{{ ___('frontend.Grade Sheet') }}</h4>
                                <div class="search_result_print_view_body_info_table_info">
                                    <table class="print_table_wrapper">
                                        <thead>
                                            <tr>
                                                <th class="marked_bg">{{ ___('frontend.Subject Code') }}</th>
                                                <th class="marked_bg">{{ ___('frontend.Subject Name') }}</th>
                                                <th class="marked_bg">{{ ___('frontend.Grade') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (@$data['marks_registers'] as $item)
                                                <tr>
                                                    <td>
                                                        <div class="classBox_wiz">
                                                            <h5>{{ $item->subject->code }}</h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="classBox_wiz">
                                                            <h5>{{ $item->subject->name }}</h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="classBox_wiz">
                                                            @php
                                                                $n = 0;
                                                            @endphp
                                                            @foreach ($item->marksRegisterChilds as $item)
                                                                @php
                                                                    $n += $item->mark;
                                                                @endphp
                                                            @endforeach
                                                            <h5>{{ markGrade($n) }}</h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="search_result_print_view_body_info_table_infoBtn">
                                    <a class="print_btn_1"
                                        href="{{ route('frontend.result.pdf-download', ['id' => @$data['classSection']->student->id, 'type' => $data['request']->exam, 'class' => @$data['classSection']->class->id, 'section' => @$data['classSection']->section->id]) }}">
                                        {{ ___('frontend.PDF Download') }}
                                    </a>
                                    <a class="print_btn_2"
                                        href="{{ route('frontend.result') }}">{{ ___('frontend.Search Again') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> --}}


            <div class="card d-flex justify-content-center align-items-center mb-4 py-4">

                <div id="print" class="border" style="width: 8.27in; height: 11in; padding: 1in;">
                    <table style="width: 100%;">
                        <tr class="top">
                            <td colspan="3">
                                <div style="text-align: center;">
                                    <span
                                        style="font-size: 22px; font-weight: 600; color: #23B7E5;">{{ setting('application_name') }}</span><br>
                                    <span style="font-size: 14px;">{{ setting('address') }}</span> <br><br>
                                    <span
                                        style="font-size: 22px; font-weight: 600; color: #23B7E5;">{{ @$data['headers']['title'] }}</span>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3">
                                <table style="width: 100%; margin-top: 75px;">
                                    <tr>
                                        <td>
                                            <span style="font-size: 18px; font-weight: 600;">Student Info</span><br>
                                            <div style="font-size: 14px;">
                                                {{ @$data['classSection']->student->first_name }}
                                                {{ @$data['classSection']->student->last_name }} <br>
                                                {{ dateFormat(@$data['classSection']->student->dob) }} <br>
                                                {{ @$data['classSection']->class->name }}
                                                ({{ @$data['classSection']->section->name }})
                                            </div>
                                        </td>
                                        <td>
                                            <div style="text-align: right;">
                                                <span style="font-size: 18px; font-weight: 600;">Guardian Info</span><br>
                                                <div style="font-size: 14px;">
                                                    {{ @$data['classSection']->student->parent->guardian_name }} <br>
                                                    {{ @$data['classSection']->student->parent->guardian_mobile }} <br>
                                                    {{ @$data['classSection']->student->parent->guardian_email }}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <table style="width: 100%; margin-top: 25px; font-size: 14px; border-collapse: collapse;">
                                    <tr>
                                        <th style="border: 1px solid #dee2e6; padding: 4px; text-align: left;">
                                            {{ ___('index.Subject Code') }}</th>
                                        <th style="border: 1px solid #dee2e6; padding: 4px; text-align: left;">
                                            {{ ___('index.Subject Name') }}</th>
                                        <th style="border: 1px solid #dee2e6; padding: 4px; text-align: right;">
                                            {{ ___('index.Grade') }}</th>
                                    </tr>



                                    @php
                                        $totalMark = 0;
                                    @endphp
                                    @forelse (@$data['marks_registers'] as $item)
                                        <tr>
                                            <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                {{ $item->subject->code }}
                                            </td>
                                            <td style="border: 1px solid #dee2e6; padding: 3px;">
                                                {{ $item->subject->name }}
                                            </td>
                                            <td style="border: 1px solid #dee2e6; padding: 3px; text-align: right;">
                                                @php
                                                    $n = 0;
                                                @endphp
                                                @foreach ($item->marksRegisterChilds as $item)
                                                    @php
                                                        $n += $item->mark;
                                                    @endphp
                                                @endforeach
                                                @php
                                                    $totalMark += $n;
                                                @endphp
                                                {{ markGrade($n) }}
                                            </td>
                                        </tr>
                                    @empty
                                        @include('backend.admin.components.table.empty')
                                    @endforelse

                                    <tr>
                                        <td></td>
                                        <td style="padding: 3px; text-align: right;">Total mark - </td>
                                        <td
                                            style="border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6; padding: 3px; text-align: right;">
                                            {{ $totalMark }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td style="padding: 3px; text-align: right;">GPA - </td>
                                        <td
                                            style="border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6; padding: 3px; text-align: right;">
                                            @if ($data['result'] == 'Passed')
                                                {{ @$data['gpa'] }}
                                            @else
                                                {{ '0.00' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <th style="padding: 3px; text-align: right;">Result - </th>
                                        <th style="border: 1px solid #dee2e6; padding: 3px; text-align: right;">
                                            {{ @$data['result'] }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td style="border-bottom: 1px solid #dee2e6; padding: 3px; text-align: center;">
                                            <div style="margin-top: 50px;">Signature</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                    </table>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-4">
                    <button class="btn btn-secondary" onclick="printDiv('print')">
                        {{ ___('index.Print') }}
                        <span><i class="fa-solid fa-print"></i></span>
                    </button>
                </div>
            </div>



        </div>
    </div>
    <!-- search_result_area::end  -->
@endsection
