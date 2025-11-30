<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class UserCreate extends Component
{
    public $name, $email, $password, $password_confirmation, $role = 'operator';

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,operator',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);
        $this->dispatch('success', message: 'Pengguna berhasil ditambahkan!');
        return $this->redirect(route('admin.users.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.user.user-form');
    }
}
