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
        <div class="row justify-content-between border-bottom pb-4 mb-4">
            <div class="col align-self-center">
                <h4 class="m-0">{{ @$data['headers']['title'] }}</h4>
            </div>
            <div class="col">
                <form action="{{ route('question-group.search') }}" method="post" id="marksheed" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center align-items-center">
                        <div class="input-group">
                            <input class="form-control" name="keyword" list="datalistOptions" id="exampleDataList"
                                placeholder="{{ ___('student_info.Search name') }}"
                                value="{{ old('keyword', @$data['request']->keyword) }}">
                            <button class="btn btn-primary" type="submit">
                                {{ ___('common.Search') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col text-end">
                @if (hasPermission(@$data['headers']['permission']))
                    <a class="btn btn-sm btn-secondary" href="{{ route(@$data['headers']['create-route']) }}">
                        <i class="fa-solid fa-plus"></i> {{ ___('common.add') }}
                    </a>
                @endif
            </div>
        </div>


        <table id="datatable" class="table">
            <thead class="thead">
                <tr>
                    <th class="serial">{{ ___('common.sr_no') }}</th>
                    <th class="purchase">{{ ___('common.name') }}</th>
                    <th class="purchase">{{ ___('common.status') }}</th>
                    @if (hasPermission('question_group_update') || hasPermission('question_group_delete'))
                        <th class="action">{{ ___('common.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['question_group'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ $row->name }}</td>
                        <td>
                            @if ($row->status == App\Enums\Status::ACTIVE)
                                <span class="badge-basic-success-text">{{ ___('common.active') }}</span>
                            @else
                                <span class="badge-basic-danger-text">{{ ___('common.inactive') }}</span>
                            @endif
                        </td>
                        @if (hasPermission('question_group_update') || hasPermission('question_group_delete'))
                            <td>
                                @if (hasPermission('question_group_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.edit') }}"
                                        href="{{ route('question-group.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('question_group_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('question-group/delete', {{ $row->id }})"><i
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
@endpush
