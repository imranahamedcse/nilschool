<!-- Footer start -->
<div class="container py-5">
    <div class="row">
        <div class="col-xl-5 col-lg-4 col-md-6">
            <a href="#">
                <img height="60" src="{{ @globalAsset(setting('light_logo'), '150X40.svg') }}" alt="Logo">
            </a>
            <p class="mt-3">{{ setting('school_about') }}</p>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <h3>{{ ___('frontend.Menus') }}</h3>
            <ul class="footer_links">
                <li><a href="{{ route('frontend.home') }}">{{ ___('frontend.Home') }}</a></li>
                <li><a href="{{ route('frontend.about') }}">{{ ___('frontend.About') }}</a></li>
                <li><a href="{{ route('frontend.news') }}">{{ ___('frontend.News') }}</a></li>
                <li><a href="{{ route('frontend.events') }}">{{ ___('frontend.Events') }}</a></li>
                <li><a href="{{ route('frontend.result') }}">{{ ___('frontend.Result') }}</a></li>
            </ul>
        </div>
        <div class="col-lg-4 col-md-6">
            <h3>{{ ___('frontend.subscribe to newsletter') }}</h3>
            <p>{{ ___('frontend.Join us and get weekly inspiration') }}</p>

            <div class="input-group mb-3">
                <input name="email" class="email form-control"
                    placeholder="{{ ___('frontend.Type e-mail address') }}" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Type e-mail address…'" required="" type="email">
                <button type="submit" class="btn btn-danger">{{ ___('frontend.Subscribe') }}</button>
            </div>

            @foreach ($sections['social_links']->data as $item)
                <a class="btn" target="_blank" href="{{ $item['link'] }}"><i
                        class="{{ $item['icon'] }}"></i></a>
            @endforeach
        </div>
    </div>
</div>


<div class="bg-body-tertiary text-center">
    <p class="py-2">{{ setting('footer_text') }}</p>
</div>
<!-- Footer start -->
