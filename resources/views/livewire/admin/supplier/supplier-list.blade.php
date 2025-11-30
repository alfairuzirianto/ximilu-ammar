<div>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div><h2 class="fw-bold mb-1">Pemasok</h2></div>
    <a href="{{ route('admin.suppliers.create') }}" wire:navigate class="btn btn-primary d-flex align-items-center gap-2">
      <iconify-icon icon="mingcute:add-fill" width="16"></iconify-icon>
      <span>Tambah Pemasok</span>
    </a>
  </div>

  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
      <input type="text" wire:model.live.debounce.300ms="search" class="form-control" placeholder="Cari pemasok...">
    </div>
  </div>

  <div wire:loading class="text-center py-5">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"></div>
  </div>

  <div wire:loading.remove>
    @if($suppliers->count())
    <div class="row g-4">
      @foreach($suppliers as $item)
      <div class="col-md-6 col-lg-4">
        <div class="card product-card border-0 shadow-sm h-100">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-3">
              <h3 class="fw-bold mb-3">{{ $item->nama }}</h3>
              <span class="badge bg-primary">{{ $item->items_count }} item</span>
            </div>
            
            <div class="mb-2 text-muted small d-flex align-items-center gap-1">
              <iconify-icon icon="solar:phone-linear" width="16"></iconify-icon> {{ $item->telepon }}
            </div>
            <div class="mb-2 text-muted small d-flex align-items-center gap-1">
              <iconify-icon icon="solar:letter-linear" width="16"></iconify-icon> {{ $item->email }}
            </div>
            <div class="text-muted small d-flex align-items-center gap-1">
              <iconify-icon icon="solar:map-point-linear" width="16"></iconify-icon> {{ Str::limit($item->alamat, 40) }}
            </div>
            
            <div class="d-flex gap-2 mt-3 pt-3 border-top">
              <a href="{{ route('admin.suppliers.show', $item->id) }}" wire:navigate class="btn btn-sm btn-primary flex-grow-1 d-flex align-items-center justify-content-center gap-2">
                <iconify-icon icon="solar:eye-linear" width="18"></iconify-icon> Detail
              </a>
              <a href="{{ route('admin.suppliers.edit', $item->id) }}" wire:navigate class="btn btn-sm btn-light">
                <iconify-icon icon="solar:pen-linear" width="18"></iconify-icon>
              </a>
              <button wire:click="confirmDelete({{ $item->id }})" class="btn btn-sm btn-light text-danger">
                <iconify-icon icon="solar:trash-bin-minimalistic-linear" width="18"></iconify-icon>
              </button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="mt-4">{{ $suppliers->links() }}</div>
    @else
    <div class="text-center py-5">
      <iconify-icon icon="solar:delivery-linear" style="font-size: 5rem;" class="text-muted mb-3"></iconify-icon>
      <h5 class="text-muted">Belum ada pemasok</h5>
    </div>
    @endif
  </div>
</div>