
    <!-- FOOTER::START  -->
    <footer class="home_three_footer">
        <div class="main_footer_wrap">
            <div class="container">
                 <div class="row">
                    <div class="col-xl-5 col-lg-4 col-md-6">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="#">
                                    <img height="60" src="{{ @globalAsset(setting('light_logo'), '154X38.webp') }}" alt="Logo">
                                </a>
                            </div>
                            <p class="description_text">{{ setting('school_about') }}</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer_widget">
                            <div class="footer_title">
                                <h3>{{ ___('frontend.Menus') }}</h3>
                            </div>
                            <ul class="footer_links">
                                <li><a href="{{ route('frontend.home') }}">{{ ___('frontend.Home') }}</a></li>
                                <li><a href="{{ route('frontend.about') }}">{{ ___('frontend.About') }}</a></li>
                                <li><a href="{{ route('frontend.news') }}">{{ ___('frontend.News') }}</a></li>
                                <li><a href="{{ route('frontend.events') }}">{{ ___('frontend.Events') }}</a></li>
                                <li><a href="{{ route('frontend.result') }}">{{ ___('frontend.Result') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4  col-md-6">
                        <div class="footer_widget">
                            <div class="footer_title">
                                <h3>{{ ___('frontend.subscribe to newsletter') }}</h3>
                            </div>
                            <p class="subscribe_text">{{ ___('frontend.Join us and get weekly inspiration') }}</p>
                            <div class="subcribe-form mb_20 theme_mailChimp2">
                                <form action="" method="get" class="subscription relative">
                                    <input name="email" class="email form-control" placeholder="{{ ___('frontend.Type e-mail address') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Type e-mail address…'" required="" type="email">
                                    <button type="submit" class="submit-btn">{{ ___('frontend.Subscribe') }}</button>
                                </form>
                            </div>
                            <div class="social__Links">
                                @foreach ($sections['social_links']->data as $item)
                                    <a target="_blank" href="{{ $item['link'] }}"><i class="{{ $item['icon'] }}"></i></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright_area p-0">
            <div class="container">
                <div class="footer_border m-0"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="copy_right_text d-flex align-items-center gap_20 flex-wrap justify-content-center">
                            <p>{{ setting('footer_text') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER::END  -->
