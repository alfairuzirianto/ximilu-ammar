<div>

  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div><h2 class="fw-bold mb-1" style="color:#8B5E3C;">Laporan</h2></div>
    <button wire:click="exportPdf" class="btn btn-brown">
      <iconify-icon icon="solar:download-linear" width="20"></iconify-icon> Export PDF
    </button>
  </div>

  <!-- FILTER -->
  <div class="card-custom mb-4 p-3">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Jenis Laporan</label>
        <select wire:model.live="reportType" class="form-select border-brown">
          <option value="penjualan">Laporan Penjualan</option>
          <option value="pengeluaran">Laporan Pengeluaran</option>
          <option value="laba-rugi">Laporan Laba Rugi</option>
          <option value="arus-kas">Laporan Arus Kas</option>
          <option value="utang">Laporan Utang</option>
        </select>
      </div>
      @if($reportType != 'utang')
      <div class="col-md-3">
        <label class="form-label">Dari Tanggal</label>
        <input type="date" wire:model.live="startDate" class="form-control border-brown">
      </div>
      <div class="col-md-3">
        <label class="form-label">Sampai Tanggal</label>
        <input type="date" wire:model.live="endDate" class="form-control border-brown">
      </div>
      @endif
    </div>
  </div>

  <!-- REPORT CONTENT -->
  <div class="card-custom border-0 shadow-sm">
    <div class="card-body">
      @if($reportType == 'penjualan')
        <h5 class="fw-bold mb-3 text-brown">Laporan Penjualan</h5>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-brown">
              <tr>
                <th>Invoice</th>
                <th>Tanggal</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @forelse($reportData as $item)
              <tr>
                <td>{{ $item->kode_invoice }}</td>
                <td>{{ $item->tanggal->format('d M Y') }}</td>
                <td class="text-brown">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
              </tr>
              @empty
              <tr><td colspan="3" class="text-center text-muted">Tidak ada data</td></tr>
              @endforelse
              @if($reportData->count())
              <tr class="fw-bold">
                <td colspan="2" class="text-end">Total Penjualan:</td>
                <td class="text-brown">Rp {{ number_format($reportData->sum('total'), 0, ',', '.') }}</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>

      @elseif($reportType == 'pengeluaran')
        <h5 class="fw-bold mb-3 text-brown">Laporan Pengeluaran</h5>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-brown">
              <tr>
                <th>Invoice</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Supplier</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @forelse($reportData as $item)
              <tr>
                <td>{{ $item->kode_invoice }}</td>
                <td>{{ $item->tanggal->format('d M Y') }}</td>
                <td><span class="badge bg-light text-dark border-brown">{{ $item->kategori }}</span></td>
                <td>{{ $item->supplier->nama ?? '-' }}</td>
                <td class="text-brown">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
              </tr>
              @empty
              <tr><td colspan="5" class="text-center text-muted">Tidak ada data</td></tr>
              @endforelse
              @if($reportData->count())
              <tr class="fw-bold">
                <td colspan="4" class="text-end">Total Pengeluaran:</td>
                <td class="text-brown">Rp {{ number_format($reportData->sum('total'), 0, ',', '.') }}</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>

      @elseif($reportType == 'laba-rugi')
        <h5 class="fw-bold mb-4 text-brown">Laporan Laba Rugi</h5>
        <div class="row g-3">
          <div class="col-md-4">
            <div class="border rounded p-3">
              <small class="text-muted">Total Penjualan</small>
              <h4 class="text-success mb-0">Rp {{ number_format($reportData['penjualan'], 0, ',', '.') }}</h4>
            </div>
          </div>
          <div class="col-md-4">
            <div class="border rounded p-3">
              <small class="text-muted">Total Pengeluaran</small>
              <h4 class="text-danger mb-0">Rp {{ number_format($reportData['pengeluaran'], 0, ',', '.') }}</h4>
            </div>
          </div>
          <div class="col-md-4">
            <div class="border rounded p-3 {{ $reportData['laba'] >= 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10">
              <small class="text-muted">{{ $reportData['laba'] >= 0 ? 'Laba' : 'Rugi' }}</small>
              <h4 class="{{ $reportData['laba'] >= 0 ? 'text-success' : 'text-danger' }} mb-0">
                Rp {{ number_format(abs($reportData['laba']), 0, ',', '.') }}
              </h4>
            </div>
          </div>
        </div>

      @elseif($reportType == 'arus-kas')
        <h5 class="fw-bold mb-4 text-brown">Laporan Arus Kas</h5>
        <div class="row g-3">
          <div class="col-md-4">
            <div class="border rounded p-3">
              <small class="text-muted">Pemasukan (Penjualan)</small>
              <h4 class="text-success mb-0">Rp {{ number_format($reportData['pemasukan'], 0, ',', '.') }}</h4>
            </div>
          </div>
          <div class="col-md-4">
            <div class="border rounded p-3">
              <small class="text-muted">Pengeluaran (Dibayar)</small>
              <h4 class="text-danger mb-0">Rp {{ number_format($reportData['pengeluaran'], 0, ',', '.') }}</h4>
            </div>
          </div>
          <div class="col-md-4">
            <div class="border rounded p-3 bg-brown bg-opacity-10">
              <small class="text-muted">Saldo Kas</small>
              <h4 class="text-brown mb-0">Rp {{ number_format($reportData['saldo'], 0, ',', '.') }}</h4>
            </div>
          </div>
        </div>

      @elseif($reportType == 'utang')
        <h5 class="fw-bold mb-3 text-brown">Laporan Utang</h5>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-brown">
              <tr>
                <th>Invoice</th>
                <th>Supplier</th>
                <th>Total</th>
                <th>Dibayar</th>
                <th>Sisa</th>
              </tr>
            </thead>
            <tbody>
              @forelse($reportData as $item)
              <tr>
                <td>{{ $item['expense']->kode_invoice }}</td>
                <td>{{ $item['expense']->supplier->nama ?? '-' }}</td>
                <td>Rp {{ number_format($item['expense']->total, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item['expense']->totalPaid(), 0, ',', '.') }}</td>
                <td class="text-danger fw-bold">Rp {{ number_format($item['sisa'], 0, ',', '.') }}</td>
              </tr>
              @empty
              <tr><td colspan="5" class="text-center text-muted">Tidak ada utang</td></tr>
              @endforelse
              @if($reportData->count())
              <tr class="fw-bold">
                <td colspan="4" class="text-end">Total Utang:</td>
                <td class="text-danger">Rp {{ number_format($reportData->sum('sisa'), 0, ',', '.') }}</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>

</div>

@push('styles')
<style>
  .btn-brown {
    background: #8B5E3C; 
    color: #fff !important;
    border-radius: 10px;
    border: none;
  }
  .btn-brown:hover {
    background: #734A2F;
    color: #fff !important;
  }
  .border-brown { border-color: #8B5E3C !important; }
  .table-brown {
    background: #F3ECE6 !important;
    color: #5A3E2B !important;
  }
  .text-brown { color: #8B5E3C !important; }
  .bg-brown.bg-opacity-10 { background-color: rgba(139,94,60,0.1) !important; }
</style>
@endpush
