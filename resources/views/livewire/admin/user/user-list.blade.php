<div>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="fw-bold mb-1">Manajemen Pengguna</h2>
      <p class="text-muted mb-0">Kelola akses admin dan operator</p>
    </div>
    <a href="{{ route('admin.users.create') }}" wire:navigate class="btn btn-primary d-flex align-items-center gap-2">
      <iconify-icon icon="mingcute:add-fill" width="16"></iconify-icon>
      <span>Tambah Pengguna</span>
    </a>
  </div>

  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-8">
          <input type="text" wire:model.live.debounce.300ms="search" class="form-control" placeholder="Cari nama atau email...">
        </div>
        <div class="col-md-4">
          <select wire:model.live="role" class="form-select">
            <option value="">Semua Role</option>
            <option value="admin">Admin</option>
            <option value="operator">Operator</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <div wire:loading class="text-center py-5">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"></div>
  </div>

  <div wire:loading.remove>
    @if($users->count())
    <div class="row g-4">
      @foreach($users as $user)
      <div class="col-md-6 col-lg-4">
        <div class="card product-card border-0 shadow-sm h-100">
          <div class="card-body text-center">
            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
              <iconify-icon icon="solar:user-bold" class="text-primary" style="font-size: 2.5rem;"></iconify-icon>
            </div>
            
            <h5 class="fw-bold mb-2">{{ $user->name }}</h5>
            <p class="text-muted mb-3">{{ $user->email }}</p>
            
            <span class="badge {{ $user->isAdmin() ? 'bg-primary' : 'bg-success' }} mb-3">
              {{ ucfirst($user->role) }}
            </span>
            
            @if($user->id == auth()->id())
            <p class="text-muted small">(Akun Anda)</p>
            @endif
            
            <div class="d-flex gap-2 mt-3">
              <a href="{{ route('admin.users.edit', $user->id) }}" wire:navigate class="btn btn-sm btn-primary flex-grow-1">
                <iconify-icon icon="solar:pen-linear" width="18"></iconify-icon> Edit
              </a>
              @if($user->id != auth()->id())
              <button wire:click="confirmDelete({{ $user->id }})" class="btn btn-sm btn-light text-danger">
                <iconify-icon icon="solar:trash-bin-minimalistic-linear" width="18"></iconify-icon>
              </button>
              @endif
            </div>
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