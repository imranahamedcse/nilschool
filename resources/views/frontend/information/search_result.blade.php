@extends('frontend.information.master')
@section('title')
    {{ ___('frontend.Search Result') }}
@endsection

@section('mainSection')
    <h3 class="fw-semibold text-dark">Search Result</h3>
    <div class="border-bottom mb-3"></div>
    <div class="row mb-3">
        <div class="col-12 col-lg-8 offset-lg-2">
            <div class="card mb-4" id="printableArea">
                <div class="card-body text-center">
                    <img class="mb-3" height="50" src="{{ @globalAsset(setting('light_logo'), '154X38.webp') }}"
                        alt="Logo">

                    <h5 class="fw-semibold m-0">{{ setting('application_name') }}</h5>
                    <p class="mb-3 small">{{ setting('address') }}</p>

                    <h6 class="fw-semibold m-0">{{ @$data['classSection']->class->name }}
                        ({{ @$data['classSection']->section->name }})</h6>
                    <p>{{ ___('frontend.Name') }} : {{ @$data['classSection']->student->first_name }}
                        {{ @$data['classSection']->student->last_name }}</p>

                    <h6 class="fw-semibold text-dark">{{ ___('frontend.Grade Sheet') }}</h6>
                    <table class="table text-start table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">{{ ___('frontend.Subject Code') }}</th>
                                <th scope="col">{{ ___('frontend.Subject Name') }}</th>
                                <th scope="col">{{ ___('frontend.Grade') }}</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach (@$data['marks_registers'] as $item)
                                <tr>
                                    <th scope="row">
                                        {{ $item->subject->code }}
                                    </th>
                                    <td>
                                        {{ $item->subject->name }}
                                    </td>
                                    <td>
                                        @php
                                            $n = 0;
                                        @endphp
                                        @foreach ($item->marksRegisterChilds as $item)
                                            @php
                                                $n += $item->mark;
                                            @endphp
                                        @endforeach
                                        {{ markGrade($n) }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2" class="text-end fw-semibold">{{ ___('frontend.Result') }} :</td>
                                <td>{{ @$data['result'] }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-end fw-semibold">{{ ___('frontend.GPA') }} :</td>
                                <td>
                                    @if ($data['result'] == 'Passed')
                                        {{ @$data['gpa'] }}
                                    @else
                                        {{ '0.00' }}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center">
                <a class="btn btn-primary"
                    href="{{ route('information.result.pdf-download', ['id' => @$data['classSection']->student->id, 'type' => $data['request']->exam, 'class' => @$data['classSection']->class->id, 'section' => @$data['classSection']->section->id]) }}">
                    {{ ___('common.PDF Download') }}
                </a>
                <a class="btn btn-primary"
                    href="{{ route('information.result') }}">{{ ___('frontend.Search Again') }}</a>
            </div>
        </div>
    </div>
@endsection
