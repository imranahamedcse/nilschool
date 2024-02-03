@extends('frontend.partials.master')
@section('title')
    {{ setting('application_name') }}
@endsection

@section('main')
    <!-- Banner start -->
    <div id="carouselSlides" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach ($data['sliders'] as $key => $item)
                <button type="button" data-bs-target="#carouselSlides" data-bs-slide-to="{{ $key }}"
                    class="{{ $key == 0 ? 'active' : '' }}" aria-current="true"
                    aria-label="Slide {{ $key }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($data['sliders'] as $key => $item)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ @globalAsset(@$item->upload->path, '1920X700.webp') }}" class="d-block w-100"
                        alt="Image">
                    <div
                        class="carousel-caption d-none d-md-block d-flex justify-content-center align-items-center flex-column">
                        <h3>{{ $item->name }}</span></h3>
                        <p>{{ $item->description }}</p>
                        <a href="{{ route('frontend.about') }}"
                            class="theme_btn min_windth_200">{{ ___('common.Read more') }}</a>
                        <a href="{{ route('frontend.contact') }}"
                            class="theme_line_btn min_windth_200">{{ ___('common.Contact Us') }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Banner end -->


    <!-- Counter start -->
    <div class="bg-info">
        <div class="container py-5">
            <div class="row">
                @foreach ($data['counters'] as $item)
                    <div class="col-xl-3 col-lg-3 col-md-6 ">
                        <div class="d-flex align-items-center">
                            <div>
                                <img height="75" src="{{ @globalAsset(@$item->upload->path, '90X60.webp') }}"
                                    alt="Icon">
                            </div>
                            <div class="px-2">
                                <strong>{{ $item->total_count }}+</strong><br>
                                <span>{{ $item->name }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Counter end -->


    <!-- Statement start -->
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-xl-7 col-lg-6 col-md-6">
                <div class="py-5">
                    <h2 class="mb-4">{{ $sections['statement']->name }}</h2>

                    @foreach ($sections['statement']->data as $item)
                        <h4>{{ $loop->iteration }}. {{ $item['title'] }}</h4>
                        <p>{{ $item['description'] }}</p>
                    @endforeach

                    <a class="mt-3 btn btn-info" href="{{ route('frontend.about') }}">{{ ___('common.More...') }}</a>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-6">
                <img src="{{ @globalAsset(@$sections['statement']->upload->path, '512X512.webp') }}" alt="Image">
            </div>
        </div>
    </div>
    <!-- Statement end -->


    <!-- Study at start -->
    <div class="py-5" data-background="{{ @globalAsset(@$sections['study_at']->upload->path, '1920X700.webp') }}">
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
                        <div class="bg-body-tertiary p-4">
                            <div class="mb-3">
                                <img src="{{ @globalAsset(uploadPath($item['icon']), '90X60.webp') }}" alt="Icon">
                            </div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['description'] }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Study at start end -->


    <!-- Explorer area start -->
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-xl-6 col-md-6">
                <img class="w-100" src="{{ @globalAsset(@$sections['explore']->upload->path, '512X512.webp') }}"
                    alt="Image">
            </div>
            <div class="col-lg-6 col-md-6">

                <div class="mb-5">
                    <h2>{{ $sections['explore']->name }}</h2>
                    <p>{{ $sections['explore']->description }}</p>
                </div>

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        @foreach ($sections['explore']->data as $key => $item)
                            <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="nav-{{ $key }}-tab"
                                data-bs-toggle="tab" data-bs-target="#nav-{{ $key }}" type="button"
                                role="tab" aria-controls="nav-{{ $key }}"
                                aria-selected="true">{{ $item['tab'] }}</button>
                        @endforeach
                    </div>
                </nav>
                <div class="tab-content mt-3" id="nav-tabContent">
                    @foreach ($sections['explore']->data as $key => $item)
                        <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="nav-{{ $key }}"
                            role="tabpanel" aria-labelledby="nav-{{ $key }}-tab" tabindex="0">
                            {{-- <h4>{{ $item['title'] }}</h4> --}}
                            <p>{{ $item['description'] }}</p>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <!-- Explorer area end -->


    <!-- Teaching area start -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h3>{{ $sections['why_choose_us']->name }}</h3>
            <p>{{ $sections['why_choose_us']->description }}</p>
        </div>

        <div class="row">
            @foreach ($sections['why_choose_us']->data as $item)
                <div class="col-12 col-md-6">
                    <div class="bg-body-tertiary p-4 mb-4">
                        <i class="far fa-check-circle"></i> {{ $item }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Teaching area end -->


    <!-- Event start -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8">
                <div class="text-center">
                    <h2>{{ $sections['coming_up']->name }}</h2>
                    <p>{{ $sections['coming_up']->description }}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="event_wrapper mb_30">
                    <div class="tab-content event_wrapper_content" id="4myTabContent">

                        @foreach ($data['comingEvents'] as $key => $item)
                            <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="event{{ $key }}"
                                role="tabpanel" aria-labelledby="event{{ $key }}-tab">
                                <div class="event_wrapper_img">
                                    <img src="{{ @globalAsset(@$item->upload->path, '800X500.webp') }}" alt="Image"
                                        class="img-fluid">
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <ul class="nav event_tabs" id="4myTab" role="tablist">

                        @foreach ($data['comingEvents'] as $key => $item)
                            <li class="nav-item">
                                <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="event{{ $key }}-tab"
                                    data-toggle="tab" href="#event{{ $key }}" role="tab"
                                    aria-controls="event{{ $key }}"
                                    aria-selected="{{ $key == 0 ? 'true' : 'false' }}">
                                    <div class="icon">
                                        <h3>{{ substr(dateFormat($item->date), 0, 3) }}</h3>
                                        <h5>{{ substr(dateFormat($item->date), 2, 11) }}</h5>
                                    </div>
                                    <div class="event_content">
                                        <span> <i class="far fa-clock"></i>{{ timeFormat($item->start_time) }} -
                                            {{ timeFormat($item->end_time) }}</span>
                                        <p>{{ $item->title }}</p>
                                    </div>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- Event start -->


    <!-- Blog start -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="text-center mb-5">
                    <h2>{{ $sections['news']->name }}</h2>
                    <p>{{ $sections['news']->description }}</p>
                </div>
            </div>
        </div>
        @foreach ($data['latestNews'] as $key => $item)
            @if ($key == 0 || $key == 2)
                <div class="row align-items-center mb-4">
                    <div class="col-12 col-md-6">
                        <a href="{{ route('frontend.news-detail', $item->id) }}" class="thumb">
                            <img height="400" src="{{ @globalAsset(@$item->upload->path, '340X410.webp') }}"
                                alt="Image" class="w-100">
                        </a>
                    </div>
                    <div class="col-12 col-md-6">
                        <h4>
                            <a href="{{ route('frontend.news-detail', $item->id) }}">{{ $item->title }}</a>
                        </h4>
                        <p>{!! Str::limit($item->description, 150) !!}</p>
                        <div class="d-flex align-items-center justify-content-between">
                            <a class="d-inline-flex align-items-center"
                                href="{{ route('frontend.news-detail', $item->id) }}">
                                <span>{{ ___('common.Read more') }} </span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <span>{{ dateFormat($item->date) }}</span>
                        </div>
                    </div>
                </div>
            @else
                <div class="row align-items-center mb-4">
                    <div class="col-12 col-md-6">
                        <h4>
                            <a href="{{ route('frontend.news-detail', $item->id) }}">{{ $item->title }}</a>
                        </h4>
                        <p>{!! Str::limit($item->description, 150) !!}</p>
                        <div class="d-flex align-items-center justify-content-between">
                            <a class="d-inline-flex align-items-center"
                                href="{{ route('frontend.news-detail', $item->id) }}">
                                <span>{{ ___('common.Read more') }} </span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <span>{{ dateFormat($item->date) }}</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <a href="{{ route('frontend.news-detail', $item->id) }}" class="thumb">
                            <img height="400" src="{{ @globalAsset(@$item->upload->path, '340X410.webp') }}"
                                alt="Image" class="w-100">
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <!-- Blog start -->


    <!-- Gallery area -->
    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-8">
                <div class="text-center">
                    <h2>{{ $sections['our_gallery']->name }}</h2>
                    <p>{{ $sections['our_gallery']->description }}</p>
                </div>
            </div>
        </div>

        <div class="portfolio-menu d-flex justify-content-center mb-4">
            <button class="btn active" data-filter="*">All</button>
            @foreach ($data['galleryCategory'] as $item)
                <button class="btn" data-filter=".{{ $item->id }}">{{ $item->name }}</button>
            @endforeach
        </div>

        <div class="row">
            @foreach ($data['gallery'] as $item)
                <div class="col-lg-3 col-md-4 grid-item {{ $item->gallery_category_id }}">
                    <a href="{{ @globalAsset(@$item->upload->path, '340X340.webp') }}"
                        class="thumb overflow-hidden popup-image d-block">
                        <img src="{{ @globalAsset(@$item->upload->path, '340X340.webp') }}" class="mb-4"
                            alt="Image">
                    </a>
                </div>
            @endforeach
        </div>

    </div>
    <!-- Gallery area -->



    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
        <div class="row">
            <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="gallery-title">Gallery</h1>
            </div>

            <div align="center">
                <button class="btn btn-default filter-button" data-filter="all">All</button>
                <button class="btn btn-default filter-button" data-filter="hdpe">HDPE Pipes</button>
                <button class="btn btn-default filter-button" data-filter="sprinkle">Sprinkle Pipes</button>
                <button class="btn btn-default filter-button" data-filter="spray">Spray Nozzle</button>
                <button class="btn btn-default filter-button" data-filter="irrigation">Irrigation Pipes</button>
            </div>
            <br />



            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter sprinkle">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter irrigation">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter spray">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>

            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter sprinkle">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive">
            </div>
        </div>
    </div>
    </section>
@endsection
