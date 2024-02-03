@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['headers']['title'] }}
@endsection

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="p-4 rounded-3 bg-white">
        @include('backend.admin.components.table.header')

        @if (@$data['resultData'])
            <div class="d-flex justify-content-center align-items-center mb-3">

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
                                                {{ @$data['student']->first_name }} {{ @$data['student']->last_name }} <br>
                                                {{ dateFormat(@$data['student']->dob) }} <br>
                                                {{ @$data['student']->session_class_student->class->name }}
                                                ({{ @$data['student']->session_class_student->section->name }})
                                            </div>
                                        </td>
                                        <td>
                                            <div style="text-align: right;">
                                                <span style="font-size: 18px; font-weight: 600;">Guardian Info</span><br>
                                                <div style="font-size: 14px;">
                                                    {{ @$data['student']->parent->guardian_name }} <br>
                                                    {{ @$data['student']->parent->guardian_mobile }} <br>
                                                    {{ @$data['student']->parent->guardian_email }}
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
                                    @forelse (@$data['resultData']['marks_registers'] as $item)
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
                                            @if ($data['resultData']['result'] == 'Passed')
                                                {{ @$data['resultData']['gpa'] }}
                                            @else
                                                {{ '0.00' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <th style="padding: 3px; text-align: right;">Result - </th>
                                        <th style="border: 1px solid #dee2e6; padding: 3px; text-align: right;">
                                            {{ @$data['resultData']['result'] }}
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
            </div>

            <div class="d-flex justify-content-center align-items-center">
                <button class="btn btn-secondary" onclick="printDiv('print')">
                    {{ ___('index.Print') }}
                    <span><i class="fa-solid fa-print"></i></span>
                </button>
            </div>
        @endif
    </div>
@endsection


@push('script')
    <script src="{{ asset('backend/js/get-section.js') }}"></script>
    <script src="{{ asset('backend/js/get-exam-type.js') }}"></script>
    <script src="{{ asset('backend/js/get-student.js') }}"></script>


    <script>
        // Report start
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
        // Report end
    </script>
@endpush
