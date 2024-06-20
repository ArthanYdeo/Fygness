<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #042631;">
    <!-- Brand Logo -->
    <a href="" class="brand-link" style="color: #FFFFFF;">
        <img src="{{ url('images/logo.jpg') }}" alt="FygnessLogo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">Fygness</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="" class="d-block">Hi, {{ Auth::user()->full_name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Admin Navbar -->
                @if(Auth::user()->user_type == 1)
                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}" class="nav-link @if(Request::is('admin/dashboard')) active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <!-- Add this menu item for Activity Logs -->
                    <li class="nav-item">
                        <a href="{{ url('admin/activity-logs') }}" class="nav-link @if(Request::is('admin/activity-logs')) active @endif">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Activity Logs</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/staff') }}" class="nav-link @if(Request::is('admin/staff')) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Staffs and Trainers</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('gyms/create') }}" class="nav-link @if(Request::is('gyms/create')) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Add Gym</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('gyms') }}" class="nav-link @if(Request::is('gyms')) active @endif">
                            <i class="nav-icon fas fa-dumbbell"></i>
                            <p>Registered Gyms</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/users') }}" class="nav-link @if(Request::is('admin/users')) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.announcements.index') }}" class="nav-link @if(Request::is('admin/announcements*')) active @endif">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>Announcement</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('profile') }}" class="nav-link @if(Request::is('profile')) active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    

                <!-- Staff Navbar -->
                @elseif(Auth::user()->user_type == 2)
                    <li class="nav-item">
                        <a href="{{ url('staff/dashboard') }}" class="nav-link @if(Request::is('staff/dashboard')) active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('staff/users/list') }}" class="nav-link @if(Request::is('staff/users/list')) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('staff/trainers/list') }}" class="nav-link @if(Request::is('staff/trainers/list')) active @endif">
                            <i class="nav-icon fas fa-dumbbell"></i>
                            <p>Trainers</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('staff/check-in') }}" class="nav-link @if(Request::is('staff/check-in')) active @endif">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>Check In Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('announcements/create') }}" class="nav-link @if(Request::is('announcements/create')) active @endif">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>Create Announcement</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('profile') }}" class="nav-link @if(Request::is('profile')) active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    <!-- Add Reports menu item -->
                    <li class="nav-item">
                        <a href="{{ url('staff/reports') }}" class="nav-link @if(Request::is('staff/reports')) active @endif">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Reports</p>
                        </a>
                    </li>

                <!-- User Navbar -->
                @elseif(Auth::user()->user_type == 3)
                    <li class="nav-item">
                        <a href="{{ url('user/dashboard') }}" class="nav-link @if(Request::is('user/dashboard')) active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    @php
                        $hasActiveSubscription = app('App\Http\Controllers\SubscriptionController')->hasActiveSubscription();
                        $hasPendingSubscription = app('App\Http\Controllers\SubscriptionController')->hasPendingSubscription();
                    @endphp

                    @if (!$hasActiveSubscription && !$hasPendingSubscription)
                        <li class="nav-item">
                            <a href="{{ url('user/subscriptions') }}" class="nav-link @if(Request::is('user/subscriptions')) active @endif">
                                <i class="nav-icon fas fa-hand-holding-usd"></i>
                                <p>Subscription</p>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ url('user/tasks') }}" class="nav-link @if(Request::is('user/tasks')) active @endif">
                            <i class="nav-icon fas fa-table left"></i>
                            <p>Create Task</p>
                            <i class="fas fa-plus right"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('profile') }}" class="nav-link @if(Request::is('profile')) active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    <!-- Add Reports menu item -->
                    <li class="nav-item">
                        <a href="{{ url('user/reports') }}" class="nav-link @if(Request::is('user/reports')) active @endif">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Reports</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ url('logout') }}" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
