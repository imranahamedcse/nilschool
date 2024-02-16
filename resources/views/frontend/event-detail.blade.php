@extends('frontend.partials.master')
@section('title')
    {{ ___('frontend.Event Details') }}
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
                <h3 class="fw-semibold">{{ $sections['study_at']->name }}</h3>
                <h6>{{ $sections['study_at']->description }}</h6>
            </div>
        </div>

        <div class="page_items container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card mb-5">
                        <div class="card-body">
                            <img width="100%"
                                src="{{ @globalAsset($data['event']->upload->path, '40X40.svg') }}" alt="Image"
                                class="mb-3">
                            <h5 class="fw-semibold text-dark">{{ $data['event']->title }}</h5>
                            <p>{!! $data['event']->description, 150 !!}</p>

                            <div>
                                <h6 class="fw-semibold text-dark">{{ ___('frontend.Event Details') }}</h6>
                                <ul>
                                    <li>{{ ___('frontend.Start') }} : {{ dateFormat($data['event']->date) }} -
                                        {{ timeFormat($data['event']->start_time) }}</li>
                                    <li>{{ ___('frontend.End') }} : {{ dateFormat($data['event']->date) }} -
                                        {{ timeFormat($data['event']->end_time) }}</li>
                                    <li>{{ $data['event']->address }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card mb-5">
                        <div class="card-body">
                            <h5 class="fw-semibold text-dark">{{ ___('frontend.Upcoming Events') }}</h5>
                            @foreach ($data['allEvent'] as $item)
                                <a href="{{ route('frontend.events-detail', $item->id) }}">
                                    <img width="100%"
                                        src="{{ @globalAsset(@$item->upload->path, '40X40.svg') }}" alt="Image">
                                </a>
                                <a class="h6 m-0 fw-semibold text-dark link-underline link-underline-opacity-0"
                                    href="{{ route('frontend.events-detail', $item->id) }}">{{ Str::limit($item->title, 50) }}</a>
                                <p>{{ dateFormat($item->date) }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- news_page_area::end  -->
@endsection
