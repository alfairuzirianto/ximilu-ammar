<div>

  <!-- HEADER -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="dashboard-title mb-1">Manajemen Pengguna</h2>
      <p class="text-muted mb-0">Kelola akses admin dan operator</p>
    </div>
    <a href="{{ route('admin.users.create') }}" wire:navigate class="btn btn-brown d-flex align-items-center gap-2">
      <iconify-icon icon="mingcute:add-fill" width="16"></iconify-icon>
      <span>Tambah Pengguna</span>
    </a>
  </div>

  <!-- FILTER -->
  <div class="card-custom mb-4 p-3">
    <div class="row g-3">
      <div class="col-md-8">
        <input type="text" wire:model.live.debounce.300ms="search" class="form-control border-brown" placeholder="Cari nama atau email...">
      </div>
      <div class="col-md-4">
        <select wire:model.live="role" class="form-select border-brown">
          <option value="">Semua Role</option>
          <option value="admin">Admin</option>
          <option value="operator">Operator</option>
        </select>
      </div>
    </div>
  </div>

  <!-- LOADING -->
  <div wire:loading class="text-center py-5">
    <div class="spinner-border text-brown" style="width: 3rem; height: 3rem;"></div>
  </div>

  <!-- USERS -->
  <div wire:loading.remove>
    @if($users->count())
    <div class="row g-4">
      @foreach($users as $user)
      <div class="col-md-6 col-lg-4">
        <div class="card-custom h-100 text-center p-3">
          
          <div class="rounded-circle bg-brown bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
            <iconify-icon icon="solar:user-bold" class="text-brown" style="font-size: 2.5rem;"></iconify-icon>
          </div>

          <h5 class="fw-bold mb-2 text-brown">{{ $user->name }}</h5>
          <p class="text-muted mb-3">{{ $user->email }}</p>

          <span class="badge {{ $user->isAdmin() ? 'bg-brown' : 'bg-success' }} mb-3">
            {{ ucfirst($user->role) }}
          </span>

          @if($user->id == auth()->id())
          <p class="text-muted small">(Akun Anda)</p>
          @endif

          <div class="d-flex gap-2 mt-3">
            <a href="{{ route('admin.users.edit', $user->id) }}" wire:navigate class="btn btn-brown flex-grow-1">
              <iconify-icon icon="solar:pen-linear" width="18"></iconify-icon> Edit
            </a>
            @if($user->id != auth()->id())
            <button wire:click="confirmDelete({{ $user->id }})" class="btn btn-light text-danger">
              <iconify-icon icon="solar:trash-bin-minimalistic-linear" width="18"></iconify-icon>
            </button>
            @endif
          </div>

        </div>
      </div>
      @endforeach
    </div>

    <div class="mt-4">{{ $users->links() }}</div>
    @else
    <div class="text-center py-5">
      <iconify-icon icon="solar:users-group-rounded-linear" style="font-size: 5rem;" class="text-muted mb-3"></iconify-icon>
      <h5 class="text-muted">Tidak ada users</h5>
    </div>
    @endif
  </div>

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
  .badge.bg-brown {
    background: #8B5E3C;
    color: #fff;
  }
  .text-brown { color: #8B5E3C !important; }
  .border-brown { border-color: #8B5E3C !important; }
  .card-custom {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
  }
  .bg-brown.bg-opacity-10 {
    background-color: rgba(139,94,60,0.1) !important;
  }
  .spinner-border.text-brown {
    border-color: #8B5E3C !important;
  }
</style>
@endpush
