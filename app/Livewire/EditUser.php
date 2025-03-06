<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EditUser extends Component
{
    public $userId;
    public $name;
    public $email;
    public $password;
    public $role;

    public function mount($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->pluck('name')->first();  // Get current role
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId,
            'password' => 'nullable|min:6',
            'role' => 'required'
        ]);

        $user = User::findOrFail($this->userId);
        $user->name = $this->name;
        $user->email = $this->email;

        if (!empty($this->password)) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        // Update role
        if ($user->roles->pluck('name')->first() !== $this->role) {
            $user->syncRoles([$this->role]);
        }

        session()->flash('message', 'User updated successfully!');
        $this->redirect('/users', navigate: true);
    }

    public function render()
    {
        return view('livewire.edit-user', [
            'roles' => Role::all()
        ]);
    }
}
