    <!-- HEADER::START -->
    <header>
        <div class="bg-primary text-light">
            @if (Setting('latest_news') != '')
                <div class="d-none d-lg-inline">
                    <marquee class="bg-dark py-1" behavior="scroll" direction="left" onmouseover="this.stop();"
                        onmouseout="this.start();">
                        <a class="text-decoration-none text-warning" href="">{{ Setting('latest_news') }}</a>
                    </marquee>
                </div>
            @endif
            <div class="container pb-1">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span>{{ setting('phone') }}</span>
                        <span>{{ setting('email') }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-globe"></i> EN
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">English</a></li>
                                <li><a class="dropdown-item" href="#">Bangla</a></li>
                                <li><a class="dropdown-item" href="#">Hindi</a></li>
                            </ul>
                        </div>

                        <div class="d-none d-sm-flex mx-1">
                            @foreach ($sections['social_links']->data as $item)
                                <a class="btn btn-sm btn-light" target="_blank" href="{{ $item['link'] }}"><i
                                        class="{{ $item['icon'] }}"></i></a>
                            @endforeach
                        </div>

                        <div>
                            @if (!\Auth::check())
                                <a class="btn btn-sm btn-light" href="{{ route('login') }}">{{ ___('frontend.Login') }}
                                </a>
                            @else
                                @if (\Auth::user()->role_id == 6)
                                    <a class="btn btn-sm btn-light"
                                        href="{{ route('student-panel-dashboard.index') }}">{{ ___('frontend.Dashboard') }}
                                    </a>
                                @elseif(\Auth::user()->role_id == 7)
                                    <a class="btn btn-sm btn-light"
                                        href="{{ route('parent-panel-dashboard.index') }}">{{ ___('frontend.Dashboard') }}
                                    </a>
                                @else
                                    <a class="btn btn-sm btn-light"
                                        href="{{ route('dashboard') }}">{{ ___('frontend.Dashboard') }} </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('frontend.home') }}">
                    {{-- <img src="{{ @globalAsset(setting('dark_logo'), '150X40.svg') }}" alt="Logo"> --}}
                    <img height="40" src="{{ @globalAsset(setting('light_logo'), '150X40.svg') }}" alt="Logo">
                </a>
                <button class="navbar-toggler btn-primary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ active_menu(['/']) }}" href="{{ route('frontend.home') }}">{{ ___('frontend.Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_menu(['about']) }}" href="{{ route('frontend.about') }}">{{ ___('frontend.About') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_menu(['academic', 'academic/*']) }}"
                                href="{{ route('academic.index') }}">{{ ___('frontend.Academics') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ active_menu(['admission', 'admission/*']) }}"
                                href="{{ route('admission.index') }}">{{ ___('frontend.Admission') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ active_menu(['information', 'information/*']) }}"
                                href="{{ route('information.index') }}">{{ ___('frontend.Key Information') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_menu(['news']) }}" href="{{ route('frontend.news') }}">{{ ___('frontend.News') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_menu(['events']) }}" href="{{ route('frontend.events') }}">{{ ___('frontend.Events') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_menu(['contact']) }}"
                                href="{{ route('frontend.contact') }}">{{ ___('frontend.Contact Us') }}</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        <a class="btn btn-sm btn-primary"
                            href="{{ route('frontend.online-admission') }}">{{ ___('frontend.Online Admission') }}</a>
                    </span>
                </div>
            </div>
        </nav>
    </header>
    <!--/ HEADER::END -->
