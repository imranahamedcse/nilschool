@extends('master')

@section('maintitle')
  @yield('title')
@endsection

@push('mainstyle')
  <link rel="stylesheet" href="{{ asset('backend/css/sidebar.css') }}">
  @stack('style')
@endpush

@section('mainsection')
  @include('backend.admin.partial.sidebar')

  <div class="home-section p-4">
    @include('backend.admin.partial.header')
    @yield('content')
  </div>

  {{-- @include('backend.admin.partial.footer') --}}
@endsection

@push('mainscript')
  <script src="{{ asset('backend/js/sidebar.js') }}"></script>
  @stack('script')
@endpush