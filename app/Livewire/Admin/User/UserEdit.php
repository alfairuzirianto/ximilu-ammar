<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class UserEdit extends Component
{
    public $userId, $name, $email, $password, $password_confirmation, $role;

    public function mount($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:admin,operator',
        ];
    }

    public function update()
    {
        $validated = $this->validate();
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        User::find($this->userId)->update($validated);
        $this->dispatch('success', message: 'Pengguna berhasil diperbarui!');
        return $this->redirect(route('admin.users.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.user.user-form');
    }
}
