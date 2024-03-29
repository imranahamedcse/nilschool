@extends('frontend.partials.master')

@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-2 bg-primary text-light min-vh-100">
                <div class="side_bar w-100 p-3">
                    <h5 class="fw-semibold ps-3 border-bottom border-1 pb-2">Key Information</h5>
                    <ul class="list-group list-group-flush">
                        <a href="{{ route('information.career') }}" class="list-group-item list-group-item-action {{ active_menu(['*/career']) }}">Career</a>
                        <a href="{{ route('information.downloadable-forms') }}" class="list-group-item list-group-item-action {{ active_menu(['*/downloadable-forms']) }}">Downloadable Forms</a>
                        <a href="{{ route('information.lesson-plan') }}" class="list-group-item list-group-item-action {{ active_menu(['*/lesson-plan']) }}">Lesson Plan</a>
                        <a href="{{ route('information.payment') }}" class="list-group-item list-group-item-action {{ active_menu(['*/payment']) }}">Payment</a>
                        <a href="{{ route('information.result') }}" class="list-group-item list-group-item-action {{ active_menu(['*/result']) }}">Result</a>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="container px-0 pt-2">

                    @yield('mainSection')

                </div>
            </div>
            <div class="col-12 col-lg-2">
            </div>
        </div>
    </div>
@endsection
