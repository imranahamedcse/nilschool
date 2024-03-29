@extends('frontend.admission.master')
@section('title')
    {{ ___('frontend.Campus') }}
@endsection

@section('mainSection')
    <h3 class="fw-semibold text-dark">{{ $data->title}}</h3>
    <div class="border-bottom mb-3"></div>

    <div class="mb-3">
        {!! $data->description !!}
    </div>
@endsection
