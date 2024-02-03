@extends('backend.student.partials.master')

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
                    <th class="purchase">{{ ___('index.subject') }}</th>
                    <th class="purchase">{{ ___('index.name') }}</th>
                    <th class="purchase">{{ ___('index.Type') }}</th>
                    <th class="purchase">{{ ___('index.Total Mark') }}</th>
                    <th class="purchase">{{ ___('index.Result') }}</th>
                    <th class="purchase">{{ ___('index.Exam Start') }}</th>
                    <th class="purchase">{{ ___('index.Exam End') }}</th>
                    <th class="purchase">{{ ___('index.Duration') }}</th>
                    <th class="purchase">{{ ___('index.status') }}</th>
                    <th class="action">{{ ___('index.action') }}</th>
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['exams'] as $key => $row)
                    <tr id="row_{{ @$row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ @$row->onlineExam->subject->name }}</td>
                        <td>{{ @$row->onlineExam->name }}</td>
                        <td>{{ @$row->onlineExam->type->name }}</td>
                        <td>{{ @$row->onlineExam->total_mark }}</td>
                        <td>{{ @$row->onlineExam->studentAnswer->where('student_id', $data['student'])->first()->result ?? '' }}
                        </td>
                        <td>{{ date('d-m-Y H:i a', strtotime(@$row->onlineExam->start)) }}</td>
                        <td>{{ date('d-m-Y H:i a', strtotime(@$row->onlineExam->end)) }}</td>
                        <td>
                            <?php
                            $startDate = new DateTime(@$row->onlineExam->start);
                            $endDate = new DateTime(@$row->onlineExam->end);
                            $interval = date_diff($startDate, $endDate);
                            echo $interval->format('%d Day %h Hour %i Minute');
                            ?>
                        </td>
                        <td>
                            @if (in_array($data['student'], @$row->onlineExam->studentAnswer->pluck('student_id')->toArray()))
                                <span class="badge-basic-success-text">{{ ___('index.Submitted') }}</span>
                            @else
                                <span class="badge-basic-danger-text">{{ ___('index.Pending') }}</span>
                            @endif
                        </td>
                        <td>
                            @if (!in_array($data['student'], @$row->onlineExam->studentAnswer->pluck('student_id')->toArray()))
                                @php
                                    $currentTime = now()->format('Y-m-d H:i:s');
                                @endphp
                                @if (@$row->onlineExam->start <= $currentTime && $currentTime <= @$row->onlineExam->end)
                                    <a class="dropdown-item"
                                        href="{{ route('student-panel-online-examination.view', @$row->onlineExam->id) }}"><span
                                            class="icon mr-8"><i
                                                class="fa-solid fa-eye"></i></span>{{ ___('index.view') }}</a>
                                @else
                                    {{ ___('index.Coming soon...') }}
                                @endif
                            @endif
                            @if (optional(@$row->onlineExam->studentAnswer->where('student_id', $data['student'])->first())->result !== null)
                                <a class="dropdown-item"
                                    href="{{ route('student-panel-online-examination.result-view', @$row->onlineExam->id) }}"><span
                                        class="icon mr-8"><i
                                            class="fa-solid fa-eye"></i></span>{{ ___('index.view') }}</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="text-center gray-color">
                            <img src="{{ asset('images/no_data.svg') }}" alt="" class="mb-primary" width="100">
                            <p class="mb-0 text-center">{{ ___('index.No data available') }}</p>
                            <p class="mb-0 text-center text-secondary font-size-90"></p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('script')
    @include('backend.admin.components.table.js')
@endpush
