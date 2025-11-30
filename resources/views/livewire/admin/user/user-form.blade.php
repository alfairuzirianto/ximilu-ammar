<div>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
    <h2 class="fw-bold mb-1">{{ isset($userId) ? 'Edit' : 'Tambah' }} Pengguna</h2>
      <p class="text-muted mb-0">{{ isset($userId) ? 'Perbarui' : 'Masukkan' }} informasi user</p>
    </div>
    <a href="{{ route('admin.users.index') }}" wire:navigate class="btn btn-outline-secondary">
      <iconify-icon icon="solar:arrow-left-linear"></iconify-icon> Kembali
    </a>
  </div>

  <form wire:submit="{{ isset($userId) ? 'update' : 'save' }}">
    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
            <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Password {{ isset($userId) ? '' : '*' }}</label>
            <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ isset($userId) ? 'Kosongkan jika tidak diubah' : '' }}">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Konfirmasi Password</label>
            <input type="password" wire:model="password_confirmation" class="form-control">
          </div>

          <div class="col-12 mb-3">
            <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
            <select wire:model="role" class="form-select @error('role') is-invalid @enderror">
              <option value="operator">Operator</option>
              <option value="admin">Admin</option>
            </select>
            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
            <span wire:loading.remove>
              <iconify-icon icon="solar:diskette-linear"></iconify-icon> {{ isset($userId) ? 'Update' : 'Simpan' }}
            </span>
            <span wire:loading>
              <span class="spinner-border spinner-border-sm"></span> Menyimpan...
            </span>
          </button>
          <a href="{{ route('admin.users.index') }}" wire:navigate class="btn btn-outline-secondary">Batal</a>
        </div>
      </div>
    </div>
  </form>
</div>