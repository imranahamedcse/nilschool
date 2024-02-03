<div class="sidebar">
    <ul class="menu-group">
        <div class="logo">
            <i class="fa-solid fa-graduation-cap"></i>
            <span class="logo-name">nilschool</span>
        </div>

        <li>
            <a class="{{ set_menu(['parent-panel/dashboard*']) }}" href="{{ route('parent-panel-dashboard.index') }}">
                <i class="prepend-icon fa-solid fa-desktop"></i>
                <span class="link-name">{{ ___('common.Dashboard') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['parent-panel/dashboard*']) }}">
                    <a href="{{ route('parent-panel-dashboard.index') }}"
                        class="link-name">{{ ___('common.Dashboard') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['parent-panel/subject-list*']) }}"
                href="{{ route('parent-panel-subject-list.index') }}">
                <i class="prepend-icon fa-solid fa-book"></i>
                <span class="link-name">{{ ___('common.Subject list') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['parent-panel/subject-list*']) }}">
                    <a href="{{ route('parent-panel-subject-list.index') }}"
                        class="link-name">{{ ___('common.Subject list') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['parent-panel/class-routine*']) }}"
                href="{{ route('parent-panel-class-routine.index') }}">
                <i class="prepend-icon fa-solid fa-table"></i>
                <span class="link-name">{{ ___('common.Class routine') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['parent-panel/class-routine*']) }}">
                    <a href="{{ route('parent-panel-class-routine.index') }}"
                        class="link-name">{{ ___('common.Class routine') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['parent-panel/fees*']) }}" href="{{ route('parent-panel-fees.index') }}">
                <i class="prepend-icon fa-solid fa-money-bill"></i>
                <span class="link-name">{{ ___('common.Fees') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['parent-panel/fees*']) }}">
                    <a href="{{ route('parent-panel-fees.index') }}" class="link-name">{{ ___('common.Fees') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['parent-panel/exam-routine*']) }}"
                href="{{ route('parent-panel-exam-routine.index') }}">
                <i class="prepend-icon fa-solid fa-graduation-cap"></i>
                <span class="link-name">{{ ___('common.Exam routine') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['parent-panel/exam-routine*']) }}">
                    <a href="{{ route('parent-panel-exam-routine.index') }}"
                        class="link-name">{{ ___('common.Exam routine') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['parent-panel/marksheet*']) }}"
                href="{{ route('parent-panel-marksheet.index') }}">
                <i class="prepend-icon fa-solid fa-clipboard"></i>
                <span class="link-name">{{ ___('common.Marksheet') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['parent-panel/marksheet*']) }}">
                    <a href="{{ route('parent-panel-marksheet.index') }}"
                        class="link-name">{{ ___('common.Marksheet') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['parent-panel/attendance*']) }}"
                href="{{ route('parent-panel-attendance.index') }}">
                <i class="prepend-icon fa-solid fa-file-circle-check"></i>
                <span class="link-name">{{ ___('common.Attendance') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['parent-panel/attendance*']) }}">
                    <a href="{{ route('parent-panel-attendance.index') }}"
                        class="link-name">{{ ___('common.Attendance') }}</a>
                </li>
            </ul>
        </li>


    </ul>
</div>
