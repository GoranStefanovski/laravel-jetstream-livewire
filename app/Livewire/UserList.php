<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public $users = [];

    public function mount()
    {
        $this->users = User::with('roles')->get()->toArray();
    }

    public function deleteUser($userId)
    {
        User::findOrFail($userId)->delete();
        session()->flash('message', 'User deleted successfully!');
        $this->mount();
    }
    

    public function render()
    {
        return view('livewire.user-list');
    }
}
