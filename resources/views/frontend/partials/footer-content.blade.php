<!-- Footer start -->
<div class="container py-5">
    <div class="row">
        <div class="col-xl-5 col-lg-4 col-md-6">
            <a href="#">
                <img height="60" src="{{ @globalAsset(setting('light_logo'), '154X38.webp') }}" alt="Logo">
            </a>
            <p class="mt-3">{{ setting('school_about') }}</p>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <h3>{{ ___('common.Menus') }}</h3>
            <ul class="footer_links">
                <li><a href="{{ route('frontend.home') }}">{{ ___('common.Home') }}</a></li>
                <li><a href="{{ route('frontend.about') }}">{{ ___('common.About') }}</a></li>
                <li><a href="{{ route('frontend.news') }}">{{ ___('common.News') }}</a></li>
                <li><a href="{{ route('frontend.events') }}">{{ ___('common.Events') }}</a></li>
                <li><a href="{{ route('frontend.result') }}">{{ ___('common.Result') }}</a></li>
            </ul>
        </div>
        <div class="col-lg-4 col-md-6">
            <h3>{{ ___('common.subscribe to newsletter') }}</h3>
            <p>{{ ___('common.Join us and get weekly inspiration') }}</p>

            <div class="input-group mb-3">
                <input name="email" class="email form-control"
                    placeholder="{{ ___('common.Type e-mail address') }}" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Type e-mail address…'" required="" type="email">
                <button type="submit" class="btn btn-danger">{{ ___('common.Subscribe') }}</button>
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
