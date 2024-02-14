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
                    <img height="700" src="{{ @globalAsset(@$item->upload->path, '1920X700.svg') }}" class="d-block w-100"
                        alt="Image">
                    <div class="carousel-caption h-100 d-inline-block">
                        <div class="row h-100">
                            <div class="col"></div>
                            <div class="col">
                                <div class=" h-100 d-flex justify-content-center align-items-center">
                                    <div class="text-start">
                                        <p class="display-3 fw-bold mb-4"><strong>{{ $item->name }}</strong></p>
                                        <p class="h3 opacity-75 mb-5">{{ $item->description }}</p>
                                        <a href="{{ route('frontend.about') }}"
                                            class="btn btn-lg btn-outline-light">{{ ___('frontend.Read more') }}</a>
                                        <a href="{{ route('frontend.contact') }}"
                                            class="btn btn-lg btn-outline-light mx-4">{{ ___('frontend.Contact Us') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Banner end -->


    <!-- Counter start -->
    <div class="counter">
        <div class="container py-5">
            <div class="row">
                @foreach ($data['counters'] as $item)
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card py-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-center align-items-center">
                                    <img height="75" src="{{ @globalAsset(@$item->upload->path, '90X60.svg') }}"
                                        alt="Icon">
                                    <div class="border-start px-2 mx-2">
                                        <h2 class="mb-0"><strong>{{ $item->total_count }}+</strong></h2>
                                        <span>{{ $item->name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Counter end -->


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


    <!-- Explorer area start -->
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-xl-6 col-md-6">
                <img class="w-100" src="{{ @globalAsset(@$sections['explore']->upload->path, '500X500.svg') }}"
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
    <div class="why_choose_us text-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h3 class="fw-bold">{{ $sections['why_choose_us']->name }}</h3>
                <p class="opacity-75">{{ $sections['why_choose_us']->description }}</p>
            </div>

            <div class="row">
                @foreach ($sections['why_choose_us']->data as $item)
                    <div class="col-12 col-md-6">
                        <div class="border border-light p-4 mb-4">
                            <i class="far fa-check-circle"></i> {{ $item }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Teaching area end -->


    <!-- Event start -->
    <div class="coming_up">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-8 col-md-8">
                    <div class="text-center">
                        <h2>{{ $sections['coming_up']->name }}</h2>
                        <p>{{ $sections['coming_up']->description }}</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <ul class="list-group list-group-flush">

                    @foreach ($data['comingEvents'] as $key => $item)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-center">
                                    <img height="75" src="{{ @globalAsset(@$item->upload->path, '90X60.svg') }}"
                                        alt="Icon">
                                    <div class="px-2 mx-2">
                                        <p class="mb-1">
                                            <strong class="opacity-75">{{ $item->title }}</strong><br>
                                            <span class="opacity-50">{{ dateFormat($item->date) }}</span>
                                        </p>
                                        <small class="opacity-50">{{ timeFormat($item->start_time) }} -
                                            {{ timeFormat($item->end_time) }}</small>
                                    </div>
                                </div>
                                <a href="{{ route('frontend.events-detail', $item->id) }}" class="btn btn-primary">
                                    <i class="fas fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    @endforeach

                </ul>

            </div>
        </div>
    </div>
    <!-- Event start -->


    <!-- Blog start -->
    <div class="blog">
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
                                <img height="400" src="{{ @globalAsset(@$item->upload->path, '400X400.svg') }}"
                                    alt="Image" class="w-100">
                            </a>
                        </div>
                        <div class="col-12 col-md-6">
                            <h2 class="mb-0">
                                <a class="link-underline link-underline-opacity-0 text-dark"
                                    href="{{ route('frontend.news-detail', $item->id) }}">{{ $item->title }}</a>
                            </h2>
                            <div class="py-4">
                                <small><strong>{{ dateFormat($item->date) }}</strong></small><br>
                                <span class="opacity-75">{!! Str::limit($item->description, 150) !!}</span>
                            </div>
                            <a class="btn btn-primary" href="{{ route('frontend.news-detail', $item->id) }}">
                                {{ ___('frontend.Read more') }}
                            </a>
                        </div>
                    </div>
                @else
                    <div class="row align-items-center mb-4">
                        <div class="col-12 col-md-6">
                            <h2 class="mb-0">
                                <a class="link-underline link-underline-opacity-0 text-dark"
                                    href="{{ route('frontend.news-detail', $item->id) }}">{{ $item->title }}</a>
                            </h2>
                            <div class="py-4">
                                <small><strong>{{ dateFormat($item->date) }}</strong></small><br>
                                <span class="opacity-75">{!! Str::limit($item->description, 150) !!}</span>
                            </div>
                            <a class="btn btn-primary" href="{{ route('frontend.news-detail', $item->id) }}">
                                {{ ___('frontend.Read more') }}
                            </a>
                        </div>
                        <div class="col-12 col-md-6">
                            <a href="{{ route('frontend.news-detail', $item->id) }}" class="thumb">
                                <img height="400" src="{{ @globalAsset(@$item->upload->path, '400X400.svg') }}"
                                    alt="Image" class="w-100">
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <!-- Blog start -->


    <!-- Gallery area -->
    <div class="gallery">
        <div class="container py-5">

            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <div class="text-center">
                        <h2>{{ $sections['our_gallery']->name }}</h2>
                        <p>{{ $sections['our_gallery']->description }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="mb-3" id="buttons"></div>
                <div id="gallery">
                    @foreach ($data['gallery'] as $item)
                        <img src="{{ @globalAsset(@$item->upload->path, '400X400.svg') }}"
                            data-tags="{{ $item->category->name }}" alt="lemon" />
                    @endforeach
                </div>
            </div>

        </div>

    </div>
    <!-- Gallery area -->
@endsection

@push('style')
    <style>
        #buttons {
            text-align: center;
        }

        #buttons button {
            color: #845ADF;
            background: #F2EEFC;
            border: 0;
            padding: 4px 10px;
            margin: 0 5px;
            border-radius: 5px;
        }

        #buttons button:hover,
        #buttons button.active {
            color: white;
            background: #845ADF;
            cursor: pointer;
        }




        #gallery {
            text-align: center;
            margin: 0 auto;
        }

        #gallery img {
            width: 24%;
            margin-bottom: 4px;
        }
    </style>
@endpush

@push('script')
    <script>
        (function() {

            var $imgs = $('#gallery img');
            var $buttons = $('#buttons');
            var tagged = {};

            $imgs.each(function() {
                var img = this;
                var tags = $(this).data('tags');

                if (tags) {
                    tags.split(',').forEach(function(tagName) {
                        if (tagged[tagName] == null) {
                            tagged[tagName] = [];
                        }
                        tagged[tagName].push(img);
                    });
                }
            });

            $('<button/>', {
                text: 'All',
                class: 'active',
                click: function() {
                    $(this)
                        .addClass('active')
                        .siblings()
                        .removeClass('active');
                    $imgs.show();
                }
            }).appendTo($buttons);

            $.each(tagged, function(tagName) {
                $('<button/>', {
                    text: tagName + ' (' + tagged[tagName].length + ')',
                    click: function() {
                        $(this)
                            .addClass('active')
                            .siblings()
                            .removeClass('active');
                        $imgs
                            .hide()
                            .filter(tagged[tagName])
                            .show();
                    }
                }).appendTo($buttons);
            });

        }());
    </script>
@endpush
