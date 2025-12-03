<div>
  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="dashboard-title">{{ isset($supplierId) ? 'Edit' : 'Tambah' }} Pemasok</h2>
    <a href="{{ route('admin.suppliers.index') }}" wire:navigate class="btn btn-outline-secondary">Kembali</a>
  </div>

  <!-- FORM -->
  <form wire:submit="{{ isset($supplierId) ? 'update' : 'save' }}">
    <div class="card-custom p-3">
      <div class="row">
        <!-- Nama Pemasok -->
        <div class="col-md-6 mb-3">
          <label class="form-label fw-semibold">Nama Pemasok <span class="text-danger">*</span></label>
          <input type="text" wire:model="nama" class="form-control @error('nama') is-invalid @enderror">
          @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <!-- Telepon -->
        <div class="col-md-6 mb-3">
          <label class="form-label fw-semibold">Telepon <span class="text-danger">*</span></label>
          <input type="text" wire:model="telepon" class="form-control @error('telepon') is-invalid @enderror">
          @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <!-- Email -->
        <div class="col-12 mb-3">
          <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
          <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
          @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <!-- Alamat -->
        <div class="col-12 mb-3">
          <label class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
          <textarea wire:model="alamat" rows="3" class="form-control resize-none @error('alamat') is-invalid @enderror"></textarea>
          @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
      </div>

      <!-- TOMBOL -->
      <div class="d-flex gap-2 mt-3 justify-content-end">
        <button type="submit" class="btn btn-brown" wire:loading.attr="disabled">
          <span wire:loading.remove>
            <iconify-icon icon="solar:diskette-linear"></iconify-icon> {{ isset($supplierId) ? 'Update' : 'Simpan' }}
          </span>
          <span wire:loading>
            <span class="spinner-border spinner-border-sm"></span> Menyimpan...
          </span>
        </button>
        <a href="{{ route('admin.suppliers.index') }}" wire:navigate class="btn btn-light-brown">Batal</a>
      </div>
    </div>
  </form>
</div>
