@extends('frontend.academic.master')
@section('title')
    {{ ___('frontend.Teachers') }}
@endsection

@section('mainSection')
    <h3 class="fw-semibold text-dark">Teachers</h3>
    <div class="border-bottom mb-3"></div>
    <div class="mb-3">

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
                        <div class="col-12 col-lg-3 col-md-6">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img height="100" class="my-4 rounded-circle"
                                        src="{{ @globalAsset(@$item->upload->path, '100X100.svg') }}" alt="Image"><br>
                                    <p class="lh-1 py-2">
                                        <span class="text-dark h6 fw-semibold m-0">{{ @$item->first_name }}
                                            {{ @$item->last_name }}</span><br>
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
    </div>
@endsection
