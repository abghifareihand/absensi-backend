<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Absensi</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">Ab</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa fa-home">
                    </i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ Request::is('users*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-user"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('users/staff*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('users.staff.index') }}">Staff</a>
                    </li>
                    <li class="{{ Request::is('users/dosen*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('users.dosen.index') }}">Dosen</a>
                    </li>
                    <li class="{{ Request::is('users/mahasiswa*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('users.mahasiswa.index') }}">Mahasiswa</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ Request::is('schedules*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-calendar"></i><span>Schedule</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('schedules/staff*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('schedules.staff.index') }}">Staff</a>
                    </li>
                    <li class="{{ Request::is('schedules/dosen*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('schedules.dosen.index') }}">Dosen</a>
                    </li>
                    <li class="{{ Request::is('schedules/mahasiswa*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('schedules.mahasiswa.index') }}">Mahasiswa</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('points') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('points.index') }}"><i class="fa fa-location-arrow">
                    </i> <span>Titik Lokasi</span>
                </a>
            </li>
            <li class="{{ Request::is('settings') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('settings.index') }}"><i class="fa fa-cog">
                    </i> <span>Title Aplikasi</span>
                </a>
            </li>
            <li class="{{ Request::is('events') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('events.index') }}"><i class="fa fa-cog">
                    </i> <span>Events</span>
                </a>
            </li>
    </aside>
</div>
