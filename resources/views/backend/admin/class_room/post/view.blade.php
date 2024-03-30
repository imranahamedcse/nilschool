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
        @include('backend.admin.components.table.header')


        <div class="border mb-4 p-3">
            <div class="d-flex align-items-center mb-4">
                <div class="flex-shrink-0">
                    <img class="rounded float-start rounded-circle" height="40" width="40"
                        src="{{ @globalAsset($data['post']->user->upload->path, '40X40.svg') }}" alt="{{ $data['post']->user->name }}">
                </div>
                <div class="flex-grow-1 ms-3">
                    <strong>{{ $data['post']->user->name }}</strong> <br>
                    <small>{{ $data['post']->created_at->format('d M') }}</small>
                </div>
            </div>
            @if ($data['post']->upload)
                <a href="{{ @globalAsset($data['post']->upload->path) }}" download><i class="fa-solid fa-download"></i></a>
            @endif
            <div>
                {{ $data['post']->description }}
            </div>
        </div>

        <div class="border p-3">
            @foreach ($data['post']->comments as $row)
                <div class="d-flex align-items-center mb-2">
                    <div class="flex-shrink-0">
                        <img class="rounded float-start rounded-circle" height="40" width="40"
                            src="{{ @globalAsset(@$row->student->user->upload->path, '40X40.svg') }}"
                            alt="{{ @$row->student->name }}">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <strong>{{ @$row->student->first_name }} {{ @$row->student->last_name }}</strong>
                        <small>{{ @$row->created_at->format('d M') }}</small><br>
                        {{ @$row->comment }}
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
