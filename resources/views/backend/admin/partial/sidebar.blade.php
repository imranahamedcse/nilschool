<div class="sidebar">
    <ul class="menu-group">
        <div class="logo">
            <i class="fa-solid fa-graduation-cap"></i>
            <span class="logo-name">nilschool</span>
        </div>
        <!-- Dashboard start -->
        <li>
            <a class="{{ set_menu(['dashboard']) }}" href="{{ route('dashboard') }}">
                <i class="prepend-icon fa-solid fa-desktop"></i>
                <span class="link-name">{{ ___('common.Dashboard') }}</span>
            </a>
            <ul class="sub-menu">
                <li class="{{ set_menu(['dashboard']) }}">
                    <a href="{{ route('dashboard') }}" class="link-name">{{ ___('common.Dashboard') }}</a>
                </li>
            </ul>
        </li>
        <!-- Dashboard end -->

        <!-- Student info -->
        @if (hasPermission('student_read') ||
                hasPermission('student_category_read') ||
                hasPermission('promote_students_read') ||
                hasPermission('disabled_students_read') ||
                hasPermission('admission_read') ||
                hasPermission('parent_read'))
            <li class="{{ set_menu(['students*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-graduation-cap"></i>
                        <span class="link-name">{{ ___('common.Students') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('student_category_read'))
                        <li class="{{ set_menu(['students/category*']) }}">
                            <a href="{{ route('student-category.index') }}">{{ ___('common.Categories') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('student_read'))
                        <li class="{{ set_menu(['students/list*']) }}">
                            <a href="{{ route('student.index') }}">{{ ___('common.Student') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('disabled_students_read'))
                        <li class="{{ set_menu(['students/disabled*']) }}">
                            <a href="{{ route('disabled-students.index') }}">{{ ___('common.Inactive') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('parent_read'))
                        <li class="{{ set_menu(['students/parent*']) }}">
                            <a href="{{ route('parent.index') }}">{{ ___('common.Parent') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('admission_read'))
                        <li class="{{ set_menu(['students/online-admissions*']) }}">
                            <a href="{{ route('online-admissions.index') }}"
                                class="parent-item-content">{{ ___('common.Applied') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('promote_students_read'))
                        <li class="{{ set_menu(['students/promote*']) }}">
                            <a href="{{ route('promote-students.index') }}">{{ ___('common.Promote') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Student info end -->

        <!-- Start Academic -->
        @if (hasPermission('classes_read') ||
                hasPermission('section_read') ||
                hasPermission('shift_read') ||
                hasPermission('class_setup_read') ||
                hasPermission('subject_read') ||
                hasPermission('subject_assign_read') ||
                hasPermission('time_schedule_read') ||
                hasPermission('class_room_read') ||
                hasPermission('class_routine_read') ||
                hasPermission('attendance_read'))
            <li class="{{ set_menu(['academic*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-house-flag"></i>
                        <span class="link-name">{{ ___('common.Academic') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">

                    @if (hasPermission('time_schedule_read'))
                        <li class="{{ set_menu(['academic/time/schedule*']) }}">
                            <a href="{{ route('time-schedule.index') }}">{{ ___('common.Time schedule') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('class_room_read'))
                        <li class="{{ set_menu(['academic/class-room*']) }}">
                            <a href="{{ route('class-room.index') }}">{{ ___('common.Room') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('shift_read'))
                        <li class="{{ set_menu(['academic/shift*']) }}">
                            <a href="{{ route('shift.index') }}">{{ ___('common.Shift') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('section_read'))
                        <li class="{{ set_menu(['academic/section*']) }}">
                            <a href="{{ route('section.index') }}">{{ ___('common.Section') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('classes_read'))
                        <li class="{{ set_menu(['academic/classes*']) }}">
                            <a href="{{ route('classes.index') }}">{{ ___('common.Class') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('class_setup_read'))
                        <li class="{{ set_menu(['academic/class-setup*']) }}">
                            <a href="{{ route('class-setup.index') }}">{{ ___('common.Class setup') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('subject_read'))
                        <li class="{{ set_menu(['academic/subject*']) }}">
                            <a href="{{ route('subject.index') }}">{{ ___('common.Subject') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('subject_assign_read'))
                        <li class="{{ set_menu(['academic/assign-subject*']) }}">
                            <a href="{{ route('assign-subject.index') }}">{{ ___('common.Subject assign') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('class_routine_read'))
                        <li class="{{ set_menu(['academic/class-routine*']) }}">
                            <a href="{{ route('class-routine.index') }}">{{ ___('common.Class routine') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('attendance_read'))
                        <li class="{{ set_menu(['academic/attendance*']) }}">
                            <a href="{{ route('attendance.index') }}">{{ ___('common.Attendance') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- End Academic -->


        <!-- start class room -->
        @if (hasPermission('homework_read') || hasPermission('assignment_read') || hasPermission('post_read'))
            <li class="{{ set_menu(['class-room*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-map"></i>
                        <span class="link-name">{{ ___('common.Class Room') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('homework_read'))
                        <li class="{{ set_menu(['class-room/homework*']) }}">
                            <a href="{{ route('homework.index') }}">{{ ___('common.Homework') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('assignment_read'))
                        <li class="{{ set_menu(['class-room/assignment*']) }}">
                            <a href="{{ route('assignment.index') }}">{{ ___('common.Assignment') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('post_read'))
                        <li class="{{ set_menu(['class-room/post*']) }}">
                            <a href="{{ route('post.index') }}">{{ ___('common.Post') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- End class room -->

        <!-- Start Fees -->
        @if (hasPermission('fees_group_read') ||
                hasPermission('fees_type_read') ||
                hasPermission('fees_master_read') ||
                hasPermission('fees_assign_read') ||
                hasPermission('fees_collect_read'))
            <li class="{{ set_menu(['fees*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-sack-dollar"></i>
                        <span class="link-name">{{ ___('common.Fees') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('fees_group_read'))
                        <li class="{{ set_menu(['fees/group*']) }}">
                            <a href="{{ route('fees-group.index') }}">{{ ___('common.Group') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('fees_type_read'))
                        <li class="{{ set_menu(['fees/type*']) }}">
                            <a href="{{ route('fees-type.index') }}">{{ ___('common.Type') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('fees_master_read'))
                        <li class="{{ set_menu(['fees/master*']) }}">
                            <a href="{{ route('fees-master.index') }}">{{ ___('common.Master') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('fees_assign_read'))
                        <li class="{{ set_menu(['fees/assign*']) }}">
                            <a href="{{ route('fees-assign.index') }}">{{ ___('common.Assign') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('fees_collect_read'))
                        <li class="{{ set_menu(['fees/collect*']) }}">
                            <a href="{{ route('fees-collect.index') }}">{{ ___('common.Collect') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- End Fees -->

        <!-- Start exam -->
        @if (hasPermission('exam_type_read') ||
                hasPermission('marks_grade_read') ||
                hasPermission('exam_assign_read') ||
                hasPermission('marks_register_read') ||
                hasPermission('exam_setting_read') ||
                hasPermission('exam_routine_read'))
            <li class="{{ set_menu(['exam*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-book-open-reader"></i>
                        <span class="link-name">{{ ___('common.Examination') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('exam_type_read'))
                        <li class="{{ set_menu(['exam/type*']) }}">
                            <a href="{{ route('exam-type.index') }}">{{ ___('common.Type') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('marks_grade_read'))
                        <li class="{{ set_menu(['exam/marks-grade*']) }}">
                            <a href="{{ route('marks-grade.index') }}">{{ ___('common.Marks / Grade') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('exam_assign_read'))
                        <li class="{{ set_menu(['exam/assign*']) }}">
                            <a href="{{ route('exam-assign.index') }}">{{ ___('common.Assign') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('marks_register_read'))
                        <li class="{{ set_menu(['exam/marks-register*']) }}">
                            <a href="{{ route('marks-register.index') }}">{{ ___('common.Marks register') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('exam_setting_read'))
                        <li class="{{ set_menu(['exam/settings*']) }}">
                            <a href="{{ route('examination-settings.index') }}">{{ ___('common.Settings') }}</a>
                        </li>
                    @endif

                    @if (hasPermission('exam_routine_read'))
                        <li class="{{ set_menu(['exam/routine*']) }}">
                            <a href="{{ route('exam-routine.index') }}">{{ ___('common.Routine') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- End exam -->

        <!-- Online Examination start -->
        @if (hasPermission('question_group_read') ||
                hasPermission('question_bank_read') ||
                hasPermission('online_exam_read') ||
                hasPermission('online_exam_type_read'))
            <li class="{{ set_menu(['online-exam*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-laptop-file"></i>
                        <span class="link-name">{{ ___('common.Online examination') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('online_exam_type_read'))
                        <li class="{{ set_menu(['online-exam/type*']) }}">
                            <a href="{{ route('online-exam-type.index') }}">{{ ___('common.Type') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('question_group_read'))
                        <li class="{{ set_menu(['online-exam/question-group*']) }}">
                            <a href="{{ route('question-group.index') }}">{{ ___('common.Question group') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('question_bank_read'))
                        <li class="{{ set_menu(['online-exam/question-bank*']) }}">
                            <a href="{{ route('question-bank.index') }}">{{ ___('common.Question bank') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('online_exam_read'))
                        <li class="{{ set_menu(['online-exam/list*']) }}">
                            <a href="{{ route('online-exam.index') }}">{{ ___('common.Exam') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Online Examination end -->

        <!-- Library start -->
        @if (hasPermission('book_category_read') ||
                hasPermission('book_read') ||
                hasPermission('member_category_read') ||
                hasPermission('member_read') ||
                hasPermission('issue_book_read'))
            <li class="{{ set_menu(['library*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-swatchbook"></i>
                        <span class="link-name">{{ ___('common.Library') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('book_category_read'))
                        <li class="{{ set_menu(['library/book-category*']) }}">
                            <a href="{{ route('book-category.index') }}">{{ ___('common.Book category') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('book_read'))
                        <li class="{{ set_menu(['library/book', 'library/book/*']) }}">
                            <a href="{{ route('book.index') }}">{{ ___('common.Book') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('member_category_read'))
                        <li class="{{ set_menu(['library/member-category*']) }}">
                            <a href="{{ route('member-category.index') }}">{{ ___('common.Member category') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('member_read'))
                        <li class="{{ set_menu(['library/member', 'library/member/*']) }}">
                            <a href="{{ route('member.index') }}">{{ ___('common.Member') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('issue_book_read'))
                        <li class="{{ set_menu(['library/issue-book*']) }}">
                            <a href="{{ route('issue-book.index') }}">{{ ___('common.Issue book') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Library end -->

        <!-- Start Transactions -->
        @if (hasPermission('account_head_read') || hasPermission('income_read') || hasPermission('expense_read'))
            <li class="{{ set_menu(['account*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-money-bill-transfer"></i>
                        <span class="link-name">{{ ___('common.Account') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('account_head_read'))
                        <li class="{{ set_menu(['account/head*']) }}">
                            <a href="{{ route('account-head.index') }}">{{ ___('common.Head') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('income_read'))
                        <li class="{{ set_menu(['account/income*']) }}">
                            <a href="{{ route('income.index') }}">{{ ___('common.Income') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('expense_read'))
                        <li class="{{ set_menu(['account/expense*']) }}">
                            <a href="{{ route('expense.index') }}">{{ ___('common.Expense') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- End Transactions -->

        <!-- Start Canteen -->
        @if (hasPermission('account_head_read'))
            <li class="{{ set_menu(['account*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-utensils"></i>
                        <span class="link-name">{{ ___('common.Canteen') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('account_head_read'))
                        <li class="{{ set_menu(['account/head*']) }}">
                            <a href="{{ route('account-head.index') }}">{{ ___('common.Head') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- End Canteen -->

        <!-- Start Dormitory -->
        @if (hasPermission('dormitory_read') ||
                hasPermission('room_type_read') ||
                hasPermission('room_read') ||
                hasPermission('dormitory_setup_read') ||
                hasPermission('dormitory_student_read'))
            <li class="{{ set_menu(['dormitory*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-hotel"></i>
                        <span class="link-name">{{ ___('common.Dormitory') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('dormitory_read'))
                        <li class="{{ set_menu(['dormitory/dormitory*']) }}">
                            <a href="{{ route('dormitory.index') }}">{{ ___('common.Dormitory') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('room_type_read'))
                        <li class="{{ set_menu(['dormitory/room-type*']) }}">
                            <a href="{{ route('room-type.index') }}">{{ ___('common.Room Type') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('room_read'))
                        <li class="{{ set_menu(['dormitory/room', 'dormitory/room/*']) }}">
                            <a href="{{ route('room.index') }}">{{ ___('common.Room') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('dormitory_setup_read'))
                        <li class="{{ set_menu(['dormitory/setup*']) }}">
                            <a href="{{ route('dormitory-setup.index') }}">{{ ___('common.Setup') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('dormitory_student_read'))
                        <li class="{{ set_menu(['dormitory/student*']) }}">
                            <a href="{{ route('dormitory-student.index') }}">{{ ___('common.Student') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- End Dormitory -->

        <!-- Start Transport -->
        @if (hasPermission('route_read') ||
                hasPermission('vehicle_read') ||
                hasPermission('pickup_point_read') ||
                hasPermission('transport_setup_read') ||
                hasPermission('transport_student_read'))
            <li class="{{ set_menu(['transport*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-bus"></i>
                        <span class="link-name">{{ ___('common.Transport') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('route_read'))
                        <li class="{{ set_menu(['transport/route*']) }}">
                            <a href="{{ route('route.index') }}">{{ ___('common.Route') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('vehicle_read'))
                        <li class="{{ set_menu(['transport/vehicle*']) }}">
                            <a href="{{ route('vehicle.index') }}">{{ ___('common.Vehicle') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('pickup_point_read'))
                        <li class="{{ set_menu(['transport/pickup-point*']) }}">
                            <a href="{{ route('pickup-point.index') }}">{{ ___('common.Pickup Point') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('transport_setup_read'))
                        <li class="{{ set_menu(['transport/transport-setup*']) }}">
                            <a href="{{ route('transport-setup.index') }}">{{ ___('common.Setup') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('transport_student_read'))
                        <li class="{{ set_menu(['transport/transport-student*']) }}">
                            <a href="{{ route('transport-student.index') }}">{{ ___('common.Student') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- End Transport -->

        <!-- Report start -->
        @if (hasPermission('report_marksheet_read') ||
                hasPermission('report_merit_list_read') ||
                hasPermission('report_progress_card_read') ||
                hasPermission('report_due_fees_read') ||
                hasPermission('report_fees_collection_read') ||
                hasPermission('report_transaction_read') ||
                hasPermission('report_attendance_read'))
            <li class="{{ set_menu(['report*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-file-contract"></i>
                        <span class="link-name">{{ ___('common.Report') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('report_marksheet_read'))
                        <li class="{{ set_menu(['report/marksheet*']) }}">
                            <a href="{{ route('report-marksheet.index') }}">{{ ___('common.Marksheet') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_merit_list_read'))
                        <li class="{{ set_menu(['report/merit-list*']) }}">
                            <a href="{{ route('report-merit-list.index') }}">{{ ___('common.Merit list') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_progress_card_read'))
                        <li class="{{ set_menu(['report/progress-card*']) }}">
                            <a href="{{ route('report-progress-card.index') }}">{{ ___('common.Progress card') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_due_fees_read'))
                        <li class="{{ set_menu(['report/due-fees*']) }}">
                            <a href="{{ route('report-due-fees.index') }}">{{ ___('common.Due fees') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_fees_collection_read'))
                        <li class="{{ set_menu(['report/fees-collection*']) }}">
                            <a
                                href="{{ route('report-fees-collection.index') }}">{{ ___('common.Fees collection') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_transaction_read'))
                        <li class="{{ set_menu(['report/account*']) }}">
                            <a href="{{ route('report-account.index') }}">{{ ___('common.Transactions') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_attendance_read'))
                        <li class="{{ set_menu(['report/attendance*']) }}">
                            <a href="{{ route('report-attendance.index') }}">{{ ___('common.Attendance') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_class_routine_read'))
                        <li class="{{ set_menu(['report/class-routine*']) }}">
                            <a href="{{ route('report-class-routine.index') }}">{{ ___('common.Class routine') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('report_exam_routine_read'))
                        <li class="{{ set_menu(['report/exam-routine*']) }}">
                            <a href="{{ route('report-exam-routine.index') }}">{{ ___('common.Exam routine') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Report end -->

        <!-- User start -->
        @if (hasPermission('role_read') ||
                hasPermission('user_read') ||
                hasPermission('department_read') ||
                hasPermission('designation_read'))
            <li class="{{ set_menu(['staff*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-users"></i>
                        <span class="link-name">{{ ___('common.Staff') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('role_read'))
                        <li class="{{ set_menu(['staff/roles*']) }}">
                            <a href="{{ route('roles.index') }}">{{ ___('common.Roles') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('user_read'))
                        <li class="{{ set_menu(['staff/users*']) }}">
                            <a href="{{ route('users.index') }}">{{ ___('common.List') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('department_read'))
                        <li class="{{ set_menu(['staff/department*']) }}">
                            <a href="{{ route('department.index') }}">{{ ___('common.Department') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('designation_read'))
                        <li class="{{ set_menu(['staff/designation*']) }}">
                            <a href="{{ route('designation.index') }}">{{ ___('common.Designation') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- User end -->

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
                hasPermission('contact_message_read') ||
                hasPermission('gallery_category_read') ||
                hasPermission('gallery_read'))
            <li class="{{ set_menu(['website-setup*']) }}">
                <div class="icon-link">
                    <a class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-screwdriver-wrench"></i>
                        <span class="link-name">{{ ___('common.Website setup') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    @if (hasPermission('subscribe_read'))
                        <li class="{{ set_menu(['website-setup/subscribe*']) }}">
                            <a href="{{ route('subscribe.index') }}"
                                class="parent-item-content">{{ ___('common.Subscribe') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('contact_message_read'))
                        <li class="{{ set_menu(['website-setup/contact-message*']) }}">
                            <a href="{{ route('contact-message.index') }}"
                                class="parent-item-content">{{ ___('common.Contact message') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('page_sections_read'))
                        <li class="{{ set_menu(['website-setup/page-sections*']) }}">
                            <a href="{{ route('sections.index') }}">{{ ___('common.Sections') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('slider_read'))
                        <li class="{{ set_menu(['website-setup/slider*']) }}">
                            <a href="{{ route('slider.index') }}">{{ ___('common.Slider') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('about_read'))
                        <li class="{{ set_menu(['website-setup/about*']) }}">
                            <a href="{{ route('about.index') }}">{{ ___('common.About') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('counter_read'))
                        <li class="{{ set_menu(['website-setup/counter*']) }}">
                            <a href="{{ route('counter.index') }}">{{ ___('common.Counter') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('contact_info_read'))
                        <li class="{{ set_menu(['website-setup/contact-info*']) }}">
                            <a href="{{ route('contact-info.index') }}">{{ ___('common.Contact info') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('dep_contact_read'))
                        <li class="{{ set_menu(['website-setup/department-contact*']) }}">
                            <a
                                href="{{ route('department-contact.index') }}">{{ ___('common.Department contact') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('news_read'))
                        <li class="{{ set_menu(['website-setup/news*']) }}">
                            <a href="{{ route('news.index') }}">{{ ___('common.News') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('event_read'))
                        <li class="{{ set_menu(['website-setup/event*']) }}">
                            <a href="{{ route('event.index') }}">{{ ___('common.Event') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('gallery_category_read'))
                        <li class="{{ set_menu(['website-setup/gallery-category*']) }}">
                            <a href="{{ route('gallery-category.index') }}">{{ ___('common.Gallery category') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('gallery_read'))
                        <li class="{{ set_menu(['website-setup/gallery', 'website-setup/gallery/*']) }}">
                            <a href="{{ route('gallery.index') }}">{{ ___('common.Images') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Website setup end -->

        <!-- Settings start -->
        @if (hasPermission('language_read') ||
                hasPermission('general_settings_read') ||
                hasPermission('task_schedules_read') ||
                hasPermission('software_update_read') ||
                hasPermission('recaptcha_settings_read') ||
                hasPermission('email_settings_read') ||
                hasPermission('gender_read') ||
                hasPermission('religion_read') ||
                hasPermission('blood_group_read') ||
                hasPermission('session_read'))
            <li class="{{ set_menu(['settings*']) }}">
                <div class="icon-link">
                    <a href="#" class="parent-item-content has-arrow">
                        <i class="prepend-icon fa-solid fa-gear"></i>
                        <span class="link-name">{{ ___('common.Settings') }}</span>
                    </a>
                    <i class="append-icon fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">

                    @if (hasPermission('language_read'))
                        <li class="{{ set_menu(['settings/languages*']) }}">
                            <a href="{{ route('languages.index') }}">{{ ___('common.Language') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('general_settings_read'))
                        <li class="{{ set_menu(['settings/general']) }}">
                            <a
                                href="{{ route('settings.general-settings') }}">{{ ___('common.General settings') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('task_schedules_read'))
                        <li class="{{ set_menu(['settings/task-schedulers']) }}">
                            <a href="{{ route('settings.task-schedulers') }}">{{ ___('common.Task schedules') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('software_update_read'))
                        <li class="{{ set_menu(['settings/software-update']) }}">
                            <a href="{{ route('settings.software-update') }}">{{ ___('common.Software update') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('email_settings_read'))
                        <li class="{{ set_menu(['settings/email']) }}">
                            <a href="{{ route('settings.mail-setting') }}">{{ ___('common.Email settings') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('gender_read'))
                        <li class="{{ set_menu(['settings/genders*']) }}">
                            <a href="{{ route('genders.index') }}">{{ ___('common.Genders') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('religion_read'))
                        <li class="{{ set_menu(['settings/religions*']) }}">
                            <a href="{{ route('religions.index') }}">{{ ___('common.Religions') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('blood_group_read'))
                        <li class="{{ set_menu(['settings/blood-groups*']) }}">
                            <a href="{{ route('blood-groups.index') }}">{{ ___('common.Blood groups') }}</a>
                        </li>
                    @endif
                    @if (hasPermission('session_read'))
                        <li class="{{ set_menu(['settings/sessions*']) }}">
                            <a href="{{ route('sessions.index') }}">{{ ___('common.Sessions') }}</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- Settings end -->
    </ul>
</div>
