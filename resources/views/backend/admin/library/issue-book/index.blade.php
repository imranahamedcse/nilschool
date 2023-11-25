@extends('backend.admin.partial.master')

@section('title')
    {{ @$data['headers']['title'] }}
@endsection

@push('style')
    @include('backend.admin.components.table.css')
@endpush

@section('content')
    @include('backend.admin.components.breadcrumb')


    <div class="col-12">
        <form action="{{ route('issue-book.search') }}" method="post" id="marksheed" enctype="multipart/form-data">
            @csrf
            <div class="card ot-card mb-24 position-relative z_1">
                <div class="card-header d-flex align-items-center gap-4 flex-wrap">
                    <h3 class="mb-0">{{ ___('common.Filtering') }}</h3>

                    <div class="card_header_right d-flex align-items-center gap-3 flex-fill justify-content-end flex-wrap">

                        <div class="single_large_selectBox">
                            <input class="form-control ot-input" name="keyword" list="datalistOptions" id="exampleDataList"
                                placeholder="{{ ___('student_info.Enter keyword') }}"
                                value="{{ @$data['request']->keyword }}">
                        </div>

                        <button class="btn btn-lg ot-btn-primary" type="submit">
                            {{ ___('common.Search') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <div class="p-4 rounded-3 bg-white">
        @include('backend.admin.components.table.header')


        <table id="datatable" class="table">
            <thead class="thead">
                <tr>
                    <th class="serial">{{ ___('common.sr_no') }}</th>
                    <th class="purchase">{{ ___('library.Book') }}</th>
                    <th class="purchase">{{ ___('library.Member') }}</th>
                    <th class="purchase">{{ ___('common.Phone') }}</th>
                    <th class="purchase">{{ ___('library.Issue Date') }}</th>
                    <th class="purchase">{{ ___('library.Return Date') }}</th>
                    <th class="purchase">{{ ___('common.status') }}</th>
                    @if (hasPermission('issue_book_update') || hasPermission('issue_book_delete'))
                        <th class="action">{{ ___('common.action') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse ($data['issue_book'] as $key => $row)
                    <tr id="row_{{ $row->id }}">
                        <td class="serial">{{ ++$key }}</td>
                        <td>{{ @$row->book->name }}</td>
                        <td>{{ @$row->user->name }}</td>
                        <td>{{ @$row->phone }}</td>
                        <td>{{ dateFormat(@$row->issue_date) }}</td>
                        <td>{{ dateFormat(@$row->return_date) }}</td>
                        <td>
                            @if ($row->status == App\Enums\Status::ACTIVE)
                                <span class="badge-basic-success-text">{{ ___('library.return') }}</span>
                            @else
                                <span class="badge-basic-danger-text">{{ ___('library.issued') }}</span>
                            @endif
                        </td>
                        @if (hasPermission('issue_book_update') ||
                                hasPermission('issue_book_delete') ||
                                @$row->status == App\Enums\IssueBook::ISSUED)
                            <td>
                                @if (hasPermission('issue_book_update'))
                                    <a class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.edit') }}"
                                        href="{{ route('issue-book.edit', $row->id) }}"><i
                                            class="fa-solid fa-pencil"></i></a>
                                @endif
                                @if (hasPermission('issue_book_delete') && $row->code != 'en')
                                    <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ ___('common.delete') }}" href="javascript:void(0);"
                                        onclick="delete_row('issue-book/delete', {{ $row->id }})"><i
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
