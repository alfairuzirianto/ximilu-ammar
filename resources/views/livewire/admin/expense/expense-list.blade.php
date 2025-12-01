<div>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div><h2 class="fw-bold mb-1">Pengeluaran</h2></div>
    <a href="{{ route('admin.expenses.create') }}" wire:navigate class="btn btn-primary d-flex align-items-center gap-2">
      <iconify-icon icon="mingcute:add-fill" width="16"></iconify-icon> 
      <span>Tambah Pengeluaran</span>
    </a>
  </div>

  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-6">
          <input type="text" wire:model.live.debounce.300ms="search" class="form-control" placeholder="Cari invoice...">
        </div>
        <div class="col-md-3">
          <select wire:model.live="kategori" class="form-select">
            <option value="">Semua Kategori</option>
            @foreach(\App\Models\Expense::KATEGORI as $k)
            <option value="{{ $k }}">{{ $k }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3">
          <select wire:model.live="status" class="form-select">
            <option value="">Semua Status</option>
            <option value="belum lunas">Belum Lunas</option>
            <option value="lunas">Lunas</option>
            <option value="dibatalkan">Dibatalkan</option>
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
                <th>Kategori</th>
                <th>Supplier</th>
                <th>Total</th>
                <th>Status</th>
                <th width="150">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($expenses as $item)
              <tr>
                <td><strong>{{ $item->kode_invoice }}</strong></td>
                <td>{{ $item->tanggal->format('d M Y') }}</td>
                <td><span class="badge bg-light text-dark">{{ $item->kategori }}</span></td>
                <td>{{ $item->supplier->nama ?? '-' }}</td>
                <td><strong>Rp {{ number_format($item->total, 0, ',', '.') }}</strong></td>
                <td>
                  @if($item->status == 'lunas')
                  <span class="badge bg-success">Lunas</span>
                  @elseif($item->status == 'belum lunas')
                  <span class="badge bg-warning">Belum Lunas</span>
                  @else
                  <span class="badge bg-danger">Dibatalkan</span>
                  @endif
                </td>
                <td>
                  <div class="d-flex gap-1">
                    <a href="{{ route('admin.expenses.show', $item->id) }}" wire:navigate class="btn btn-sm btn-info" title="Detail">
                      <iconify-icon icon="solar:eye-linear" width="16"></iconify-icon>
                    </a>
                    <a href="{{ route('admin.expenses.edit', $item->id) }}" wire:navigate class="btn btn-sm btn-warning" title="Edit">
                      <iconify-icon icon="solar:pen-linear" width="16"></iconify-icon>
                    </a>
                    <button wire:click="confirmDelete({{ $item->id }})" class="btn btn-sm btn-danger" title="Hapus">
                      <iconify-icon icon="solar:trash-bin-minimalistic-linear" width="16"></iconify-icon>
                    </button>
                  </div>
                </td>
              </tr>
              @empty
              <tr><td colspan="7" class="text-center text-muted py-4">Belum ada pengeluaran</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="mt-3">{{ $expenses->links() }}</div>
      </div>
    </div>
  </div>
</div>