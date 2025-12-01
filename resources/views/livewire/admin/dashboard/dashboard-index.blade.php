<div>
  <div class="mb-4">
    <h2 class="fw-bold">Dashboard</h2>
    <p class="text-muted">Selamat datang di sistem manajemen UMKM</p>
  </div>

  <!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
      <div class="card border-0 shadow-sm">
        <div class="card-body px-lg-9">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="text-muted mb-1 small">Total Produk</h6>
              <h3 class="mb-0 fw-bold fs-5">{{ $totalProduk }}</h3>
            </div>
            <iconify-icon icon="solar:box-linear" class="text-primary" width="30" height="30"></iconify-icon>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
      <div class="card border-0 shadow-sm">
        <div class="card-body px-lg-9">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="text-muted mb-1 small">Total Pemasok</h6>
              <h3 class="mb-0 fw-bold fs-5">{{ $totalPemasok }}</h3>
            </div>
            <iconify-icon icon="solar:delivery-linear" class="text-info" width="30" height="30"></iconify-icon>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
      <div class="card border-0 shadow-sm">
        <div class="card-body px-lg-9">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="text-muted mb-1 small">Penjualan Hari Ini</h6>
              <h3 class="mb-0 fw-bold fs-5 text-success">Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</h3>
            </div>
            <iconify-icon icon="streamline:money-graph-arrow-increase-ascend-growth-up-arrow-stats-graph-right-grow" class="text-success" width="30" height="30"></iconify-icon>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
      <div class="card border-0 shadow-sm">
        <div class="card-body px-lg-9">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="text-muted mb-1 small">Pengeluaran Hari Ini</h6>
              <h3 class="mb-0 fw-bold fs-5 text-danger">Rp {{ number_format($pengeluaranHariIni, 0, ',', '.') }}</h3>
            </div>
            <iconify-icon icon="streamline:money-graph-arrow-decrease-down-stats-graph-descend-right-arrow" class="text-danger" width="30" height="30"></iconify-icon>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts Row 1 -->
  <div class="row g-3 mb-4">
    <!-- Arus Kas -->
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Arus Kas (7 Hari Terakhir)</h5>
          <div id="chartArusKas"></div>
        </div>
      </div>
    </div>

    <!-- Pengeluaran per Kategori -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Pengeluaran per Kategori</h5>
          <div id="chartPengeluaranKategori"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts Row 2 -->
  <div class="row g-3">
    <!-- Status Pembayaran -->
    <div class="col-lg-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Status Pembayaran Supplier</h5>
          <div id="chartStatusPembayaran"></div>
        </div>
      </div>
    </div>

    <!-- Top Produk -->
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Top 5 Produk Terjual</h5>
          <div id="chartTopProduk"></div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  var chartArusKas, chartPengeluaranKategori, chartStatusPembayaran, chartTopProduk;

  // Arus Kas Chart
    var optionsArusKas = {
      series: [{
        name: 'Pemasukan',
        data: @json($arusKas->pluck('pemasukan'))
      }, {
        name: 'Pengeluaran',
        data: @json($arusKas->pluck('pengeluaran'))
      }],
      chart: { type: 'line', height: 300, toolbar: { show: false } },
      colors: ['#10b981', '#ef4444'],
      stroke: { width: 3, curve: 'smooth' },
      xaxis: { categories: @json($arusKas->pluck('date')) },
      yaxis: {
        labels: {
          formatter: function(val) {
            return 'Rp ' + val.toLocaleString('id-ID');
          }
        }
      },
      legend: { position: 'top' }
    };
  
    // Pengeluaran Kategori Chart
    var optionsPengeluaranKategori = {
        series: @json($pengeluaranKategori->pluck('total')->map(fn($v) => (float) $v)),
        chart: {
            type: 'polarArea',
            height: 250
        },
        labels: @json($pengeluaranKategori->pluck('kategori')),
        colors: ['#DA7326', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899'],
        legend: { position: 'bottom' },
        stroke: {
            width: 1
        },
        fill: {
            opacity: 0.8
        },
        tooltip: {
            y: {
                formatter: function (value) {
                    return "Rp " + value.toLocaleString("id-ID");
                }
            }
        }
    };
    
    // Status Pembayaran Chart
    var optionsStatusPembayaran = {
      series: [{{ $statusPembayaran['lunas'] }}, {{ $statusPembayaran['belum_lunas'] }}],
      chart: { type: 'pie', height: 250 },
      labels: ['Lunas', 'Belum Lunas'],
      colors: ['#10b981', '#f59e0b'],
      legend: { position: 'bottom' }
    };
  
    // Top Produk Chart
    var optionsTopProduk = {
      series: [{
        name: 'Terjual',
        data: @json($topProduk->pluck('total'))
      }],
      chart: { type: 'bar', height: 300, toolbar: { show: false } },
      colors: ['#DA7326'],
      plotOptions: {
        bar: { horizontal: true, borderRadius: 4 }
      },
      xaxis: { categories: @json($topProduk->pluck('nama')) },
      dataLabels: { enabled: false }
    };

  function initCharts() {
    if (chartArusKas) { chartArusKas.destroy(); }
    if (chartPengeluaranKategori) { chartPengeluaranKategori.destroy(); }
    if (chartStatusPembayaran) { chartStatusPembayaran.destroy(); }
    if (chartTopProduk) { chartTopProduk.destroy(); }

    chartArusKas = new ApexCharts(document.querySelector("#chartArusKas"), optionsArusKas);
    chartArusKas.render();

    chartPengeluaranKategori = new ApexCharts(document.querySelector("#chartPengeluaranKategori"), optionsPengeluaranKategori);
    chartPengeluaranKategori.render();

    chartStatusPembayaran = new ApexCharts(document.querySelector("#chartStatusPembayaran"), optionsStatusPembayaran);
    chartStatusPembayaran.render();

    chartTopProduk = new ApexCharts(document.querySelector("#chartTopProduk"), optionsTopProduk);
    chartTopProduk.render();
  }

  document.addEventListener("DOMContentLoaded", function () {
      initCharts();
  });

  document.addEventListener("livewire:navigated", function () {
      initCharts();
  });
</script>
@endpush