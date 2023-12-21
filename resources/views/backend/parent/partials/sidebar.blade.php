<div class="sidebar">
    <ul class="menu-group">
        <div class="logo">
            <i class="fa-solid fa-graduation-cap"></i>
            <span class="logo-name">nilschool</span>
        </div>

        <li>
            <a class="{{ set_menu(['parent-panel-dashboard*']) }}" href="{{ route('parent-panel-dashboard.index') }}">
                <i class="prepend-icon fa-solid fa-desktop"></i>
                <span class="link-name">{{ ___('menu.Dashboard') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['parent-panel-dashboard*']) }}">
                    <a href="{{ route('parent-panel-dashboard.index') }}"
                        class="link-name">{{ ___('menu.Dashboard') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['parent-panel-subject-list*']) }}"
                href="{{ route('parent-panel-subject-list.index') }}">
                <i class="prepend-icon fa-solid fa-desktop"></i>
                <span class="link-name">{{ ___('menu.Subject list') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['parent-panel-subject-list*']) }}">
                    <a href="{{ route('parent-panel-subject-list.index') }}"
                        class="link-name">{{ ___('menu.Subject list') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['parent-panel-class-routine*']) }}"
                href="{{ route('parent-panel-class-routine.index') }}">
                <i class="prepend-icon fa-solid fa-desktop"></i>
                <span class="link-name">{{ ___('menu.Class routine') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['parent-panel-class-routine*']) }}">
                    <a href="{{ route('parent-panel-class-routine.index') }}"
                        class="link-name">{{ ___('menu.Class routine') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['parent-panel-fees*']) }}" href="{{ route('parent-panel-fees.index') }}">
                <i class="prepend-icon fa-solid fa-desktop"></i>
                <span class="link-name">{{ ___('menu.Fees') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['parent-panel-fees*']) }}">
                    <a href="{{ route('parent-panel-fees.index') }}" class="link-name">{{ ___('menu.Fees') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['parent-panel-exam-routine*']) }}"
                href="{{ route('parent-panel-exam-routine.index') }}">
                <i class="prepend-icon fa-solid fa-desktop"></i>
                <span class="link-name">{{ ___('menu.Exam routine') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['parent-panel-exam-routine*']) }}">
                    <a href="{{ route('parent-panel-exam-routine.index') }}"
                        class="link-name">{{ ___('menu.Exam routine') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['parent-panel-marksheet*']) }}"
                href="{{ route('parent-panel-marksheet.index') }}">
                <i class="prepend-icon fa-solid fa-desktop"></i>
                <span class="link-name">{{ ___('menu.Marksheet') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['parent-panel-marksheet*']) }}">
                    <a href="{{ route('parent-panel-marksheet.index') }}"
                        class="link-name">{{ ___('menu.Marksheet') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['parent-panel-attendance*']) }}"
                href="{{ route('parent-panel-attendance.index') }}">
                <i class="prepend-icon fa-solid fa-desktop"></i>
                <span class="link-name">{{ ___('menu.Attendance') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['parent-panel-attendance*']) }}">
                    <a href="{{ route('parent-panel-attendance.index') }}"
                        class="link-name">{{ ___('menu.Attendance') }}</a>
                </li>
            </ul>
        </li>


    </ul>
</div>
