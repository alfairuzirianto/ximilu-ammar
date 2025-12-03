<div>

  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="dashboard-title mb-1">{{ isset($userId) ? 'Edit' : 'Tambah' }} Pengguna</h2>
      <p class="text-muted mb-0">{{ isset($userId) ? 'Perbarui' : 'Masukkan' }} informasi user</p>
    </div>
    <a href="{{ route('admin.users.index') }}" wire:navigate class="btn btn-outline-brown">
      <iconify-icon icon="solar:arrow-left-linear"></iconify-icon> Kembali
    </a>
  </div>

  <!-- FORM -->
  <form wire:submit="{{ isset($userId) ? 'update' : 'save' }}">
    <div class="card-custom p-3">

      <div class="row g-3">

        <!-- Nama Lengkap -->
        <div class="col-md-6">
          <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
          <input type="text" wire:model="name" 
                 class="form-control @error('name') is-invalid @enderror">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Email -->
        <div class="col-md-6">
          <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
          <input type="email" wire:model="email" 
                 class="form-control @error('email') is-invalid @enderror">
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Password -->
        <div class="col-md-6">
          <label class="form-label fw-semibold">Password {{ isset($userId) ? '' : '*' }}</label>
          <input type="password" wire:model="password" 
                 class="form-control @error('password') is-invalid @enderror"
                 placeholder="{{ isset($userId) ? 'Kosongkan jika tidak diubah' : '' }}">
          @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="col-md-6">
          <label class="form-label fw-semibold">Konfirmasi Password</label>
          <input type="password" wire:model="password_confirmation" class="form-control">
        </div>

        <!-- Role -->
        <div class="col-12">
          <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
          <select wire:model="role" class="form-select @error('role') is-invalid @enderror">
            <option value="operator">Operator</option>
            <option value="admin">Admin</option>
          </select>
          @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

      </div>

      <!-- BUTTONS -->
      <div class="d-flex gap-2 mt-3">
        <button type="submit" class="btn btn-brown" wire:loading.attr="disabled">
          <span wire:loading.remove>
            <iconify-icon icon="solar:diskette-linear"></iconify-icon> {{ isset($userId) ? 'Update' : 'Simpan' }}
          </span>
          <span wire:loading>
            <span class="spinner-border spinner-border-sm"></span> Menyimpan...
          </span>
        </button>
        <a href="{{ route('admin.users.index') }}" wire:navigate class="btn btn-outline-brown">Batal</a>
      </div>

    </div>
  </form>
</div>

@push('styles')
<style>
  .btn-brown {
    background: #8B5E3C;
    color: #fff !important;
    border-radius: 10px;
    border: none;
  }
  .btn-brown:hover {
    background: #734A2F;
    color: #fff !important;
  }
  .btn-outline-brown {
    border: 1px solid #8B5E3C;
    color: #8B5E3C;
    border-radius: 10px;
  }
  .btn-outline-brown:hover {
    background: #8B5E3C;
    color: #fff;
  }
  .dashboard-title {
    color: #8B5E3C;
  }
  .card-custom {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
  }
</style>
@endpush
