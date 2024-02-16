<!-- Footer start -->
<div class="footer">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-lg-4 text-center text-lg-start">
                <a href="#">
                    <img height="60" src="{{ @globalAsset(setting('light_logo'), '150X40.svg') }}" alt="Logo">
                </a>
                <p class="mt-3">{{ setting('school_about') }}</p>
            </div>
            <div class="col-12 col-lg-4 text-center">
                <h5 class="text-light">{{ ___('frontend.Menus') }}</h5>
                <a href="{{ route('frontend.home') }}">{{ ___('frontend.Home') }}</a><br>
                <a href="{{ route('frontend.about') }}">{{ ___('frontend.About') }}</a><br>
                <a href="{{ route('frontend.news') }}">{{ ___('frontend.News') }}</a><br>
                <a href="{{ route('frontend.events') }}">{{ ___('frontend.Events') }}</a><br>
                <a href="{{ route('frontend.result') }}">{{ ___('frontend.Result') }}</a><br>
            </div>
            <div class="col-12 col-lg-4 text-center text-lg-start">
                <h5 class="text-light">{{ ___('frontend.subscribe to newsletter') }}</h5>
                <p>{{ ___('frontend.Join us and get weekly inspiration') }}</p>

                <div class="input-group mb-3">
                    <input name="email" class="email form-control"
                        placeholder="{{ ___('frontend.Type e-mail address') }}" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Type e-mail address…'" required="" type="email">
                    <button type="submit" class="btn btn-outline-light">{{ ___('frontend.Subscribe') }}</button>
                </div>

                @foreach ($sections['social_links']->data as $item)
                    <a class="btn" target="_blank" href="{{ $item['link'] }}"><i
                            class="{{ $item['icon'] }}"></i></a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="border-top border-dark text-center">
        <p class="py-4 m-0">{{ setting('footer_text') }}</p>
    </div>
</div>


<!-- Footer start -->
