<div class="sidebar">
    <ul class="menu-group">
        <div class="logo">
            <i class="fa-solid fa-graduation-cap"></i>
            <span class="logo-name">nilschool</span>
        </div>
        <!-- Dashboard start -->
        <li>
            <a href="{{ route('dashboard') }}">
                <i class="fa-solid fa-school"></i>
                <span class="link-name">{{ ___('common.dashboard') }}</span>
            </a>
            <ul class="sub-menu blank">
                <li><a href="{{ route('dashboard') }}" class="link-name">{{ ___('common.dashboard') }}</a></li>
            </ul>
        </li>
        <!-- Dashboard end -->
        
        {{-- Student info --}}
        @if (hasPermission('student_read') ||
                hasPermission('student_category_read') ||
                hasPermission('promote_students_read') ||
                hasPermission('disabled_students_read') ||
                hasPermission('admission_read') ||
                hasPermission('parent_read'))
            <li class="{{ set_menu(['online-admissions*', 'student*', 'student/category*','promote/students*','disabled/students*','parent*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <span class="link-name">{{ ___('settings.student_info') }}</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('admission_read'))
                        <li class="{{ set_menu(['online-admissions*']) }}">
                            <a href="{{ route('online-admissions.index') }}" class="parent-item-content">{{ ___('settings.Online admissions') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('student_read'))
                        <li class="{{ set_menu(['student', 'student/create', 'student/edit']) }}">
                            <a href="{{ route('student.index') }}">{{ ___('settings.Students') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('student_category_read'))
                        <li class="{{ set_menu(['student/category*']) }}">
                            <a
                                href="{{ route('student_category.index') }}">{{ ___('student_info.Categories') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('promote_students_read'))
                        <li class="{{ set_menu(['promote/students*']) }}">
                            <a
                                href="{{ route('promote_students.index') }}">{{ ___('student_info.Promote students') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('disabled_students_read'))
                        <li class="{{ set_menu(['disabled/students*']) }}">
                            <a
                                href="{{ route('disabled_students.index') }}">{{ ___('student_info.Disabled students') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('parent_read'))
                        <li class="{{ set_menu(['parent*']) }}">
                            <a href="{{ route('parent.index') }}">{{ ___('student_info.Guardian') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        {{-- Student info end --}}

        {{-- Start Academic --}}
        @if (hasPermission('classes_read') ||
                hasPermission('section_read') ||
                hasPermission('shift_read') ||
                hasPermission('class_setup_read') ||
                hasPermission('subject_read') ||
                hasPermission('subject_assign_read') ||
                hasPermission('time_schedule_read') ||
                hasPermission('class_room_read'))
            <li class="{{ set_menu(['classes*','section*','shift*','class-setup*','subject*','assign-subject*','time/schedule*','class-room*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="fa-solid fa-house-flag"></i>
                        <span class="link-name">{{ ___('settings.academic') }}</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('classes_read'))
                        <li class="{{ set_menu(['classes*']) }}">
                            <a href="{{ route('classes.index') }}">{{ ___('settings.class') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('section_read'))
                        <li class="{{ set_menu(['section*']) }}">
                            <a href="{{ route('section.index') }}">{{ ___('settings.section') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('shift_read'))
                        <li class="{{ set_menu(['shift*']) }}">
                            <a href="{{ route('shift.index') }}">{{ ___('settings.shift') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('class_setup_read'))
                        <li class="{{ set_menu(['class-setup*']) }}">
                            <a href="{{ route('class-setup.index') }}">{{ ___('settings.class_setup') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('subject_read'))
                        <li class="{{ set_menu(['subject*']) }}">
                            <a href="{{ route('subject.index') }}">{{ ___('settings.subject') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('subject_assign_read'))
                        <li class="{{ set_menu(['assign-subject*']) }}">
                            <a href="{{ route('assign-subject.index') }}">{{ ___('settings.subject_assign') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('time_schedule_read'))
                        <li class="{{ set_menu(['time/schedule*']) }}">
                            <a href="{{ route('time_schedule.index') }}">{{ ___('academic.time_schedule') }}</a>
                        </li>
                    @endif

                    @if (hasPermission('class_room_read'))
                        <li class="{{ set_menu(['class-room*']) }}">
                            <a href="{{ route('class-room.index') }}">{{ ___('settings.class_room') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        {{-- End Academic --}}

        {{-- start routines --}}
        @if (hasPermission('class_routine_read'))
            <li class="{{ set_menu(['class-routine*', 'exam-routine*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="fa-solid fa-map"></i>
                        <span class="link-name">{{ ___('settings.Routines') }}</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('class_routine_read'))
                        <li class="{{ set_menu(['class-routine*']) }}">
                            <a href="{{ route('class-routine.index') }}">{{ ___('settings.Class routine') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('exam_routine_read'))
                        <li class="{{ set_menu(['exam-routine*']) }}">
                            <a href="{{ route('exam-routine.index') }}">{{ ___('settings.Exam routine') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        {{-- End routines --}}

        {{-- Start Attendance --}}
        @if (hasPermission('attendance_read') || hasPermission('report_attendance_read'))
            <li class="{{ set_menu(['attendance*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="fa-solid fa-arrow-up-right-dots"></i>
                        <span class="link-name">{{ ___('settings.Attendance') }}</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('attendance_read'))
                        <li class="{{ set_menu(['attendance.index', 'attendance.search']) }}">
                            <a href="{{ route('attendance.index') }}">{{ ___('settings.Attendance') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_attendance_read'))
                        <li class="{{ set_menu(['attendance/report*']) }}">
                            <a href="{{ route('attendance.report') }}">{{ ___('settings.Attendance report') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        {{-- End Attendance --}}

        {{-- Start Fees --}}
        @if (hasPermission('fees_group_read') ||
                hasPermission('fees_type_read') ||
                hasPermission('fees_master_read') ||
                hasPermission('fees_assign_read') ||
                hasPermission('fees_collect_read'))
            <li class="{{ set_menu(['fees*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="fa-solid fa-sack-dollar"></i>
                        <span class="link-name">{{ ___('settings.fees') }}</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('fees_group_read'))
                        <li class="{{ set_menu(['fees-group*']) }}">
                            <a href="{{ route('fees-group.index') }}">{{ ___('settings.group') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('fees_type_read'))
                        <li class="{{ set_menu(['fees-type*']) }}">
                            <a href="{{ route('fees-type.index') }}">{{ ___('settings.type') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('fees_master_read'))
                        <li class="{{ set_menu(['fees-master*']) }}">
                            <a href="{{ route('fees-master.index') }}">{{ ___('settings.master') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('fees_assign_read'))
                        <li class="{{ set_menu(['fees-assign*']) }}">
                            <a href="{{ route('fees-assign.index') }}">{{ ___('settings.assign') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('fees_collect_read'))
                        <li class="{{ set_menu(['fees-collect*']) }}">
                            <a href="{{ route('fees-collect.index') }}">{{ ___('settings.collect') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        {{-- End Fees --}}

        {{-- Start exam --}}
        @if (hasPermission('exam_type_read') ||
                hasPermission('marks_grade_read') ||
                hasPermission('exam_assign_read') ||
                hasPermission('marks_register_read') ||
                hasPermission('exam_setting_read'))
            <li
                class="{{ set_menu(['exam-type*', 'marks-grade*', 'exam-assign*', 'marks-register*', 'examination-settings*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="fa-solid fa-book-open-reader"></i>
                        <span class="link-name">{{ ___('settings.examination') }}</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('exam_type_read'))
                        <li class="{{ set_menu(['exam-type*']) }}">
                            <a href="{{ route('exam-type.index') }}">{{ ___('settings.type') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('marks_grade_read'))
                        <li class="{{ set_menu(['marks-grade*']) }}">
                            <a href="{{ route('marks-grade.index') }}">{{ ___('examination.marks_grade') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('exam_assign_read'))
                        <li class="{{ set_menu(['exam-assign*']) }}">
                            <a href="{{ route('exam-assign.index') }}">{{ ___('examination.exam_assign') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('marks_register_read'))
                        <li class="{{ set_menu(['marks-register*']) }}">
                            <a href="{{ route('marks-register.index') }}">{{ ___('examination.marks_register') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('exam_setting_read'))
                        <li class="{{ set_menu(['examination-settings*']) }}">
                            <a href="{{ route('examination-settings.index') }}">{{ ___('settings.settings') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('homework_read'))
                        <li class="{{ set_menu(['homework*']) }}">
                            <a href="{{ route('homework.index') }}">{{ ___('settings.Homework') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        {{-- End exam --}}

        <!-- Online Examination start -->
        @if (hasPermission('question_group_read'))
            <li class="{{ set_menu(['question-group*', 'question-bank*', 'online-exam*', 'online-exam-type*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="fa-solid fa-laptop-file"></i>
                        <span class="link-name">{{ ___('online-examination.online_examination') }}</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('question_group_read') ||
                            hasPermission('question_bank_read') ||
                            hasPermission('online_exam_read') ||
                            hasPermission('online_exam_type_read'))
                        <li class="{{ set_menu(['online-exam-type*']) }}">
                            <a href="{{ route('online-exam-type.index') }}">{{ ___('settings.type') }}</a>
                        </li>
                        <li class="{{ set_menu(['question-group*']) }}">
                            <a
                                href="{{ route('question-group.index') }}">{{ ___('online-examination.question_group') }}</a>
                        </li>
                        <li class="{{ set_menu(['question-bank*']) }}">
                            <a
                                href="{{ route('question-bank.index') }}">{{ ___('online-examination.question_bank') }}</a>
                        </li>
                        <li class="{{ set_menu(['online-exam', 'online-exam/create', 'online-exam/edit*']) }}">
                            <a
                                href="{{ route('online-exam.index') }}">{{ ___('online-examination.online_exam') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Online Examination end -->

        <!-- Library start -->
        @if (hasPermission('book_category_read'))
            <li class="{{ set_menu(['book-category*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="fa-solid fa-swatchbook"></i>
                        <span class="link-name">{{ ___('settings.library') }}</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('book_category_read') ||
                            hasPermission('book_read') ||
                            hasPermission('member_read') ||
                            hasPermission('issue_book_read'))
                        <li class="{{ set_menu(['book-category*']) }}">
                            <a href="{{ route('book-category.index') }}">{{ ___('settings.book_category') }}</a>
                        </li>
                        <li class="{{ set_menu(['book', 'book/create', 'book/edit*']) }}">
                            <a href="{{ route('book.index') }}">{{ ___('settings.book') }}</a>
                        </li>
                        <li class="{{ set_menu(['member-category*']) }}">
                            <a
                                href="{{ route('member-category.index') }}">{{ ___('settings.member_category') }}</a>
                        </li>
                        <li class="{{ set_menu(['member', 'member/create', 'member/edit*']) }}">
                            <a href="{{ route('member.index') }}">{{ ___('settings.member') }}</a>
                        </li>
                        <li class="{{ set_menu(['issue-book*']) }}">
                            <a href="{{ route('issue-book.index') }}">{{ ___('settings.issue_book') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Library end -->

        {{-- Start Transactions --}}
        @if (hasPermission('account_head_read') || hasPermission('income_read') || hasPermission('expense_read'))
            <li class="{{ set_menu(['accounts*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                        <span class="link-name">{{ ___('account.transactions') }}</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('account_head_read'))
                        <li class="{{ set_menu(['account_head*']) }}">
                            <a href="{{ route('account_head.index') }}">{{ ___('account.account_head') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('income_read'))
                        <li class="{{ set_menu(['income*']) }}">
                            <a href="{{ route('income.index') }}">{{ ___('account.income') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('expense_read'))
                        <li class="{{ set_menu(['expense*']) }}">
                            <a href="{{ route('expense.index') }}">{{ ___('account.expense') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        {{-- End Transactions --}}

        {{-- Report start --}}
        @if (hasPermission('report_marksheet_read') ||
                hasPermission('report_merit_list_read') ||
                hasPermission('report_progress_card_read') ||
                hasPermission('report_due_fees_read') ||
                hasPermission('report_fees_collection_read') ||
                hasPermission('report_transaction_read') ||
                hasPermission('class_routine_read') ||
                hasPermission('exam_routine_read') ||
                hasPermission('report_attendance_read'))
            <li class="{{ set_menu(['report-*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="fa-solid fa-file-contract"></i>
                        <span class="link-name">{{ ___('settings.report') }}</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('report_marksheet_read'))
                        <li class="{{ set_menu(['report-marksheet*']) }}">
                            <a href="{{ route('report-marksheet.index') }}">{{ ___('settings.marksheet') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_merit_list_read'))
                        <li class="{{ set_menu(['report-merit-list*']) }}">
                            <a href="{{ route('report-merit-list.index') }}">{{ ___('settings.merit_list') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_progress_card_read'))
                        <li class="{{ set_menu(['report-progress-card*']) }}">
                            <a
                                href="{{ route('report-progress-card.index') }}">{{ ___('settings.progress_card') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_due_fees_read'))
                        <li class="{{ set_menu(['report-due-fees*']) }}">
                            <a href="{{ route('report-due-fees.index') }}">{{ ___('settings.due_fees') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_fees_collection_read'))
                        <li class="{{ set_menu(['report-fees-collection*']) }}">
                            <a
                                href="{{ route('report-fees-collection.index') }}">{{ ___('settings.fees_collection') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_transaction_read'))
                        <li class="{{ set_menu(['report-account*']) }}">
                            <a href="{{ route('report-account.index') }}">{{ ___('settings.transactions') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('class_routine_read'))
                        <li class="{{ set_menu(['report-class-routine*']) }}">
                            <a
                                href="{{ route('report-class-routine.index') }}">{{ ___('settings.class_routine') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('exam_routine_read'))
                        <li class="{{ set_menu(['report-exam-routine*']) }}">
                            <a
                                href="{{ route('report-exam-routine.index') }}">{{ ___('settings.exam_routine') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_attendance_read'))
                        <li class="{{ set_menu(['report-attendance/report*']) }}">
                            <a href="{{ route('report-attendance.report') }}">{{ ___('settings.attendance') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        {{-- Report end --}}

        <!-- Language layout start -->
        @if (hasPermission('language_read'))
            <li class="{{ set_menu(['languages*']) }}">
                <a href="{{ route('languages.index') }}" class="parent-item-content">
                    <i class="fa-solid fa-language"></i>
                    <span class="link-name">{{ ___('common.language') }}</span>
                </a>
            </li>
        @endif
        <!-- Language layout end -->

        <!-- Staff start -->
        @if (hasPermission('role_read') ||
                hasPermission('user_read') ||
                hasPermission('department_read') ||
                hasPermission('designation_read'))
            <li class="{{ set_menu(['users*', 'roles*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="fa-solid fa-users"></i>
                        <span class="link-name">{{ ___('settings.staff_manage') }}</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('role_read'))
                        <li class="{{ set_menu(['roles*']) }}">
                            <a href="{{ route('roles.index') }}">{{ ___('users_roles.roles') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('user_read'))
                        <li class="{{ set_menu(['users*']) }}">
                            <a href="{{ route('users.index') }}">{{ ___('settings.staff') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('department_read'))
                        <li class="{{ set_menu(['department', 'department/create', 'department/edit*']) }}">
                            <a href="{{ route('department.index') }}">{{ ___('staff.department') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('designation_read'))
                        <li class="{{ set_menu(['designation*']) }}">
                            <a href="{{ route('designation.index') }}">{{ ___('staff.designation') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Staff end -->

        <!-- Website setup start -->
        @if (hasPermission('page_sections_read') ||
                hasPermission('slider_read') ||
                hasPermission('about_read') ||
                hasPermission('counter_read') ||
                hasPermission('contact_info_read') ||
                hasPermission('dep_contact_read') ||
                hasPermission('news_read') ||
                hasPermission('event_read') ||
                hasPermission('subscribe_read') ||
                hasPermission('contact_message_read'))
            <li
                class="{{ set_menu(['page-sections*', 'slider*', 'about*', 'counter*', 'contact-info*', 'department-contact*', 'admin-news*', 'event*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                        <span class="link-name">{{ ___('settings.website_setup') }}</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('subscribe_read'))
                        <li class="{{ set_menu(['subscribe*']) }}">
                            <a href="{{ route('subscribe.index') }}"
                                class="parent-item-content">{{ ___('settings.subscribe') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('contact_message_read'))
                        <li class="{{ set_menu(['contact-message*']) }}">
                            <a href="{{ route('contact-message.index') }}"
                                class="parent-item-content">{{ ___('settings.contact_message') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('page_sections_read'))
                        <li class="{{ set_menu(['page-sections*']) }}">
                            <a href="{{ route('sections.index') }}">{{ ___('settings.sections') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('slider_read'))
                        <li class="{{ set_menu(['slider*']) }}">
                            <a href="{{ route('slider.index') }}">{{ ___('settings.slider') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('about_read'))
                        <li class="{{ set_menu(['about*']) }}">
                            <a href="{{ route('about.index') }}">{{ ___('settings.about') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('counter_read'))
                        <li class="{{ set_menu(['counter*']) }}">
                            <a href="{{ route('counter.index') }}">{{ ___('settings.counter') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('contact_info_read'))
                        <li class="{{ set_menu(['contact-info*']) }}">
                            <a
                                href="{{ route('contact-info.index') }}">{{ ___('settings.contact_information') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('dep_contact_read'))
                        <li class="{{ set_menu(['department-contact*']) }}">
                            <a
                                href="{{ route('department-contact.index') }}">{{ ___('settings.department_contact') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('news_read'))
                        <li class="{{ set_menu(['admin-news*']) }}">
                            <a href="{{ route('news.index') }}">{{ ___('settings.news') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('event_read'))
                        <li class="{{ set_menu(['event*']) }}">
                            <a href="{{ route('event.index') }}">{{ ___('settings.event') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Website setup end -->

        <!-- Gallery start -->
        @if (hasPermission('gallery_category_read') || hasPermission('gallery_read'))
            <li class="{{ set_menu(['gallery-category*', 'gallery/*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="fa-solid fa-photo-film"></i>
                        <span class="link-name">{{ ___('settings.gallery') }}</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('gallery_category_read'))
                        <li class="{{ set_menu(['gallery-category*']) }}">
                            <a
                                href="{{ route('gallery-category.index') }}">{{ ___('settings.gallery_category') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('gallery_read'))
                        <li class="{{ set_menu(['gallery', 'gallery/*']) }}">
                            <a href="{{ route('gallery.index') }}">{{ ___('settings.images') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Gallery end -->

        <!-- Settings layout start -->
        @if (hasPermission('general_settings_read') ||
                hasPermission('storage_settings_read') ||
                hasPermission('task_schedules_read') ||
                hasPermission('software_update_read') ||
                hasPermission('recaptcha_settings_read') ||
                hasPermission('email_settings_read') ||
                hasPermission('gender_read') ||
                hasPermission('religion_read') ||
                hasPermission('blood_group_read') ||
                hasPermission('session_read'))
            <li class="{{ set_menu(['setting*', 'genders*', 'religions*', 'blood-groups*', 'sessions*']) }}">
                <div class="icon-link">
                    <a href="#" class="parent-item-content has-arrow">
                        <i class="fa-solid fa-gear"></i>
                        <span class="link-name">{{ ___('common.settings') }}</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('general_settings_read'))
                        <li class="{{ set_menu(['settings.general-settings']) }}">
                            <a
                                href="{{ route('settings.general-settings') }}">{{ ___('settings.general_settings') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('storage_settings_read'))
                        <li class="{{ set_menu(['settings.storagesetting']) }}">
                            <a
                                href="{{ route('settings.storagesetting') }}">{{ ___('settings.storage_settings') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('task_schedules_read'))
                        <li class="{{ set_menu(['settings.task-schedulers']) }}">
                            <a
                                href="{{ route('settings.task-schedulers') }}">{{ ___('settings.task_schedules') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('software_update_read'))
                        <li class="{{ set_menu(['settings.software-update']) }}">
                            <a
                                href="{{ route('settings.software-update') }}">{{ ___('settings.software_update') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('recaptcha_settings_read'))
                        <li class="{{ set_menu(['settings.recaptcha-setting']) }}">
                            <a
                                href="{{ route('settings.recaptcha-setting') }}">{{ ___('settings.recaptcha_settings') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('email_settings_read'))
                        <li class="{{ set_menu(['settings.mail-setting']) }}">
                            <a href="{{ route('settings.mail-setting') }}">{{ ___('settings.email_settings') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('gender_read'))
                        <li class="{{ set_menu(['genders*']) }}">
                            <a href="{{ route('genders.index') }}">{{ ___('settings.genders') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('religion_read'))
                        <li class="{{ set_menu(['religions*']) }}">
                            <a href="{{ route('religions.index') }}">{{ ___('settings.religions') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('blood_group_read'))
                        <li class="{{ set_menu(['blood-groups*']) }}">
                            <a href="{{ route('blood-groups.index') }}">{{ ___('settings.blood_groups') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('session_read'))
                        <li class="{{ set_menu(['sessions*']) }}">
                            <a href="{{ route('sessions.index') }}">{{ ___('settings.sessions') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Settings layout end -->
    </ul>
</div>
