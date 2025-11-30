<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    #[Url(as: 'cari')]
    public $search = '';
    
    #[Url(as: 'role')]
    public $role = '';

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingRoleFilter() { $this->resetPage(); }

    public function confirmDelete($id)
    {
        if ($id == auth()->id()) {
            $this->dispatch('error', message: 'Tidak dapat menghapus akun sendiri!');
            return;
        }
        $this->dispatch('confirm-delete', id: $id, message: 'User akan dihapus permanen!');
    }

    #[\Livewire\Attributes\On('delete-confirmed')]
    public function delete($id)
    {
        User::find($id)?->delete();
        $this->dispatch('success', message: 'User berhasil dihapus!');
    }

    public function render()
    {
        $query = User::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
        }
        if ($this->role) $query->where('role', $this->role);

        return view('livewire.admin.user.user-list', [
            'users' => $query->latest()->paginate(9)
        ]);
    }
}
