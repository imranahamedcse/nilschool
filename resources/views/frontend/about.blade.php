@extends('frontend.partials.master')
@section('title')
    {{ $data['title'] }}
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
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-6">
                            <div class="py-5 text-center text-lg-end">
                                <h3 class="text-dark fw-semibold">{{ $sections['statement']->name }}</h3>

                                @foreach ($sections['statement']->data as $item)
                                    <h6 class="text-dark fw-semibold">{{ $loop->iteration }}. {{ $item['title'] }}</h6>
                                    <p>{{ $item['description'] }}</p>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <img width="100%" src="{{ @globalAsset(@$sections['statement']->upload->path, '500X500.svg') }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Statement end -->


    <!-- Study at start -->
    <div class="py-5 study_at">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="text-center mb-5">
                        <h3 class="fw-semibold text-dark">{{ $sections['study_at']->name }}</h3>
                        <p>{{ $sections['study_at']->description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($sections['study_at']->data as $item)
                    <div class="col-12 col-lg-4 text-center text-lg-start">

                        <div class="card">
                            <div class="card-body">
                                <img height="60" src="{{ @globalAsset(uploadPath($item['icon']), '90X60.svg') }}"
                                    alt="Icon">
                                <h6 class="text-dark fw-semibold mt-4">{{ $item['title'] }}</h6>
                                <p>{{ $item['description'] }}</p>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Study at start end -->

    
@endsection
