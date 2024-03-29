@extends('frontend.academic.master')
@section('title')
    {{ ___('frontend.Academic Calendar') }}
@endsection

@section('mainSection')
    <h3 class="fw-semibold text-dark">Academic Calendars</h3>
    <div class="border-bottom mb-3"></div>

    @foreach ($items as $item)
        <div class="card mb-3">
            <div class="card-body">
                <a class="text-primary" href="{{ @globalAsset(@$item->upload->path) }}" target="_blank"
                    rel="noopener noreferrer">{{ $item->name }}</a>
            </div>
        </div>
    @endforeach
@endsection
