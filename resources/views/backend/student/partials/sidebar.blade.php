<div class="sidebar">
    <ul class="menu-group">
        <div class="logo">
            <i class="fa-solid fa-graduation-cap"></i>
            <span class="logo-name">nilschool</span>
        </div>

        <li>
            <a class="{{ set_menu(['student-panel/dashboard*']) }}" href="{{ route('student-panel-dashboard.index') }}">
                <i class="prepend-icon fa-solid fa-desktop"></i>
                <span class="link-name">{{ ___('partial.Dashboard') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['student-panel/dashboard*']) }}">
                    <a href="{{ route('student-panel-dashboard.index') }}"
                        class="link-name">{{ ___('partial.Dashboard') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['student-panel/subject-list*']) }}"
                href="{{ route('student-panel-subject-list.index') }}">
                <i class="prepend-icon fa-solid fa-book"></i>
                <span class="link-name">{{ ___('partial.Subject list') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['student-panel/subject-list*']) }}">
                    <a href="{{ route('student-panel-subject-list.index') }}"
                        class="link-name">{{ ___('partial.Subject list') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['student-panel/class-routine*']) }}"
                href="{{ route('student-panel-class-routine.index') }}">
                <i class="prepend-icon fa-solid fa-table"></i>
                <span class="link-name">{{ ___('partial.Class routine') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['student-panel/class-routine*']) }}">
                    <a href="{{ route('student-panel-class-routine.index') }}"
                        class="link-name">{{ ___('partial.Class routine') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['student-panel/fees*']) }}" href="{{ route('student-panel-fees.index') }}">
                <i class="prepend-icon fa-solid fa-money-bill"></i>
                <span class="link-name">{{ ___('partial.Fees') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['student-panel/fees*']) }}">
                    <a href="{{ route('student-panel-fees.index') }}" class="link-name">{{ ___('partial.Fees') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['student-panel/exam-routine*']) }}"
                href="{{ route('student-panel-exam-routine.index') }}">
                <i class="prepend-icon fa-solid fa-graduation-cap"></i>
                <span class="link-name">{{ ___('partial.Exam routine') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['student-panel/exam-routine*']) }}">
                    <a href="{{ route('student-panel-exam-routine.index') }}"
                        class="link-name">{{ ___('partial.Exam routine') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['student-panel/online-examination*']) }}"
                href="{{ route('student-panel-online-examination.index') }}">
                <i class="prepend-icon fa-solid fa-chalkboard-user"></i>
                <span class="link-name">{{ ___('partial.Online examination') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['student-panel/online-examination*']) }}">
                    <a href="{{ route('student-panel-online-examination.index') }}"
                        class="link-name">{{ ___('partial.Online examination') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['student-panel/marksheet*']) }}"
                href="{{ route('student-panel-marksheet.index') }}">
                <i class="prepend-icon fa-solid fa-clipboard"></i>
                <span class="link-name">{{ ___('partial.Marksheet') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['student-panel/marksheet*']) }}">
                    <a href="{{ route('student-panel-marksheet.index') }}"
                        class="link-name">{{ ___('partial.Marksheet') }}</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="{{ set_menu(['student-panel/attendance*']) }}"
                href="{{ route('student-panel-attendance.index') }}">
                <i class="prepend-icon fa-solid fa-file-circle-check"></i>
                <span class="link-name">{{ ___('partial.Attendance') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['student-panel/attendance*']) }}">
                    <a href="{{ route('student-panel-attendance.index') }}"
                        class="link-name">{{ ___('partial.Attendance') }}</a>
                </li>
            </ul>
        </li>


    </ul>
</div>
