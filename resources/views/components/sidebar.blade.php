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
            <li class="{{ Request::is('users') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}"><i class="fa fa-user">
                    </i> <span>Users</span>
                </a>
            </li>
            <li class="{{ Request::is('points') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('points.index') }}"><i class="fa fa-location">
                    </i> <span>Titik Lokasi</span>
                </a>
            </li>
            <li class="{{ Request::is('schedule') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('schedules.index') }}"><i class="fa fa-location">
                    </i> <span>Jadwal</span>
                </a>
            </li>
    </aside>
</div>
