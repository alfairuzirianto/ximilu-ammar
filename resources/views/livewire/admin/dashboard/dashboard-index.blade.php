<style>
    body {
        background: #f5e9d7 !important;
    }

    .dashboard-title {
        font-weight: 800;
        font-size: 26px;
        color: #5a4637;
    }

    .subtitle {
        color: #8c7b6f;
    }

    .card-custom {
        border: none;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: 0.2s ease;
    }

    .card-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }

    .icon-box {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f5e9d7;
        color: #d27b35;
    }

    .chart-card {
        background: #fff;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .chart-title {
        font-weight: 700;
        margin-bottom: 15px;
        color: #5a4637;
    }
</style>

<div>
    <!-- TITLE -->
    <div class="mb-4">
        <h2 class="dashboard-title">Dashboard</h2>
        <p class="subtitle">Selamat datang di sistem manajemen UMKM</p>
    </div>

    <!-- STAT CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card-custom p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="subtitle small mb-1">Total Produk</p>
                        <h3 class="fw-bold fs-4">{{ $totalProduk }}</h3>
                    </div>
                    <div class="icon-box">
                        <iconify-icon icon="solar:box-linear" width="26"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card-custom p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="subtitle small mb-1">Total Pemasok</p>
                        <h3 class="fw-bold fs-4">{{ $totalPemasok }}</h3>
                    </div>
                    <div class="icon-box">
                        <iconify-icon icon="solar:delivery-linear" width="26"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card-custom p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="subtitle small mb-1">Penjualan Hari Ini</p>
                        <h3 class="fw-bold fs-4 text-success">Rp {{ number_format($penjualanHariIni, 0, ',', '.') }}</h3>
                    </div>
                    <div class="icon-box">
                        <iconify-icon icon="streamline:money-graph-arrow-increase-ascend-growth-up-arrow-stats-graph-right-grow" width="26"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card-custom p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="subtitle small mb-1">Pengeluaran Hari Ini</p>
                        <h3 class="fw-bold fs-4 text-danger">Rp {{ number_format($pengeluaranHariIni, 0, ',', '.') }}</h3>
                    </div>
                    <div class="icon-box">
                        <iconify-icon icon="streamline:money-graph-arrow-decrease-down-stats-graph-descend-right-arrow" width="26"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CHARTS ROW 1 -->
    <div class="row g-3 mb-4">
        <div class="col-lg-8">
            <div class="chart-card">
                <h5 class="chart-title">Arus Kas (7 Hari Terakhir)</h5>
                <div id="chartArusKas"></div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="chart-card">
                <h5 class="chart-title">Pengeluaran per Kategori</h5>
                <div id="chartPengeluaranKategori"></div>
            </div>
        </div>
    </div>

    <!-- CHART ROW 2 -->
    <div class="row g-3">
        <div class="col-lg-4">
            <div class="chart-card">
                <h5 class="chart-title">Status Pembayaran Supplier</h5>
                <div id="chartStatusPembayaran"></div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="chart-card">
                <h5 class="chart-title">Top 5 Produk Terjual</h5>
                <div id="chartTopProduk"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var chartArusKas, chartPengeluaranKategori, chartStatusPembayaran, chartTopProduk;

    // Arus Kas
    var optionsArusKas = {
        series: [{
            name: 'Pemasukan',
            data: @json($arusKas->pluck('pemasukan'))
        }, {
            name: 'Pengeluaran',
            data: @json($arusKas->pluck('pengeluaran'))
        }],
        chart: { type: 'line', height: 300, toolbar: { show: false }},
        colors: ['#10b981', '#ef4444'],
        stroke: { width: 4, curve: 'smooth' },
        xaxis: { categories: @json($arusKas->pluck('date')) },
        yaxis: {
            labels: {
                formatter: val => 'Rp ' + val.toLocaleString('id-ID')
            }
        }
    };

    // Pengeluaran kategori
    var optionsPengeluaranKategori = {
        series: @json($pengeluaranKategori->pluck('total')->map(fn($v) => (float) $v)),
        chart: { type: 'polarArea', height: 260 },
        labels: @json($pengeluaranKategori->pluck('kategori')),
        colors: ['#d27b35', '#3b82f6', '#10b981', '#ef4444', '#8b5cf6', '#ec4899'],
        legend: { position: 'bottom' }
    };

    // Status pembayaran
    var optionsStatusPembayaran = {
        series: [{{ $statusPembayaran['lunas'] }}, {{ $statusPembayaran['belum_lunas'] }}],
        chart: { type: 'pie', height: 250 },
        labels: ['Lunas', 'Belum Lunas'],
        colors: ['#10b981', '#d27b35'],
        legend: { position: 'bottom' }
    };

    // Top produk
    var optionsTopProduk = {
        series: [{
            name: 'Terjual',
            data: @json($topProduk->pluck('total'))
        }],
        chart: { type: 'bar', height: 300, toolbar: { show: false }},
        colors: ['#d27b35'],
        plotOptions: { bar: { horizontal: true, borderRadius: 6 }},
        xaxis: { categories: @json($topProduk->pluck('nama')) }
    };

    function initCharts() {
        if (chartArusKas) chartArusKas.destroy();
        if (chartPengeluaranKategori) chartPengeluaranKategori.destroy();
        if (chartStatusPembayaran) chartStatusPembayaran.destroy();
        if (chartTopProduk) chartTopProduk.destroy();

        chartArusKas = new ApexCharts(document.querySelector("#chartArusKas"), optionsArusKas);
        chartPengeluaranKategori = new ApexCharts(document.querySelector("#chartPengeluaranKategori"), optionsPengeluaranKategori);
        chartStatusPembayaran = new ApexCharts(document.querySelector("#chartStatusPembayaran"), optionsStatusPembayaran);
        chartTopProduk = new ApexCharts(document.querySelector("#chartTopProduk"), optionsTopProduk);

        chartArusKas.render();
        chartPengeluaranKategori.render();
        chartStatusPembayaran.render();
        chartTopProduk.render();
    }

    document.addEventListener("DOMContentLoaded", initCharts);
    document.addEventListener("livewire:navigated", initCharts);
</script>
@endpush
