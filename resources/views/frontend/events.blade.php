@extends('frontend.partials.master')
@section('title')
    {{ ___('frontend.Events') }}
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
                <h3 class="fw-semibold">{{ $sections['coming_up']->name }}</h3>
                <h6>{{ $sections['coming_up']->description }}</h6>
            </div>
        </div>

        <div class="page_items container">
            <div class="row align-items-center">

                @foreach ($data['events'] as $item)
                    <div class="col-xl-4 col-lg-4 col-md-4 mb_24">
                        <div class="card mb-4">
                            <a href="{{ route('frontend.events-detail', $item->id) }}" class="">
                                <img height="480" src="{{ @globalAsset(@$item->upload->path, '600X480.svg') }}"
                                    alt="Image" class="img-fluid rounded-top">
                            </a>
                            <div class="card-body lh-sm">
                                <h6 class="fw-semibold">
                                    <a class="link-underline link-underline-opacity-0 text-dark"
                                        href="{{ route('frontend.events-detail', $item->id) }}"><strong>{{ $item->title }}</strong></a>
                                </h6>

                                <small>{!! Str::limit($item->description, 100) !!}</small><br>
                                <a class="btn btn-sm btn-primary mt-3"
                                    href="{{ route('frontend.events-detail', $item->id) }}">{{ ___('frontend.Read more') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="row mb-4">
                <div class="col-12 text-end">
                    @if ($data['events']->currentPage() == 1)
                        <a class="btn btn-secondary" href="javascript:void(0)">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    @else
                        <a class="btn btn-secondary"
                            href="{{ url('events?page=') }}{{ $data['events']->currentPage() - 1 }}">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    @endif

                    @foreach ($data['events']->links()['elements'][0] as $key => $item)
                        <a class="btn btn-secondary {{ $key == $data['events']->currentPage() ? 'active' : '' }}"
                            href="{{ $item }}">{{ $key }}</a>
                    @endforeach

                    @if ($data['events']->currentPage() == count($data['events']->links()['elements'][0]))
                        <a class="btn btn-secondary" href="javascript:void(0)">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    @else
                        <a class="btn btn-secondary"
                            href="{{ url('events?page=') }}{{ $data['events']->currentPage() + 1 }}">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Events end  -->
@endsection
