<nav class="navbar navbar-expand-lg py-2 px-3 shadow-sm"
     style="
        background: #f6eee7;
        border-bottom: 1px solid #e0d3c6;
     ">
    <div class="container-fluid">

        <!-- LEFT KOSONG -->
        <div class="flex-grow-1"></div>

        <!-- RIGHT -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">

                <button class="d-flex align-items-center gap-2 px-3 py-2 rounded-4 border"
                        style="
                            background: #f2e6db;
                            border: 1px solid #d5c4b4;
                            color: #5a4337;
                        "
                        data-bs-toggle="dropdown">

                    <!-- Avatar -->
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="
                            width: 38px;
                            height: 38px;
                            background: #c9a889;
                            color: white;
                            font-weight: 600;
                            font-size: 14px;
                         ">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>

                    <!-- Name + Role -->
                    <div class="text-start">
                        <div class="fw-semibold" style="font-size: 14px; color: #4a3b33;">
                            {{ Auth::user()->name }}
                        </div>
                        <span class="badge rounded-pill"
                              style="background: #b5835a; font-size: 10px; color:white;">
                            Administrator
                        </span>
                    </div>

                    <!-- Arrow -->
                    <iconify-icon icon="ph:caret-down-bold" 
                                  style="font-size: 16px; color: #7a6a5e;">
                    </iconify-icon>
                </button>

                <!-- DROPDOWN MENU -->
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 p-2"
                    style="background: #fff9f3;">

                    <li class="px-3 py-2">
                        <div class="fw-semibold" style="color:#4a3b33;">
                            {{ Auth::user()->name }}
                        </div>
                        <div class="text-muted" style="font-size: 12px;">
                            {{ Auth::user()->email }}
                        </div>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item"
                                    style="color: #b63d39; font-weight: 500;">
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>

            </li>
        </ul>

    </div>
</nav>
