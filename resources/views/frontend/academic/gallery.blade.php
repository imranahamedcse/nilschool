@extends('frontend.academic.master')
@section('title')
    {{ ___('frontend.Gallery') }}
@endsection

@section('mainSection')
    <h3 class="fw-semibold text-dark">Gallery</h3>
    <div class="border-bottom mb-3"></div>

    <div class="mb-3">

        <!-- Gallery end start -->
        <div class="gallery">
            <div class="container text-center py-lg-5">

                <h3 class="fw-semibold text-dark">{{ @$sections['our_gallery']->name }}</h3>
                <p class="mb-5">{{ @$sections['our_gallery']->description }}</p>

                <div class="row mb-4">
                    <div class="mb-4" id="buttons"></div>
                    <div id="gallery">
                        @foreach ($data['gallery'] as $item)
                            <img width="24.5%" height="400" class="img-fluid animate__animated animate__zoomIn"
                                src="{{ @globalAsset(@$item->upload->path, '400X400.svg') }}"
                                data-tags="{{ $item->category->name }}" alt="lemon" />
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        <!-- Gallery end -->
    </div>
@endsection

@push('script')
    <script>
        (function() {

            var $imgs = $('#gallery img');
            var $buttons = $('#buttons');
            var tagged = {};

            $imgs.each(function() {
                var img = this;
                var tags = $(this).data('tags');

                if (tags) {
                    tags.split(',').forEach(function(tagName) {
                        if (tagged[tagName] == null) {
                            tagged[tagName] = [];
                        }
                        tagged[tagName].push(img);
                    });
                }
            });

            $('<button/>', {
                text: 'All',
                class: 'active',
                click: function() {
                    $(this)
                        .addClass('active')
                        .siblings()
                        .removeClass('active');
                    $imgs.show();
                }
            }).appendTo($buttons);

            $.each(tagged, function(tagName) {
                $('<button/>', {
                    text: tagName + ' (' + tagged[tagName].length + ')',
                    click: function() {
                        $(this)
                            .addClass('active')
                            .siblings()
                            .removeClass('active');
                        $imgs
                            .hide()
                            .filter(tagged[tagName])
                            .show();
                    }
                }).appendTo($buttons);
            });

        }());
    </script>
@endpush
