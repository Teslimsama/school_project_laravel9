@php
    $allowedRoles = ['Super Admin', 'Admin', 'Accounting', 'Student', 'Teachers'];
    $userRole = Session::get('role_name');
@endphp

@if (in_array($userRole, $allowedRoles))
    @if ($userRole === 'Super Admin')
        {{-- SUPER ADMIN --}}
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">
                            <span>Main Menu</span>
                        </li>
                        <li class="{{ set_active(['setting/page']) }}">
                            <a href="{{ route('setting/page') }}" class="{{ set_active(['setting/page']) }}">
                                <i class="fas fa-cog"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li class="{{ set_active(['home']) }}">
                            <a href="{{ route('home') }}" class="{{ set_active(['home']) }}"><i
                                    class="feather-grid"></i>
                                <span> Dashboard</span>
                            </a>
                        </li>

                        <li
                            class="submenu {{ set_active(['list/users']) }} {{ request()->is('view/user/edit/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-shield-alt"></i>
                                <span>User Management</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('list/users') }}"
                                        class="{{ set_active(['list/users']) }} {{ request()->is('view/user/edit/*') ? 'active' : '' }}">List
                                        Users</a></li>
                            </ul>
                        </li>

                        <li
                            class="submenu {{ set_active(['student/list', 'student/grid', 'student/add/page']) }} {{ request()->is('student/edit/*') ? 'active' : '' }} {{ request()->is('student/profile/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-graduation-cap"></i>
                                <span> Students</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('student/list') }}"
                                        class="{{ set_active(['student/list', 'student/grid']) }}">Student List</a>
                                </li>
                                <li><a href="{{ route('student/add/page') }}"
                                        class="{{ set_active(['student/add/page']) }}">Student Add</a></li>
                            </ul>
                        </li>

                        <li
                            class="submenu  {{ set_active(['teacher/add/page', 'teacher/list/page', 'teacher/grid/page', 'teacher/edit']) }} {{ request()->is('teacher/edit/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-chalkboard-teacher"></i>
                                <span> Teachers</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ route('teacher/list/page') }}"
                                        class="{{ set_active(['teacher/list/page', 'teacher/grid/page']) }}">Teacher
                                        List
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('teacher/add/page') }}"
                                        class="{{ set_active(['teacher/add/page']) }}">Teacher Add
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="submenu {{ set_active(['department/add/page', 'department/list/page']) }} {{ request()->is('department/edit/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-building"></i>
                                <span> Departments</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('department/list/page') }}"
                                        class="{{ set_active(['department/list/page']) }}">Department List</a></li>
                                <li><a href="{{ route('department/add/page') }}"
                                        class="{{ set_active(['department/add/page']) }}">Department Add</a></li>

                            </ul>
                        </li>
                        <li class="submenu {{ set_active(['subject/add/page', 'subject/list/page']) }} {{ request()->is('subject/edit/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-book-reader"></i>
                                <span> Subjects</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('subject/list/page') }}" class="{{ set_active(['subject/list/page']) }}">Subject List</a></li>
                                <li><a href="{{ route('subject/add/page') }}" class="{{ set_active(['subject/add/page']) }}">Subject Add</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Management</span>
                        </li>
                        <li class="submenu {{ set_active(['feescollection/page', 'salary/page', 'expenses/page']) }}  {{ request()->is('feescollection/edit/*') ? 'active' : '' }} {{ request()->is('expenses/edit/*') ? 'active' : '' }}  {{ request()->is('salary/edit/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-file-invoice-dollar"></i>
                                <span> Accounts</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('feescollection/page') }}" class="{{ set_active(['feescollection/page', 'feescollection/page/add']) }} {{ request()->is('feescollection/edit/*') ? 'active' : '' }}">Fees Collection</a></li>
                                <li><a href="{{ route('expenses/page') }}" class="{{ set_active(['expenses/page','expenses/add/page']) }} {{ request()->is('expenses/edit/*') ? 'active' : '' }}">Expenses</a></li>
                                <li><a href="{{ route('salary/page' ) }}" class="{{ set_active(['salary/page', 'salary/add/page']) }} {{ request()->is('salary/edit/*') ? 'active' : '' }}">Salary</a></li>
                            </ul>
                        </li>
                        
                        <li class="{{ set_active(['fees/page']) }}">
                            <a href="{{ route('fees/page') }}" class="{{ set_active(['fees/page']) }}"><i class="fas fa-comment-dollar"></i> <span>Fees</span></a>
                        </li>
                        <li class="{{ set_active(['exam/page']) }}">
                            <a href="{{ route('exam/page') }}" class="{{ set_active(['exam/page']) }}"><i class="fas fa-clipboard-list"></i> <span>Exam list</span></a>
                        </li>
                        <li class="{{ set_active(['getevent']) }}">
                            <a href="{{ route('getevent') }}" class="{{ set_active(['getevent']) }}"><i class="fas fa-calendar-day"></i> <span>Events</span></a>
                        </li>
                        <li class="{{ set_active(['library/page']) }}">
                            <a href="{{route('library/page')}}"><i class="fas fa-table"></i> <span>Time Table</span></a>
                        </li>
                        <li  class="{{ set_active(['library/page']) }}">
                            <a href="{{ route('library/page') }}"  class="{{ set_active(['library/page']) }}"><i class="fas fa-book"></i> <span>Library</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @elseif ($userRole === 'Admin')
        {{-- ADMIN --}}
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">
                            <span>Main Menu</span>
                        </li>
                        <li class="{{ set_active(['home']) }}">
                            <a href="{{ route('home') }}" class="{{ set_active(['home']) }}">
                                <i class="feather-grid"></i><span> Dashboard</span>
                            </a>
                        </li>

                        <li
                            class="submenu {{ set_active(['list/users']) }} {{ request()->is('view/user/edit/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-shield-alt"></i>
                                <span>User Management</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('list/users') }}"
                                        class="{{ set_active(['list/users']) }} {{ request()->is('view/user/edit/*') ? 'active' : '' }}">List
                                        Users</a></li>
                            </ul>
                        </li>

                        <li
                            class="submenu {{ set_active(['student/list', 'student/grid', 'student/add/page']) }} {{ request()->is('student/edit/*') ? 'active' : '' }} {{ request()->is('student/profile/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-graduation-cap"></i>
                                <span> Students</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('student/list') }}"
                                        class="{{ set_active(['student/list', 'student/grid']) }}">Student List</a>
                                </li>
                                <li><a href="{{ route('student/add/page') }}"
                                        class="{{ set_active(['student/add/page']) }}">Student Add</a></li>

                            </ul>
                        </li>

                        <li
                            class="submenu  {{ set_active(['teacher/add/page', 'teacher/list/page', 'teacher/grid/page', 'teacher/edit']) }} {{ request()->is('teacher/edit/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-chalkboard-teacher"></i>
                                <span> Teachers</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('teacher/list/page') }}"
                                        class="{{ set_active(['teacher/list/page', 'teacher/grid/page']) }}">Teacher
                                        List</a>
                                </li>
                                <li><a href="{{ route('teacher/add/page') }}"
                                        class="{{ set_active(['teacher/add/page']) }}">Teacher Add</a></li>

                            </ul>
                        </li>

                        <li class="submenu {{ set_active(['department/add/page', 'department/list/page']) }} {{ request()->is('department/edit/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-building"></i>
                                <span> Departments</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('department/list/page') }}"
                                        class="{{ set_active(['department/list/page']) }}">Department List</a></li>
                                <li><a href="{{ route('department/add/page') }}"
                                        class="{{ set_active(['department/add/page']) }}">Department Add</a></li>

                            </ul>
                        </li>
                        <li class="submenu {{ set_active(['subject/add/page', 'subject/list/page']) }}{{ request()->is('subject/edit/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-book-reader"></i>
                                <span> Subjects</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('subject/list/page') }}" class="{{ set_active(['subject/list/page']) }}">Subject List</a></li>
                                <li><a href="{{ route('subject/add/page') }}" class="{{ set_active(['subject/add/page']) }}">Subject Add</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">
                            <span>Management</span>
                        </li>
                        <li class="submenu {{ set_active(['feescollection/page', 'salary/page', 'expenses/page']) }}  {{ request()->is('feescollection/edit/*') ? 'active' : '' }} {{ request()->is('expenses/edit/*') ? 'active' : '' }}  {{ request()->is('salary/edit/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-file-invoice-dollar"></i>
                                <span> Accounts</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('feescollection/page') }}" class="{{ set_active(['feescollection/page', 'feescollection/page/add']) }} {{ request()->is('feescollection/edit/*') ? 'active' : '' }}">Fees Collection</a></li>
                                <li><a href="{{ route('expenses/page') }}" class="{{ set_active(['expenses/page','expenses/add/page']) }} {{ request()->is('expenses/edit/*') ? 'active' : '' }}">Expenses</a></li>
                                <li><a href="{{ route('salary/page' ) }}" class="{{ set_active(['salary/page', 'salary/add/page']) }} {{ request()->is('salary/edit/*') ? 'active' : '' }}">Salary</a></li>
                            </ul>
                        </li>
                        
                        <li class="{{ set_active(['fees/page']) }}">
                            <a href="{{ route('fees/page') }}" class="{{ set_active(['fees/page']) }}"><i class="fas fa-comment-dollar"></i> <span>Fees</span></a>
                        </li>
                        <li class="{{ set_active(['exam/page']) }}">
                            <a href="{{ route('exam/page') }}" class="{{ set_active(['exam/page']) }}"><i class="fas fa-clipboard-list"></i> <span>Exam list</span></a>
                        </li>
                        <li class="{{ set_active(['getevent']) }}">
                            <a href="{{ route('getevent') }}" class="{{ set_active(['getevent']) }}"><i class="fas fa-calendar-day"></i> <span>Events</span></a>
                        </li>
                        <li class="{{ set_active(['library/page']) }}">
                            <a href="{{route('library/page')}}"><i class="fas fa-table"></i> <span>Time Table</span></a>
                        </li>
                        <li  class="{{ set_active(['library/page']) }}">
                            <a href="{{ route('library/page') }}"  class="{{ set_active(['library/page']) }}"><i class="fas fa-book"></i> <span>Library</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @elseif ($userRole === 'Accounting')
        {{-- ACCOUNTING --}}
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">
                            <span>Main Menu</span>
                        </li>
                        <li class="{{ set_active(['home']) }}">
                            <a href="{{ route('home') }}" class="{{ set_active(['home']) }}">
                                <i class="feather-grid"></i><span> Dashboard</span>
                            </a>
                        </li>

                        <li class="submenu {{ set_active(['feescollection/page', 'salary/page', 'expenses/page']) }}  {{ request()->is('feescollection/edit/*') ? 'active' : '' }} {{ request()->is('expenses/edit/*') ? 'active' : '' }}  {{ request()->is('salary/edit/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-file-invoice-dollar"></i>
                                <span> Accounts</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('feescollection/page') }}" class="{{ set_active(['feescollection/page', 'feescollection/page/add']) }} {{ request()->is('feescollection/edit/*') ? 'active' : '' }}">Fees Collection</a></li>
                                <li><a href="{{ route('expenses/page') }}" class="{{ set_active(['expenses/page','expenses/add/page']) }} {{ request()->is('expenses/edit/*') ? 'active' : '' }}">Expenses</a></li>
                                <li><a href="{{ route('salary/page' ) }}" class="{{ set_active(['salary/page', 'salary/add/page']) }} {{ request()->is('salary/edit/*') ? 'active' : '' }}">Salary</a></li>
                            </ul>
                        </li>
                        
                        <li class="{{ set_active(['fees/page']) }}">
                            <a href="{{ route('fees/page') }}" class="{{ set_active(['fees/page']) }}"><i class="fas fa-comment-dollar"></i> <span>Fees</span></a>
                        </li>
                        <li class="{{ set_active(['getevent']) }}">
                            <a href="{{ route('getevent') }}" class="{{ set_active(['getevent']) }}"><i class="fas fa-calendar-day"></i> <span>Events</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @elseif ($userRole === 'Student')
        {{-- STUDENTS --}}
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">
                            <span>Main Menu</span>
                        </li>
                        <li class="{{ set_active(['student/dashboard']) }}">
                            <a
                                href="{{ route('student/dashboard') }}"class="{{ set_active(['student/dashboard']) }}">
                                <i class="feather-grid"></i><span>Dashboard</span></a>
                        </li>

                        <li class="submenu {{ set_active([ 'subject/list/page']) }}">
                            <a href="#"><i class="fas fa-book-reader"></i>
                                <span> Subjects</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('subject/list/page') }}" class="{{ set_active(['subject/list/page']) }}">Subject List</a></li>
                                
                            </ul>
                        </li>

                        
                       <li class="{{ set_active(['fees/page']) }}">
                            <a href="{{ route('fees/page') }}" class="{{ set_active(['fees/page']) }}"><i class="fas fa-comment-dollar"></i> <span>Fees</span></a>
                        </li>
                        <li class="{{ set_active(['exam/page']) }}">
                            <a href="{{ route('exam/page') }}" class="{{ set_active(['exam/page']) }}"><i class="fas fa-clipboard-list"></i> <span>Exam list</span></a>
                        </li>
                        <li class="{{ set_active(['getevent']) }}">
                            <a href="{{ route('getevent') }}" class="{{ set_active(['getevent']) }}"><i class="fas fa-calendar-day"></i> <span>Events</span></a>
                        </li>
                        <li class="{{ set_active(['library/page']) }}">
                            <a href="{{route('library/page')}}"><i class="fas fa-table"></i> <span>Time Table</span></a>
                        </li>
                        <li  class="{{ set_active(['library/page']) }}">
                            <a href="{{ route('library/page') }}"  class="{{ set_active(['library/page']) }}"><i class="fas fa-book"></i> <span>Library</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @elseif ($userRole === 'Teachers')
        {{-- TEACHERS --}}
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">
                            <span>Main Menu</span>
                        </li>
                        <li class="{{ set_active(['teacher/dashboard']) }}">

                            <a
                                href="{{ route('teacher/dashboard') }}"class="{{ set_active(['teacher/dashboard']) }}">
                                <i class="feather-grid"></i><span>Dashboard</span>
                            </a>
                        </li>

                        <li
                            class="submenu {{ set_active(['student/list', 'student/grid']) }} {{ request()->is('student/edit/*') ? 'active' : '' }} {{ request()->is('student/profile/*') ? 'active' : '' }}">
                            <a href="#"><i class="fas fa-graduation-cap"></i>
                                <span> Students</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('student/list') }}"
                                        class="{{ set_active(['student/list', 'student/grid']) }}">Student List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fas fa-book-reader"></i>
                                <span> Subjects</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('subject/list/page') }}"class="{{ set_active(['subject/list/page']) }}">Subject List</a></li>
                            </ul>
                        </li>

                        <li class="{{ set_active(['exam/page']) }}">
                            <a href="{{ route('exam/page') }}" class="{{ set_active(['exam/page']) }}"><i class="fas fa-clipboard-list"></i> <span>Exam list</span></a>
                        </li>
                        <li class="{{ set_active(['getevent']) }}">
                            <a href="{{ route('getevent') }}" class="{{ set_active(['getevent']) }}"><i class="fas fa-calendar-day"></i> <span>Events</span></a>
                        </li>
                        <li class="{{ set_active(['library/page']) }}">
                            <a href="{{route('library/page')}}"><i class="fas fa-table"></i> <span>Time Table</span></a>
                        </li>
                        <li  class="{{ set_active(['library/page']) }}">
                            <a href="{{ route('library/page') }}"  class="{{ set_active(['library/page']) }}"><i class="fas fa-book"></i> <span>Library</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endif

@endif
