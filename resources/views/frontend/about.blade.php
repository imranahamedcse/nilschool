@extends('frontend.partials.master')
@section('title')
    {{ $data['title'] }}
@endsection

@section('main')
    <!-- Breadcrumbs start  -->
    <div class="container">
        <nav class="mt-3" aria-label="breadcrumb">
            <ol class="breadcrumb">
                @foreach (@$data['breadcrumbs'] as $item)
                    @if ($item['route'] != '')
                        <li class="breadcrumb-item"><a class="text-info"
                                href="{{ route($item['route']) }}">{{ $item['title'] }}</a></li>
                    @else
                        <li class="breadcrumb-item active">{{ $item['title'] }}</li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
    <!-- Breadcrumbs end  -->

    <!-- Statement start -->
    <div class="statement">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-xl-7 col-lg-6 col-md-6">
                    <div class="py-5">
                        <h2 class="mb-4 fw-bold">{{ $sections['statement']->name }}</h2>

                        @foreach ($sections['statement']->data as $item)
                            <h4 class="fw-bold">{{ $loop->iteration }}. {{ $item['title'] }}</h4>
                            <p class="opacity-75">{{ $item['description'] }}</p>
                        @endforeach

                        <a class="mt-3 btn btn-primary"
                            href="{{ route('frontend.about') }}">{{ ___('frontend.Read more') }}</a>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <img src="{{ @globalAsset(@$sections['statement']->upload->path, '500X500.svg') }}" alt="Image">
                </div>
            </div>
        </div>
    </div>
    <!-- Statement end -->


    <!-- Study at start -->
    <div class="py-5 study_at" data-background="{{ @globalAsset(@$sections['study_at']->upload->path, '1920X700.svg') }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="text-center mb-5">
                        <h2>{{ $sections['study_at']->name }}</h2>
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
                                <h3 class="mt-4">{{ $item['title'] }}</h3>
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
                                    <strong>{{ $item->name }}</strong><br>
                                    <span class="opacity-75">{{ $item->description }}</span>
                                </div>
                            </div>
                        @else
                            <div class="row align-items-center mb-4">
                                <div class="col-12 col-md-6">
                                    <img height="60" src="{{ @globalAsset(@$item->icon_upload->path, '90X60.svg') }}"
                                        alt="Image" class="mb-4"><br>
                                    <strong>{{ $item->name }}</strong><br>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3 class="text-capitalize">{{ $sections['our_teachers']->name }}</span></h3>
                    </div>
                </div>
            </div>
            <div class="row">


                @foreach ($data['teachers'] as $item)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img height="100" class="my-4" src="{{ @globalAsset(@$item->upload->path, '100X100.svg') }}" alt="Image"><br>
                                <p class="lh-1 py-2">
                                    <strong>{{ @$item->first_name }} {{ @$item->last_name }}</strong><br>
                                    <small class="opacity-75">
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
