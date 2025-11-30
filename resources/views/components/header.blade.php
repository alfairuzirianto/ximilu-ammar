<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
                </li>
            </ul>
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <div class="d-flex align-items-center justify-content-center gap-2 me-2">
                    <span class="badge bg-{{ auth()->user()->isAdmin() ? 'primary' : 'success' }}">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </div>
            </ul>
        </div>
    </nav>
</header>