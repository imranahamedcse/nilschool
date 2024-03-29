@extends('frontend.academic.master')
@section('title')
    {{ ___('frontend.Notice Details') }}
@endsection

@section('mainSection')
    <h3 class="fw-semibold text-dark">Notice Details</h3>
    <div class="mb-3">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <img src="{{ @globalAsset(@$data['notice-board']->upload->path, '800X500.webp') }}" alt="Image"
                            class="rounded-top mb-4" width="100%">

                        <a class="btn btn-sm btn-outline-primary mb-3" href="{{ @globalAsset(@$data['notice-board']->upload->path) }}" download><i
                                class="fa-solid fa-download"></i> Download</a>
                        <h3 class="fw-semibold">{{ $data['notice-board']->title }}</h3>
                        <p>{!! $data['notice-board']->description !!}</p>

                        <h5 class="fw-semibold">{{ ___('frontend.Event Details') }}</h5>
                        <ul>
                            <li>{{ dateFormat($data['notice-board']->date) }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <h3 class="fw-semibold">{{ ___('frontend.Latest Notices') }}</h3>

                <ul class="list-group list-group-flush">
                    @foreach ($data['allNotice'] as $item)
                        @if ($data['notice-board']->id != $item->id)
                            <li class="list-group-item">
                                <a class="text-black"
                                    href="{{ route('academic.notice-detail', $item->id) }}"><strong>{{ $item->title }}</strong></a><br>
                                <small>{{ dateFormat($item->date) }}</small>
                            </li>
                        @endif
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
@endsection
