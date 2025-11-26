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
                    <h5>{{ auth()->user()->name }}</h5>
                    <span class="badge bg-{{ auth()->user()->isAdmin() ? 'primary' : 'success' }}">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </div>
                <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                    <div class="message-body">
                    <form method="POST" action="{{ route('logout') }}" class="d-flex justify-content-center">
                        @csrf
                        <button type="submit" class="w-100 btn btn-outline-primary mx-3 mt-2 d-block">
                            Logout
                        </button>
                    </form>
                    </div>
                </div>
                </li>
            </ul>
        </div>
    </nav>
</header>