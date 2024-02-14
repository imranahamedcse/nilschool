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

    <!-- eventList_area::start  -->
    <div class="news">
        <div class="container py-5">

            <div class="row align-items-center mb_30">


                @foreach ($data['news'] as $item)
                    <div class="col-xl-4 col-lg-4 col-md-4 mb_24 grid-item cat4">
                        <div class="card mb-4">
                            <a href="{{ route('frontend.news-detail', $item->id) }}">
                                <img height="480" src="{{ @globalAsset(@$item->upload->path, '600X480.svg') }}"
                                    alt="Image" class="img-fluid rounded-top">
                            </a>
                            <div class="card-body lh-sm">
                                <a class="link-underline link-underline-opacity-0 text-dark"
                                    href="{{ route('frontend.news-detail', $item->id) }}"><strong>{{ $item->title }}</strong></a><br>
                                <small class="opacity-75">{!! Str::limit($item->description, 75) !!}</small><br>

                                <a class="btn btn-sm btn-primary mt-3"
                                    href="{{ route('frontend.news-detail', $item->id) }}">{{ ___('frontend.Read more') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
            <div class="row mt-4">
                <div class="col-12">
                    @if ($data['news']->currentPage() == 1)
                        <a class="btn btn-secondary"
                            href="javascript:void(0)">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    @else
                        <a class="btn btn-secondary"
                            href="{{ url('news?page=') }}{{ $data['news']->currentPage() - 1 }}">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    @endif


                    @foreach ($data['news']->links()['elements'][0] as $key => $item)
                        <a class="btn btn-secondary {{ $key == $data['news']->currentPage() ? 'active' : '' }}"
                            href="{{ $item }}">{{ $key }}</a>
                    @endforeach

                    @if ($data['news']->currentPage() == count($data['news']->links()['elements'][0]))
                        <a class="btn btn-secondary"
                            href="javascript:void(0)">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    @else
                        <a class="btn btn-secondary"
                            href="{{ url('news?page=') }}{{ $data['news']->currentPage() + 1 }}">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- eventList_area::end  -->
@endsection

@push('style')
    <style>
        .btn-primary {
            color: #845ADF !important;
            background: #F2EEFC !important;
            border: 0 !important;
        }
    </style>
@endpush
