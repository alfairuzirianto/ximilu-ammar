<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Ximilu Ammar</title>
  <link rel="stylesheet" href="{{ asset('/assets/css/styles.min.css') }}" />
  <style>
    [data-bs-theme="dark"] {
      --bs-body-bg: #1a1d1f;
      --bs-body-color: #e4e4e7;
      --bs-card-bg: #27272a;
    }
    .product-card {
      transition: transform 0.2s, box-shadow 0.2s;
      cursor: pointer;
    }
    .product-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    .product-image {
      height: 200px;
      object-fit: cover;
      width: 100%;
      border-radius: 8px 8px 0 0;
    }
    .status-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      z-index: 1;
    }
    nav svg {
      width: 1em !important;
      height: 1em !important;
      transform: none !important;
    }
  </style>
  @livewireStyles
  @stack('styles')
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    
    @include('components.sidebar')

    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('components.header')
      <!--  Header End -->
      
      <div class="container-fluid ">
        {{ $slot }}
      </div>
    </div>
  </div>

  <script src="{{ asset('/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('/assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('/assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('/assets/js/app.min.js') }}"></script>
  <script src="{{ asset('/assets/js/dashboard.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @livewireScripts
  <script>
    // Toast configuration
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    });

    // Livewire events
    window.addEventListener('success', event => {
      Toast.fire({
        icon: 'success',
        title: event.detail.message || event.detail[0] || 'Berhasil!'
      });
    });

    window.addEventListener('error', event => {
      Toast.fire({
        icon: 'error',
        title: event.detail.message || event.detail[0] || 'Terjadi kesalahan!'
      });
    });

    window.addEventListener('warning', event => {
      Toast.fire({
        icon: 'warning',
        title: event.detail.message || event.detail[0] || 'Perhatian!'
      });
    });

    // Confirm delete
    window.addEventListener('confirm-delete', event => {
      Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: event.detail.message || "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DA7326',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          Livewire.dispatch('delete-confirmed', { id: event.detail.id });
        }
      });
    });
  </script>

  @stack('scripts')
</body>

</html>