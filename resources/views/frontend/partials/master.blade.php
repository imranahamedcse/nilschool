@extends('master')

@section('maintitle')
    @yield('title')
@endsection

@push('mainstyle')
    @stack('style')
    <style>
        .bg-primary {
            background: #845ADF !important;
        }

        .btn-primary {
            color: white;
            background: #845ADF;
            border: 0;
        }

        .btn-primary:hover {
            color: #845ADF;
            background: #F2EEFC;
            border: 0;
        }

        .counter {
            background-color: #F9FAFB;
        }

        .statement {
            background-color: #F0F1F7;
        }

        .study_at {
            background-color: #F9FAFB;
        }

        .bg-primary-light {
            background-color: #F2EEFC;
        }
        .why_choose_us{
            background-color: #845ADF;
        }
        .comming_up{
            background-color: #F9FAFB;
        }
        .footer {
            background-color: #1F1F20;
            color: #A4A4A5;
        }
        .footer a {
            text-decoration: none;
            color: #A4A4A5;
        }
        .footer input {
            background: transparent;
            color: #A4A4A5;
        }
    </style>
@endpush

@section('mainsection')
    @include('frontend.partials.navbar')

    @yield('main')

    @include('frontend.partials.footer-content')
@endsection

@push('mainscript')
    @stack('script')
@endpush
