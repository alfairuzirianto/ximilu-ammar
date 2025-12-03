<div>

  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-1 section-title">Pemasok</h2>

    <a href="{{ route('admin.suppliers.create') }}" wire:navigate 
       class="btn btn-brown d-flex align-items-center gap-2 px-3">
      <iconify-icon icon="mingcute:add-fill" width="16"></iconify-icon>
      Tambah Pemasok
    </a>
  </div>

  <!-- SEARCH -->
  <div class="card-custom mb-4 p-3">
    <input type="text" wire:model.live.debounce.300ms="search"
           class="form-control" placeholder="Cari pemasok...">
  </div>

  <!-- LOADING -->
  <div wire:loading class="text-center py-5">
    <div class="spinner-border text-brown" style="width: 3rem; height: 3rem;"></div>
  </div>

  <!-- CONTENT -->
  <div wire:loading.remove>
    @if($suppliers->count())

    <div class="row g-4">
      @foreach($suppliers as $item)
      <div class="col-md-6 col-lg-4">
        <div class="card-custom h-100 p-3">

          <div class="d-flex align-items-start justify-content-between mb-2">
            <h5 class="fw-bold section-title">{{ $item->nama }}</h5>
            <span class="badge badge-brown">{{ $item->items_count }} item</span>
          </div>

          <div class="mb-2 text-muted small d-flex align-items-center gap-1">
            <iconify-icon icon="solar:phone-linear" width="16"></iconify-icon> 
            {{ $item->telepon }}
          </div>

          <div class="mb-2 text-muted small d-flex align-items-center gap-1">
            <iconify-icon icon="solar:letter-linear" width="16"></iconify-icon> 
            {{ $item->email }}
          </div>

          <div class="text-muted small d-flex align-items-center gap-1">
            <iconify-icon icon="solar:map-point-linear" width="16"></iconify-icon> 
            {{ Str::limit($item->alamat, 40) }}
          </div>

          <div class="d-flex gap-2 mt-3 pt-3 border-top">
            <a href="{{ route('admin.suppliers.show', $item->id) }}" wire:navigate
             class="btn btn-sm btn-brown flex-fill d-flex align-items-center justify-content-center gap-2">
              <iconify-icon icon="solar:eye-linear" width="18"></iconify-icon> Detail
            </a>

            <a href="{{ route('admin.suppliers.edit', $item->id) }}" wire:navigate
     class="btn btn-sm btn-light-brown flex-fill d-flex align-items-center justify-content-center gap-2">
    <iconify-icon icon="solar:pen-linear" width="18"></iconify-icon> Edit
  </a>

  <button wire:click="confirmDelete({{ $item->id }})"
          class="btn btn-sm btn-light text-danger flex-fill d-flex align-items-center justify-content-center gap-2">
    <iconify-icon icon="solar:trash-bin-minimalistic-linear" width="18"></iconify-icon> Hapus
  </button>
</div>

        </div>
      </div>
      @endforeach
    </div>

    <div class="mt-4">
      {{ $suppliers->links() }}
    </div>

    @else

    <div class="text-center py-5">
      <iconify-icon icon="solar:delivery-linear" style="font-size: 5rem;" 
                    class="text-muted mb-3"></iconify-icon>
      <h5 class="text-muted">Belum ada pemasok</h5>
    </div>

    @endif
  </div>

</div>

@push('styles')
<style>
  body {
    background: #f5e9d7 !important;
  }

  .card-custom {
    background: #fff;
    border-radius: 14px;
    border: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  }

  .section-title {
    color: #5a4637;
    font-weight: 700;
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
</style>
@endpush
