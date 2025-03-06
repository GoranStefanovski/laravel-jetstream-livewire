<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class ListView extends Component
{
    public $items = [];
    public $search = '';
    public $suggestions = [];

    public function updatedSearch()
    {
        if (!empty($this->search)) {
            $this->suggestions = Item::where('name', 'like', '%' . $this->search . '%')->get()->toArray();
        } else {
            $this->suggestions = [];
        }
    }

    public function mount()
    {
        $this->items = Item::with('image')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.list-view');
    }
}
