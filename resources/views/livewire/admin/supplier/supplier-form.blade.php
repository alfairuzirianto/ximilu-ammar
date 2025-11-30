<div>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-1">{{ isset($supplierId) ? 'Edit' : 'Tambah' }} Pemasok</h2>
    <a href="{{ route('admin.suppliers.index') }}" wire:navigate class="btn btn-outline-secondary">Kembali</a>
  </div>

  <form wire:submit="{{ isset($supplierId) ? 'update' : 'save' }}">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Nama Pemasok <span class="text-danger">*</span></label>
            <input type="text" wire:model="nama" class="form-control @error('nama') is-invalid @enderror">
            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Telepon <span class="text-danger">*</span></label>
            <input type="text" wire:model="telepon" class="form-control @error('telepon') is-invalid @enderror">
            @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-12 mb-3">
            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
            <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-12 mb-3">
            <label class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
            <textarea wire:model="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror"></textarea>
            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
            <span wire:loading.remove><iconify-icon icon="solar:diskette-linear"></iconify-icon> {{ isset($supplierId) ? 'Update' : 'Simpan' }}</span>
            <span wire:loading><span class="spinner-border spinner-border-sm"></span> Menyimpan...</span>
          </button>
          <a href="{{ route('admin.suppliers.index') }}" wire:navigate class="btn btn-outline-secondary">Batal</a>
        </div>
      </div>
    </div>
  </form>
</div>