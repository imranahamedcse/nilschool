@extends('master')

@section('maintitle')
    @yield('title')
@endsection

@push('mainstyle')
    @stack('style')
    <style>
        .gallery-title {
            font-size: 36px;
            color: #42B32F;
            text-align: center;
            font-weight: 500;
            margin-bottom: 70px;
        }

        .gallery-title:after {
            content: "";
            position: absolute;
            width: 7.5%;
            left: 46.5%;
            height: 45px;
            border-bottom: 1px solid #5e5e5e;
        }

        .filter-button {
            font-size: 18px;
            border: 1px solid #42B32F;
            border-radius: 5px;
            text-align: center;
            color: #42B32F;
            margin-bottom: 30px;

        }

        .filter-button:hover {
            font-size: 18px;
            border: 1px solid #42B32F;
            border-radius: 5px;
            text-align: center;
            color: #ffffff;
            background-color: #42B32F;

        }

        .btn-default:active .filter-button:active {
            background-color: #42B32F;
            color: white;
        }

        .port-image {
            width: 100%;
        }

        .gallery_product {
            margin-bottom: 30px;
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
    <script src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend') }}/js/wow.min.js"></script>
    <script>
        // filter items on button click
        $(".portfolio-menu").on("click", "button", function() {
            var filterValue = $(this).attr("data-filter");
            $grid.isotope({
                filter: filterValue
            });
        });

        //for menu active class
        $(".portfolio-menu button").on("click", function(event) {
            $(this).siblings(".active").removeClass("active");
            $(this).addClass("active");
            event.preventDefault();
        });
    </script>
    <script>
        $(document).ready(function() {

            $(".filter-button").click(function() {
                var value = $(this).attr('data-filter');

                if (value == "all") {
                    //$('.filter').removeClass('hidden');
                    $('.filter').show('1000');
                } else {
                    //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
                    //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
                    $(".filter").not('.' + value).hide('3000');
                    $('.filter').filter('.' + value).show('3000');

                }
            });

            if ($(".filter-button").removeClass("active")) {
                $(this).removeClass("active");
            }
            $(this).addClass("active");

        });
    </script>
@endpush
