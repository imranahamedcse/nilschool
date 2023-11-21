<header class="header">
    <button class="close-toggle sidebar-toggle p-0">
        <img src="{{ asset('backend') }}/assets/images/icons/hammenu-2.svg" alt="" />
    </button>
    <div class="spacing-icon">
        <div class="header-search tab-none">
            <div class="search-icon">
                <i class="las la-search"></i>
            </div>
            <input class="search-field ot_input" id="search_field" type="text"
                placeholder="{{ ___('common.search_page') }}" onkeyup="searchMenu()">
            <div id="autoCompleteData" class="d-none">
                <ul class="search_suggestion">

                </ul>
            </div>
        </div>

        @if (hasPermission('report_attendance_read'))
        <div class="teacher_student_count d-flex align-items-center gap-3">
            <div class="teacher_student_count_item d-flex align-items-center">
                <i class="las la-user-tie" ></i>
                <p class="m-0">{{ ___('common.Student present')}}: <span>{{ @$attendance['present_student'] }}</span> {{ ___('common.& Absent')}}: <span class="absent_text">{{ @$attendance['absent_student'] }}</span></p>
            </div>
        </div>
        @endif

        <div class="header-controls">
            <div class="header-control-item md-none">
                <div class="item-content language-currceny-container">
                    <button class="language-currency-btn d-flex align-items-center mt-0" type="button" id="language_change" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="icon-flag">
                            <i class="{{ @$language['language']->icon_class }} rounded-circle icon"></i>
                        </div>
                        <h6>{{ @$language['language']->name }}</h6>
                    </button>

                    <div class="language-currency-dropdown dropdown-menu dropdown-menu-end top-navbar-dropdown-menu ot-card" aria-labelledby="language_change">

                        <div class="lanuage-currency-">
                            <div class="dropdown-item-list language-list mb-20">
                                <h5>{{ ___('common.language') }}</h5>
                                <select name="language" id="language_with_flag" class="form-select ot-input mb-3 language-change" aria-label="Default select example">
                                    @foreach ($language['languages'] as $row)
                                    <option data-icon="{{ $row->icon_class }}" value="{{ $row->code }}" {{ $row->code == \Session::get('locale') ? 'selected' : '' }}>
                                        {{ $row->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="header-control-item md-none">
                <div class="item-content language-currceny-container">
                    <button class="language-currency-btn d-flex align-items-center mt-0" type="button" id="language_change" data-bs-toggle="dropdown" aria-expanded="false">

                        <h6>{{ ___('settings.Sessions') }}: {{ @$session['session']->name }}</h6>
                    </button>

                    <div class="language-currency-dropdown dropdown-menu dropdown-menu-end top-navbar-dropdown-menu ot-card" aria-labelledby="language_change">

                        <div class="lanuage-currency-">
                            <div class="dropdown-item-list language-list mb-20">
                                <h5>{{ ___('settings.sessions') }}</h5>
                                <select name="language" id="language_with_flag" class="form-select ot-input mb-3 session-change" aria-label="Default select example">
                                    @foreach ($session['sessions'] as $row)
                                    <option value="{{ $row->id }}" {{ $row->id == setting('session') ? 'selected' : '' }}>
                                        {{ $row->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="header-control-item">
                <div class="dropdown theme_dropdown ">
                    <button id="button" class="btn "><i class="lar la-sun"></i></button>
                </div>
            </div>
            <div class="header-control-item">
                <div class="item-content dropdown md-none">
                    <button class="mt-0 p-0" onclick="javascript:toggleFullScreen()">
                        <img class="icon" src="{{ asset('backend/assets/images/icons/full-screen.svg') }}" alt="check in" />
                    </button>
                </div>
            </div>


            <div class="header-control-item">
                <div class="item-content">
                    <button class="profile-navigate mt-0 p-0" type="button" id="profile_expand" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="profile-photo user-card">
                            <img src="{{ @globalAsset(Auth::user()->upload->path, '40X40.webp') }}" alt="{{ Auth::user()->name }}">
                        </div>
                        <div class="profile-info md-none">
                            <h6>{{ Auth::user()->name }}</h6>
                            <p>{{ @Auth::user()->role->name }}</p>
                        </div>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end profile-expand-dropdown top-navbar-dropdown-menu ot-card" aria-labelledby="profile_expand">
                        <div class="profile-expand-container">
                            <div class="profile-expand-list d-flex flex-column">
                                <a class="profile-expand-item {{ set_menu(['my.profile'], 'active') }}" href="{{ route('my.profile') }}">
                                    <span>{{ ___('common.my_profile') }}</span>
                                </a>
                                <a class="profile-expand-item {{ set_menu(['passwordUpdate'], 'active') }}" href="{{ route('passwordUpdate') }}">
                                    <span>{{ ___('common.update_password') }}</span>
                                </a>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="profile-expand-item">
                                        <span>
                                            {{ ___('common.logout') }}</span>
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</header>