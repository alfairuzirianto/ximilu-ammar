<div>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div><h2 class="fw-bold mb-1">Penjualan</h2></div>
    <a href="{{ route('admin.sales.create') }}" wire:navigate class="btn btn-primary d-flex align-items-center gap-2">
      <iconify-icon icon="mingcute:add-fill" width="16"></iconify-icon> 
      <span>Tambah Penjualan</span>
    </a>
  </div>

  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
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
  </div>

  <div wire:loading class="text-center py-5">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"></div>
  </div>

  <div wire:loading.remove>
    <div class="card border-0 shadow-sm">
      <div class="card-body">
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
                <td><span class="badge bg-light text-dark">{{ $item->metode }}</span></td>
                <td><strong class="text-success">Rp {{ number_format($item->total, 0, ',', '.') }}</strong></td>
                <td>
                  <div class="d-flex gap-1">
                    <a href="{{ route('admin.sales.show', $item->id) }}" wire:navigate class="btn btn-sm btn-info">
                      <iconify-icon icon="solar:eye-linear" width="16"></iconify-icon>
                    </a>
                    <a href="{{ route('admin.sales.edit', $item->id) }}" wire:navigate class="btn btn-sm btn-warning">
                      <iconify-icon icon="solar:pen-linear" width="16"></iconify-icon>
                    </a>
                    <button wire:click="confirmDelete({{ $item->id }})" class="btn btn-sm btn-danger">
                      <iconify-icon icon="solar:trash-bin-minimalistic-linear" width="16"></iconify-icon>
                    </button>
                  </div>
                </td>
              </tr>
              @empty
              <tr><td colspan="4" class="text-center text-muted py-4">Belum ada penjualan</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="mt-3">{{ $sales->links() }}</div>
      </div>
    </div>
  </div>
</div>