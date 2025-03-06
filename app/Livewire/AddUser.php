<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AddUser extends Component
{
    public $name, $email, $password, $role;

    public function addUser()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        $user->assignRole($this->role);

        session()->flash('message', 'User added successfully!');
        $this->redirect('/users', navigate: true);
    }

    public function render()
    {
        return view('livewire.add-user', [
            'roles' => Role::all()
        ]);
    }
}
