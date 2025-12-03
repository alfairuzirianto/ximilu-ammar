<div>

  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-1 text-brown">Pengeluaran</h2>
    <a href="{{ route('admin.expenses.create') }}" wire:navigate 
       class="btn btn-brown d-flex align-items-center gap-2 px-3">
      <iconify-icon icon="mingcute:add-fill" width="16"></iconify-icon>
      <span>Tambah Pengeluaran</span>
    </a>
  </div>

  <!-- FILTER / SEARCH -->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-6">
          <input type="text" 
                 wire:model.live.debounce.300ms="search"
                 class="form-control border-brown"
                 placeholder="Cari invoice...">
        </div>
        <div class="col-md-3">
          <select wire:model.live="kategori" class="form-select border-brown">
            <option value="">Semua Kategori</option>
            @foreach(\App\Models\Expense::KATEGORI as $k)
              <option value="{{ $k }}">{{ $k }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3">
          <select wire:model.live="status" class="form-select border-brown">
            <option value="">Semua Status</option>
            <option value="belum lunas">Belum Lunas</option>
            <option value="lunas">Lunas</option>
            <option value="dibatalkan">Dibatalkan</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <!-- LOADING -->
  <div wire:loading class="text-center py-5">
    <div class="spinner-border text-brown" style="width: 3rem; height: 3rem;"></div>
  </div>

  <!-- TABLE -->
  <div wire:loading.remove>
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-brown">
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
                  <td class="fw-bold text-brown">{{ $item->kode_invoice }}</td>
                  <td>{{ $item->tanggal->format('d M Y') }}</td>
                  <td><span class="badge bg-light text-dark border-brown">{{ $item->kategori }}</span></td>
                  <td>{{ $item->supplier->nama ?? '-' }}</td>
                  <td class="fw-bold text-brown">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
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
                      <a href="{{ route('admin.expenses.show', $item->id) }}" wire:navigate 
                         class="btn btn-sm btn-outline-brown" title="Detail">
                        <iconify-icon icon="solar:eye-linear" width="16"></iconify-icon>
                      </a>
                      <a href="{{ route('admin.expenses.edit', $item->id) }}" wire:navigate 
                         class="btn btn-sm btn-outline-warning" title="Edit">
                        <iconify-icon icon="solar:pen-linear" width="16"></iconify-icon>
                      </a>
                      <button wire:click="confirmDelete({{ $item->id }})" 
                              class="btn btn-sm btn-outline-danger" title="Hapus">
                        <iconify-icon icon="solar:trash-bin-minimalistic-linear" width="16"></iconify-icon>
                      </button>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center text-muted py-4">Belum ada pengeluaran</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="mt-3">{{ $expenses->links() }}</div>
      </div>
    </div>
  </div>
</div>

@push('styles')
<style>
  .text-brown { color: #8B5E3C !important; }

  .btn-brown {
    background: #8B5E3C; 
    color: #fff;
    border-radius: 10px;
  }
  .btn-brown:hover { background: #734A2F; color: #fff; }

  .btn-outline-brown {
    border: 1px solid #8B5E3C;
    color: #8B5E3C;
  }
  .btn-outline-brown:hover { background: #8B5E3C; color: #fff; }

  .border-brown { border-color: #8B5E3C !important; }

  .table-brown { background: #F3ECE6 !important; color: #5A3E2B !important; }

  .spinner-border.text-brown { border-color: #8B5E3C !important; }
</style>
@endpush
