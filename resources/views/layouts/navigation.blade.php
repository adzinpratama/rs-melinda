<ul class="nav flex-column pt-3 pt-md-0">
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link d-flex align-items-center">
            <span class="sidebar-icon me-3">
                <img src="{{ asset('images/brand/light.svg') }}" height="20" width="20" alt="Volt Logo">
            </span>
            <span class="mt-1 ms-1 sidebar-text">
                RS Melinda
            </span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="nav-link">
            <span class="sidebar-icon">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                </svg>
            </span>
            <span class="sidebar-text">{{ __('Dashboard') }}</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('schedule.index') ? 'active' : '' }}">
        <a href="{{ route('schedule.index') }}" class="nav-link">
            <span class="sidebar-icon">
                <svg class="icon icon-xs mr-2" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
            <span class="sidebar-text">{{ __('Schdule') }}</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('docter.index') ? 'active' : '' }}">
        <a href="{{ route('docter.index') }}" class="nav-link">
            <span class="sidebar-icon me-3">
                <i class="fas fa-user-nurse"></i>
            </span>
            <span class="sidebar-text">{{ __('Docters') }}</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}" class="nav-link">
            <span class="sidebar-icon me-3">
                <i class="fas fa-user-alt fa-fw"></i>
            </span>
            <span class="sidebar-text">{{ __('Users') }}</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('soal2') ? 'active' : '' }}">
        <a href="{{ route('soal2') }}" class="nav-link">
            <span class="sidebar-icon me-3">
                <i class="fas fa-user-alt fa-fw"></i>
            </span>
            <span class="sidebar-text">{{ __('Soal 2') }}</span>
        </a>
    </li>
</ul>
