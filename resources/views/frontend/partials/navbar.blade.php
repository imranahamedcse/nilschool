    <!-- HEADER::START -->
    <header>
        <div class="bg-primary text-light">
            <div class="container py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span>{{ setting('phone') }}</span>
                        <span>{{ setting('email') }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        {{-- <select class="form-control language-change">
                            @foreach (@$language['languages'] as $row)
                                <option value="{{ $row->code }}"
                                    {{ $row->code == \Session::get('locale') ? 'selected' : '' }}>
                                    {{ $row->name }}
                                </option>
                            @endforeach
                        </select> --}}
                        <div class="dropdown">
                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
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
                                <a class="btn btn-sm btn-primary" target="_blank" href="{{ $item['link'] }}"><i class="{{ $item['icon'] }}"></i></a>
                            @endforeach
                        </div>

                        <div>
                            @if (!\Auth::check())
                                <a class="btn btn-sm btn-primary" href="{{ route('login') }}">{{ ___('frontend.Login') }} </a>
                            @else
                                @if (\Auth::user()->role_id == 6)
                                    <a class="btn btn-sm btn-primary" href="{{ route('student-panel-dashboard.index') }}">{{ ___('frontend.Dashboard') }}
                                    </a>
                                @elseif(\Auth::user()->role_id == 7)
                                    <a class="btn btn-sm btn-primary" href="{{ route('parent-panel-dashboard.index') }}">{{ ___('frontend.Dashboard') }}
                                    </a>
                                @else
                                    <a class="btn btn-sm btn-primary" href="{{ route('dashboard') }}">{{ ___('frontend.Dashboard') }} </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('frontend.home') }}">
                    {{-- <img src="{{ @globalAsset(setting('dark_logo'), '150X40.svg') }}" alt="Logo"> --}}
                    <img height="40" src="{{ @globalAsset(setting('light_logo'), '150X40.svg') }}" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.home') }}">{{ ___('frontend.Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('frontend.about') }}">{{ ___('frontend.About') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.news') }}">{{ ___('frontend.News') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('frontend.events') }}">{{ ___('frontend.Events') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('frontend.result') }}">{{ ___('frontend.Result') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('frontend.contact') }}">{{ ___('frontend.Contact Us') }}</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        <a class="btn btn-sm btn-outline-light"
                            href="{{ route('frontend.online-admission') }}">{{ ___('frontend.Online Admission') }}</a>
                    </span>
                </div>
            </div>
        </nav>
    </header>
    <!--/ HEADER::END -->
