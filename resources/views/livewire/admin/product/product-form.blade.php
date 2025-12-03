<div>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">{{ isset($productId) ? 'Edit' : 'Tambah' }} Produk</h2>
    </div>
    <a href="{{ route('admin.products.index') }}" wire:navigate class="btn btn-outline-secondary">
      <iconify-icon icon="solar:arrow-left-linear"></iconify-icon> Kembali
    </a>
  </div>

  <form wire:submit="{{ isset($productId) ? 'update' : 'save' }}">
    <div class="row g-4">
      
      <!-- FORM -->
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:14px;">
          <div class="card-body">

            <div class="mb-3">
              <label class="form-label fw-semibold">Nama Produk <span class="text-danger">*</span></label>
              <input type="text" wire:model="nama" class="form-control @error('nama') is-invalid @enderror">
              @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                <select wire:model="kategori" class="form-select @error('kategori') is-invalid @enderror">
                  <option value="">Pilih</option>
                  @foreach(\App\Models\Product::KATEGORI as $k)
                  <option value="{{ $k }}">{{ $k }}</option>
                  @endforeach
                </select>
                @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Satuan <span class="text-danger">*</span></label>
                <select wire:model="satuan" class="form-select @error('satuan') is-invalid @enderror">
                  <option value="">Pilih</option>
                  @foreach(\App\Models\Product::SATUAN as $s)
                  <option value="{{ $s }}">{{ $s }}</option>
                  @endforeach
                </select>
                @error('satuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Harga Satuan <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text bg-light">Rp</span>
                <input type="number" wire:model="harga_satuan" class="form-control @error('harga_satuan') is-invalid @enderror">
              </div>
              @error('harga_satuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Deskripsi</label>
              <textarea wire:model="deskripsi" rows="4" class="form-control"></textarea>
            </div>

          </div>
        </div>
      </div>

      <!-- GAMBAR PRODUK -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm" style="border-radius:14px;">
          <div class="card-body">
            <h5 class="fw-bold mb-3">Gambar Produk</h5>

            @if($gambar)
            <img src="{{ $gambar->temporaryUrl() }}" class="w-100 rounded mb-2" style="aspect-ratio: 1/1; object-fit: cover;">
            @elseif($existingGambar)
            <img src="{{ asset('storage/'.$existingGambar) }}" class="w-100 rounded mb-2" style="aspect-ratio: 1/1; object-fit: cover;">
            @else
            <div class="bg-light rounded d-flex align-items-center justify-content-center mb-2"
              style="aspect-ratio:1/1;">
              <iconify-icon icon="solar:gallery-linear" class="text-muted" style="font-size: 4rem;"></iconify-icon>
            </div>
            @endif

            <input type="file" wire:model="gambar" class="form-control" accept="image/*">

            <div wire:loading wire:target="gambar" class="mt-2 text-secondary">
              <small><i class="spinner-border spinner-border-sm"></i> Upload...</small>
            </div>

            @error('gambar')<div class="text-danger small mt-1">{{ $message }}</div>@enderror

            <button type="submit" class="btn w-100 mt-3"
              style="background:#8B5E3C; color:white; border:none;">
              <span wire:loading.remove>
                <iconify-icon icon="solar:diskette-linear"></iconify-icon>
                {{ isset($productId) ? 'Update' : 'Simpan' }}
              </span>
              <span wire:loading><span class="spinner-border spinner-border-sm"></span> Menyimpan...</span>
            </button>

          </div>
        </div>
      </div>

    </div>
  </form>
</div>
