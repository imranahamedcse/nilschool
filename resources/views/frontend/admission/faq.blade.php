@extends('frontend.admission.master')
@section('title')
    {{ ___('frontend.FAQ') }}
@endsection

@section('mainSection')
    <h3 class="fw-semibold text-dark">FAQ</h3>
    <div class="border-bottom mb-3"></div>

    @foreach ($items as $key=>$item)
        <div class="card mb-3">
            <div class="card-body">
                <a href="" class="text-primary fw-semibold" data-bs-toggle="collapse" data-bs-target="#que{{$key}}">{{ $item->question }}</a>
                <div id="que{{$key}}" class="collapse">{{ $item->answer }}</div>
            </div>
        </div>
    @endforeach
@endsection
