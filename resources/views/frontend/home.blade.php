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
                    <img src="{{ @globalAsset(@$item->upload->path, '1920X700.svg') }}" class="d-block w-100"
                        alt="Image">
                    <div class="carousel-caption h-100 d-inline-block">
                        <div class="row h-100">
                            <div class="col"></div>
                            <div class="col">
                                <div class=" h-100 d-flex justify-content-center align-items-center">
                                    <div class="text-start d-none d-md-inline">
                                        <p class="display-5 fw-bold mb-4"><strong>{{ $item->name }}</strong></p>
                                        <p class="h5 mb-5">{{ $item->description }}</p>
                                        <a href="{{ route('frontend.about') }}"
                                            class="btn btn-lg btn-outline-light">{{ ___('frontend.Read more') }}</a>
                                        <a href="{{ route('frontend.contact') }}"
                                            class="btn btn-lg btn-outline-light mx-4">{{ ___('frontend.Contact Us') }}</a>
                                    </div>
                                    <div class="text-start d-md-none"> <!-- responsive -->
                                        <strong>{{ $item->name }}</strong>
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
                                        <input type="hidden" name="" class="countVal{{ $loop->iteration }}" value="{{ $item->total_count }}">
                                        {{-- <h3 class="text-dark fw-semibold mb-0"><strong>{{ $item->total_count }}+</strong></h3> --}}
                                        <h3 class="text-dark fw-semibold mb-0"><strong><span id="count{{ $loop->iteration }}"></span>+</strong></h3>
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
                <div class="col-12 col-lg-6">
                    <div class="py-5 text-center text-lg-end">
                        <h3 class="text-dark fw-semibold">{{ $sections['statement']->name }}</h3>

                        @foreach ($sections['statement']->data as $item)
                            <h6 class="text-dark fw-semibold">{{ $loop->iteration }}. {{ $item['title'] }}</h6>
                            <p>{{ $item['description'] }}</p>
                        @endforeach

                        <a class="mt-3 btn btn-primary"
                            href="{{ route('frontend.about') }}">{{ ___('frontend.Read more') }}</a>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <img width="100%" src="{{ @globalAsset(@$sections['statement']->upload->path, '500X500.svg') }}" alt="Image">
                </div>
            </div>
        </div>
    </div>
    <!-- Statement end -->

    <!-- Explorer area start -->
    <div class="explorer">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <img class="w-100" src="{{ @globalAsset(@$sections['explore']->upload->path, '500X500.svg') }}"
                        alt="Image">
                </div>
                <div class="col-12 col-lg-6">

                    <div class="mb-5 text-center text-lg-start">
                        <h3 class="text-dark fw-semibold m-0">{{ $sections['explore']->name }}</h3>
                        <p>{{ $sections['explore']->description }}</p>
                    </div>

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @foreach ($sections['explore']->data as $key => $item)
                                <button class="nav-link text-dark fw-semibold {{ $key == 0 ? 'active' : '' }}" id="nav-{{ $key }}-tab"
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
                                <p>{{ $item['description'] }}</p>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Explorer area end -->


    <!-- Teaching area start -->
    <div class="why_choose_us text-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h3 class="fw-semibold">{{ $sections['why_choose_us']->name }}</h3>
                <p>{{ $sections['why_choose_us']->description }}</p>
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
            <div class="row justify-content-center pb-5">
                <div class="col-lg-8 col-md-8">
                    <div class="text-center">
                        <h3 class="text-dark fw-semibold">{{ $sections['coming_up']->name }}</h3>
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
                                            <span class="h6 text-dark fw-semibold m-0">{{ $item->title }}</span><br>
                                            <span>{{ dateFormat($item->date) }}</span>
                                        </p>
                                        <small>{{ timeFormat($item->start_time) }} -
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

    <!-- Gallery area -->
    <div class="gallery">
        <div class="container py-5">

            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <div class="text-center">
                        <h3 class="text-dark fw-semibold">{{ $sections['our_gallery']->name }}</h3>
                        <p>{{ $sections['our_gallery']->description }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="mb-3" id="buttons"></div>
                <div id="gallery">
                    @foreach ($data['gallery'] as $item)
                        <img class="animate__animated animate__zoomIn" src="{{ @globalAsset(@$item->upload->path, '400X400.svg') }}"
                            data-tags="{{ $item->category->name }}" alt="lemon" />
                    @endforeach
                </div>
            </div>

        </div>

    </div>
    <!-- Gallery area -->
@endsection

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
