<aside class="left-sidebar" style="background:#f6eee6;">
  <div class="d-flex flex-column h-100">

    <!-- LOGO -->
    <div class="brand-logo d-flex align-items-center justify-content-between p-3">
      <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
        <div class="d-flex align-items-center gap-2">
          <div class="rounded-circle d-flex align-items-center justify-content-center" 
               style="width: 40px; height: 40px; background:#d6b39a;">
            <img src="{{ asset('img/logo.png') }}" 
                 alt="Logo" style="width:100%; height:100%; object-fit:cover;">
          </div>
          <div>
            <h5 class="mb-0 fw-bold" style="color:#4a332a;">Ximilu Ammar</h5>
            <small class="text-muted">Dashboard Backoffice</small>
          </div>
        </div>
      </a>
    </div>

    <!-- MENU -->
    <nav class="sidebar-nav scroll-sidebar flex-grow-1" data-simplebar="">
      <ul id="sidebarnav" class="px-3">

        <!-- DASHBOARD -->
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
             href="{{ route('admin.dashboard') }}">

            <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
            <span class="ms-2">Dashboard</span>
          </a>
        </li>

        <!-- PRODUK -->
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
             href="{{ route('admin.products.index') }}">
            <iconify-icon icon="solar:box-linear"></iconify-icon>
            <span class="ms-2">Produk</span>
          </a>
        </li>

        <!-- PEMASOK -->
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('admin.suppliers.*') ? 'active' : '' }}"
             href="{{ route('admin.suppliers.index') }}">
            <iconify-icon icon="solar:delivery-linear"></iconify-icon>
            <span class="ms-2">Pemasok</span>
          </a>
        </li>

        <!-- PENGELUARAN -->
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('admin.expenses.*') ? 'active' : '' }}"
             href="{{ route('admin.expenses.index') }}">
            <iconify-icon icon="streamline:money-graph-arrow-decrease-down-stats-graph-descend-right-arrow"></iconify-icon>
            <span class="ms-2">Pengeluaran</span>
          </a>
        </li>

        <!-- PENJUALAN -->
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('admin.sales.*') ? 'active' : '' }}"
             href="{{ route('admin.sales.index') }}">
            <iconify-icon icon="streamline:money-graph-arrow-increase-ascend-growth-up-arrow-stats-graph-right-grow"></iconify-icon>
            <span class="ms-2">Penjualan</span>
          </a>
        </li>

        @can('admin')
        <!-- LAPORAN -->
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"
             href="{{ route('admin.reports.index') }}">
            <iconify-icon icon="mdi:report-areaspline"></iconify-icon>
            <span class="ms-2">Laporan</span>
          </a>
        </li>

        <!-- PENGGUNA -->
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
             href="{{ route('admin.users.index') }}">
            <iconify-icon icon="solar:users-group-rounded-linear"></iconify-icon>
            <span class="ms-2">Pengguna</span>
          </a>
        </li>
        @endcan

      </ul>
    </nav>

    <!-- LOGOUT -->
    <div class="mt-auto p-3 border-top">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn w-100">
          <iconify-icon icon="solar:logout-2-linear"></iconify-icon>
          <span>Logout</span>
        </button>
      </form>
    </div>

  </div>
</aside>

<style>
/* MENU ITEM */
.sidebar-link {
    display: flex;
    align-items: center;
    padding: 12px 14px;
    gap: 12px;
    color: #5d4a42;
    border-radius: 12px;
    font-weight: 500;
    transition: .25s;
}

/* HOVER */
.sidebar-link:hover {
    background: #ecdfd3;
    color: #3e2d26;
}

/* ACTIVE (COFFEE TONE – NO BLUE AT ALL) */
.sidebar-link.active {
    background: #d7b8a6 !important;
    color: #3b2922 !important;
    font-weight: 600;
    transform: translateX(3px);
}

/* ICON */
iconify-icon {
    font-size: 20px;
    opacity: .9;
}

/* LOGOUT BUTTON */
.logout-btn {
    background: #d7b8a6;
    border: none;
    padding: 12px;
    border-radius: 10px;
    color: #3b2922;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    transition: .2s;
}

.logout-btn:hover {
    background: #caa48e;
}
</style>
