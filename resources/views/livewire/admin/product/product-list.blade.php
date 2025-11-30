<div>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">Produk</h2>
      <p class="text-muted mb-0">Kelola produk untuk penjualan</p>
    </div>
    <a href="{{ route('admin.products.create') }}" wire:navigate class="btn btn-primary d-flex align-items-center gap-2">
      <iconify-icon icon="mingcute:add-fill" width="16"></iconify-icon>
      <span>Tambah Produk</span>
    </a>
  </div>

  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-8">
          <input type="text" wire:model.live.debounce.300ms="search" class="form-control" placeholder="Cari produk...">
        </div>
        <div class="col-md-4">
          <select wire:model.live="kategori" class="form-select">
            <option value="">Semua Kategori</option>
            @foreach($categories as $k)
            <option value="{{ $k }}">{{ $k }}</option>
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
    @if($products->count())
    <div class="row g-4">
      @foreach($products as $item)
      <div class="col-md-6 col-lg-4">
        <div class="card product-card border-0 shadow-sm max-h-100">
          <div class="position-relative">
            @if($item->gambar)
            <img src="{{ asset('storage/'.$item->gambar) }}" class="product-image" alt="{{ $item->nama }}">
            @else
            <div class="product-image bg-light d-flex align-items-center justify-content-center">
              <iconify-icon icon="solar:gallery-linear" class="text-muted" style="font-size: 4rem;"></iconify-icon>
            </div>
            @endif
          </div>
          
          <div class="card-body">
            <h5 class="fw-bold mb-2">{{ $item->nama }}</h5>
            <span class="badge bg-light text-dark mb-3">{{ $item->kategori }}</span>
            <p class="text-muted small mb-3">{{ Str::limit($item->deskripsi, 60) }}</p>
            
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <h5 class="fw-bold text-primary mb-0">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</h5>
                <small class="text-muted">per {{ $item->satuan }}</small>
              </div>
            </div>

            <div class="d-flex gap-2">
              <a href="{{ route('admin.products.edit', $item->id) }}" wire:navigate class="btn btn-sm btn-primary flex-grow-1 d-flex align-items-center justify-content-center gap-2">
                <iconify-icon icon="solar:pen-linear" width="18"></iconify-icon> Edit
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
    <div class="mt-4 d-flex align-items-center justify-content-center">{{ $products->links() }}</div>
    @else
    <div class="text-center py-5">
      <iconify-icon icon="solar:box-linear" style="font-size: 5rem;" class="text-muted mb-3"></iconify-icon>
      <h5 class="text-muted">Belum ada produk</h5>
    </div>
    @endif
  </div>
</div>