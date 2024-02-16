@extends('frontend.partials.master')
@section('title')
    {{ ___('frontend.News Details') }}
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
                <div class="col-8">
                    <div class="card mb-5">
                        <div class="card-body">
                            <img width="100%" height="500"
                                src="{{ @globalAsset($data['news']->upload->path, '40X40.svg') }}" alt="Image"
                                class="mb-3">
                            <h5 class="fw-semibold text-dark">{{ $data['news']->title }}</h5>
                            <p>{!! $data['news']->description, 150 !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card mb-5">
                        <div class="card-body">
                            <h5 class="fw-semibold text-dark">{{ ___('frontend.Latest News') }}</h5>
                            @foreach ($data['allNews'] as $item)
                                <a href="{{ route('frontend.news-detail', $item->id) }}">
                                    <img width="100%" height="200"
                                        src="{{ @globalAsset(@$item->upload->path, '40X40.svg') }}" alt="Image">
                                </a>
                                <a class="h6 m-0 fw-semibold text-dark link-underline link-underline-opacity-0"
                                    href="{{ route('frontend.news-detail', $item->id) }}">{{ Str::limit($item->title, 50) }}</a>
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
