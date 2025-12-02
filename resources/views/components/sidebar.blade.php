<aside class="left-sidebar">
  <div class="d-flex flex-column h-100">
    <div class="brand-logo d-flex align-items-center justify-content-between p-3">
      <a href="{{ route('admin.dashboard') }}" wire:navigate class="text-decoration-none">
        <div class="d-flex align-items-center gap-2">
          <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <span class="text-white fw-bold fs-5">XA</span>
          </div>
          <div>
            <h5 class="mb-0 fw-bold">Ximilu Ammar</h5>
            <small class="text-muted">Dashboard Backoffice</small>
          </div>
        </div>
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>

    <nav class="sidebar-nav scroll-sidebar flex-grow-1" data-simplebar="">
      <ul id="sidebarnav" class="px-2">
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
             href="{{ route('admin.dashboard') }}" wire:navigate>
            <iconify-icon icon="solar:widget-add-line-duotone" class="fs-6"></iconify-icon>
            <span class="hide-menu ms-2">Dashboard</span>
          </a>
        </li>
        
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" 
             href="{{ route('admin.products.index') }}" wire:navigate>
            <iconify-icon icon="solar:box-linear" class="fs-6"></iconify-icon>
            <span class="hide-menu ms-2">Produk</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('admin.suppliers.*') ? 'active' : '' }}" 
             href="{{ route('admin.suppliers.index') }}" wire:navigate>
            <iconify-icon icon="solar:delivery-linear" class="fs-6"></iconify-icon>
            <span class="hide-menu ms-2">Pemasok</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('admin.expenses.*') ? 'active' : '' }}" 
             href="{{ route('admin.expenses.index') }}" wire:navigate>
            <iconify-icon icon="streamline:money-graph-arrow-decrease-down-stats-graph-descend-right-arrow" class="fs-6"></iconify-icon>
            <span class="hide-menu ms-2">Pengeluaran</span>
          </a>
        </li>
        
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('admin.sales.*') ? 'active' : '' }}" 
             href="{{ route('admin.sales.index') }}" wire:navigate>
            <iconify-icon icon="streamline:money-graph-arrow-increase-ascend-growth-up-arrow-stats-graph-right-grow" class="fs-6"></iconify-icon>
            <span class="hide-menu ms-2">Penjualan</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" 
             href="{{ route('admin.reports.index') }}" wire:navigate>
            <iconify-icon icon="mdi:report-areaspline" class="fs-6"></iconify-icon>
            <span class="hide-menu ms-2">Laporan</span>
          </a>
        </li>
        @can('admin')
        <li class="sidebar-item">
          <a class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
             href="{{ route('admin.users.index') }}" wire:navigate>
            <iconify-icon icon="solar:users-group-rounded-linear" class="fs-6"></iconify-icon>
            <span class="hide-menu ms-2">Pengguna</span>
          </a>
        </li>
        @endcan
      </ul>
    </nav>

    <div class="border-top p-3 mt-auto">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
          <iconify-icon icon="solar:logout-2-linear"></iconify-icon>
          <span>Logout</span>
        </button>
      </form>
    </div>
  </div>
</aside>