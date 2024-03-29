@extends('frontend.partials.master')

@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-2 bg-primary text-light min-vh-100">
                <div class="side_bar w-100 p-3">
                    <h5 class="fw-semibold ps-3 border-bottom border-1 pb-2">Admission</h5>
                    <ul class="list-group list-group-flush">
                        <a href="{{ route('admission.why-our-school') }}" class="list-group-item list-group-item-action {{ active_menu(['*/why-our-school']) }}">Why Our
                            School</a>
                        <a href="{{ route('admission.how-to-apply') }}" class="list-group-item list-group-item-action {{ active_menu(['*/how-to-apply']) }}">How to apply</a>
                        <a href="{{ route('admission.admission-process') }}" class="list-group-item list-group-item-action {{ active_menu(['*/admission-process']) }}">Admission
                            Process</a>
                        <a href="{{ route('admission.financial-assistances') }}" class="list-group-item list-group-item-action {{ active_menu(['*/financial-assistances']) }}">Financial
                            Assistances</a>
                        <a href="{{ route('admission.fees') }}" class="list-group-item list-group-item-action {{ active_menu(['*/fees']) }}">Fees</a>
                        <a href="{{ route('admission.faq') }}" class="list-group-item list-group-item-action {{ active_menu(['*/faq']) }}">FAQ</a>
                        <a href="{{ route('admission.cumpus') }}" class="list-group-item list-group-item-action {{ active_menu(['*/cumpus']) }}">Campus</a>
                        <a href="{{ route('admission.apply-online') }}" class="list-group-item list-group-item-action {{ active_menu(['*/apply-online']) }}">Apply Online</a>
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
