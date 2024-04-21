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
                <form action="{{ route('order.search') }}" method="post" id="marksheed" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input class="form-control" name="keyword"
                                placeholder="{{ ___('index.Enter keyword') }}"
                                value="{{ @$data['request']->keyword }}">
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" type="submit">
                                {{ ___('index.Search') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col text-end">
                @if (hasPermission(@$data['headers']['create-permission']))
                    <a class="btn btn-sm btn-secondary" href="{{ route(@$data['headers']['create-route']) }}">
                        <i class="fa-solid fa-plus"></i> {{ ___('index.add') }}
                    </a>
                @endif
            </div>
        </div>



        <table id="datatable" class="table">
            <thead class="thead">
                <tr>
                    <th class="serial">{{ ___('index.sr_no') }}</th>
                    <th class="purchase">{{ ___('index.Book') }}</th>
                    <th class="purchase">{{ ___('index.Member') }}</th>
                    <th class="purchase">{{ ___('index.Phone') }}</th>
                    <th class="purchase">{{ ___('index.Issue Date') }}</th>
                    <th class="purchase">{{ ___('index.Return Date') }}</th>
                    <th class="purchase">{{ ___('index.status') }}</th>
                    @if (hasPermission('order_update') || hasPermission('order_delete'))
                        <th class="action">{{ ___('index.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['order'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ @$row->book->name }}</td>
                        <td>{{ @$row->user->name }}</td>
                        <td>{{ @$row->phone }}</td>
                        <td>{{ dateFormat(@$row->issue_date) }}</td>
                        <td>{{ dateFormat(@$row->return_date) }}</td>
                        <td>
                            @include('backend.admin.components.table.status')
                        </td>
                        @if (hasPermission('order_update') ||
                                hasPermission('order_delete') ||
                                @$row->status == App\Enums\IssueBook::ISSUED)
                            <td>
                                @if (hasPermission('order_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('index.edit') }}"
                                        href="{{ route('order.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('order_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('index.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('library/order/delete', {{ $row->id }})"><i
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
