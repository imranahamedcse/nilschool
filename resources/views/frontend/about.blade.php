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
                        <div class="col-6">
                            <div class="py-5 text-end">
                                <h3 class="text-dark fw-semibold">{{ $sections['statement']->name }}</h3>

                                @foreach ($sections['statement']->data as $item)
                                    <h6 class="text-dark fw-semibold">{{ $loop->iteration }}. {{ $item['title'] }}</h6>
                                    <p>{{ $item['description'] }}</p>
                                @endforeach

                                <a class="mt-3 btn btn-primary"
                                    href="{{ route('frontend.about') }}">{{ ___('frontend.Read more') }}</a>
                            </div>
                        </div>
                        <div class="col-6">
                            <img src="{{ @globalAsset(@$sections['statement']->upload->path, '500X500.svg') }}" alt="Image">
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
                    <div class="col-xl-4 col-md-4">

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

    <!-- About start  -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    @foreach ($data['abouts'] as $key => $item)
                        @if ($key % 2 == 0)
                            <div class="row align-items-center mb-4">
                                <div class="col-12 col-md-6">
                                    <img height="400" src="{{ @globalAsset(@$item->upload->path, '800X500.svg') }}"
                                        alt="Image" class="w-100">
                                </div>
                                <div class="col-12 col-md-6">
                                    <img height="60" src="{{ @globalAsset(@$item->icon_upload->path, '90X60.svg') }}"
                                        alt="Image" class="mb-4"><br>
                                    <h6 class="text-dark fw-semibold m-0">{{ $item->name }}</h6>
                                    <span class="opacity-75">{{ $item->description }}</span>
                                </div>
                            </div>
                        @else
                            <div class="row align-items-center mb-4">
                                <div class="col-12 col-md-6 text-end">
                                    <img height="60" src="{{ @globalAsset(@$item->icon_upload->path, '90X60.svg') }}"
                                        alt="Image" class="mb-4"><br>
                                    <h6 class="text-dark fw-semibold m-0">{{ $item->name }}</h6>
                                    <span class="opacity-75">{{ $item->description }}</span>
                                </div>
                                <div class="col-12 col-md-6">
                                    <img height="400" src="{{ @globalAsset(@$item->upload->path, '800X500.svg') }}"
                                        alt="Image" class="w-100">
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- About end  -->

    <!-- Teacher start  -->
    <div class="teacher py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3 class="text-dark fw-semibold m-0">{{ $sections['our_teachers']->name }}</h3>
                        <p>{{ $sections['our_teachers']->description }}</p>
                    </div>
                </div>
            </div>
            <div class="row">


                @foreach ($data['teachers'] as $item)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img height="100" class="my-4 rounded-circle" src="{{ @globalAsset(@$item->upload->path, '100X100.svg') }}" alt="Image"><br>
                                <p class="lh-1 py-2">
                                    <span class="text-dark h6 fw-semibold m-0">{{ @$item->first_name }} {{ @$item->last_name }}</span><br>
                                    <small>
                                        {{ @$item->email }}<br>
                                        {{ @$item->designation->name }}
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- Teacher end  -->
@endsection
