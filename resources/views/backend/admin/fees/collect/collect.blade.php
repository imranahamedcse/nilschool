@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['headers']['title'] }}
@endsection

@push('style')
    @include('backend.admin.components.table.css')
@endpush

@section('content')
    @include('backend.admin.components.breadcrumb')

    <div class="card card">
        <div class="card-body">


            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                <h4>{{ ___('index.Fees Details') }}</h4>

                <div class="align-content-center mb-3">
                    <strong>{{ ___('index.admission_no') }} :</strong>
                    <span>{{ @$data['student']->admission_no }},</span>

                    <strong>{{ ___('index.Student Name') }} :</strong>
                    <span>{{ @$data['student']->first_name }} {{ @$data['student']->last_name }}</span>

                    <input type="hidden" name="student_id" id="student_id" value="{{ $data['student']->id }}" />
                </div>

                @if (hasPermission('fees_collect_create'))
                    <a href="#" class="btn btn-info mb-3" data-bs-toggle="modal" data-bs-target="#modalCustomizeWidth"
                        onclick="feesCollect()">
                        <span><i class="fa-solid fa-plus"></i> </span>
                        <span class="">{{ ___('index.Collect') }}</span>
                    </a>
                @endif
            </div>

            <table id="datatable" class="table">
                <thead class="thead">
                    <tr>
                        <th class="purchase mr-4">{{ ___('index.All') }} <input class="form-check-input all"
                                type="checkbox"></th>
                        <th class="purchase">{{ ___('index.group') }}</th>
                        <th class="purchase">{{ ___('index.type') }}</th>
                        <th class="purchase">{{ ___('index.due_date') }}</th>
                        <th class="purchase">{{ ___('index.amount') }} ({{ Setting('currency_symbol') }})</th>
                        <th class="purchase">{{ ___('index.status') }}</th>
                        <th class="purchase">{{ ___('index.fine_type') }}</th>
                        <th class="purchase">{{ ___('index.percentage') }}</th>
                        <th class="purchase">{{ ___('index.fine_amount') }} ({{ Setting('currency_symbol') }})</th>
                        @if (hasPermission('fees_collect_delete'))
                            <th class="purchase">{{ ___('index.action') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="tbody">

                    @foreach (@$data['fees_assigned'] as $item)
                        <tr>
                            <td><input class="form-check-input child" type="checkbox" name="fees_assign_childrens[]"
                                    value="{{ $item->id }}"></td>
                            <td>{{ @$item->feesMaster->group->name }}</td>
                            <td>{{ @$item->feesMaster->type->name }}</td>
                            <td>{{ dateFormat(@$item->feesMaster->due_date) }}</td>
                            <td>{{ @$item->feesMaster->amount }}

                                @if (date('Y-m-d') > $item->feesMaster->date && $item->fees_collect_count == 0)
                                    <span class="text-danger">+ {{ @$item->feesMaster->fine_amount }}</span>
                                @elseif($item->fees_collect_count == 1 && $item->feesMaster->date < $item->feesCollect->date)
                                    <span class="text-danger">+ {{ @$item->feesMaster->fine_amount }}</span>
                                @endif

                            </td>
                            <td>
                                @if ($item->fees_collect_count)
                                    <span class="badge-basic-success-text">{{ ___('index.Paid') }}</span>
                                @else
                                    <span class="badge-basic-danger-text">{{ ___('index.Unpaid') }}</span>
                                @endif
                            </td>
                            <td>
                                @if (@$item->fine_type == 0)
                                    <span class="badge-basic-info-text">{{ ___('index.none') }}</span>
                                @elseif(@$item->fine_type == 1)
                                    <span class="badge-basic-info-text">{{ ___('index.percentage') }}</span>
                                @elseif(@$item->fine_type == 2)
                                    <span class="badge-basic-info-text">{{ ___('index.fixed') }}</span>
                                @endif
                            </td>
                            <td>{{ @$item->feesMaster->percentage }}</td>
                            <td>
                                @if (date('Y-m-d') > @$item->feesMaster->due_date)
                                    {{ @$item->feesMaster->fine_amount }}
                                @else
                                    0
                                @endif
                            </td>

                            @if (hasPermission('fees_collect_delete'))
                                <td>
                                    @if ($item->fees_collect_count)
                                        <a class="btn btn-sm btn-danger" href="javascript:void(0);"
                                            onclick="delete_row('fees-collect/delete', {{ @$item->feesCollect->id }}, true)">
                                            <span class="icon mr-8"><i class="fa-solid fa-trash-can"></i></span>
                                            <span>{{ ___('index.Revert Payment') }}</span>
                                        </a>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div id="view-modal">
        <div class="modal fade" id="modalCustomizeWidth" tabindex="-1" aria-labelledby="modalWidth" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                {{--  --}}
            </div>
        </div>
    </div>
@endsection


@push('script')
    @include('backend.admin.components.table.js')
    @include('backend.admin.components.table.delete-ajax')

    <script>
        function feesCollect() {

            var fees_assign_childrens = $('input[name="fees_assign_childrens[]"]').map(function() {
                if ($(this).is(':checked')) {
                    return $(this).val();
                }
            }).get();

            var formData = {
                fees_assign_childrens: fees_assign_childrens,
                student_id: $("#student_id").val(),
            }

            $.ajax({
                type: "GET",
                dataType: 'html',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/fees/collect/fees-show',
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
