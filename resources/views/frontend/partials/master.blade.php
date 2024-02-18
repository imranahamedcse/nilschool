@extends('master')

@section('maintitle')
    @yield('title')
@endsection

@push('mainstyle')
    @stack('style')
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css">
@endpush

@section('mainsection')
    @include('frontend.partials.navbar')

    @yield('main')

    @include('frontend.partials.footer-content')
@endsection

@push('mainscript')
    @stack('script')
    <script src="{{ asset('frontend') }}/js/script.js"></script>
    <script src="{{ asset('backend/js/sweetalert2.js') }}"></script>
@endpush
