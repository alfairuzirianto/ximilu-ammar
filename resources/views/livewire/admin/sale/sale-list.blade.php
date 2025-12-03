<div>
  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div><h2 class="dashboard-title mb-1">Penjualan</h2></div>
    <a href="{{ route('admin.sales.create') }}" wire:navigate class="btn btn-brown d-flex align-items-center gap-2">
      <iconify-icon icon="mingcute:add-fill" width="16"></iconify-icon> 
      <span>Tambah Penjualan</span>
    </a>
  </div>

  <!-- FILTER / SEARCH -->
  <div class="card-custom mb-4 p-3">
    <div class="row g-3">
      <div class="col-md-8">
        <input type="text" wire:model.live.debounce.300ms="search" class="form-control" placeholder="Cari invoice...">
      </div>
      <div class="col-md-4">
        <select wire:model.live="metode" class="form-select">
          <option value="">Semua Metode</option>
          @foreach(\App\Models\Sale::METODE as $m)
          <option value="{{ $m }}">{{ $m }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <!-- LOADING -->
  <div wire:loading class="text-center py-5">
    <div class="spinner-border text-brown" style="width: 3rem; height: 3rem;"></div>
  </div>

  <!-- TABLE -->
  <div wire:loading.remove>
    <div class="card-custom p-3">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>Invoice</th>
              <th>Tanggal</th>
              <th>Metode</th>
              <th>Total</th>
              <th width="150">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($sales as $item)
            <tr>
              <td><strong>{{ $item->kode_invoice }}</strong></td>
              <td>{{ $item->tanggal->format('d M Y') }}</td>
              <td><span class="badge badge-brown">{{ $item->metode }}</span></td>
              <td><strong class="text-brown">Rp {{ number_format($item->total, 0, ',', '.') }}</strong></td>
              <td>
                <div class="d-flex gap-1">
                  <a href="{{ route('admin.sales.show', $item->id) }}" wire:navigate class="btn btn-sm btn-brown">
                    <iconify-icon icon="solar:eye-linear" width="16"></iconify-icon>
                  </a>
                  <a href="{{ route('admin.sales.edit', $item->id) }}" wire:navigate class="btn btn-sm btn-light-brown">
                    <iconify-icon icon="solar:pen-linear" width="16"></iconify-icon>
                  </a>
                  <button wire:click="confirmDelete({{ $item->id }})" class="btn btn-sm btn-light text-danger">
                    <iconify-icon icon="solar:trash-bin-minimalistic-linear" width="16"></iconify-icon>
                  </button>
                </div>
              </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center text-muted py-4">Belum ada penjualan</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-3">{{ $sales->links() }}</div>
    </div>
  </div>
</div>

@push('styles')
<style>
.card-custom {
    background: #fff;
    border-radius: 14px;
    border: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: 0.2s ease;
}
.card-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.12);
}
.btn-brown {
    background: #d27b35;
    color: #fff !important;
    border-radius: 10px;
    border: none;
}
.btn-brown:hover {
    background: #bb6e2f;
    color: #fff !important;
}
.btn-light-brown {
    background: #f5e9d7;
    color: #5a4637;
    border-radius: 10px;
    border: none;
}
.badge-brown {
    background: #d27b35;
    color: white;
}
.text-brown {
    color: #d27b35 !important;
}
.dashboard-title {
    font-weight: 800;
    font-size: 26px;
    color: #5a4637;
}
</style>
@endpush
