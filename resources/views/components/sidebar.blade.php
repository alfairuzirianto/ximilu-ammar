<nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
            <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active bg-primary' : '' }}" href="{{ route('admin.dashboard') }}" aria-expanded="false">
            <span>
                <iconify-icon icon="material-symbols:dashboard-rounded" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
            <span class="hide-menu">MASTER DATA</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.produk.index') ? 'active bg-primary' : '' }}" href="{{ route('admin.produk.index') }}" aria-expanded="false">
            <span>
                <iconify-icon icon="ix:package-filled" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Produk</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.pemasok.index') ? 'active bg-primary' : '' }}" href="{{ route('admin.pemasok.index') }}" aria-expanded="false">
            <span>
                <iconify-icon icon="material-symbols:hand-package-rounded" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Pemasok</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.transaksi.index') ? 'active bg-primary' : '' }}" href="{{ route('admin.transaksi.index') }}" aria-expanded="false">
            <span>
                <iconify-icon icon="grommet-icons:transaction" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Transaksi</span>
            </a>
        </li>
        @can('admin')
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
            <span class="hide-menu">PENGATURAN</span>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link {{ request()->routeIs('admin.pengguna.index') ? 'active bg-primary' : '' }}" href="{{ route('admin.pengguna.index') }}" aria-expanded="false">
            <span>
                <iconify-icon icon="flowbite:users-solid" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">Pengguna</span>
            </a>
        </li>
        @endcan
    </ul>
</nav>