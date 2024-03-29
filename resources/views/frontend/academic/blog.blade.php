@extends('frontend.academic.master')
@section('title')
    {{ ___('frontend.Blogs') }}
@endsection

@section('mainSection')
    <h3 class="fw-semibold text-dark">Blogs</h3>
    <div class="border-bottom mb-3"></div>
    <div class="mb-3">

        <!-- About start  -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    @foreach ($data['abouts'] as $key => $item)
                        @if ($key % 2 == 0)
                            <div class="row align-items-center mb-4">
                                <div class="col-12 col-lg-6">
                                    <img width="100%" src="{{ @globalAsset(@$item->upload->path, '800X500.svg') }}"
                                        alt="Image">
                                </div>
                                <div class="col-12 col-lg-6 text-center text-lg-start">
                                    <img height="60" src="{{ @globalAsset(@$item->icon_upload->path, '90X60.svg') }}"
                                        alt="Image" class="mb-4"><br>
                                    <h6 class="text-dark fw-semibold m-0">{{ $item->name }}</h6>
                                    <span class="opacity-75">{{ $item->description }}</span>
                                </div>
                            </div>
                        @else
                            <div class="row align-items-center mb-4">
                                <div class="col-12 col-lg-6 text-center text-lg-end">
                                    <img height="60" src="{{ @globalAsset(@$item->icon_upload->path, '90X60.svg') }}"
                                        alt="Image" class="mb-4"><br>
                                    <h6 class="text-dark fw-semibold m-0">{{ $item->name }}</h6>
                                    <span class="opacity-75">{{ $item->description }}</span>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <img width="100%" src="{{ @globalAsset(@$item->upload->path, '800X500.svg') }}"
                                        alt="Image">
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- About end  -->

    </div>
@endsection
