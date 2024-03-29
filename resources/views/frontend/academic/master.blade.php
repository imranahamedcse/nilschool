@extends('frontend.partials.master')

@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-2 bg-primary text-light min-vh-100">
                <div class="side_bar w-100 p-3">
                    <h5 class="fw-semibold ps-3 border-bottom border-1 pb-2 m-0">Academic</h5>
                    <ul class="list-group list-group-flush list-group-primary">
                        <a href="{{ route('academic.notices') }}" class="list-group-item list-group-item-action {{ active_menu(['*/notices']) }}">Notice</a>
                        <a href="{{ route('academic.blog') }}" class="list-group-item list-group-item-action {{ active_menu(['*/blog']) }}">Blogs</a>
                        <a href="{{ route('academic.teacher') }}" class="list-group-item list-group-item-action {{ active_menu(['*/teacher']) }}">Teachers</a>
                        <a href="{{ route('academic.calendar') }}" class="list-group-item list-group-item-action {{ active_menu(['*/calendar']) }}">Academic
                            Calendar</a>
                        <a href="{{ route('academic.curriculum') }}" class="list-group-item list-group-item-action {{ active_menu(['*/curriculum']) }}">Our
                            Curriculum</a>
                        <a href="{{ route('academic.facilities') }}"
                            class="list-group-item list-group-item-action {{ active_menu(['*/facilities']) }}">Facilities</a>
                        <a href="{{ route('academic.management') }}"
                            class="list-group-item list-group-item-action {{ active_menu(['*/management']) }}">Management</a>
                        <a href="{{ route('academic.service-support') }}"
                            class="list-group-item list-group-item-action {{ active_menu(['*/service-support']) }}">Services & Supports</a>
                        <a href="{{ route('academic.syllabus') }}"
                            class="list-group-item list-group-item-action {{ active_menu(['*/syllabus']) }}">Syllabus</a>
                        <a href="{{ route('academic.gallery') }}"
                            class="list-group-item list-group-item-action {{ active_menu(['*/gallery']) }}">Gallery</a>
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
